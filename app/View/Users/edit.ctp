<h1>edit Users</h3>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>
<?php
echo "<tr><td>名前</td><td>{$data[0]['User']['username']}</td></tr>";
?>
</table>

<?php
echo $this->Form->create('User',array('type' => 'post' , 'action' => 'edit'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Edit');
?>