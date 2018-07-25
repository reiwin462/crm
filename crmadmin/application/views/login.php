<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Geo Grout CRM</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
	
	<link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/css/core.css">
	<link rel="stylesheet" href="../assets/css/misc-pages.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<body class="simple-page">
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="#">
				<span>Geo Grout</span>
			</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
		<h4 class="form-title m-b-xl text-center">Sign In With Your Geo Grout Account</h4>
			<form id="auth" class="form" method="post" action="<?php echo base_url("process/auth"); ?>">
				<div class="form-group">
					<input id="sign-in-email" type="email" name="username" class="form-control" placeholder="Email">
				</div>
				<div class="form-group">
					<input id="sign-in-password" type="password" name="password" class="form-control" placeholder="Password">
				</div>

				<input type="submit" class="btn btn-primary" value="SIGN IN"  >
			</form>
		</div>

	</div>

</body>
	
	<script src="<?php echo base_url(); ?>libs/bower/jquery/dist/jquery.js"></script>
	<script src="<?php echo base_url(); ?>libs/bower/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
	<script src="<?php echo base_url(); ?>libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
	
	<script src="<?php echo base_url(); ?>libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="<?php echo base_url(); ?>libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js"></script>
	

</html>