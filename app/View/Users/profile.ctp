<h1>ユーザー詳細情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>


<table>
<?php
echo "<tr><td>名前</td><td>{$data[0]['User']['username']}</td></tr>";
?>
</table>

<a href=<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'edit')); ?> >プロフィールを変更する</a>
