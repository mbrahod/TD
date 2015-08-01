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
            <?php echo form_open("login");?>
            	<div class="form-group">
					<?php echo form_input(array(
							'name' => 'username',
							'id' => 'username',
							'class' => 'form-control input-lg',
							'placeholder' => lang('login_identity_placeholder')
					)); ?>
					<?php echo form_password(array(
							'name' => 'password',
                			'id' => 'password',
							'class' => 'form-control input-lg',
							'placeholder' => lang('login_password_placeholder')
					));?>
					<?php echo form_button(array(
							'name' => 'signin',
							'class' => 'btn btn-primary signin-but',
							'type' => 'submit'
					), lang('login_submit_btn')); ?>
                </div>
                <div class="last_box">
                <div class="check_box">
                	<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                    <?php echo lang('login_remember_label', 'RememberMe');?>
                </div>
                <div class="learn">
                	<?php echo anchor(
                			'forgot_password', 
                			lang('login_forgot_password'), 
                			array(
                				'title' => lang('login_forgot_password'),
                				'alt' => lang('login_forgot_password')
                	)); ?>
                </div>
                </div> 
            <?php echo form_close();?>
             <div class="clearfix"><hr><hr></div>
             <div class="row">
             	<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="social">
                          <h3><?php echo lang('login_alternet_txt'); ?></h3>
                       	  <div class="twiter_box">
                            	<?php echo anchor(
                            			'#', 
                            			img(
                            				'/assets/images/twitter.png', 
                            				false, 
                            				array(
                            	))); ?>
								<h6><?php echo lang('login_twitter_txt'); ?></h6>
                            </div>
                            <div class="twiter_box">
                            	<?php echo anchor(
                            			'#', 
                            			img(
                            				'/assets/images/facebook.png', 
                            				false, 
                            				array(
                            	))); ?>
								<h6><?php echo lang('login_facebook_txt'); ?></h6>
                            </div>    
                          <div class="twiter_box">
                            	<?php echo anchor(
                            			'#', 
                            			img(
                            				'/assets/images/google.png', 
                            				false, 
                            				array(
                            	))); ?>
								<h6><?php echo lang('login_gplus_txt'); ?></h6>
                          	</div>	
						</div>
                        <div class="clearfix">
                        	<hr><hr>
                        	<h3><?php echo lang('login_dont_have_account_txt'); ?> <span><?php echo anchor('#', lang('HERE')); ?></span></h3>
                        </div>
                </div>
             </div>
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