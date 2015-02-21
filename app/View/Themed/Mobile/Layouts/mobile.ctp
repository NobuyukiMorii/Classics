<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="user-scalable=no">
	<title>jQuery Mobile: Theme Download</title>
	<?php echo $this->Html->css('CebuWifi.min') ;?>
	<?php echo $this->Html->css('jquery.mobile.icons.min.css') ;?>
	<?php echo $this->Html->css('jquery.mobile.structure-1.4.5.min.css') ;?>
	<?php echo $this->Html->css('style.css') ;?>
	<?php echo $this->Html->script('jquery-1.11.2.min.js') ;?>
	<?php echo $this->Html->script('jquery.mobile-1.4.5.js') ;?>
	<?php echo $this->fetch('meta') ;?>
	<?php echo $this->fetch('css') ;?>
	<?php echo $this->fetch('script') ;?>

</head>
<body>
	<div data-role="page" data-theme="a">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>