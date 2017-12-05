<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis as Redis;
use DB;
class RedisController extends Controller{

		//登录
	public function login(){
		$username = Input::get('username');
		$password = Input::get('password');
		$user = DB::table('user')->where('username',$username)->first();
		if(empty($user)){
			exit('用户不存在');
		}
		if($user['password'] != $password){
			exit('密码错误');
		}
		session(['uid'=>$user['uid']]);
		return redirect('Redis/add');
	}

	//添加日程
	public function add(){
		$uid = session('uid');
		if(!$uid){
			return Redirect('Redis/login');
		}
		$data = Input::get();
		$arr['uid'] = $uid;
		$arr['rcontent'] = $data['content'];
		$arr['rtime'] = $data['time'];
		$arr['static'] = $data['static'];
		$flag = DB::table('richeng')->insert($arr);
		if(!$flag){
			exit('入库失败');
		}
		if($arr['static']==1){
			Redis::lpush('richeng',serialize($arr));
		}
		return redirect('Redis/add');
	}
}
?>