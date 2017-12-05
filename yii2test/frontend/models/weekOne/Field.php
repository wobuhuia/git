<?php

namespace frontend\models\weekOne;

use yii;
use yii\db\ActiveRecord;

class Field extends ActiveRecord{
	public static function tableName()
    {
        return 'field';
    }
}
?>