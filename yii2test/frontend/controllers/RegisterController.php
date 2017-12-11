<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\models\register\Register;
class RegisterController extends Controller{

	public function actionRegister(){
		$session = Yii::$app->session;
		$data = Yii::$app->request->post();
		$arr = json_decode($session->get('data'),true);
		if(!$arr){
			$arr = array(
				'username'=>'',
				'password'=>'',
				'phone'=>'',
				'hobby'=>'',
				'date'=>'',
				'address'=>''
			);
		}
		if($data){
			unset($data['_csrf-frontend']);
			foreach ($data as $key => $value) {
				$arr[$key] = $value;
			}
			$session->set('data',json_encode($arr));
			return $this->redirect(['register/register2']);
		}else{
			return $this->render('register',['arr'=>$arr]);
		}
	}

	public function actionRegister2(){
		$session = Yii::$app->session;
		$arr = json_decode($session->get('data'),true);
		$data = Yii::$app->request->post();
		if($data){
			unset($data['_csrf-frontend']);
			foreach ($data as $key => $value) {
				$arr[$key] = $value;
			}
			$session->set('data',json_encode($arr));
			return $this->redirect(['register/register3']);
		}else{
			return $this->render('register_2',['arr'=>$arr]);
		}
	}

	public function actionRegister3(){
		$session = Yii::$app->session;
		$data = Yii::$app->request->post();
		$arr = json_decode($session->get('data'),true);
		if($data){
			unset($data['_csrf-frontend']);
			$arr['hobby'] = implode(',',$data['hobby']);
			$session->set('data',json_encode($arr));
			$registerObj = new Register;
			foreach ($arr as $key => $value) {
				$registerObj->$key = $value;
			}
			$registerObj->save();
		}else{
			return $this->render('register_3');
		}
	}
}
?>