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
                            			'fb_login', 
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
                        	<h3><?php echo lang('login_dont_have_account_txt'); ?> <span><?php echo anchor('register', lang('HERE')); ?></span></h3>
                        </div>
                </div>
             </div>
        </div>