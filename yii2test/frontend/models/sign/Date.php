<?php

namespace frontend\models\sign;

use yii;
use yii\db\ActiveRecord;

class Date extends ActiveRecord{
	public static function tableName()
    {
        return 'date';
    }
}
?>