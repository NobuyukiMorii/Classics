<h1>ユーザー詳細情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>


<table>
<?php
echo "<tr><td>ユーザー名</td><td><a href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'profile')) . "/{$data[0]['User']['id']}>{$data[0]['User']['username']}</a></td></tr>";
?>
</table>

<table>
<?php
for($i = 0; $i < count($data); $i++){
	echo "<tr><td><a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$data[$i]['Place']['id']}>{$data[$i]['Place']['name']}</a></td></tr>";
}
?>
</table>