<!-- jQueryを使用 -->
<?php echo $this->Html->script('jquery-1.11.2.min'); ?>
<!-- ラジオボタンを横並びに設定 -->
<?php echo $this->Html->css( 'radio-horizon'); ?>
<!-- Wifiの速度を図るファイルを使用-->
<?php echo $this->Html->script('SpeedTest'); ?>
<!-- 緯度と経度をとるファイルを使用-->
<?php echo $this->Html->script('GetLocation'); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
SpeedTest();
startFunc();
 
google.maps.event.addDomListener(window, 'load', function() { 
    var lng = <?php echo $data[0]['Place']['longitude'] ;?>; 
    var lat = <?php echo $data[0]['Place']['latitude'] ;?>; 

    var latlng = new google.maps.LatLng(lat, lng); 
    var mapOptions = { 
        zoom: 18, 
        center: latlng, 
        mapTypeId: google.maps.MapTypeId.ROADMAP, 
        scaleControl: true 
    }; 
    var mapObj = new google.maps.Map(document.getElementById('gmap'), mapOptions); 

    var marker = new google.maps.Marker({ 
        position: latlng, 
        map: mapObj 
    }); 
});
</script>

<?php
$arr = $data;
	$arr = $data[0];
	echo '<div class="miginiyoseru">';

		echo '<div class="row">';
			echo '<div class="span9">';
			echo '<h1 class="PlaceName2">';
				echo  $arr['Place']['name']. ' ';
				echo "<span class='VagueGrayGenre'>";
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
				echo "</span>";
			echo '</h1>';
			echo '</div>';
			echo '<div class="span2">';
				echo '<p><a href=' . $this->Html->url(array('controller' => 'Places' , 'action' => 'edit')) . "/" . $data[0]['Place']['id'] . ' class="btn btn-orange margin-edit-button">編集する</a></p>';
			echo '</div>';
		echo '</div>';

		echo '<div class="row">';
			echo '<div class="span2">';
				if($arr['Place']['avatar_file_name'] != null){
					echo $this->Upload->uploadImage($arr['Place'], 'Place.avatar', array('style' => 'thumb'));
				} else {
					echo "<img border='0' src='/Classics/img/NoImage.jpg' width='170'>";
				}
			echo '</div>';
			echo '<div class="span3">';
				if($arr['Place']['wifi_existence'] == 0){
					echo '<span class="VagueGrayVagueGrayWifiMbps">wifiなし</span>';
				} else if($arr['Place']['wifi_average_speed'] == 0){
					echo '<span class="VagueGrayVagueGrayWifiMbps">未測定</span>';
				} else {
					echo '<h3 class="WifiAverageSpeed">' . $arr['Place']['wifi_average_speed'] . '<span class="VagueGrayVagueGrayWifiMbps">Mbps</span></h3>';
				}
				echo '<h3 class="AveragePaymentNumber">' . number_format($arr['Place']['payment_average']) . '<span class="VagueGrayVagueGrayWifiMbps">ペソ</span></h3>';
			echo '</div>';
			echo '<div class="span4">';
				echo '<p class="IndexComment">' . $arr['Place']['comment'] . '</p>';
			echo '</div>';
			echo '<div class="span2">';
				echo '<div class="MarginButtom">';
					echo '<span class="VagueGrayVagueGraySmall">営業時間</span>';
					echo '<br>';
					echo '<span class="BlackSmall">' . date("H時i分", strtotime($arr['Place']['open_time'])) . '</span>';
					echo '<span class="VagueGrayVagueGraySmall">〜</span>';
					echo '<span class="BlackSmall	">' . date("H時i分", strtotime($arr['Place']['close_time'])) . '</span>';
					echo '<br>';
				echo '</div>';
				echo '<div class="MarginButtom">';
					echo '<span class="VagueGrayVagueGraySmall">登録した人</span>';
					echo '<br>';
					if($created_user['username'] != "退会者"){
						echo "<a class='OrangeSmall' href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$created_user['id']}>{$created_user['username']}</a>";
					} else {
						echo "<span class='BlackSmall'}>{$created_user['username']}</span>";						
					}
					echo '<br>';
				echo '</div>';
				echo '<div class="MarginButtom">';
					echo '<span class="VagueGrayVagueGraySmall">登録日</span>';
					echo '<br>';
					echo '<span class="BlackSmall">' . date("Y年m月d日", strtotime($arr['Place']['created'])) . '</span>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>

