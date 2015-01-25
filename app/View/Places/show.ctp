<?php echo $this->Html->script('jquery-1.11.2.min'); ?>
<script>
function SpeedTest(){
    var start = (new Date()).getTime();
    $.get('/classics/img/CebuWifi.png?' + start, function(data) {
        var end = (new Date()).getTime();
        var sec = (end - start) / 1000;
        var mbps =  (( (data.length *8) / sec)/1000000).toFixed(5);
        alert((mbps) + 'Mbps');
    });
};
SpeedTest();
</script>

<?php
$arr = $data;
	$arr = $data[0];
		echo '<div class="hero-unit">';
		
			echo '<h1>' . $arr['Place']['name'] . '</h1>';
			echo '<div class="span3">';
			echo '</div>';
			echo '<div class="span2">';
				echo '<h2>' . $arr['Place']['wifi_average_speed'] . 'Mbps</h2>';
			echo '</div>';
			echo '<div class="span2">';
					echo '<h2>' . $arr['Place']['payment_average'] . 'peso</h2>';
			echo '</div>';
			echo '<div class="span3">';
					echo '<h2>';
						switch ($arr['Place']['genre']) {
							case 0:
								echo "カフェ";
								break;
							case 1:
								echo "バー";
								break;
							case 2:
								echo "レストラン";
								break;
							default:
								echo "不明";
								break;
						}
					echo '</h2>';
			echo '</div>';
			echo '<p><a href=' . $this->Html->url(array('controller' => 'Places' , 'action' => 'edit')) . "/" . $data[0]['Place']['id'] . ' class="btn btn-primary btn-large">編集する &raquo;</a></p>';
		echo '</div>';

		echo '<div class="row">';
			echo '<div class="span4">';
				echo '<h2>Image</h2>';
				echo '<p>';
				if($arr['Place']['avatar_file_name'] != null){
					echo $this->Upload->uploadImage($arr['Place'], 'Place.avatar', array('style' => 'thumb'));
				} else {
					echo "<img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='170'>";
				}
				echo '</p>';
			echo '</div>';
			echo '<div class="span4">';
				echo '<h2>Instruction</h2>';
				echo '<p>' . $arr['Place']['comment'] . '</p>';
			echo '</div>';
			echo '<div class="span4">';
				echo '<h2>Details</h2>';
				echo '<dl>';
					echo '<dt>';
						echo '営業時間：';
						echo date("H:i", strtotime($arr['Place']['open_time']));
						echo "-";
						echo date("H:i", strtotime($arr['Place']['close_time']));
					echo '</dt>';
					echo '<dt>';
						echo '登録した人：';
						echo "<a href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$created_user['id']}>{$created_user['username']}</a>";
					echo '</dt>';
					echo '<dt>';
						echo '登録日時：';
						echo date("Y/m/d H:i", strtotime($arr['Place']['created']));
					echo '</dt>';
				echo '</dl>';
			echo '</div>';

		echo '</div>';
		echo '<hr>';
?>

<div class="bs-docs-grid">
	<div class="row-fluid show-grid">
	  	<div class="span7">	
			<?php
			if (isset($data[0]['Post']['id'])) {
				for($i = 0; $i < count($data); $i++){
					$arr = $data[$i];

					echo '<div class="bs-docs-grid">';
						echo '<div class="row-fluid show-grid">';
							echo '<div class="span3">';
								//Photo
								if($arr['Post']['avatar_file_name'] != null){
									echo "<td>" .  $this->Upload->uploadImage($arr, 'Post.avatar', array('style' => 'thumb')) . "</td>";
								} else {
									echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='170'></td>";
								}
							echo '</div>';
							echo '<div class="span9">';
								echo '<div class="row-fluid show-grid">';
									echo '<div class="span5">';
										echo '<h3>' . $arr['Post']['wifi_speed'] . 'Mbps</h3>';
										echo "<dl>";
										echo "<dt>" . $arr['Post']['payment'] . "peso</dt>";
										echo "<dt>" . $arr['Post']['time_zone'] . "</dt>";
										echo "</dl>";
									echo '</div>';
									echo '<div class="span7">';
										echo '<p>' . $arr['Post']['comment'] . '<br><strong>（<a href=' . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>" . $arr['User']['username'] . '</a>：' . date("Y/m/d H:i", strtotime($arr['Post']['created'])) . '）</strong></p>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<hr>';
				}
			}
			?>
	  	</div>
	  	<div class="span5">
			<?php echo $this->Form->create('Post', array('class' => 'form-horizontal' , 'type' => 'file' , 'action' => 'add')); ?>
				<fieldset>
					<legend>感想フォーム</legend>
					<?php echo $this->Form->text('Post.places_id' , array('value' => $data[0]['Place']['id'] , 'type' => 'hidden')); ?>
					<?php echo $this->Form->input('Post.comment', array(
						'label' => '感想',
						'type' => 'textarea',
						'class' => 'input-xlarge',
						'cols' => 80,
						'rows' => 10,
					)); ?>
					<?php echo $this->Form->error('Post.comment');?>
					<?php echo $this->Form->input('Post.wifi_speed', array(
						'label' => 'Wifiスピード（Mbps）',
						'type' => 'text',
						'class' => 'input-xlarge',
						'helpBlock' => '10.00の形式でご入力下さい。'
					)); ?>
					<?php echo $this->Form->error('Post.wifi_speed');?>
					<?php echo $this->Form->input('Post.time_zone', array(
						'label' => '利用時間',
						'type' => 'select',
						'class' => 'input-xlarge',
						'value' => 22,
						'options' => array(0 => "0時" , 1 => "1時" , 2 => "2時" , 3 => "3時" , 4 => "4時" , 5 => "5時" , 6 => "6時" , 7 => "7時" , 8 => "8時" , 9=> "9時" , 10 => "10時" ,11 => "11時" , 12 =>"12時" , 13 => "13時" , 14 => "14時" , 15 => "15時" , 16 => "16時" , 17 => "17時" , 18 => "18時" , 19 => "19時" , 20 => "20時" , 21 => "21時" , 22 => "22時" ,23 => "23時")
					)); ?>
					<?php echo $this->Form->error('Post.time_zone');?>
					<?php echo $this->Form->input('Post.payment', array(
						'label' => '使った金額（１人）',
						'type' => 'text',
						'class' => 'input-xlarge',
						'helpBlock' => '10.00の形式でご入力下さい。'
					)); ?>
					<?php echo $this->Form->error('Post.payment'); ?>
					<?php echo $this->Form->input('avatar',array('type'=>'file','label'=>'写真'));?>
					<div class="form-actions">
						<?php echo $this->Form->submit('登録する', array(
							'div' => false,
							'class' => 'btn btn-primary',
						)); ?>
					</div>
				</fieldset>
			<?php echo $this->Form->end(); ?>
	  	</div>
	</div>
</div>

<div class="text-center">
	<div class="pagination">                         
	  <ul>                                           
	    <?php 
			//レコードがある時だけ表示する
	    	echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>'));                             
			echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		?>
	  </ul>                                          
	</div>
</div>