<!doctype html>
<html class="fixed">
	<!--Header Start-->
	<?php if($auth_header) echo $auth_header ;?>
	<!--Header End-->

	<body class="pageid-12">
		<!--Header Start-->
		<div class="login_main_box">
			<div class="login_box">
        		<?php if($auth_middle) echo $auth_middle;?>
			</div>
		</div>
		<!--Header End-->
	</div>

	<!-- Footer JavaScript -->
	<?php if($auth_footer) echo $auth_footer ;?>
	<!-- Footer JavaScript -->
	</body>
</html>