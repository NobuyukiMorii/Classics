<h1>トップページ</h1>
<br>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'add')); ?> >※場所を追加する</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'profile')); ?> >※自分のユーザー情報を確認する</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'logout')); ?> >※ログアウトする</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'serchUser')); ?> >※全ユーザーを表示する</a>
<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'delete')); ?> >※退会する</a>

<table>
	<tr>
		<th>場所</th><th>コメント</th><th>ユーザー名</th><th>画像</th>
	</tr>
	<?php
	for($i = 0; $i < count($data); $i++){
		$arr = $data[$i];
		echo "<tr>";
		//場所の名前
		echo 
				"<td>
					<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$arr['Place']['id']}>{$arr['Place']['name']}</a>
				</td>"; 
		//場所の名前
		echo 
				"<td>
					{$arr['Place']['comment']}
				</td>";	
		//ユーザー情報
		echo 
				"<td>
					<a href=".$this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>{$arr['User']['username']}</a>
				</td>";
		//画像
		if($arr['Place']['avatar_file_name'] != null){
			echo 	"<td>" .  $this->Upload->uploadImage($arr , 'Place.avatar', array('style' => 'thumb')) . "</td>";
		} else {
			echo 	"<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
		}
		echo "</tr>";
	}
	?>
</table>

<?php
echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true));
echo $this->Form->input('name');
echo $this->Form->end('送信');
?>