<h1>ユーザー詳細情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<a href="javascript:history.back();">一つ前のページへ戻る</a>

<table>
<?php
echo "<tr>";
echo "<td>ユーザー名</td><td>{$data_user[0]['User']['username']}</td>";
if($data_user[0]['User']['avatar_file_name'] != null){
	echo "<td>" .  $this->Upload->uploadImage($data_user[0] , 'User.avatar', array('style' => 'thumb')) . "</td>";
} else {
	echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
}
echo "</tr>";
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