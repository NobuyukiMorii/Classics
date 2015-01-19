<h1>ユーザー詳細情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<a href="javascript:history.back();">一つ前のページへ戻る</a>

<table>
<?php
echo "<tr>";
echo "<td>名前</td><td>{$data[0]['User']['username']}</td>";
if($data[0]['User']['avatar_file_name'] != null){
	echo "<td>画像</td><td>" .  $this->Upload->uploadImage($data[0], 'User.avatar', array('style' => 'thumb')) . "</td>";
} else {
	echo "<td>画像</td><td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
}
echo "</tr>";
?>
</table>

<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'edit')); ?> >プロフィールを変更する</a>