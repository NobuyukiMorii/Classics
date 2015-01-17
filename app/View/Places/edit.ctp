<h1>場所情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<?php
echo "<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$data['Place']['id']}>閲覧する</a>";
?>
<table>
<?php
	$arr = $data;
	if($arr['Place']['avatar_file_name'] != null){
		echo "<tr>
				<td>画像</td><td>" .  $this->Upload->uploadImage($arr['Place'], 'Place.avatar', array('style' => 'thumb')) . "</td>
			</tr>";
	} else {
		echo "<tr>
		 		<td>画像</td><td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>
		 	</tr>";
	}
	echo "<tr><td>名前</td><td>{$arr['Place']['name']}</td></tr>";
	echo "<tr><td>紹介文</td><td>{$arr['Place']['comment']}</td></tr>";
	echo "<tr><td>ユーザー名</td><td><a href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>{$arr['User']['username']}</a></td></tr>";
	//ジャンル
	switch ($arr['Place']['genre']) {
		case 0:
			echo "<tr><td>ジャンル</td><td>カフェ</td></tr>";
			break;
		case 1:
			echo "<tr><td>ジャンル</td><td>バー</td></tr>";
			break;
		case 2:
			echo "<tr><td>ジャンル</td><td>レストラン</td></tr>";
			break;
		default:
			echo "<tr><td>ジャンル</td><td>不明</td></tr>";
			break;
	}
	//wifi
	switch ($arr['Place']['wifi_existence']) {
		case 0:
			echo "<tr><td>wifi</td><td>なし</td></tr>";
			break;
		case 1:
			echo "<tr><td>wifi</td><td>あり</td></tr>";
			break;
		case 2:
			echo "<tr><td>wifi</td><td>不明</td></tr>";
			break;
		default:
			echo "<tr><td>wifi</td><td>不明</td></tr>";
			break;
	}
	//wifiの平均スピード
	echo "<tr><td>wifiスピード</td><td>{$arr['Place']['wifi_average_speed']}</td></tr>";
	echo "<tr><td>予算</td><td>{$arr['Place']['payment_average']}</td></tr>";
	echo "<tr><td>開店時間</td><td>{$arr['Place']['wifi_average_speed']}</td></tr>";
	echo "<tr><td>開店時間</td><td>{$arr['Place']['open_time']}</td></tr>";
	echo "<tr><td><閉店時間</td><td>{$arr['Place']['close_time']}</td></tr>";
?>
</table>

<?php
	$arr = $data;
	echo $this->Form->create('Place',array('type' => 'file' , 'action' => 'edit'));
	echo $this->Form->text('Place.id' , array('value' => $arr['Place']['id'] , 'type' => 'hidden'));
	echo '名前：' . $this->Form->text('Place.name' , array('value' => $arr['Place']['name']));
	echo $this->Form->error('Place.name');
	echo 'コメント：' . $this->Form->textarea('Place.comment' , array('value' => $arr['Place']['comment']));
	echo $this->Form->error('Place.comment');
	echo 'ジャンル：<br>' . $this->Form->select('Place.genre' , array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他') ,array('value' => $arr['Place']['genre'] , 'legend' => false));
	echo $this->Form->error('Place.genre');
	echo '<br>wifi：<br>' . $this->Form->radio('Place.wifi_existence' , array(1 => "あり" , 0 => "なし" , 3 => "不明") ,array('value' => $arr['Place']['wifi_existence'] , 'legend' => false));
	echo $this->Form->error('Place.wifi_existence');
	echo '開店時間：' . $this->Form->time('Place.open_time' , array('value' => $arr['Place']['open_time']));
	echo $this->Form->error('Place.open_time');
	echo '閉店時間：' . $this->Form->time('Place.close_time' , array('value' => $arr['Place']['close_time']));
	echo $this->Form->error('Place.close_time');
	echo '写真：' . $this->Form->input('avatar',array('type'=>'file' , 'label' => ''));	
	echo $this->Form->end("送信");
?>
