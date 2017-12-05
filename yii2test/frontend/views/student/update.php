<?php
use yii\helpers\html;
use yii\helpers\url;

echo Html::tag('h3','留言板');
echo Html::beginForm(Url::to(['student/save']), 'post');
echo Html::tag('textarea',$arr['content'],['name'=>'content']);
echo Html::input('hidden','id',$arr['id']);
echo Html::tag('br');
echo Html::submitButton('修改');
echo Html::endForm();