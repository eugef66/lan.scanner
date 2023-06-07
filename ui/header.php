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
  <link rel="stylesheet" href="lib/AdminLTE/dist/css/skins/skin-green-light.min.css">

  <!-- lan.scanner CSS -->
  <link rel="stylesheet" href="css/lanscanner.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Page Icon -->
  <link rel="icon" type="image/png" sizes="160x160" href="img/pialertLogoGray80.png" />

  <!-- Favicon -->

	<link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
	<link rel="manifest" href="img/favicons/site.webmanifest">
	<link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
</head>

<!-- ----------------------------------------------------------------------- -->
<!-- Layout Boxed green -->
<body class="hold-transition skin-green-light layout-boxed sidebar-mini" style="background-image: url('img/background.png');">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

<!-- ----------------------------------------------------------------------- -->
    <!-- Logo -->
    <a href="." class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">P<b>a</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">lan<b>.scanner</b></span>
    </a>

<!-- ----------------------------------------------------------------------- -->
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Server Name -->
          <li><a style="pointer-events:none;"><?php echo gethostname(); ?></a></li>

          <!-- Header right info -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="img/pialertLogoWhite.png" class="user-image" style="border-radius: initial" alt="lan.scanner Logo">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">lan.scanner</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="img/pialertLogoWhite.png" class="img-circle" alt="lan.scanner Logo" style="border-color:transparent">
                <p>
                  Open Source Network Guard
                  <small>Designed for Raspberry Pi</small>
                </p>
              </li>

              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a target="_blank" href="https://github.com/eugef66/lan.scanner">GitHub lan.scanner</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="mailto:eugef66@gmail.com">email Support</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a target="_blank" href="https://github.com/eugef66/lan.scanner/blob/master/LICENSE">GNU GPLv3</a>
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

