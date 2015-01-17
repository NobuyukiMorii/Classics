<h1>詳細確認画面</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>
<?php
echo "<tr><td>名前</td><td>{$data[0]['Place']['name']}</td></tr>";
echo "<tr><td>コメント</td><td>{$data[0]['Place']['comment']}</td></tr>";
echo "<tr><td>ユーザー名</td><td><a href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$data[0]['User']['id']}>{$data[0]['User']['username']}</a></td></tr>";
	if($data[0]['Place']['avatar_file_name'] != null){
		echo "<tr>
				<td>画像</td><td>" .  $this->Upload->uploadImage($data[0]['Place'], 'Place.avatar', array('style' => 'thumb')) . "</td>
			</tr>";
	} else {
		echo "<tr>
		 		<td>画像</td><td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>
		 	</tr>";
	}
?>
</table>

<?php
echo "<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'edit')) . "/{$data[0]['Place']['id']}>編集する</a>";
?>

<table>
	<tr>
		<th>コメント</th><th>ユーザー名</th><th>
	</tr>
	<?php
	if (isset($data[0]['Post']['id'])) {
		for($i = 0; $i < count($data); $i++){
			$arr = $data[$i];
			echo "<tr>";
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
			//画像
			if($arr['Post']['avatar_file_name'] != null){
				echo "<td>" .  $this->Upload->uploadImage($arr, 'Post.avatar', array('style' => 'thumb')) . "</td>";
			} else {
				echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
			}
			echo "</tr>";

		}
	}
	?>
</table>

投稿画面
<?php
	echo $this->Form->create('Post',array('type' => 'file', 'action' => 'add'));
	echo '名前：' . $this->Form->text('Post.comment');
	echo $this->Form->error('Post.comment');
	echo $this->Form->text('Post.places_id' , array('value' => $data[0]['Place']['id'] , 'type' => 'hidden'));
	echo $this->Form->input('avatar',array('type'=>'file','label'=>'写真'));
	echo $this->Form->end("送信");
?>