<div class="container" style="margin-top:40px;">
  	<div class="span6">
  		<span class="label label-custom" id="kansou"><h4>これまでの感想</h4></span>
		<?php
		if (isset($data[0]['Post']['id'])) {
			for($i = 0; $i < count($data); $i++){
				$arr = $data[$i];

				echo '<div class="bs-docs-grid">';
					echo '<div class="row-fluid show-grid2">';
						echo '<div class="span3">';
							//Photo
							if($arr['Post']['avatar_file_name'] != null){
								echo "<td>" .  $this->Upload->uploadImage($arr, 'Post.avatar', array('style' => 'thumb')) . "</td>";
							} else {
								echo "<td><img border='0' src='/Classics/img/NoImage.jpg' width='170'></td>";
							}
						echo '</div>';
						echo '<div class="span9">';
							echo '<div class="row-fluid show-grid">';
								echo '<div class="span5">';
									if($arr['Post']['wifi_speed'] != 0){
										echo '<h3 class="PlaceShowPlaceWifiOrange">' . $arr['Post']['wifi_speed'] .'<span class="PlaceShowPlaceWifiGraySmall">Mbps</span></h3>';
									} else {
										echo '<h3 class="PlaceShowPlaceWifiGray">Wifi未測定</h3>';
									}
									echo "<h3 class='PlaceShowPlacePesoOrabge'>" . $arr['Post']['payment'] . "<span class='PlaceShowPlacePesoGray'>ペソ</span></h3>";
								echo '</div>';
								echo '<div class="span7">';
									echo '<p>';
										echo '<p class="IndexComment">' . $arr['Post']['comment'] . '</p>';
										echo '<br>';
										if($arr['User']['username'] !== "退会者"){
											echo '<a class="OrangeSmall" href=' . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$arr['User']['id']}>";
										}
										echo $arr['User']['username'];
										if($arr['User']['username'] !== "退会者"){
											echo '</a> &nbsp;';
										}
										echo "&nbsp;";
										echo date("Y/m/d H:i", strtotime($arr['Post']['created']));
									echo '</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
		?>
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
  	<div class="span5">
		<?php echo $this->Form->create('Post', array('class' => 'form-horizontal' , 'type' => 'file' , 'action' => 'add')); ?>
			<fieldset id="fieldset">
				<span class="label label-custom" id="toukou"><h4>お店のWifiに繋いで感想を登録して下さい</h4></span>
				<h3 class="WifiAverageSpeed" style=text-align:center;>
					<span class="VagueGrayVagueGrayWifiMbps">現在</span>
					<span id="wifi_speed_text"></span>
					<span class="VagueGrayVagueGrayWifiMbps">Mbps</span>
				</h3>
				<?php echo $this->Form->text('Post.places_id' , array('value' => $data[0]['Place']['id'] , 'type' => 'hidden')); ?>
				<?php echo $this->Form->input('Post.ConnectToShopFifi', array(
				'label' => '今繋いでいるのは',
				'type' => 'radio',
				'div' => 'radio-horizontal',
				'options' => array( 0 => "お店のWifi" , 1 => "その他" ),
				'value' => 1,
				'style' => 'float:none;',
				)); ?>
				<?php echo $this->Form->error('Post.ConnectToShopFifi');?>
				<?php echo $this->Form->input('Post.comment', array(
					'label' => '感想',
					'type' => 'textarea',
					'class' => 'input-xlarge',
					'cols' => 80,
					'rows' => 10,
				)); ?>
				<?php echo $this->Form->error('Post.comment');?>
				<?php echo $this->Form->text('Post.wifi_speed' , array('value' => '' , 'type' => 'hidden' , 'id' => 'wifi_speed'));?>
				<?php echo $this->Form->text('Post.latitude' , array('value' => '' , 'type' => 'hidden' , 'id' => 'latitude'));?>
				<?php echo $this->Form->text('Post.longitude' , array('value' => '' , 'type' => 'hidden' , 'id' => 'longitude'));?>
				<?php echo $this->Form->error('Post.time_zone');?>
				<?php echo $this->Form->input('Post.payment', array(
					'label' => '使った金額',
					'type' => 'text',
					'class' => 'input-xlarge',
					'helpBlock' => '一人あたりの金額をご入力下さい。'
				)); ?>
				<?php echo $this->Form->error('Post.payment'); ?>
				<?php echo $this->Form->input('avatar',array('type'=>'file','label'=>'写真'));?>
				<div class="form-actions">
					<?php echo $this->Form->submit('登録する', array(
						'div' => false,
						'class' => 'btn btn-orange btn-large',
					)); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
  	</div>
</div>

<!-- 地図の表示 -->
<?php if(isset($data[0]['Place']['longitude'])): ?>
<div class="container" style="margin:50px 0px 50px 30px;">
	<div id="gmap" style="width: 1170px; height: 600px; border: 1px solid Gray;"> </div> 
</div>
<?php endif ; ?>