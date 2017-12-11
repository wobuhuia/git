<?php
namespace frontend\controllers;

use Yii;
use yii\web\controller;
use frontend\models\User;
use frontend\models\sign\Sign;

class SignController extends Controller{

    private $userObj;
    private $signObj;
    private $session;

    public function init(){
        $this->signObj = new Sign;
        $this->userObj = new User;
        $this->session = Yii::$app->session;
    }

    //登陆
	public function actionLogin(){
		$data = Yii::$app->request->post();
		if($data){

			//查询用户
			$user = $this->userObj->find()
    				->where(['username' => $data['username']])
    				->asArray()
    				->one();

			//判断用户信息
    		if(!$user) exit('用户名不存在');
    		if($user['password'] != $data['password']) exit('密码错误');

    		//存session
    		$this->session->set('uid', $user['uid']);

            //判断是不是第一次登陆
            if( $user['lastsigntime'] ){

                //计算距上次签到有多久
                $diff = strtotime(date('Y-m-d')) - strtotime($user['lastsigntime']);

                //如果已经断更 
                if( $diff > 3600*24 ){

                    //跟新用户信息
                    $_userObj = clone $this->userObj;
                    $_userObj = $_userObj->findOne(['uid' => $user['uid']]);
                    $_userObj->day_sum = 0;
                    $_userObj->save();

                    //将未签天数入库
                    $i=1;//天数
                    while( $diff > 3600*24 ){
                        $_signObj = clone $this->signObj;
                        $time = strtotime($user['lastsigntime']) + 3600*24*$i;
                        $_signObj->date = date('Y-m-d',$time);
                        $_signObj->uid = $user['uid'];
                        $_signObj->insert();
                        $diff = $diff - 3600*24;
                        $i++;
                    }
                }
            }

    		//重定向
    		return $this->redirect(['sign/show']);

		}else{

			//进登陆页
			return $this->render('login');
		}
	}

	public function actionSign(){
		$uid = $this->session->get('uid');

        //判断非法登陆
        if(!$uid){
            exit('请先登陆');
        }

        //查询用户表
        $user = $this->userObj->find()
                ->where(['uid' => $uid])
                ->asArray()
                ->one();

        //入明细表做准备 签到
        $sign['date'] = date('Y-m-d');
        $sign['static'] = '1';
        $sign['uid'] = $user['uid'];

        //更新天数
        $user['day_sum']++;
		
        //判断连续签到的天数 更新金币
        if($user['day_sum'] >= 5){
            $user['gold_sum'] = $user['gold_sum'] + 5;
            $sign['sanction'] = 5;

            //每连续满60天加100金币
            if($user['day_sum'] % 60 == 0){
                $user['gold_sum'] = $user['gold_sum'] + 100;
                $sign['sanction'] = $sign['sanction'] + 100;
            }
        }else{
            $user['gold_sum'] = $user['gold_sum'] + $user['day_sum'];
            $sign['sanction'] = $user['day_sum'];
        }

        //跟新最后一次签到时间
        $user['lastsigntime'] = $sign['date'];

        //入明细表 签到
        $_signObj = clone $this->signObj;
        foreach ($sign as $key => $value) {
            $_signObj->$key = $value;
        }
        $_signObj->insert();

        //更新用户数据
        $_userObj = clone $this->userObj;
        $_userObj = $_userObj->findOne(['uid'=>$user['uid']]);
        foreach ($user as $key => $value) {
            $_userObj->$key = $value;
        }
        $_userObj->update();

        return $this->redirect(['sign/show']);
	}

    public function actionShow(){
        $uid = $this->session->get('uid');

        //判断非法登陆
        if(!$uid){
            exit('请先登陆');
        }

        //查询用户
        $res = $this->userObj->find()
                ->where(['uid' => $uid])
                ->asArray()
                ->one();

        //计算十天前的日期
        $date = strtotime(date('Y-m-d'))-3600*240;
        $date = date('Y-m-d',$date);

        //查询可以补签的详情
        $arr = $this->signObj->find()
                ->where(['and',['uid'=>$uid],['static'=>0],['>=','date',$date]])
                ->asArray()
                ->all();
        return $this->render('sign',['user'=>$res,'sign'=>$arr]);
    }


    public function actionUpdate($id){
        $uid = $this->session->get('uid');

        //判断非法登陆
        if(!$uid){
            exit('请先登陆');
        }

        //查询用户
        $user = $this->userObj->find()
                ->where(['uid' => $uid])
                ->asArray()
                ->one();

        //判断钱够不够
        if( ! ($user['gold_sum'] >= 100) ){
            exit('金币不足');
        }

        //修改详情表
        $_signObj = clone $this->signObj;
        $_signObj = $_signObj->findOne(['id'=>$id]);
        $_signObj->static = 2;
        $_signObj->sanction = 0-100;
        $_signObj->save();

        //计算连续签到天数
        $oneDay = $this->signObj->find()
                        ->where(['or',['uid'=>$uid,'static'=>0],['sanction'=>105]])
                        ->orderBy('date desc')
                        ->asArray()
                        ->one();
        if($oneDay){
            $where = ['and',['uid'=>$uid],['!=','static','0'],['>','date',$oneDay['date']]];
        }else{
            $where = ['and',['uid'=>$uid],['!=','static','0']];
        }
        $day_sum = $this->signObj->find()
                        ->where(['or',$where])
                        ->asArray()
                        ->count();

        /*如果连续天数大于60天就将奖励的100 gold 加给今天
         如果还未签到就直接签了*/
        if($day_sum>=60){
            $_signObj = clone $this->signObj;
            $_signObj = $_signObj->findOne('date = '.date('Y-m-d').' and uid = '.$uid);
            $_signObj->date = date('Y-m-d');
            $_signObj->uid = $uid;
            $_signObj->static = 1;
            $_signObj->sanction = 105;
            $_signObj->save();
        }

        //跟新用户信息
        $_userObj = clone $this->userObj;
        $_userObj = $_userObj->findOne(['uid'=>$uid]);
        if($day_sum>=60){
            $_userObj->gold_sum = $user['gold_sum']+5;
            $_userObj->lastsigntime = date('Y-m-d');
        }else{
            $_userObj->gold_sum = $user['gold_sum']-100;
        }
        $_userObj->day_sum = $day_sum;
        $_userObj->save();

        return $this->redirect(['sign/show']);
    }
}
?>