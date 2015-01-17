<h1>トップページ</h1>
<br>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'add')); ?> >※場所を追加する</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'profile')); ?> >※自分のユーザー情報を確認する</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'logout')); ?> >※ログアウトする</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'serchUser')); ?> >※全ユーザーを表示する</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'delete')); ?> >※退会する</a>

<table>
	<tr>
		<th>画像</th><th>場所</th><th>wifi</th><th>wifi speed</th><th>ジャンル</th><th>紹介文</th><th>開店時間</th><th>閉店時間</th><th>ユーザー名</th><th>登録日</th>
	</tr>
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
echo $this->Paginator->prev('prev' , array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('next' , array(), null, array('class' => 'next disabled'));
?>



<?php
echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true));
echo $this->Form->input('name');
echo $this->Form->end('送信');
?>