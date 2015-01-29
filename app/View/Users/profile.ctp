<?php

echo '<h1 class="page-header">' . $data_user[0]['User']['username'] . '</h1>';
echo '<div class="row">';
echo '<div class="span3">';
if($data_user[0]['User']['avatar_file_name'] != null){
	echo "<td>" .  $this->Upload->uploadImage($data_user[0] , 'User.avatar', array('style' => 'thumb')) . "</td>";
} else {
	echo "<td><img border='0' src='/Classics/img/NoImage.jpg' width='170'></td>";
}
echo '</div>';
echo '<div class="span3">';
	echo '<h3>';
	echo '平均' . $data_user[0]['User']['wifi_average_speed'] . 'Mbps';
	echo '</h3>';
	echo '<h3>';
	echo '平均' . $data_user[0]['User']['payment_average'] . 'peso';
	echo '</h3>';
echo '</div>';
echo '<div class="span3">';
	echo '<p><a href=' . $this->Html->url(array('controller' => 'Users' , 'action' => 'edit')) . ' class="btn btn-primary btn-large">プロフィールを編集する &raquo;</a></p>';
	echo '<p><a href=' . $this->Html->url(array('controller' => 'Users' , 'action' => 'delete')) . ' class="btn btn-primary btn-large">退会する &raquo;</a></p>';
echo '</div>';			


echo '</div>';

echo '<hr>';
?>

<div class="container" style="margin-top:40px;">
<div class="span5">

<h2 class="page-header" >登録したお店</h2>

<?php
for($i = 0; $i < count($data_place); $i++){
	$arr = $data_place[$i];
	echo '<div class="row">';
	  	echo '<div class="span9">';
	    	echo '<div class="row">';
	      		echo "<div class='span2'>";
	      			//Photo
					if($arr['Place']['avatar_file_name'] != null){
						echo 	$this->Upload->uploadImage($arr , 'Place.avatar', array('style' => 'thumb'));
					} else {
						echo 	"<img border='0' src='/Classics/img/NoImage.jpg' width='170'>";
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
			    			echo '</div>';

			    			echo '<div class="row">';
			      				echo '<div class="span2">';
			      					echo '<div class="row">';
			      						echo '<h3>' . $arr['Place']['wifi_average_speed'] . 'Mbps</h3>';
			      					echo '</div>';
			      					echo '<div class="row">';
			      						echo "<dl>";
											echo "<dt>" . $arr['Place']['payment_average'] . "peso</dt>";
											echo "<dt>" .  date("Y/m/d H:i", strtotime($arr['Place']['modified'])) . "更新</dt>";
										echo "</dl>";
			      					echo '</div>';	
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


</div>
<div class="span5">

<h2 class="page-header" >感想リスト</h2>

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
					echo '<div class="span5">';
						echo '<h3>' . $data_post[$i]['Post']['wifi_speed'] . 'Mbps</h3>';
						echo "<dl>";
						echo "<dt>" . $data_post[$i]['Post']['payment'] . "peso</dt>";
						echo "<dt>" . date("Y/m/d H:i", strtotime($data_post[$i]['Post']['created'])) . "</dt>";
						echo "</dl>";
					echo '</div>';
					echo '<div class="span7">';
						echo '<p>' . $data_post[$i]['Post']['comment'] . '）</strong></p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	echo '<hr>';
}
?>

</div>
</div>