<?php
use yii\helpers\html;
use yii\helpers\url;
?>
<?= Html::beginForm(Url::to(['student/index']), 'post'); ?>
username
<?= Html::input('text', 'username') ?>
<?= Html::tag('br') ?>
password
<?= Html::input('password', 'password') ?>
<?= Html::tag('br') ?>
<?= Html::submitButton('Submit') ?>
<?= Html::endForm(); ?>