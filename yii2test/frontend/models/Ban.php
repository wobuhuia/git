<?php

namespace frontend\models;

use yii;
use yii\db\ActiveRecord;

class Ban extends ActiveRecord{
	public static function tableName()
    {
        return 'liuyanban';
    }
}
?>