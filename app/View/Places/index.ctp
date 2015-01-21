<table>
	<?php
	if($record == true){
	echo "<tr>
		<th>画像</th><th>場所</th><th>wifi</th><th>wifi speed</th><th>ジャンル</th><th>予算</th><th>紹介文</th><th>開店時間</th><th>閉店時間</th><th>ユーザー名</th><th>登録日</th>
		</tr>";
	}
	?>
	<?php
	for($i = 0; $i < count($data); $i++){
		$arr = $data[$i];
		echo "<tr>";
		//画像
		if($arr['Place']['avatar_file_name'] != null){
			echo 	"<td>" .  $this->Upload->uploadImage($arr , 'Place.avatar', array('style' => 'thumb')) . "</td>";
		} else {
			echo 	"<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
		}
		//場所の名前
		echo 
				"<td>
					<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$arr['Place']['id']}>{$arr['Place']['name']}</a>
				</td>";
		//wifiの有無
		switch ($arr['Place']['wifi_existence']) {
			case 0:
				echo "<td>なし</td>";
				break;
			case 1:
				echo "<td>あり</td>";
				break;
			case 2:
				echo "<td>不明</td>";
				break;
			default:
				echo "><td>不明</td>";
				break;
		}
		//wifiのスピード
		echo 
				"<td>
					{$arr['Place']['wifi_average_speed']}
				</td>";
		//ジャンル
		switch ($arr['Place']['genre']) {
			case 0:
				echo "<td>カフェ</td>";
				break;
			case 1:
				echo "<td>バー</td>";
				break;
			case 2:
				echo "<td>レストラン</td>";
				break;
			default:
				echo "<td>不明</td>";
				break;
		}
		//ジャンル
		echo 
				"<td>
					{$arr['Place']['payment_average']}
				</td>";			
		//紹介文
		echo 
				"<td>
					{$arr['Place']['comment']}
				</td>";	
		//開店時間
		echo 
				"<td>
					{$arr['Place']['open_time']}
				</td>";
		//閉店時間		
		echo 
				"<td>
					{$arr['Place']['close_time']}
				</td>";
		//最後に更新したユーザー
		echo 
				"<td>
					<a href=".$this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>{$arr['User']['username']}</a>
				</td>";
		//最終更新日
		echo 
				"<td>
					{$arr['Place']['modified']}
				</td>";	
		echo "</tr>";
	}
	?>
</table>

<?php

if($record == true){
	//レコードがある時だけ表示する
	echo $this->Paginator->prev('prev' , array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next('next' , array(), null, array('class' => 'next disabled'));
}
?>



<?php
echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true));
echo '名前：<br>' . $this->Form->input('Place.name' , array('label' => false));
echo $this->Form->text('Place.flg' , array('value' => "name_form" , 'type' => 'hidden'));
echo $this->Form->end('送信');
?>

<?php
echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true));
if(empty($value_genre)){
	echo 'ジャンル：<br>' . $this->Form->radio('Place.genre' , array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他') ,array('value' => 0 , 'legend' => false));
} else {
	echo 'ジャンル：<br>' . $this->Form->radio('Place.genre' , array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他') ,array('value' => $value_genre , 'legend' => false));
}
if(empty($value_wifi_average_speed)){
	echo '<br>wifiスピード：<br>' . $this->Form->radio('Place.wifi_average_speed' , array(0,1,2,3,4,5) ,array('value' => 0 , 'legend' => false));
} else {
	echo '<br>wifiスピード：<br>' . $this->Form->radio('Place.wifi_average_speed' , array(0,1,2,3,4,5) ,array('value' => $value_wifi_average_speed , 'legend' => false));
}
echo $this->Form->text('Place.flg' , array('value' => "other_form" , 'type' => 'hidden'));
echo $this->Form->end('送信');
?>