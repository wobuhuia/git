<table>
	<tr>
		<th>id</th>
		<th>content</th>
	</tr>
	<?php foreach ($arr as $key => $value) {?>
	<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['content']?></td>
	</tr>
	<?php }?>
</table>