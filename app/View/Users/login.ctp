<?php
if($this->Session->check('Message.auth'))
echo $this->Session->flash('auth');

echo $this->Form->create('User',array('action' => 'login'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Login');

?>

<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'add')); ?> >※ユーザー登録する</a>