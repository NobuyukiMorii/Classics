<!-- ラジオボタンを横並びに設定 -->
<?php echo $this->Html->css( 'radio-horizon'); ?>

<?php echo $this->Form->create('Place', array('class' => 'form-horizontal' , 'type' => 'file' , 'action' => 'add')); ?>
	<fieldset>
		<legend>お店情報登録フォーム</legend>
		<?php echo $this->Form->input('Place.name', array(
			'label' => '店名',
			'type' => 'text',
			'class' => 'input-xlarge',
			'helpBlock' => 'ホテルの場合にはホテル名をご入力下さい。',
		)); ?>
		<?php echo $this->Form->error('Place.name');?>

		<?php echo $this->Form->input('Place.comment' , array(
			'label' => '紹介文',
			'type' => 'textarea',
			'class' => 'input-xlarge',
			'cols' => 80,
			'rows' => 10,
		)); ?>
		<?php echo $this->Form->error('Place.comment');?>

		<?php echo $this->Form->input('Place.genre', array(
			'label' => 'ジャンル',
			'type' => 'select',
			'options' => array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他'),
			'value' => 0
		)); ?>
		<?php echo $this->Form->error('Place.genre');?>

		<?php echo $this->Form->input('Place.wifi_existence', array(
			'label' => 'wifiの有無',
			'type' => 'radio',
			'div' => 'radio-horizontal',
			'options' => array(1 => "あり" , 0 => "なし" , 3 => "不明"),
			'value' => 1,
			'style' => 'float:none;',
		)); ?>
		<?php echo $this->Form->error('Place.wifi_existence');?>

		<?php echo $this->Form->input('Place.open_time', array(
			'label' => '開店時間',
			'type' => 'time',
			'class' => 'input-xlarge',
			'selected' => '08:00:00'
		)); ?>
		<?php echo $this->Form->error('Place.open_time'); ?>

		<?php echo $this->Form->input('Place.close_time', array(
			'label' => '閉店時間',
			'type' => 'time',
			'class' => 'input-xlarge',
			'selected' => '22:00:00'
		)); ?>
		<?php echo $this->Form->error('Place.close_time'); ?>

		<?php echo $this->Form->input('avatar',array('type'=>'file' , 'label' => ''));?>

		<div class="form-actions">
			<?php echo $this->Form->submit('登録する', array(
				'div' => false,
				'class' => 'btn btn-primary',
			)); ?>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>