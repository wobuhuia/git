<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Ban;
use yii\web\controller;
class TwoController extends Controller{
	public function actionShow(){
		$ban = new Ban;
		$arr = $ban->find()->asArray()->all();
		return $this->render('show',['arr'=>$arr]);
	}

	public function actionIndex(){
		$content = Yii::$app->request->post('content');
		if($content){
			$ban = new Ban;
			$ban->content = $content;
			$flag = $ban->save();
			if(!$flag){
				exit("添加失败");
			}
			return $this->redirect(['two/show']);
		}else{
			return $this->render('add');
		}
	}
}
?>