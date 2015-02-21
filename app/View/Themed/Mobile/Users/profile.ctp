<?php echo $this->Html->script('BanningScrol'); ?>
<?php echo $this->Html->css('pagination') ; ?>
<div data-role="header" data-theme="a" data-position="fixed">
 	<a href="javascript:history.back();" class="ui-btn ui-btn-icon-left ui-icon-arrow-l ui-btn-icon-notext ui-corner-all" data-ajax="false"></a>
		<h1>Cebu Wifi</h1>
 	<a href="<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'index'));?>" class="ui-btn ui-btn-icon-right ui-icon-home ui-btn-icon-notext ui-corner-all" data-ajax="false"></a>
</div>

<div class="ui-grid-a">
    <div class="ui-block-a" style="height:170px;">
    	<div class="ui-bar ui-bar-a" id="mobile-imageA">
    	<?php
		if($data_user[0]['User']['avatar_file_name']  != null){
			echo $this->Upload->uploadImage($data_user[0] , 'User.avatar', array('style' => 'thumb'));
		} else {
			echo "<img border='0' src='/Classics/img/NoImage.jpg' width='170'>";
		}
		?>
    	</div>
	</div>
    <div class="ui-block-b">
    	<div class="ui-bar ui-bar-a" id="mobile-imageB">
    		<span class="mobile-spot-name"><?php echo $data_user[0]['User']['username']; ?></span>
    		<br>
    		<p>
    			<a href='<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'edit')); ?>' class="orange-button" data-role="button" data-ajax="false">
    				編集する
    			</a>
    		</p>
			<p>
				<a href='<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'delete')) ;?>' class="orange-button" data-role="button" data-ajax="false">
					退会する
				</a>
			</p>
    	</div>
    </div>
</div><!-- /grid-a -->

<!-- リストビュー -->
 <div id="list" class="ui-body-a">
	<ul data-role="listview">
		<?php if(isset($data_post[0]['Post']['id'])): ?>
			<?php for($i = 0; $i < count($data_post); $i++): ?>
				<?php $arr = $data_post[$i]; ?>
				<li class="ui-li-has-thumb">
					<a>
						<!-- 画像を表示する -->
						<?php if(!empty($arr['Post']['avatar_file_name'])): ?>
							<?php echo $this->Upload->uploadImage($arr['Post'], 'Post.avatar', array('style' => 'thumb'));?>
						<?php else: ?>
							<img border="0" src="/Classics/img/NoImage.jpg" width="170" class="ImageLeft" />
						<?php endif; ?>
						<!-- お店の名前を表示する -->
						<span class="ShopName">
							<?php echo $arr['Place']['name']; ?>
						</span>
						<br>

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

<!-- フッター -->
<div data-role="footer" data-position="fixed">
    <div data-role="navbar">
  		<ul>
		    <li><a href="<?php echo $this->Html->url(array('controller' => 'Places' , 'action' => 'add')); ?>" data-icon="plus" class="ui-btn-active" data-ajax="false"></a></li>
		    <li><a href="<?php echo $this->Html->url(array('controller' => 'Users' , 'action' => 'profile')); ?>" data-icon="user" data-ajax="false"></a></li>
  		</ul>
    </div>
</div>