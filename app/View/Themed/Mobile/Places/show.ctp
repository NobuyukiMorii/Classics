<?php echo $this->Html->css('pagination') ; ?>
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


<div data-role="header" data-theme="a" data-position="fixed">
 	<a href="javascript:history.back();" class="ui-btn ui-btn-icon-left ui-icon-arrow-l ui-btn-icon-notext ui-corner-all" data-ajax="false"></a>
		<h1>Cebu Wifi</h1>
 	<a href="<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index'));?>" class="ui-btn ui-btn-icon-right ui-icon-home ui-btn-icon-notext ui-corner-all" data-ajax="false"></a>
</div>

<div class="ui-grid-a">
    <div class="ui-block-a" style="height:170px;">
    	<div class="ui-bar ui-bar-a" id="mobile-imageA">
    	<?php
		if($data[0]['Place']['avatar_file_name'] != null){
			echo $this->Upload->uploadImage($data[0]['Place'], 'Place.avatar', array('style' => 'thumb' , 'border' => 0));
		} else {
			echo "<img border='0' src='/Classics/img/NoImage.jpg' width='170'>";
		}
		?>
    	</div>
	</div>
    <div class="ui-block-b">
    	<div class="ui-bar ui-bar-a" id="mobile-imageB">
    		<span class="mobile-spot-name"><?php echo $data[0]['Place']['name']; ?></span>
    		<br>
    		<?php
				if($data[0]['Place']['wifi_existence'] == 0){
					echo '<span class="VagueGrayVagueGrayWifiMbps">wifiなし</span>';
				} else if($data[0]['Place']['wifi_average_speed'] == 0){
					echo '<span class="VagueGrayVagueGrayWifiMbps">未測定</span>';
				} else {
					echo '<h3 class="WifiAverageSpeed">' . $data[0]['Place']['wifi_average_speed'] . '<span class="VagueGrayVagueGrayWifiMbps">Mbps</span></h3>';
				}
			?>
			<br>
			<?php
			echo '<span class="AveragePaymentNumber">' . number_format($data[0]['Place']['payment_average']) . '<span class="VagueGrayVagueGrayWifiMbps">ペソ</span></h3>';
			?>
			<br>
			<?php 
			echo '<span class="BlackSmall">' . date("H時i分", strtotime($data[0]['Place']['open_time'])) . '</span>';
			echo '<span class="BlackSmall">〜</span>';
			echo '<span class="BlackSmall	">' . date("H時i分", strtotime($data[0]['Place']['close_time'])) . '</span>';
			?>
			<br>
			<?php
			if($created_user['username'] != "退会者"){
				echo "<a class='OrangeSmall' data-ajax='false' href=" . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/{$created_user['id']}>{$created_user['username']}</a>";
			} else {
				echo "<span class='BlackSmall'}>{$created_user['username']}</span>";						
			}
			?>
			<a href="<?php $this->Html->url(array('controller' => 'Places' , 'action' => 'edit')) . "/" . $data[0]['Place']['id'];?>" data-role="button" class="orange-button">編集する</a>
    	</div>
    </div>
</div><!-- /grid-a -->
<div class="ui-grid-a">
	<?php
	echo '<span class="IndexComment">' . $data[0]['Place']['comment'] . '</span>';
	?>
</div>

<!-- 地図 -->
<?php if(isset($data[0]['Place']['longitude'])): ?>
		<div id="gmap" style="width: 120%; height: 300px; border: 1px solid Gray;"> </div> 
<?php endif ; ?>

