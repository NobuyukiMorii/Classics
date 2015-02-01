<?php
	echo '<div class="miginiyoseru">';

		echo '<div class="row">';
			echo '<div class="span9">';
			echo '<h1 class="PlaceNameUserShow">';
				echo  $data_user[0]['User']['username'] . ' ';
			echo '</h1>';
			echo '</div>';
		echo '</div>';

		echo '<div class="row">';
			echo '<div class="span2">';
				if($data_user[0]['User']['avatar_file_name'] != null){
					echo "<td>" .  $this->Upload->uploadImage($data_user[0] , 'User.avatar', array('style' => 'thumb')) . "</td>";
				} else {
					echo "<td><img border='0' src='/Classics/img/NoImage.jpg' width='170'></td>";
				}
			echo '</div>';
			echo '<div class="span9">';
				if($data_user[0]['User']['wifi_average_speed'] == 0){
					echo '<span class="VagueGrayVagueGrayWifiMbps">未測定</span>';
				} else {
					echo '<h3 class="WifiAverageSpeed"><span class="VagueGrayVagueGrayWifiMbps">平均</span>' . $data_user[0]['User']['wifi_average_speed'] . '<span class="VagueGrayVagueGrayWifiMbps">Mbpsのwifiを利用しています。</span></h3>';
				}
				if($data_user[0]['User']['wifi_average_speed'] == 0){
					echo '<h3 class="AveragePaymentNumber">未測定<span class="VagueGrayVagueGrayWifiMbps">ペソ</span></h3>';
				} else {
					echo '<h3 class="AveragePaymentNumber"><span class="VagueGrayVagueGrayWifiMbps">平均</span>' . number_format($data_user[0]['User']['payment_average']) . '<span class="VagueGrayVagueGrayWifiMbps">ペソでお食事をされています。</span></h3>';					
				}
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>

<div class="container" style="margin-top:40px;">
  	<div class="span10">
  		<span class="label label-custom" id="toukouUserShow"><h4>これまでの感想</h4></span>
		<?php
			for($i = 0; $i < count($data_post); $i++){
				echo '<div class="bs-docs-grid">';
					echo '<div class="row-fluid show-grid">';
						echo '<div class="span3">';
							//Photo
							if($data_post[$i]['Post']['avatar_file_name'] != null){
								echo "<td>" . $this->Upload->uploadImage($data_post[$i], 'Post.avatar', array('style' => 'thumb')) . "</td>";
							} else {
								echo "<td><img border='0' src='/Classics/img/NoImage.jpg' width='170'></td>";
							}  
						echo '</div>';
						echo '<div class="span9">';
							echo '<div class="row-fluid show-grid">';
								echo '<div class="row">';
									echo '<div class="span6">';
										echo "<h3 class='UserShowPlaceName'>";
											echo $data_post[$i]['Place']['name'];
											echo "<span class='PlaceShowPlacePesoGray'>";
											switch ($data_post[$i]['Place']['genre']) {
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
										echo "</h3>";
									echo '</div>';
									echo '<div class="span3">';
										echo '<h3 class="PlaceShowPlaceWifiOrange">' . $data_post[$i]['Post']['wifi_speed'] .'<span class="PlaceShowPlaceWifiGraySmall">Mbps</span></h3>';
									echo '</div>';
									echo '<div class="span3">';
										echo "<h3 class='PlaceShowPlacePesoOrabge'>" . $data_post[$i]['Post']['payment'] . "<span class='PlaceShowPlacePesoGray'>ペソ</span></h3>";
									echo '</div>';
								echo '</div>';
								echo '<div class="row">';
									echo '<p>';
										echo '<p class="IndexComment">' . $data_post[$i]['Post']['comment'] . '</p>';
										echo date("Y/m/d H:i", strtotime($data_post[$i]['Post']['created']));
									echo '</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<hr>';
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
</div>