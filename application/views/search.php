<!doctype html>
<html class="fixed">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <title>Welcome to Trucker District :: Message center</title>

    <!-- Add CSS Files -->
    <link href="assets/css/custom.css" rel="stylesheet">
    
    <script src='https://api.mapbox.com/mapbox.js/v2.2.1/mapbox.js'></script>
	<link href='https://api.mapbox.com/mapbox.js/v2.2.1/mapbox.css' rel='stylesheet' />
    
 	<!-- Add JS Files -->

  	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  	<script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
  		#map { position:absolute; top:0; bottom:0; width:100%; }
	</style>
  </head>

<body class="pageid-14">

<!--Header Start-->
<div class="header">
	  <div class="row">
    		<div class="col-sm-12 col-lg-12 col-md-12 header_logo"> 
            	<?php echo anchor('/', img('/assets/images/logo.png', false, array('alt' => 'Trucker District'))); ?>
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse"> </button>
        	</div>
   	 </div>
</div>
<!--Header End-->

<!--Contain_box Start-->
<div class="contain_box">
	
	<div class="navbar-collapse collapse">
    	<div class="sidebar-left">
        	<h4>menu</h4>
          <ul class="menu_link">
              <li><?php echo anchor('/', 'HOME'); ?></li>
			  <li class="active"><a href="#">EXPLORE</a></li>
			  <li><a href="#">CAREER CENTER</a></li>
              <li><?php echo anchor('register', 'SIGN UP'); ?></li>
              <li><?php echo anchor('login', 'LOG IN'); ?></li>	
          </ul>
          	<?php echo form_open("search");?>
            	<!-- <input type="search" placeholder="" value="SEARCH ZIP"/> -->
            	<?php echo form_input(array(
						'name' => 'search',
						'id' => 'search',
						'class' => 'search',
            			'type' => 'search',
						'placeholder' => 'SEARCH ZIP'
					)); ?>
            	<?php echo form_input(array('name' => 'lat', 'type'=>'hidden', 'id' =>'lat', 'value' => $latitude)); ?>
            	<?php echo form_input(array('name' => 'long', 'type'=>'hidden', 'id' =>'long', 'value' => $langitude)); ?>
            	<!-- <button type="button"> </button> -->
            	<?php echo form_button(array(
								'name' => 'search',
								'class' => '',
								'type' => 'submit'
						), ''); ?>
             <?php echo form_close(); ?>
    	</div>
    </div>
</div>
<!--Contain_box End-->

<!--Contain_body Start-->
<div id='map'></div>
<div class="content-pointer">
	<!-- <img src="assets/images/popup.png">
    <div class="pointer">
		<h3>Loves Keller IS-45</h3>
		<h4>keller tx</h4>
		<div class="clearfix">
			<hr><hr>
		</div>
		<h5>FAVORITE THIS STOP</h5>
        <img class="arrow" src="assets/images/arrow_b.png">
  	</div> -->
</div>

<!--Contain_body End-->
<script type="text/javascript">
L.mapbox.accessToken = '<?php echo $this->config->item('public_access_token'); ?>';
var map = L.mapbox.map('map', 'mapbox.streets').setView([<?php echo $latitude . "," . $langitude; ?>], 9);

var myLayer = L.mapbox.featureLayer().addTo(map);
L.marker([<?php echo $latitude . "," . $langitude; ?>]).addTo(map);

</script>

  <!-- Footer JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>