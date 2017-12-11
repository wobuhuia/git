<?php
namespace frontend\controllers;

use Yii;
use yii\web\controller;
use frontend\models\login\Login;

class LoginController extends Controller{
	public $enableCsrfValidation = false;
	public function actionIndex(){
		return $this->render('login');
	}

	public function actionLogin(){
		$session = Yii::$app->session;
		$userObj = new Login;
		$data = Yii::$app->request->post();
		// 返回ID为1的客户：
		$arr = $userObj->find()
		    ->where(['phone' => $data['phone']])
		    ->asArray()
		    ->one();
		if($arr['password']!=$data['pwd']){
			$errorSum = $session->get('error');
			if($errorSum<3) $errorSum++;
			$session->set('error',$errorSum);
			echo json_encode(array('static'=>0,'errorSum'=>$errorSum));
		}else{
			echo json_encode(array('static'=>1));
		}
	}

}
?>