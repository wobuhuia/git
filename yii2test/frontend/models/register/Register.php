<?php

namespace frontend\models\register;

use yii;
use yii\db\ActiveRecord;

class Register extends ActiveRecord{
	public static function tableName()
    {
        return 'register';
    }
}
?>