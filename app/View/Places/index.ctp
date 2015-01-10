<h1>送信フォーム</h1>
<table>
	<?php
	for($i = 0; $i <count($data); $i++){
		$arr = $data[$i]['Place'];
		echo "<tr><td>{$arr['id']}</td>";
		echo "<td>{$arr['name']}</td>";
		echo "<td>{$arr['comments']}</td>";
		echo "<td>{$arr['username']}</td></tr>";
	}
	?>
</table>


追加用
<?php
echo $this->form->create('Place',array('type'=>'post','action'=>'addRecord'));
echo $this->Form->text("Place.name");
echo $this->Form->text("Place.comments");
echo $this->Form->text('Place.username');
echo $this->Form->submit('送信');
echo $this->Form->end();
?>

