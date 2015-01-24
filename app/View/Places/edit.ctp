<!-- ラジオボタンを横並びに設定 -->
<?php echo $this->Html->css( 'radio-horizon'); ?>

<?php echo $this->Form->create('Place', array('class' => 'form-horizontal' , 'type' => 'file' , 'action' => 'edit')); ?>
	<fieldset>
		<?php $arr = $data; ?>
		<legend>お店情報編集フォーム</legend>
		<?php echo $this->Form->text('Place.id' , array('value' => $arr['Place']['id'] , 'type' => 'hidden'));?>
		<?php echo $this->Form->input('Place.name', array(
			'label' => '店名',
			'type' => 'text',
			'class' => 'input-xlarge',
			'helpBlock' => 'ホテルの場合にはホテル名をご入力下さい。',
			'value' => $arr['Place']['name']
		)); ?>
		<?php echo $this->Form->error('Place.name');?>
		<?php echo $this->Form->input('Place.comment' , array(
			'label' => '紹介文',
			'type' => 'textarea',
			'class' => 'input-xlarge',
			'cols' => 80,
			'rows' => 10,
			'value' => $arr['Place']['comment']
		)); ?>
		<?php echo $this->Form->error('Place.comment');?>

		<?php echo $this->Form->input('Place.genre', array(
			'label' => 'ジャンル',
			'type' => 'select',
			'options' => array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他'),
			'value' => $arr['Place']['genre']
		)); ?>
		<?php echo $this->Form->error('Place.genre');?>

		<?php echo $this->Form->input('Place.wifi_existence', array(
			'label' => 'wifiの有無',
			'type' => 'radio',
			'div' => 'radio-horizontal',
			'options' => array(1 => "あり" , 0 => "なし" , 3 => "不明"),
			'value' => $arr['Place']['wifi_existence'],
			'style' => 'float:none;',
		)); ?>
		<?php echo $this->Form->error('Place.wifi_existence');?>

		<?php echo $this->Form->input('Place.open_time', array(
			'label' => '開店時間',
			'type' => 'time',
			'class' => 'input-xlarge',
			'selected' => $arr['Place']['open_time']
		)); ?>
		<?php echo $this->Form->error('Place.open_time'); ?>

		<?php echo $this->Form->input('Place.close_time', array(
			'label' => '閉店時間',
			'type' => 'time',
			'class' => 'input-xlarge',
			'selected' => $arr['Place']['close_time']
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