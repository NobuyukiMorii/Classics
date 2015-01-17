<h1>edit Users</h3>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>
<?php
echo "<tr>";
echo "<td>名前</td><td>{$data[0]['User']['username']}</td>";
if(isset($data[0]['User']['avatar_file_name'])) {
	echo "<td>画像</td><td>" .  $this->Upload->uploadImage($data[0], 'User.avatar', array('style' => 'thumb')) . "</td>";
} else {
	echo "<td>画像</td><td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
}
echo "</tr>";
?>
</table>

<?php
echo $this->Form->create('User',array('type' => 'file' , 'action' => 'edit'));
echo $this->Form->input('username' , array('default' => $data[0]['User']['username']));
echo $this->Form->input('password');
echo $this->Form->input('avatar',array('type'=>'file','label'=>'写真'));
echo $this->Form->end('Edit');
?>