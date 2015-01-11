<h1>場所登録フォーム</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<br>

<?php
	echo $this->Form->create('Place',array('type' => 'post', 'action' => 'add'));
	echo '名前：' . $this->Form->text('Place.name');
	echo $this->Form->error('Place.name');
	echo 'コメント：' . $this->Form->textarea('Place.comment');
	echo $this->Form->error('Place.comment');
	echo $this->Form->end("送信");
?>
