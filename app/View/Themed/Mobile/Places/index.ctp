<?php echo $this->Html->css('pagination') ; ?>

<div data-role="header" data-theme="a" data-position="fixed">
 	<a href="javascript:history.back();" class="ui-btn ui-btn-icon-left ui-icon-arrow-l ui-btn-icon-notext ui-corner-all" data-ajax="false"></a>
		<h1>Cebu Wifi</h1>
 	<a href="<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index'));?>" class="ui-btn ui-btn-icon-right ui-icon-home ui-btn-icon-notext ui-corner-all" data-ajax="false"></a>
</div>

<!--2タブパネル全体を定義-->
<div id="tabs" data-role="tabs">
  	<!--2タブリストを準備-->
  	<div data-role="navbar" data-position="fixed">
    	<ul>
      		<li><a href="#list" class="ui-btn-active">リスト</a></li>
      		<li><a href="#form">検索</a></li>
    	</ul>
  	</div>
  	<!--1パネル（リスト領域）を準備-->
  	<div id="list" class="ui-body-a">
		<ul data-role="listview">
			<?php for ($i = 0; $i < count($data); ++$i): ?>
				<?php $arr = $data[$i]; ?>
				<li class="ui-li-has-thumb">
					<a href="<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'show')) . "/" . $arr['Place']['id']; ?>" rel="external">
						<!-- 画像を表示する -->
						<?php if($arr['Place']['avatar_file_name'] != null): ?>
							<?php echo $this->Upload->uploadImage($arr , 'Place.avatar', array('style' => 'thumb') , array('class' => 'ImageLeft'));?>
						<?php else: ?>
							<img border="0" src="/Classics/img/NoImage.jpg" width="170" class="ImageLeft" />
						<?php endif; ?>

						<!-- 名前を表示する -->
						<?php echo $arr['Place']['name']; ?>
						
						<!-- Wifiの速度を表示する -->
						<?php if($arr['Place']['wifi_existence'] == 0): ?>
							<span class="VagueGrayVagueGrayWifiMbps">wifiなし</span>
						<?php elseif($arr['Place']['wifi_average_speed'] == 0): ?>
							<span class="VagueGrayVagueGrayWifiMbps">Wifi未測定</span>
						<?php else: ?>

						<?php echo '<h3 class="WifiAverageSpeed">' . $arr['Place']['wifi_average_speed'] . '<span class="VagueGrayVagueGrayWifiMbps">Mbps</span></h3>';?>
						<?php endif; ?>
					</a>
				</li>	
			<?php endfor; ?>
		</ul>

		<div class="pagination">                         
		  <ul>                                           
		    <?php echo $this->Paginator->prev(__('prev'), array('tag' => 'li', 'data-ajax' => "false"), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
		    <?php echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled' , 'data-ajax' => "false"), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
		  </ul>                                          
		</div>  

  	</div>
  	<!--2パネル（検索領域）を準備-->
  	<div id="form" class="ui-body ui-body-a">

	    <!--3タブパネル全体を定義-->
	    <div id="tabs" data-role="tabs">
			<!--2タブリストを準備-->
			<div data-role="navbar">
			    <ul>
		         	<li><a href="#detail-search" class="ui-btn-active">詳細条件で検索</a></li>
		          	<li><a href="#name-search">名前で検索</a></li>
			    </ul>
		    </div>
		    <!--1パネル（コンテンツ領域）を準備-->
		    <div id="detail-search" class="ui-body ui-body-a">				
				<div class="container-fluid form-box">
				  	<div class="row-fluid">
					    <div class="span6 SerchFormGroup">

					    	<?php
					    	echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true ,'data-ajax'=>"false"));
					    	?>

							<?php
							if(empty($value_wifi_average_speed)){
								echo $this->Form->input('Place.wifi_average_speed', array(
									'label' => false,
									'type' => 'radio',
									'options' =>  array(0 => '0Mbps以上' , 1 =>'1Mbps以上' , 2 => '2Mbps以上', 3 => '3Mbps以上', 4 =>'4Mbps以上' , 5 => '5Mbps以上'),
									'value' => 0,
									'data-wrapper-class' => "custom-size-flipswitch",
									'class' => 'radio-genre'
								));
							} else {
								echo $this->Form->input('Place.wifi_average_speed', array(
									'label' => false,
									'type' => 'radio',
									'options' => array(0 => '0Mbps以上' , 1 =>'1Mbps以上' , 2 => '2Mbps以上', 3 => '3Mbps以上', 4 =>'4Mbps以上' , 5 => '5Mbps以上'),
									'value' => $value_wifi_average_speed,
									'data-wrapper-class' => "custom-size-flipswitch",
									'class' => 'radio-genre'
								));
							}
							;?>

							<?php
						
							if(empty($value_genre)){
								echo $this->Form->input('Place.genre', array(
									'label' => false,
									'type' => 'radio',
									'options' => array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他'),
									'value' => 0,
									'data-wrapper-class' => "custom-size-flipswitch",
									'class' => 'radio-genre'
								));
							} else {
								echo $this->Form->input('Place.genre', array(
									'label' => false,
									'type' => 'radio',
									'options' => array(0 => "カフェ" , 1 => "バー" , 2 => "レストラン" , 3 => "ホテル" , 4 => 'その他'),
									'value' => $value_genre ,
									'data-wrapper-class' => "custom-size-flipswitch",
									'class' => 'radio-genre'
								));
							}
							?>

							<div class="containing-element">
								<?php
								if(!isset($value_wifi_existence) ||$value_wifi_existence == 1){
									echo $this->Form->input('Place.wifi_existence', array(
										'label' => false,
										'type' => 'select',
										'options' => array(1 => "Wifiあり" , 0 => "Wifiなし"),
										'value' => 1,
										'data-role' => "slider",
									));
								} else {
									echo $this->Form->input('Place.wifi_existence', array(
										'label' => false,
										'type' => 'select',
										'options' => array(1 => "Wifiあり" , 0 => "Wifiなし"),
										'value' => 0,
										'data-role' => "slider",
									));
								}
								?>
							</div>

							<?php
							echo $this->Form->text('Place.flg' , array('value' => "other_form" , 'type' => 'hidden'));
							?>
							<?php
							$options = array('label' => '送信', 'class' => 'orange-submit', 'div' => false);
							echo $this->Form->end($options);
							?>
					    </div>
					 </div>
				</div>
		    </div>
		    <div id="name-search" class="ui-body ui-body-a">
				<div data-role="fieldcontain">
					<?php
					echo $this->Form->create('Place' , array('type' => 'post' , 'action' => 'index' , 'novalidate' => true , 'data-ajax'=>"false"));
					echo $this->Form->input('Place.name' , array('label' => false, 'type' => 'search'));
					echo $this->Form->text('Place.flg' , array('value' => "name_form" , 'type' => 'hidden'));
					$options = array('label' => '送信', 'class' => 'orange-submit', 'div' => false);
					echo $this->Form->end($options);
					?>
				</div>
		    </div>
	    </div>
  	</div>
</div>


<div data-role="footer" data-position="fixed">
    <div data-role="navbar">
  		<ul>
		    <li><a href="<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'add')); ?>" data-icon="plus" class="ui-btn-active" data-ajax="false"></a></li>
		    <li><a href="<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'profile')); ?>" data-icon="user" data-ajax="false"></a></li>
  		</ul>
    </div>
</div>