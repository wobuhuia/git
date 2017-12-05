<?php
namespace frontend\controllers;

use Yii;
use yii\web\controller;
use frontend\models\User;
use frontend\models\sign\Date;
use frontend\models\sign\Sign;

class SignController extends Controller{
	public function actionLogin(){
		$data = Yii::$app->request->post();
		if($data){

			$user = new User;//实例化表

			//查询用户
			$arr = $user->find()
    				->where(['username' => $data['username']])
    				->asArray()
    				->one();

			//判断用户信息
    		if(!$arr){
    			exit('用户名不存在');
    		}
    		if($arr['password'] != $data['password']){
    			exit('密码错误');
    		}

    		//存session
    		$session = Yii::$app->session;
    		$userStr = serialize($arr);
    		$session->set('user', $userStr);

    		//重定向
    		return $this->redirect(['sign/sign']);

		}else{

			//进登陆页
			return $this->render('login');
		}
	}

	public function actionSign($id = ''){
		$session = Yii::$app->session;
		$userStr = $session->get('user');
		$user = unserialize($userStr);

		//判断日期表是否有数据
		$signObj = new Sign;
		$dateObj = new Date;

		$time = $dateObj->find()
    				->where(['date' => date('Y-m-d')])
    				->asArray()
    				->one();
    	$sign = $sign->find()
    				->where(['uid' => $user['uid']])
    				->asArray()
    				->one();

    	if(!$time){
    		$dateObj->delete();
    		for ($i=0; $i < 90; $i++) {
    			$dateObj->date = date('Y-m-d',time()+(60*60*24*$i));
    			if(!$dateObj->insert()){
    			 	exit("添加日期失败");
    			}
    		}
    	}

    	if(!$sign){
    		$where = 'uid = '.$user['uid'].' and tid'
    		$signObj->delete('uid = '.$user['uid']);

    	}




		if($id){

		}else{

			return $this->render('sign',['user'=>$user]);
		}
	}
}
?>