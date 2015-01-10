<h1>送信フォーム</h1>

<table>
	<?php
	for($i = 0; $i <count($data); $i++){
		$arr = $data[$i]['Place'];
		echo "<tr><td>{$arr['id']}</td>";
		echo "<td>{$arr['name']}</td>";
		echo "<td>{$arr['comments']}</td>";
		echo "<td>{$arr['username']}</td>";
	}
	?>
</table>

