<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB,Redirect;
class StudentsController extends Controller{

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
		session(['uid'=> $user['uid']]);
		return redirect('show');
	}

	//查询评论
	public function show(){

		//查表
		$liuArr = DB::table('liuyanban')->paginate(2);;
		$userArr = DB::table('user')->get();

		//处理数组
		foreach ($userArr as $key => $value) {
			if(!empty($value['uid'])){
				$res[$value['uid']] = $value['username'];
			}
		}
		foreach ($liuArr as $key => $val) {
			$val['uid'] = $res[$val['uid']];
			$arr[$key] = $val;
		}
		return view('students.add',['link'=>$liuArr,'arr'=>$arr]);
	}

	//添加评论
	public function add(){
		$uid = session('uid');
		if(!$uid){
			return Redirect('/');
		}
		$content = Input::get('content');
		$arr['content'] = $content;
		$arr['uid'] = $uid;
		$flag = DB::table('liuyanban')->insert($arr);
		if(!$flag){
			exit('入库失败');
		}
		return redirect('show');
	}

	//删除
	public function del($id){
		$flag = DB::table('liuyanban')->where('id',$id)->delete();
		if(!$flag){
			exit('删除失败');
		}
		return redirect('show');
	}

	//展示修改数据
	public function save($id){
		$arr = DB::table('liuyanban')->where('id',$id)->first();
		return view('students.save',['arr'=>$arr]);
	}

	//修改 do
	public function save_act(){
		$arr['content'] = Input::get('content');
		$id = Input::get('id');
		$flag = DB::table('liuyanban')->where('id',$id)->update($arr);
		if(!$flag){
			exit('修改失败');
		}
		return redirect('show');
	}

}
?>