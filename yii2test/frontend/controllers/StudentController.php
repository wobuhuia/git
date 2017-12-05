<?php 
namespace frontend\controllers;

use yii;
use yii\web\controller;
use frontend\models\Student;
use frontend\models\User;
use frontend\models\Ban;
use yii\data\Pagination;
use DfaFilter\SensitiveHelper;

class StudentController extends controller{

	//登录
	public function actionIndex(){
		$user = new User;
		$session = Yii::$app->session;

		//接值
		$data = Yii::$app->request->post();

		if(!empty($data) || !empty($data['username'])){

			unset($data['_csrf-frontend']);

			$arr = $user->find()
    				->where(['username' =>$data['username']])
    				->asArray()
    				->one();

    		//判断用户信息
    		if(!$arr){
    			exit('用户名不存在');
    		}
    		if($arr['password'] != $data['password']){
    			exit('密码错误');
    		}

    		//判断session是否开启
    		if (!$session->isActive) $session->open();

    		$session->set('uid', $arr['uid']);
    		return $this->redirect(['student/add']);
		}else{

			return $this->render('index');
		}
	}

	//添加
	public function actionAdd(){
		$session = Yii::$app->session;
		$uid = $session->get('uid');

		//判断是否登录
		if(!$uid){
			return $this->redirect(['student/index']);
		}

		$content = Yii::$app->request->post('content');//接值
		$ban = new Ban;//实例化表

		if($content){

			//入库
			$wordData = array(
			    '杨兴国',
			);
			$content = SensitiveHelper::init()->setTree($wordData)->replace($content, '***');
			$ban->uid = $uid;
			$ban->content = $content;
			if(!$ban->save()){
				exit('入库失败');
			}
			return $this->redirect(['student/add']);
		}else{

			$user = new User;//实例化表

		    $query = $ban->find()->orderBy('id');
		    $countQuery = clone $query;
		    $pages = new Pagination(['totalCount' => $countQuery->count()]);
		    $pages->pageSize=2;
		    $arr = $query->offset($pages->offset)
		        ->limit($pages->limit)
		        ->all();
			$userArr = $user->find()
				->asArray()
				->all();

			//处理数组
			foreach ($userArr as $key => $value) {
				$res[$value['uid']]=$value['username'];
			}
			foreach ($arr as $key => &$value) {
				if(!empty($value['uid'])){
					$value['uid'] = $res[$value['uid']];
				}
			}

			return $this->render('add',['arr'=>$arr,'pages'=>$pages]);
		}
	}

	public function actionDel($id){
		$ban = new Ban;
		$ban = $ban->findOne($id);
		$flag = $ban->delete();
		if(!$flag){
			exit('删除失败');
		}
		return $this->redirect(['student/add']);
	}

	public function actionSave($id = ''){

		$ban = new Ban;
		if(!empty($id)){

			$arr = $ban->find()
				->where(['id'=>$id])
				->asArray()
				->one();
			return $this->render('update',['arr'=>$arr]);
		}else{
			$id = Yii::$app->request->post('id');
			$ban = $ban->findOne($id);
			$ban->content = Yii::$app->request->post('content');
			$flag = $ban->save();
			if(!$flag){
				exit('修改失败');
			}
			return $this->redirect(['student/add']);
		}
	}
}
?>