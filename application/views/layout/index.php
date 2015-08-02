<!doctype html>
<html class="fixed">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico">

    <title>Welcome to Trucker District :: Dashboard</title>

    <!-- Add CSS Files -->
    <link href="/assets/css/custom.css" rel="stylesheet">
    
  <!-- Add JS Files -->

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body class="pageid-1">

<!--Header Start-->
<?php if($header) echo $header ;?>
<!--Header End-->
<div class="contain_box">
	<div class="navbar-collapse collapse">
    <!--Contain_box Start-->
    <?php if(isset($left) && $left):?>
        	<?php echo $left ;?>
    <?php endif;?>
    </div>
</div>
<!--Contain_box End-->

<!--Contain_body Start-->
<?php if($middle) echo $middle ;?>
<!--Contain_body End-->
           	
<!-- Footer JavaScript -->
<?php if($footer) echo $footer ;?>
</body>
</html>
