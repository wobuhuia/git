<?php
use yii\helpers\html;
use yii\helpers\url;
use yii\widgets\LinkPager;

echo Html::tag('h3','留言板');
echo Html::beginForm(Url::to(['student/add']), 'post');
echo Html::tag('textarea','',['name'=>'content']);
echo Html::tag('br');
echo Html::submitButton('Submit');
echo Html::endForm();
echo Html::tag('br');

echo Html::beginTag('table');
	echo Html::beginTag('tr');
		echo Html::Tag('th','id');
		echo Html::Tag('th','留言人');
		echo Html::Tag('th','留言内容');
		echo Html::Tag('th','操作');
	echo Html::endTag('tr');
	foreach ($arr as $key => $value) {
		echo Html::beginTag('tr');
			echo Html::Tag('td',$value['id']);
			echo Html::Tag('td',$value['uid']);
			echo Html::Tag('td',$value['content']);
			echo Html::beginTag('td');
				echo Html::Tag('a','删除',['href'=>Url::to(['student/del','id'=>$value['id']])]);
				echo '-';
				echo Html::Tag('a','修改',['href'=>Url::to(['student/save','id'=>$value['id']])]);
			echo Html::endTag('td');
		echo Html::endTag('tr');
	}
echo Html::endTag('table');
echo LinkPager::widget(['pagination' => $pages]);
?>

