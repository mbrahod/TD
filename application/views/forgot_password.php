<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!doctype html>
<html class="fixed">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico">

    <title>Welcome to Trucker District :: <?php echo $title; ?></title>

    <!-- Add CSS Files -->
    <link href="/assets/css/custom.css" rel="stylesheet">
    
  <!-- Add JS Files -->

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body class="pageid-12">

<!--Header Start-->
<div class="login_main_box">
	<div class="login_box">
        <div class="white_bg mapp_box">
        <?php echo anchor('#', img('/assets/images/login-logo.png', false, array('class' => 'login_img', 'alt' => lang('Trucker District')))); ?>
        <h1><?php echo lang('login_h1_heading'); ?></h1>
        <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open("forgot_password");?>
            	<div class="form-group">
					<?php echo form_input(array(
							'name' => 'email',
							'id' => 'email',
							'class' => 'form-control input-lg',
							'placeholder' => lang('login_identity_placeholder')
					)); ?>
					<?php echo form_submit(array(
							'name' => 'forgotbtn',
							'class' => 'btn btn-primary signin-but'
					), lang('forgot_password_submit_btn')); ?>
                </div>
                
            <?php echo form_close();?>
        </div>
	</div>
</div>
<!--Header End-->

<!--Contain_box Start-->

</div>

<!--Contain_body End-->
           	
  <!-- Footer JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>