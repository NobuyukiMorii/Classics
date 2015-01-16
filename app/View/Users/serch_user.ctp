<h1>show all Users</h3>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>
	<tr>
		<th>ユーザー名</th><th>
	</tr>
	<?php
	for($i = 0; $i < count($data); $i++){
		$arr = $data[$i];
		echo "<tr>";
		//ユーザー名
		echo 
				"<td>
					<a href=".$this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>{$arr['User']['username']}</a>
				</td>";
		echo "<td>画像</td><td>" .  $this->Upload->uploadImage($arr['User'] , 'User.avatar', array('style' => 'thumb')) . "</td>";
		echo "</tr>";
	}
	?>
</table>

<?php
echo $this->Form->create('User',array('action' => 'serchUser' , 'type' => 'post' , 'novalidate' => true));
echo $this->Form->input('username');
echo $this->Form->end('Serch');
?>