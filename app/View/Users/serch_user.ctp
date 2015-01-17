<h1>show all Users</h3>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>

	<?php
	for($i = 0; $i < count($data); $i++){
		$arr = $data[$i];
		echo "<tr>";
		//ユーザー名
		echo 
				"<td>
					<a href=".$this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>{$arr['User']['username']}</a>
				</td>";
		//画像
		if($arr['User']['avatar_file_name'] != null){
			echo "<td>" .  $this->Upload->uploadImage($arr['User'] , 'User.avatar', array('style' => 'thumb')) . "</td>";
		} else {
			echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
		}
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
echo $this->Form->create('User',array('action' => 'serchUser' , 'type' => 'post' , 'novalidate' => true));
echo $this->Form->input('username');
echo $this->Form->end('Serch');
?>