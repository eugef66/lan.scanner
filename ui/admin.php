<?php
require 'header.php';
require 'notification.php';
?>


<!-- Page ------------------------------------------------------------------ -->
<div class="content-wrapper">

	<!-- Content header--------------------------------------------------------- -->
	<section class="content-header">
		<?php require 'notification.php'; ?>

		<h1 id="pageTitle">
			Device Details
		</h1>

		<!-- Main content ---------------------------------------------------------- -->
		<section class="content">

<!-- form -->
<form action="updateMetadata.php" method='POST' id="adminForm">
			<!-- tab control------------------------------------------------------------ -->
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<!-- <div class="box-transparent"> -->
					<div class="row">
						<!-- column 1 -->
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<h4 class="bottom-border-aqua">Metadata</h4>
							<div class="box-body form-horizontal">

								<!-- Owner -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Owner</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input class="form-control" id="owner_value" name="owner" type="text"
												value="">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="owner" class="dropdown-menu dropdown-menu-right"></ul>
												<button type=button class="btn btn-success" id="btnOwnerSave"><i class="fa fa-floppy-o "></i></button>
												<button type=button class="btn btn-danger" disabled id="btnOwnerDelete"><i class="fa fa-trash"></i></button>
											</div>
										</div>
									</div>
								</div>

								<!-- Type -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Type</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input class="form-control" id="device_type_value" name="device_type" type="text"
												value="">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="device_type" class="dropdown-menu dropdown-menu-right">
												</ul>
												<button type=button class="btn btn-success" id="btnTypeSave"><i class="fa fa-floppy-o "></i></button>
												<button type=button class="btn btn-danger" disabled id="btnTypeDelete"><i class="fa fa-trash"></i></button>
											</div>
										</div>
									</div>
								</div>



								<!-- Location -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Location</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input class="form-control" id="location_value" name="location" type="text"
												value="">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="location" class="dropdown-menu dropdown-menu-right"></ul>
												<button type=button class="btn btn-success" id="btnLocationSave"><i class="fa fa-floppy-o"></i></button>
												<button type=button class="btn btn-danger" disabled id="btnLocationDelete"><i class="fa fa-trash"></i></button>
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>

						<!-- column 2 -->
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<h4 class="bottom-border-aqua">Appirence</h4>
							<div class="box-body form-horizontal">

								<!-- Status -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Status</label>
									<div class="col-sm-7">
										<input class="form-control" id="status" name="status" type="text" readonly value="--">
									</div>
								</div>

								<!-- IP -->
								<div class="form-group">
									<label class="col-sm-5 control-label">IP Address</label>
									<div class="col-sm-7">
										<input class="form-control" id="ip" name="ip" type="text" readonly value="--">
									</div>
								</div>


							</div>
						</div>

						
						<!-- Buttons -->
						<div class="col-xs-12">
							<div class="pull-right">
								<button type="submit" class="btn btn-success pa-btn" style="margin-left:6px; "
									id="btnSave" name="action" value="save"> Save </button> 
								<a class="btn btn-default pa-btn" style="margin-left:6px;" id="btnCancel"
									href="index.php"> Cancel </a>
							</div>
						</div>

					</div>
					<!-- </div> -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
</form>
<!-- /.form -->
			<!-- ----------------------------------------------------------------------- -->
		</section>
		<!-- /.content -->
	</section>
</div>
<!-- /.content-wrapper -->
<!-- ----------------------------------------------------------------------- -->
<?php
require 'footer.php';
?>


<!-- ----------------------------------------------------------------------- -->
<!-- iCkeck -->
<link rel="stylesheet" href="lib/AdminLTE/plugins/iCheck/all.css">
<script src="lib/AdminLTE/plugins/iCheck/icheck.min.js"></script>

<!-- Datatable -->
<link rel="stylesheet" href="lib/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="lib/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="lib/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- fullCalendar -->
<link rel="stylesheet" href="lib/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="lib/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
<script src="lib/AdminLTE/bower_components/moment/moment.js"></script>
<script src="lib/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="admin.js"></script>
<script src="utils.js"></script>

<script>
	load();
</script>