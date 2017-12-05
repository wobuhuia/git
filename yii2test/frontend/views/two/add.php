<?php
use yii\helpers\Html;
use yii\helpers\Url;
echo Html::beginForm(Url::to(['two/index']), 'post');
echo Html::input('text', 'content');
echo Html::submitButton('添加');
echo Html::endForm();
?>