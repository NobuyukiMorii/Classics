<div class="span8">

</div>

<div class="span3">
	<?php
	echo '<h4>名前で検索</h4>';
	echo $this->Form->create('User' , array('type' => 'post' , 'action' => 'serchUser' , 'novalidate' => true));
	echo $this->Form->input('User.username' , array('label' => false));
	echo $this->Form->end('送信');
	?>
</div>

<?php
for($i = 0; $i < count($data); $i++){
	$arr = $data[$i];
	$rank = $i + 1;
	echo '<div class="row">';
	  	echo '<div class="span9">';
	    	echo '<div class="row">';
	    		echo "<div class='span2'>";
	    			if($rank === 1){
	    				echo "<h1>KING</h1>";
	    			} else {
	    				echo "<h1>" . $rank . "位</h1>";
	    			}
	    		echo "</div>";
	      		echo "<div class='span2'>";
	      			//Photo
					if($arr['User']['avatar_file_name'] != null){
						echo "<td>" .  $this->Upload->uploadImage($arr['User'] , 'User.avatar', array('style' => 'thumb')) . "</td>";
					} else {
						echo "<td><img border='0' src='http://www.tg-net.co.jp/html/noimage.jpg' width='128'></td>";
					}
	      		echo "</div>";
	      		echo '<div class="span5">';
					echo '<div class="row">';
			  			echo '<div class="span9">';
			    			echo '<div class="row">';
			      				echo '<div class="span3">';
			      					echo '<h3><a href=' . $this->Html->url(array('controller' => 'Users' , 'action' => 'show')) . "/" . $arr['User']['id'] . '>' . $arr['User']['username'] . '</a></h3>';
			      				echo '</div>';
			      				echo '<div class="span2">';
			      					echo '<h3>' . $arr['User']['wifi_average_speed'] . 'Mbps</h3>';
			      				echo '</div>';
			      				echo '<div class="span2">';
			      					echo '<h3>平均' . $arr['User']['payment_average'] . 'peso</h3>';
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

<div class="text-center">
	<div class="pagination">                         
	  <ul>                                           
	    <?php 
	    	echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>'));                             
			echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		?>
	  </ul>                                          
	</div>
</div>

