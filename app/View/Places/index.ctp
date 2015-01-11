<h1>トップページ</h1>
<br>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'add')); ?> >※投稿する</a>

<table>
	<tr>
		<th>ユーザー名</th><th>場所</th><th>
	</tr>
	<?php
	for($i = 0; $i < count($data); $i++){
		$arr = $data[$i];
		echo "<tr>";
		//場所情報
		echo 
				"<td>
					<a href=".$this->Html->url(array('controller' => 'Places' , 'action' => 'show'))."/{$arr['Place']['id']}>{$arr['Place']['name']}</a>
				</td>";	
		//ユーザー情報
		echo 
				"<td>
					<a href=".$this->Html->url(array('controller' => 'Places' , 'action' => 'show2'))."/{$arr['User']['id']}>{$arr['User']['username']}</a>
				</td>";
		echo "</tr>";
	}
	?>
</table>
