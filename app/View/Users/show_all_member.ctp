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
		echo "</tr>";
	}
	?>
</table>
