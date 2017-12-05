<?php
use yii\helpers\url;
?>
<form action="<?= url::to(['sign/login'])?>" method="post">
	<table border=1px>
		<tr>
			<td>username</td>
			<td>
				<input type="text" name="username">
			</td>
		</tr>
		<tr>
			<td>password</td>
			<td>
				<input type="text" name="password">
			</td>
		</tr>
		<tr>
			<td>
				<input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
			</td>
			<td>
				<input type="submit" value="登陆">
			</td>
		</tr>
	</table>
</form>