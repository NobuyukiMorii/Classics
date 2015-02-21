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
		if($data[0]['User']['avatar_file_name']  != null){
			echo $this->Upload->uploadImage($data[0], 'User.avatar', array('style' => 'thumb'));
		} else {
			echo "<img border='0' src='/Classics/img/NoImage.jpg' width='170'>";
		}
		?>
    	</div>
	</div>
    <div class="ui-block-b margin-top-edit">
    	<div class="ui-bar ui-bar-a" id="mobile-imageB">
			<div class="outer" style="height:170px;">  
			    <div class="vertical_middle">  
			        <p class="inner mobile-spot-name"><span class="mobile-spot-name"><?php echo $data[0]['User']['username']; ?></span></p>  
			    </div>  
			</div>      		
    	</div>
    </div>
</div><!-- /grid-a -->

<!-- リストビュー -->
 <div id="list" class="ui-body-a">
	<?php
	echo $this->Form->create('User',array('type' => 'file' , 'action' => 'edit'));
	?>
	<p class="Edit-UserName">ユーザーネーム</p>
	<?php
	echo $this->Form->input('username' , array('default' => $data[0]['User']['username'] , 'label' => false));
	?>
	<br>
	<p class="Edit-UserPassword">パスワード</p>
	<?php
	echo $this->Form->input('password' , array('label' => false));
	?>
	<p class="Edit-UserPhoto">写真</p>
	<?php
	echo $this->Form->input('avatar',array('type'=>'file','label'=> false));
	?>
	<div class="PhotoEditMargin"></div>
	<?php
	echo $this->Form->submit('登録する', array(
		'div' => false,
		'class' => 'orange-submit',
	));
	?>
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