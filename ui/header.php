<?php
require 'config.php';
?>
<!-- ---------------------------------------------------------------------------
#  lan.scanner
#  Open Source Network Guard / WIFI & LAN intrusion detector 
#
#  header.php - Front module. Common header to all the web pages 
#-------------------------------------------------------------------------------
#  eugef 2021        eugef66@gmail.com        GNU GPLv3
#--------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html>

<!-- ----------------------------------------------------------------------- -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>lan.scanner</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="lib/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="lib/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">

	<!-- Ionicons -->
	<link rel="stylesheet" href="lib/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" href="lib/AdminLTE/dist/css/AdminLTE.min.css">

	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
		page. However, you can choose any other skin. Make sure you
		apply the skin class to the body tag so the changes take effect. -->
	<link rel="stylesheet" href="lib/AdminLTE/dist/css/skins/_all-skins.min.css">

	<!-- lan.scanner CSS -->
	<link rel="stylesheet" href="css/lanscanner.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	

	<!-- Google Font -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- Page Icon -->
	<link rel="icon" type="image/png" sizes="160x160" href="img/<?=$logo ?>" />

	<!-- Favicon -->

	<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="img/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
	<link rel="manifest" href="img/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="img/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- .Favicons -->
</head>

<!-- ----------------------------------------------------------------------- -->
<!-- Layout Boxed green -->

<body class="hold-transition <?=$skin?> layout-boxed sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<!-- Main Header -->
		<header class="main-header">

			<!-- ----------------------------------------------------------------------- -->
			<!-- Logo -->
			<a href="." class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">l<b>.s</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">lan<b>.scanner</b></span>
			</a>

			<!-- ----------------------------------------------------------------------- -->
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">

						<!-- Server Name -->
						<li><a style="pointer-events:none;">
								<?php echo gethostname(); ?>
							</a></li>

						<!-- Header right info -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">

								<img src="img/Logo.png" class="user-image" style="border-radius: initial"
									alt="lan.scanner Logo">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs">lan.scanner</span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="img/Logo.png" class="img-circle" alt="lan.scanner Logo"
										style="border-color:transparent">
									<p>
										Open Source Network Scanner
									</p>
								</li>

								<!-- Menu Body -->
								<li class="user-body">
									<div class="row">
										<div class="col-xs-4 text-center">
											<a target="_blank" href="https://github.com/eugef66/lan.scanner">GitHub
												lan.scanner</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="mailto:eugef66@gmail.com">email Support</a>
										</div>
										<div class="col-xs-4 text-center">
											<a target="_blank"
												href="https://github.com/eugef66/lan.scanner/blob/master/LICENSE">GNU
												GPLv3</a>
										</div>
										<!--
				  <div class="col-xs-4 text-center">
					<a href="#">Updates</a>
				  </div>
				  -->
									</div>
									<!-- /.row -->
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<!-- ----------------------------------------------------------------------- -->
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">

			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">

				<!-- Sidebar user panel (optional) -->
				<div class="user-panel">
					<a href="." class="logo">
						<img src="img/Logo.png" class="img-responsive" alt="lan.scanner Logo" />
					</a>
				</div>

				<!-- search form (Optional) -->
				<!-- DELETED -->

				<!-- Sidebar Menu -->
				<ul class="sidebar-menu" data-widget="tree">
					<!--
	<li class="header">MAIN MENU</li>
-->

					<li
						class=" <?php if (in_array(basename($_SERVER['SCRIPT_NAME']), array('index.php', 'device.php'))) {
							echo 'active';
						} ?>">
						<a href="index.php"><i class="fa fa-laptop"></i> <span>Devices</span></a>
					</li>

					<!--
	 <li><a href="devices.php?status=favorites"><i class="fa fa-star"></i> <span>Favorites Devices</span></a></li>
-->

					<li
						class=" <?php if (in_array(basename($_SERVER['SCRIPT_NAME']), array('admin.php'))) {
							echo 'active';
						} ?>">
						<a href="admin.php"><i class="fa fa-list-ul"></i> <span>Configurations</span></a>
					</li>

				</ul>

				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>