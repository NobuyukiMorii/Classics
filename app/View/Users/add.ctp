<?php echo $this->Form->create('User', array('class' => 'form-horizontal' , 'type' => 'file' , 'action' => 'add')); ?>
	<fieldset>
		<legend>アカウント作成</legend>
		<?php echo $this->Form->input('User.username', array(
			'label' => 'ユーザー名',
			'type' => 'text',
			'class' => 'input-xlarge'
		)); ?>
		<?php echo $this->Form->error('User.username');?>

		<?php echo $this->Form->input('User.password', array(
			'label' => 'パスワード',
			'type' => 'text',
			'class' => 'input-xlarge'
		)); ?>
		<?php echo $this->Form->error('User.password');?>

		<?php echo $this->Form->input('avatar',array('type'=>'file' , 'label' => ''));?>

		<div class="form-actions">
			<?php echo $this->Form->submit('登録する', array(
				'div' => false,
				'class' => 'btn btn-primary',
			)); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>

<button class="btn btn-success" id="JampToLogin" style="margin-top: 20px;">ログイン画面に戻る</button>

<?php echo $this->Html->script('jquery-1.11.2.min'); ?>
<script>
//新規登録ボタンが押されたら、User.addページに遷移する
$(document).ready(function(){
	$('#JampToLogin').click(function(){
	  	window.location.href = 'http://' + location.host + '/classics/Users/login';
	  	console.log('http://' + location.host + '/Classics/Users/login');
	});
});
</script>