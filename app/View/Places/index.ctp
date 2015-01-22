<style>
input[type=radio] {
    margin:0px;
    width:20px;
}
.radio-horizontal label{
    display: inline-block;
}
</style>

<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span6">
  		<?php echo $this->Html->image('CebuWifi.png', array('alt' => 'CebuWifi'));?>
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
				'options' => array(0,1,2,3,4,5),
				'value' => 3 ,
				'style' => 'float:none;',
			));
		} else {
			echo $this->Form->input('Place.wifi_average_speed', array(
				'label' => false,
				'type' => 'radio',
				'div' => 'radio-horizontal',
				'options' => array(0,1,2,3,4,5),
				'value' => $value_wifi_average_speed ,
				'style' => 'float:none;',
			));
		}
		echo $this->Form->text('Place.flg' , array('value' => "other_form" , 'type' => 'hidden'));
		echo $this->Form->end('送信');
		?>
    </div>
  </div>
</div>
<hr>
<?php
for($i = 0; $i < count($data); $i++){
	$arr = $data[$i];
	echo '<div class="row">';
	  	echo '<div class="span9">';
	    	echo '<div class="row">';
	      		echo "<div class='span2'>";
	      			//Photo
					if($arr['Place']['avatar_file_name'] != null){
						echo 	$this->Upload->uploadImage($arr , 'Place.avatar', array('style' => 'thumb'));
					} else {
						echo 	"<img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='170'>";
					}
	      		echo "</div>";
	      		echo '<div class="span7">';
					echo '<div class="row">';
			  			echo '<div class="span9">';
			    			echo '<div class="row">';
			      				echo '<div class="span7">';
			      					echo '<div class="row">';
			      						echo '<h3><a href=' . $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/" . $arr['Place']['id'] . '>' . $arr['Place']['name'] . '</a></h3>';
			      					echo '</div>';	
			      				echo '</div>';
			      				echo '<div class="span2">';
			      					echo '<h5 style="text-align:right;">';
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
									echo '</h5>';
			      				echo '</div>';
			    			echo '</div>';

			    			echo '<div class="row">';
			      				echo '<div class="span2">';
			      					echo '<div class="row">';
			      						echo '<h3>' . $arr['Place']['wifi_average_speed'] . 'Mbps</h3>';
			      					echo '</div>';
			      					echo '<div class="row">';
			      						echo "<dl>";
											echo "<dt>" . $arr['Place']['payment_average'] . "peso</dt>";
											echo "<dt>" . $arr['Place']['open_time'] . ' - ' . $arr['Place']['close_time'] . "</dt>";
										echo "</dl>";
			      					echo '</div>';	
			      				echo '</div>';
			      				echo '<div class="span7">';
			      					echo '<p>1) あ、このぺんかそれぺんですか？それでも、あなたがすきです。雨でも晴れでも、行きましょう！誰でもが行うことが出来るよ。新しい車は好きですが、高い車は好きじゃないね。あなたは、これが好きですか？昨日、私達はマクドナルドでハンバーガーを多く食べた。僕たちの友人が来たから、ビールを飲んだ。ここからあの病院まで、１０キロメートルくらいでしょう。<strong>（<a href=' . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/" . $arr['User']['id'] . ">" . $arr['User']['username'] . '</a>:' . $arr['Place']['modified'] . '更新）</strong></p>';
			      				echo '</div>';
			    			echo '</div>';
			  			echo '</div>';
					echo '</div>';
	      		echo '</div>';
	    	echo '</div>';
	 	echo '</div>';
	echo '</div>';
	echo '<hr>';

}
?>




<?php

if($record == true){
	//レコードがある時だけ表示する
	echo $this->Paginator->prev('prev' , array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next('next' , array(), null, array('class' => 'next disabled'));
}
?>