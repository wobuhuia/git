<?php

namespace frontend\models\login;

use yii;
use yii\db\ActiveRecord;

class Login extends ActiveRecord{
	public static function tableName()
    {
        return 'register';
    }
}
?>