<?php echo $this->Form->create('User', array('class' => 'form-horizontal' , 'type' => 'file' , 'action' => 'edit')); ?>
	<fieldset>
		<legend>プロフィール編集</legend>
		<?php echo $this->Form->input('User.username', array(
			'label' => 'ユーザー名',
			'type' => 'text',
			'class' => 'input-xlarge',
			'default' => $data[0]['User']['username'],
			'required' => false
		)); ?>

		<?php echo $this->Form->input('User.password', array(
			'label' => 'パスワード',
			'type' => 'text',
			'class' => 'input-xlarge',
			'required' => false
		)); ?>

		<?php echo $this->Form->input('avatar',array('type'=>'file' , 'label' => ''));?>

		<div class="form-actions">
			<?php echo $this->Form->submit('登録する', array(
				'div' => false,
				'class' => 'btn btn-primary',
			)); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>