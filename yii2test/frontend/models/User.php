<?php

namespace frontend\models;

use yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord{
	public static function tableName()
    {
        return 'user';
    }
}
?>