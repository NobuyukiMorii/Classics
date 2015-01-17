<h1>投稿兼詳細確認画面</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<h1>投稿画面</h1>
<?php
	echo $this->Form->create('Post',array('type' => 'file', 'action' => 'add'));
	echo $this->Form->text('Post.places_id' , array('value' => $data[0]['Place']['id'] , 'type' => 'hidden'));
	echo '感想：' . $this->Form->text('Post.comment');
	echo $this->Form->error('Post.comment');
	echo 'wifiスピード（0.00の形式で入力してください）：' . $this->Form->text('Post.wifi_speed');
	echo $this->Form->error('Post.wifi_speed');
	echo $this->Form->error('Post.time_zone');
	echo '<br>利用料金（１人）：<br>' . $this->Form->text('Post.payment');
	echo '利用した時間帯：<br>' . $this->Form->select('Post.time_zone' , array(0 => "0時" , 1 => "1時" , 2 => "2時" , 3 => "3時" , 4 => "4時" , 5 => "5時" , 6 => "6時" , 7 => "7時" , 8 => "8時" , 9=> "9時" , 10 => "10時" ,11 => "11時" , 12 =>"12時" , 13 => "13時" , 14 => "14時" , 15 => "15時" , 16 => "16時" , 17 => "17時" , 18 => "18時" , 19 => "19時" , 20 => "20時" , 21 => "21時" , 22 => "22時" ,23 => "23時") ,array('value' => 12 , 'legend' => false));
	echo $this->Form->error('Post.payment');
	echo $this->Form->input('avatar',array('type'=>'file','label'=>'写真'));
	echo $this->Form->end("送信");
?>

<table>
<?php
$arr = $data;
	$arr = $data[0];
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
	echo "<tr><td>開店時間</td><td>{$arr['Place']['open_time']}</td></tr>";
	echo "<tr><td><閉店時間</td><td>{$arr['Place']['close_time']}</td></tr>";
?>
</table>

<?php
echo "<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'edit')) . "/{$data[0]['Place']['id']}>編集する</a>";
?>

<table>
	<tr>
		<th>写真</th><th>wifiスピード</th><th>感想</th><th>ユーザー名</th><th>投稿日</th>
	</tr>
	<?php
	if (isset($data[0]['Post']['id'])) {
		for($i = 0; $i < count($data); $i++){
			$arr = $data[$i];
			echo "<tr>";
			//画像
			if($arr['Post']['avatar_file_name'] != null){
				echo "<td>" .  $this->Upload->uploadImage($arr, 'Post.avatar', array('style' => 'thumb')) . "</td>";
			} else {
				echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
			}
			//wifiのスピード
			echo 
					"<td>
						{$arr['Post']['wifi_speed']}
					</td>"; 

			//投稿内容
			echo 
					"<td>
						{$arr['Post']['comment']}
					</td>"; 
			//ユーザー情報
			echo 
					"<td>
						<a href=".$this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>{$arr['User']['username']}</a>
					</td>";
			//登校日
			echo 
					"<td>
						{$arr['Post']['created']}
					</td>";
			echo "</tr>";

		}
	}
	?>
</table>