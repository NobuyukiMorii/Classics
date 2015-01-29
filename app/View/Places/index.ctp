<!-- ラジオボタンを横並びに設定 -->
<?php echo $this->Html->css('radio-horizon'); ?>

<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span6">
  		<a href=<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index'));?>><?php echo $this->Html->image('CebuWifi.png', array('alt' => 'CebuWifi'));?></a>
  	</div>
    <div class="span3">
		<?php
		echo '<h4>場所名で検索</h4>';
		echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true));
		echo $this->Form->input('Place.name' , array('label' => false));
		echo $this->Form->text('Place.flg' , array('value' => "name_form" , 'type' => 'hidden'));
		echo $this->Form->end('送信');
		?>
    </div>
    <div class="span3">
		<?php
		echo '<h4>Wifiのスピードとジャンルで検索</h4>';
		echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true));
		if(empty($value_genre)){
			echo $this->Form->input('Place.genre', array(
				'label' => false,
				'type' => 'radio',
				'div' => 'radio-horizontal',
				'options' => array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他'),
				'value' => 0,
				'style' => 'float:none;',
			));
		} else {
			echo $this->Form->input('Place.genre', array(
				'label' => false,
				'type' => 'radio',
				'div' => 'radio-horizontal',
				'options' => array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他'),
				'value' => $value_genre ,
				'style' => 'float:none;',
			));
		}
		if(empty($value_wifi_average_speed)){
			echo $this->Form->input('Place.wifi_average_speed', array(
				'label' => false,
				'type' => 'radio',
				'div' => 'radio-horizontal',
				'options' =>  array(0 => '0Mbps以上' , 1 =>'1Mbps以上' , 2 => '2Mbps以上', 3 => '3Mbps以上', 4 =>'4Mbps以上' , 5 => '5Mbps以上'),
				'value' => 0,
				'style' => 'float:none;',
			));
		} else {
			echo $this->Form->input('Place.wifi_average_speed', array(
				'label' => false,
				'type' => 'radio',
				'div' => 'radio-horizontal',
				'options' => array(0 => '0Mbps以上' , 1 =>'1Mbps以上' , 2 => '2Mbps以上', 3 => '3Mbps以上', 4 =>'4Mbps以上' , 5 => '5Mbps以上'),
				'value' => $value_wifi_average_speed,
				'style' => 'float:none;',
			));
		}
		echo $this->Form->text('Place.flg' , array('value' => "other_form" , 'type' => 'hidden'));
		echo $this->Form->end('送信');
		?>
    </div>
  </div>
</div>

<div class="pagination">                         
  <ul>                                           
    <?php 
    	if($record == true){
		//レコードがある時だけ表示する
    	echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>'));                             
		echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		}
	?>
  </ul>                                          
</div>

<hr>


<?php
for($i = 0; $i < count($data); $i++){
	$arr = $data[$i];
	
	echo '<div class="row">';
  		echo "<div class='span2'>";
  			//Photo
			if($arr['Place']['avatar_file_name'] != null){
				echo 	$this->Upload->uploadImage($arr , 'Place.avatar', array('style' => 'thumb'));
			} else {
				echo "<img border='0' src='/Classics/img/NoImage.jpg' width='170'>";
			}
  		echo "</div>";

  		echo '<div class="span6">';
			echo '<div class="row">';
	  			echo '<div class="span11">';
	    			echo '<div class="row">';
	      				echo '<div class="span4">';
	      					echo '<h3>';
	      					echo '<a href=' . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/" . $arr['Place']['id'] . '>' . $arr['Place']['name'] . '</a>';
		      					echo '<small>';
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
								echo '</small>';
							echo '</h3>';
	      				echo '</div>';
						echo '<div class="span3">';
							if($arr['Place']['wifi_existence'] == 0){
								echo '<h3>wifiなし</h3>';
							} else if($arr['Place']['wifi_average_speed'] == 0){
								echo '<h3>未測定</h3>';
							} else {
								echo '<h3>' . $arr['Place']['wifi_average_speed'] . 'Mbps</h3>';
							}
						echo '</div>';
						echo '<div class="span3">';
							echo '<h3>' . $arr['Place']['payment_average'] . 'peso</h3>';
						echo '</div>';
	    			echo '</div>';

	    			echo '<div class="row">';
	      				echo '<div class="span12">';
	      					echo '<h4>' . $arr['Place']['comment'] . '<br><small>（<a href=' . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/" . $arr['User']['id'] . ">" . $arr['User']['username'] . '</a>：' . date("Y/m/d H:i", strtotime($arr['Place']['modified'])) . '）</small></h4>';
	      				echo '</div>';
	    			echo '</div>';
	    			
	  			echo '</div>';
			echo '</div>';
  		echo '</div>';
	echo '</div>';

	echo '<hr>';

}
?>


<div class="text-center">
	<div class="pagination">                         
	  <ul>                                           
	    <?php 
	    	if($record == true){
			//レコードがある時だけ表示する
	    	echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>'));                             
			echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			}
		?>
	  </ul>                                          
	</div>
</div>