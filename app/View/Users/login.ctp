<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">

    <title>Siimple - Free Bootstrap 3 Landing Page</title>

    <!-- Bootstrap -->
    <link href="<?php echo $this->Html->webroot ;?>css/bootstrap3/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $this->Html->webroot ;?>css/bootstrap3/bootstrap-theme.css" rel="stylesheet">

    <!-- siimple style -->
    <link href="<?php echo $this->Html->webroot ;?>css/login.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

	<div id="header">
		<div class="container">
			<?php
			//認証エラーの表示
			if($this->Session->check('Message.auth'))
			echo $this->Session->flash('auth');
			;?>
			<div class="row">
				<div class="col-lg-6">
					<?php echo $this->Html->image('CebuWifi.png', array('alt' => 'CebuWifi'));?>
					<?php echo $this->Form->create('User', array('action' => 'login' , 'class' => 'form-inline signup')); ?>
					  <div class="form-group">
							<?php echo $this->Form->input('User.username', array(
								'type' => 'text',
								'class' => 'form-control',
								'placeholder' => 'ユーザー名',
							)); ?>						
							<?php echo $this->Form->input('User.password', array(
								'class' => 'form-control',
								'placeholder' => 'パスワード',
							)); ?>	
					  </div>
					  <button type="submit" class="btn btn-theme">Login</button>
					</form>					
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
					<p class="copyright">Copyright &copy; 2015 - Morii NObuyuki</p>
			</div>
		</div>		
	</div>	
	</div>

  </body>
</html>
