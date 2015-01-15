<h1>ユーザー詳細情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>
<?php
echo "<tr>
		<td>画像</td><td>" .  $this->Upload->uploadImage($data_user[0], 'User.avatar', array('style' => 'thumb')) . "</td>
		<td>ユーザー名</td><td>{$data_user[0]['User']['username']}</td>
	</tr>";
?>
</table>

<table>
<?php
for($i = 0; $i < count($data_place); $i++){
	echo "<tr>
			<td>
				<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$data_place[$i]['Place']['id']}>{$data_place[$i]['Place']['name']}</a>
			</td>
		  </tr>";
}
?>
</table>