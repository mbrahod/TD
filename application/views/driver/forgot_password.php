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
                <div class="last_box">
	                <div class="learn">
	                	<?php echo anchor(
	                			'login', 
	                			lang('login_heading'), 
	                			array(
	                				'title' => lang('login_heading'),
	                				'alt' => lang('login_heading')
	                	)); ?>
	                </div>
                </div> 
            <?php echo form_close();?>
        </div>