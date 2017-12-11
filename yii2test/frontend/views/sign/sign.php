<?php
use yii\helpers\Url;
?>
<h3>欢迎<?=$user['username']?>登陆</h3>
金币:<?=$user['gold_sum']?><br>
连续登陆：<?=$user['day_sum']?>天<br>
日期：<?=date('Y-m-d')?>
<?php if( date('Y-m-d')!=$user['lastsigntime'] ){?>
<a href="<?= Url::to(['sign/sign'])?>">签到</a>
<?php }else{?>
已签
<?php }?>
<br>
<br>
<br>
<h2>补签（十天之内 补一天扣金币100）</h2>
<ul>
	<?php foreach ($sign as $key => $value): ?>
		<li>
			<?=$value['date']?>
			<a href="<?= Url::to(['sign/update','id'=>$value['id']])?>"> 补签</a>
		</li>
	<?php endforeach ?>
</ul>
