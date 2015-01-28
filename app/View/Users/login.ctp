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
      <button class="btn btn-success" id="addToJamp" style="margin-top: 20px;">新規ユーザー登録</button>
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

    <div class="container margin-top">

      <!-- Three columns of text below the carousel -->
      <div class="row margin-bottom">
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Find Wifi Spot</h2>
          <p>セブ市内でWiFiが快適に使えるカフェ、レストラン、ホテルなどを簡単に見つけられます！！</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Check Review</h2>
          <p>平均予算や営業時間、これまで使ったユーザーの感想など、過去に利用したユーザーの生の感想をお届けします！！</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" style="width: 140px; height: 140px;">
          <h2>Reliable Data</h2>
          <p>ユーザーの投稿によりデータが収集されるので、ブログよりも信頼性が高いです！！</p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Find Wifi Spot<span class="text-muted">First</span></h2>
          <p class="lead">こんな感じだよん！</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->
  </body>
  <?php echo $this->Html->script('jquery-1.11.2.min'); ?>
  <script>
  //新規登録ボタンが押されたら、User.addページに遷移する
  $(document).ready(function(){
    $('#addToJamp').click(function(){
      window.location.href = 'http://' + location.host + '/classics/Users/add';
    });
  });
  </script>
</html>