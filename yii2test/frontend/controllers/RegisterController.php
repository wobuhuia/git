<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\models\register\Register;
class RegisterController extends Controller{
	public static $param;

	public function actionRegister(){
		$data = Yii::$app->request->post();
		if($data){
			unset($data['_csrf-frontend']);
			foreach ($data as $key => $value) {
				self::$param[$key] = $value;
			}
			return $this->redirect(['register/register2']);
		}else{
			return $this->render('register',['arr'=>self::$param]);
		}
	}

	public function actionRegister2(){
		$data = Yii::$app->request->post();
		if($data){
			unset($data['_csrf-frontend']);

			foreach ($data as $key => $value) {
				self::$param[$key] = $value;
			}
			return $this->redirect(['register/register3']);
		}else{
			return $this->render('register_2',['arr'=>self::$param]);
		}
	}

	public function actionRegister3(){
		$data = Yii::$app->request->post();
		if($data){
			unset($data['_csrf-frontend']);
			foreach ($data as $key => $value) {
				self::$param[$key] = $value;
			}
			self::$param['hobby'] = implode(',',self::$param['hobby']);
			$registerObj = new Register;
			foreach (self::$param as $key => $value) {
				$registerObj->$key = $value;
			}
			$registerObj->save();
		}else{
			return $this->render('register_3');
		}
	}
}
?>