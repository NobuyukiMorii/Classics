<h1>ユーザー詳細情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<a href="javascript:history.back();">一つ前のページへ戻る</a>

<table>

<p>ユーザー情報<p>
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

<p>場所情報</p>
<table>
<?php
for($i = 0; $i < count($data_place); $i++){
	echo "<tr>";
	if($data_place[$i]['Place']['avatar_file_name'] != null){
		echo "<td>" . $this->Upload->uploadImage($data_place[$i], 'Place.avatar', array('style' => 'thumb')) . "</td>";  
	} else {
		echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";  
	}
	echo 
		"<td>
			<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$data_place[$i]['Place']['id']}>{$data_place[$i]['Place']['name']}</a>
		</td>";
	echo "<td>{$data_place[$i]['Place']['wifi_average_speed']}</td>";
	echo "<td>{$data_place[$i]['Place']['payment_average']}</td>";
	echo "</tr>";
}
?>
</table>

</p>投稿情報</p>
<table>
<?php
for($i = 0; $i < count($data_post); $i++){
	echo "<tr>";
		if($data_post[$i]['Post']['avatar_file_name'] != null){
			echo "<td>" . $this->Upload->uploadImage($data_post[$i], 'Post.avatar', array('style' => 'thumb')) . "</td>";
		} else {
			echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
		}  
		echo "<td>{$data_post[$i]['Post']['created']}</td>";
		echo "<td>{$data_post[$i]['Post']['comment']}</td>";
		echo "<td>{$data_post[$i]['Post']['wifi_speed']}</td>";
		echo "<td>{$data_post[$i]['Post']['payment']}</td>";
		echo "<td>{$data_post[$i]['Post']['time_zone']}</td>";
	echo "</tr>";
}
?>
</table>