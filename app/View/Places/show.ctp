<h1>詳細確認画面</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>

<table>
<?php
echo "<tr><td>名前</td><td>{$data[0]['Place']['name']}</td></tr>";
echo "<tr><td>コメント</td><td>{$data[0]['Place']['comment']}</td></tr>";
echo "<tr><td>ユーザー名</td><td><a href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$data[0]['User']['id']}>{$data[0]['User']['username']}</a></td></tr>";
?>
</table>
<?php
echo "<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'edit')) . "/{$data[0]['Place']['id']}>編集する</a>";
?>
