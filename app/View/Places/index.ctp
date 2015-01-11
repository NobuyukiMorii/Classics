<h1>トップページ</h1>
<br>
<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'add')); ?> >※投稿する</a>

<table>
	<tr>
		<th>ユーザー名</th><th>タイトル</th><th>
	</tr>
	<?php pr($data) ?>
	