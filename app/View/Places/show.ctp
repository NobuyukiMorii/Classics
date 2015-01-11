<h1>詳細確認画面</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>
<?php
echo "<tr><td>ユーザー名</td><td>{$data[0]['User']['username']}</td></tr>";
echo "<tr><td>名前</td><td>{$data[0]['Place']['name']}</td></tr>";
echo "<tr><td>名前</td><td>{$data[0]['Place']['comment']}</td></tr>";
?>
</table>
