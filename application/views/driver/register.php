
        <div class="white_bg mapp_box">
        <?php echo anchor('#', img('/assets/images/login-logo.png', false, array('class' => 'login_img', 'alt' => lang('Trucker District')))); ?>
        <h1><?php echo lang('login_h1_heading'); ?></h1>
        <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open("register");?>
            	<div class="form-group">
            		<?php echo form_error('first_name'); ?>
					<?php echo form_input(array(
							'name' => 'first_name',
							'id' => 'first_name',
							'class' => 'form-control input-lg',
							'placeholder' => lang('First Name')
					)); ?>
					<?php echo form_error('last_name'); ?>
					<?php echo form_input(array(
							'name' => 'last_name',
							'id' => 'last_name',
							'class' => 'form-control input-lg',
							'placeholder' => lang('Last Name')
					)); ?>
					<?php echo form_error('email'); ?>
					<?php echo form_input(array(
							'name' => 'email',
							'id' => 'email',
							'class' => 'form-control input-lg',
							'placeholder' => lang('Email')
					)); ?>
					<?php echo form_error('phone'); ?>
					<?php echo form_input(array(
							'name' => 'phone',
							'id' => 'phone',
							'class' => 'form-control input-lg',
							'placeholder' => lang('Phone')
					)); ?>
					<?php echo form_error('password'); ?>
					<?php echo form_password(array(
							'name' => 'password',
							'id' => 'password',
							'class' => 'form-control input-lg',
							'placeholder' => lang('Password')
					)); ?>
					<?php echo form_error('password_confirm'); ?>
					<?php echo form_password(array(
							'name' => 'password_confirm',
							'id' => 'password_confirm',
							'class' => 'form-control input-lg',
							'placeholder' => lang('Confirm Password')
					)); ?>
					<?php echo form_button(array(
							'name' => 'register',
							'class' => 'btn btn-primary signin-but',
							'type' => 'submit'
					), lang('Register')); ?>
                </div> 
            <?php echo form_close();?>
             <div class="row">
             	<div class="col-sm-12 col-lg-12 col-md-12">
                        <div class="clearfix">
                        	<hr><hr>
                        	<h3><?php echo lang('Already have an account?'); ?> <span><?php echo anchor('login', lang('Login')); ?></span></h3>
                        </div>
                </div>
             </div>
        </div>