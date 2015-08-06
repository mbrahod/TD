<!--Header Start-->
<div class="search_main_box">
	<div class="text-center log_b">
        <?php echo anchor('/', img('/assets/images/search-logo.png', false, array('alt' => 'Trucker District'))); ?>
        <h1>THE WORLDS FIRST SOCIAL MAPPING PLATFORM FOR TRUCKERS</h1>
        <div class="white_bg">
            <?php echo form_open("search");?>
            	<?php echo form_input(array('name' => 'lat', 'type'=>'hidden', 'id' =>'lat')); ?>
            	<?php echo form_input(array('name' => 'long', 'type'=>'hidden', 'id' =>'long')); ?>
            	
            	<div class="search_box">
            		<?php echo form_input(array(
							'name' => 'search',
							'id' => 'search',
							'class' => 'search',
							'placeholder' => 'Enter a ZIP code and search'
					)); ?>
                	<span>
	                	<?php echo form_button(array(
								'name' => 'search',
								'class' => '',
								'type' => 'submit'
						), 'SEARCH'); ?>
					</span>
                </div>
                <div class="clearfix"><hr><hr></div>
                <div class="last_box">
                <div class="check_box">
                	<input class="cheak" name="checkbox" type="checkbox" value="checkbox">
                    <label for="RememberMe">DETECT MY LOCATION</label>
                </div>
                <div class="learn">
                	<h6><a href="#">Learn More About Trucker District</a></h6>
                </div>
                </div> 
            <?php echo form_close(); ?>
        </div>
	</div>
</div>
<!--Header End-->