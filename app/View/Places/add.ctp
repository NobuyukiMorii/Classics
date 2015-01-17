<h1>場所登録フォーム</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<br>

<?php
	echo $this->Form->create('Place',array('type' => 'file' , 'action' => 'add'));
	echo '名前：' . $this->Form->text('Place.name');
	echo $this->Form->error('Place.name');
	echo 'コメント：' . $this->Form->textarea('Place.comment');
	echo $this->Form->error('Place.comment');
	echo 'ジャンル：<br>' . $this->Form->select('Place.genre' , array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他') ,array('value' => 0 , 'legend' => false));
	echo $this->Form->error('Place.genre');
	echo '<br>wifi：<br>' . $this->Form->radio('Place.wifi_existence' , array(1 => "あり" , 0 => "なし" , 3 => "不明") ,array('value' => 3 , 'legend' => false));
	echo $this->Form->error('Place.wifi_existence');
	echo '開店時間：' . $this->Form->time('Place.open_time' , array('value' => '08:00'));
	echo $this->Form->error('Place.open_time');
	echo '閉店時間：' . $this->Form->time('Place.close_time' , array('value' => '22:00'));
	echo $this->Form->error('Place.close_time');
	echo '写真：' . $this->Form->input('avatar',array('type'=>'file' , 'label' => ''));	
	echo $this->Form->end("送信");
?>
