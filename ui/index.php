<!-- ---------------------------------------------------------------------------
#  lan.scanner
#  Open Source Network scanner 
#
#  devices.php - Front module. Devices list page
#-------------------------------------------------------------------------------
#  eugef 2023        eugef66@gmail.com        GNU GPLv3
#--------------------------------------------------------------------------- -->

<?php
require 'header.php';
?>

<!-- Page ------------------------------------------------------------------ -->
  <div class="content-wrapper">

	<!-- Content header--------------------------------------------------------- -->
	<section class="content-header">
		<h1 id="pageTitle">
			Devices
		</h1>
	</section>

	<!-- Main content ---------------------------------------------------------- -->
	<section class="content">

		<!-- top small box 1 ------------------------------------------------------- -->
		<div class="row">

			<div class="col-lg-2 col-sm-4 col-xs-6">
				<a href="index.php?filter=all" >
					<div class="small-box bg-green pa-small-box-green pa-small-box-2">
						<div class="inner">
							<h3 id="all_count"> -- </h3>
						</div>
						<div class="icon"> <i class="fa fa-laptop text-green-20"></i> </div>
						<div class="small-box-footer pa-small-box-footer"> All Devices <i
								class="fa fa-arrow-circle-right"></i> </div>
					</div>
				</a>
			</div>

			<!-- top small box 2 ------------------------------------------------------- -->
			<div class="col-lg-2 col-sm-4 col-xs-6">
				<a href="index.php?filter=new">
					<div class="small-box bg-yellow pa-small-box-yellow pa-small-box-2">
						<div class="inner">
							<h3 id="new_count"> -- </h3>
						</div>
						<div class="icon"> <i class="ion ion-plus-round text-yellow-20"></i> </div>
						<div class="small-box-footer pa-small-box-footer"> New Devices <i
								class="fa fa-arrow-circle-right"></i> </div>
					</div>
				</a>
			</div>

			<!-- top small box 3 ------------------------------------------------------- -->
			<div class="col-lg-2 col-sm-4 col-xs-6">
				<a href="index.php?filter=online">
					<div class="small-box bg-aqua pa-small-box-aqua pa-small-box-2">
						<div class="inner">
							<h3 id="online_count"> -- </h3>
						</div>
						<div class="icon"> <i class="fa fa-plug text-aqua-20"></i> </div>
						<div class="small-box-footer pa-small-box-footer"> On-line Devices<i
								class="fa fa-arrow-circle-right"></i> </div>
					</div>
				</a>
			</div>

			<!-- top small box 4 ------------------------------------------------------- -->
			<div class="col-lg-2 col-sm-4 col-xs-6">
				<a href="index.php?filter=down">
					<div class="small-box bg-red pa-small-box-red pa-small-box-2">
						<div class="inner">
							<h3 id="down_count"> -- </h3>
						</div>
						<div class="icon"> <i class="fa fa-warning text-red-20"></i> </div>
						<div class="small-box-footer pa-small-box-footer"> Down Devices <i
								class="fa fa-arrow-circle-right"></i> </div>
					</div>
				</a>
			</div>
		</div>
		<!-- /.row -->

		<!-- datatable ------------------------------------------------------------- -->
		<div class="row">
			<div class="col-xs-12">
				<div id="tableDevicesBox" class="box">

					<!-- box-header -->
					<div class="box-header">
						<h3 id="tableDevicesTitle" class="box-title text-gray">Devices</h3>
					</div>

					<!-- table -->
					<div class="box-body table-responsive">
						<table id="devices" class="table table-bordered table-hover table-striped"></table>
					</div>
					<!-- /.box-body -->

				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- ----------------------------------------------------------------------- -->
	</section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- ----------------------------------------------------------------------- -->

<?php
require 'footer.php';
?>

<!-- ----------------------------------------------------------------------- -->
<!-- Datatable -->
<link rel="stylesheet" href="lib/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="lib/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="lib/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="index.js"></script>

<script>
load();
</script>







