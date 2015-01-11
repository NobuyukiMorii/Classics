<h1>場所情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<?php
echo "<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$data[0]['Place']['id']}>閲覧する</a>";
?>


<?php
	$arr = $data[0];
	echo $this->Form->create('Place',array('type' => 'post', 'action' => 'add'));
	echo '名前：' . $this->Form->text('Place.name' , array('value' => $arr['Place']['name']));
	echo $this->Form->error('Place.name');
	echo 'コメント：' . $this->Form->textarea('Place.comment' , array('value' => $arr['Place']['comment']));
	echo $this->Form->error('Place.comment');
	echo $this->Form->end("送信");
?>
