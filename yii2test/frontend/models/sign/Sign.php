<?php

namespace frontend\models\sign;

use yii;
use yii\db\ActiveRecord;

class Sign extends ActiveRecord{
	public static function tableName()
    {
        return 'sign';
    }
}
?>