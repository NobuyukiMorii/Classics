<h1>edit Users</h3>

<?php
echo $this->Form->create('User',array('type' => 'post' , 'action' => 'edit'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Edit');
?>