<!--3タブパネル全体を定義-->
<div id="tabs" data-role="tabs">
    <!--2タブリストを準備-->
    <div data-role="navbar">
        <ul>
          	<li><a href="#backbone" class="ui-btn-active">みんなの感想</a></li>
          	<li><a href="#angular">感想を入力</a></li>
        </ul>
    </div>
    <!--1パネル（コンテンツ領域）を準備-->
    <div id="backbone" class="ui-body ui-body-a listview-post">

    	<!-- リストビュー -->
	  	<div id="list" class="ui-body-a">
			<ul data-role="listview">
				<?php if(isset($data[0]['Post']['id'])): ?>
				<?php for($i = 0; $i < count($data); $i++): ?>

					<?php $arr = $data[$i]; ?>
					<li class="ui-li-has-thumb">
						<a>
							<!-- 画像を表示する -->
							<?php if($arr['Post']['avatar_file_name'] != null): ?>
								<?php echo $this->Upload->uploadImage($arr , 'Post.avatar', array('style' => 'thumb') , array('class' => 'ImageLeft'));?>
							<?php else: ?>
								<img border="0" src="/Classics/img/NoImage.jpg" width="170" class="ImageLeft" />
							<?php endif; ?>

							<!-- Wifiの速度を表示する -->
							<?php if($arr['Post']['wifi_speed'] != 0): ?>
								<?php echo '<span class="WifiAverageSpeed">' . $arr['Post']['wifi_speed']. '<span class="VagueGrayVagueGrayWifiMbps">Mbps</span></span>';?>
							<?php else: ?>
								<span class="VagueGrayVagueGrayWifiMbps">Wifi未測定</span>
							<?php endif; ?>
							<br>

							<!-- 平均金額を表示する -->
							<?php
							echo "<span class='PlaceShowPlacePesoOrabge'>" . $arr['Post']['payment'] . "<span class='PlaceShowPlacePesoGray'>ペソ</span></span>";
							?>
							<br>
							<!-- 投稿者情報 -->
							<?php
							echo $arr['User']['username'];
							?>
						</a>
					</li>	
				<?php endfor; ?>
				<?php endif; ?>
			</ul>
			<!-- ページネーション -->
			<div class="pagination">                         
			  <ul>                                           
			    <?php echo $this->Paginator->prev(__('prev'), array('tag' => 'li', 'data-ajax' => "false"), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
			    <?php echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled' , 'data-ajax' => "false"), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
			  </ul>                                          
			</div>  

	  	</div>

    </div>
    <div id="angular" class="ui-body ui-body-a">
	    <?php echo $this->Form->create('Post', array('class' => 'form-horizontal' , 'type' => 'file' , 'action' => 'add')); ?>
			<fieldset id="fieldset">

				<?php echo $this->Form->text('Post.places_id' , array('value' => $data[0]['Place']['id'] , 'type' => 'hidden' , 'data-ajax'=>"false")); ?>

				<div class="ui-grid-a margin-delete">
				    <div class="ui-block-a" style="height:170px;">
				    	<div class="ui-bar ui-bar-a" id="mobile-imageA">
							<h3 class="WifiAverageSpeed">
								<span class="VagueGrayVagueGrayWifiMbps">現在</span>
								<span id="wifi_speed_text"></span>
								<span class="VagueGrayVagueGrayWifiMbps">Mbps</span>
							</h3>
				    	</div>
					</div>
				    <div class="ui-block-b">
				    	<div class="ui-bar ui-bar-a" id="mobile-imageB">
							<!-- 利用中のwifiの選択 -->
							<div class="containing-element switch-margin">
								<?php
								echo $this->Form->input('Post.ConnectToShopFifi', array(
									'label' => false,
									'type' => 'select',
									'options' => array(0 => "お店のWifi" , 1 => "お店以外のWifi"),
									'value' => 1,
									'data-role' => "slider",
								));
								?>
							</div>
				    	</div>
				    </div>
				</div><!-- /grid-a -->				

				<?php echo $this->Form->error('Post.ConnectToShopFifi');?>
				<!-- コメントを入力 -->

				<p class="Comment">感想を入力して下さい。</p>
				<?php echo $this->Form->input('Post.comment', array(
					'label' => false,
					'type' => 'textarea',
					'class' => 'input-xlarge',
					'cols' => 80,
					'rows' => 5,
				)); ?>
				<?php echo $this->Form->error('Post.comment');?>

				<?php echo $this->Form->text('Post.wifi_speed' , array('value' => '' , 'type' => 'hidden' , 'id' => 'wifi_speed'));?>
				<?php echo $this->Form->text('Post.latitude' , array('value' => '' , 'type' => 'hidden' , 'id' => 'latitude'));?>
				<?php echo $this->Form->text('Post.longitude' , array('value' => '' , 'type' => 'hidden' , 'id' => 'longitude'));?>

				<br>
				<!-- 支払い金額の入力 -->
				<p class="Comment2">支払った金額をご記入下さい。（ペソ単位）</p>
				<?php echo $this->Form->input('Post.payment', array(
					'label' => false,
					'type' => 'text',
					'class' => 'input-xlarge',
					'placeholder' =>'ex.)100'
				)); ?>
				<?php echo $this->Form->error('Post.payment'); ?>

				<br>
				<!-- 写真を登録する -->
				<p class="Comment3">写真を選択して下さい。</p>
				<?php echo $this->Form->input('avatar',array('type'=>'file','label'=>false));?>

				<br>
				<div class="form-actions">
					<?php echo $this->Form->submit('登録する', array(
						'div' => false,
						'class' => 'orange-submit',
					)); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
    </div>
</div>

<!-- フッター -->
<div data-role="footer" data-position="fixed">
    <div data-role="navbar">
  		<ul>
		    <li><a href="<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'add')); ?>" data-icon="plus" class="ui-btn-active" data-ajax="false"></a></li>
		    <li><a href="<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'profile')); ?>" data-icon="user" data-ajax="false"></a></li>
  		</ul>
    </div>
</div>