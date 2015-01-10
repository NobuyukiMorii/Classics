<h1>送信フォーム</h1>

追加用
<?php
echo $this->form->create('Place',array('type'=>'post','action'=>'addRecord'));
echo $this->Form->text("Place.name");
echo $this->Form->text("Place.comments");
echo $this->Form->text('Place.username');
echo $this->Form->submit('送信');
echo $this->Form->end();
?>

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

検索用
<?php
echo $this->Form->create('Place',array('type'=>'post','action'=>'index'));
echo $this->Form->text("Place.id");
echo $this->Form->submit("送信");
?>

<table>
	<?php
	for($i = 0; $i <count($id_number); $i++){
		$arr_id_number = $id_number[$i]['Place'];
		echo "<tr><td>{$arr_id_number['id']}</td>";
		echo "<td>{$arr_id_number['name']}</td>";
		echo "<td>{$arr_id_number['comments']}</td>";
		echo "<td>{$arr_id_number['username']}</td></tr>";
	}
	?>
</table>