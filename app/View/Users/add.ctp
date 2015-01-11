<h1>add Users</h3>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<?php
echo $this->Form->create('User',array('action' => 'add'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Add');
?>