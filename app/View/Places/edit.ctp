<h1>場所情報</h1>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index')); ?> >トップ画面に戻る</a>
<?php
echo "<a href=" . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/{$data['Place']['id']}>閲覧する</a>";
?>
<table>
<?php
	$arr = $data;
	echo "<tr><td>名前</td><td>{$arr['Place']['name']}</td></tr>";
	echo "<tr><td>コメント</td><td>{$arr['Place']['comment']}</td></tr>";
	echo "<tr><td>ユーザー名</td><td><a href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>{$arr['User']['username']}</a></td></tr>";
	echo "<tr>
			<td>画像</td><td>" .  $this->Upload->uploadImage($arr['Place'], 'Place.avatar', array('style' => 'thumb')) . "</td>
		</tr>";
?>
</table>

<?php
	$arr = $data;
	echo $this->Form->create('Place',array('type' => 'file' , 'action' => 'edit' , 'novalidate' => true));
	echo $this->Form->text('Place.id' , array('value' => $arr['Place']['id'] , 'type' => 'hidden'));
	echo '名前：' . $this->Form->text('Place.name' , array('value' => $arr['Place']['name']));
	echo $this->Form->error('Place.name');
	echo 'コメント：' . $this->Form->textarea('Place.comment' , array('value' => $arr['Place']['comment']));
	echo $this->Form->error('Place.comment');
	echo $this->Form->input('avatar',array('type'=>'file','label'=>'写真'));
	echo $this->Form->end("送信");
?>
