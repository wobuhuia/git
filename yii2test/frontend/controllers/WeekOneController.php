<?php
namespace frontend\controllers;
use Yii;
use yii\web\controller;
use frontend\models\weekOne\Field;
class WeekoneController extends Controller{
	
	public function actionIndex(){
		$field = new Field;
		$arr = $field->find()->orderBy('field_id')->asArray()->all();
		return $this->render('index',['arr'=>$arr]);
	}

	public function actionAdd(){

		//实例化表
		$field = new Field;

		$id = Yii::$app->request->get('id');
		$data = Yii::$app->request->post();
		
		//处理数组
		if($data){
			$data['field_num'] = $data['smail'].'~'.$data['big'];

			//删除多余字段
			unset($data['smail']);
			unset($data['big']);
			unset($data['_csrf-frontend']);
			$field_id = $data['id'];
			unset($data['id']);

			if($field_id){
				$field = $field->findOne(['field_id'=>$field_id]);
			}

			foreach ($data as $key => $value) {
				$field->$key = $value;
			}
		    $flag = $field->save();

		}else{
			if($id){
				$arr = $field->find()
						->where(['field_id'=>$id])
						->asArray()
						->one();
				$res = explode('~',$arr['field_num']);
				$arr['smail'] = $res[0];
				$arr['big'] = $res[1];
				return $this->render('add',['arr'=>$arr]);
			}else{
				return $this->render('add',['arr'=>'']);
			}
		}

		//添加修改成功 跳转展示页面
		if($flag){
			return $this->redirect(['weekone/index']);
		}

		exit('失败');
	}

	public function actionDel($id){
		$field = new field;
		$field = $field->findOne(['field_id'=>$id]);
		$flag = $field->delete();
		if(!$flag){
			exit('删除失败');
		}
		return $this->redirect(['weekone/index']);
	}
}
?>