<?php
require 'header.php';
require 'notification.php';
?>


<!-- Page ------------------------------------------------------------------ -->
<div class="content-wrapper">

	<!-- Content header--------------------------------------------------------- -->
	<section class="content-header">
		

		<h1 id="pageTitle">
			Device Details
		</h1>

		<!-- Main content ---------------------------------------------------------- -->
		<section class="content">

			<!-- top small box 1 ------------------------------------------------------- -->
			<div class="row">

				<div class="col-lg-3 col-sm-6 col-xs-6">
					<a href="#" onclick="javascript: $('#tabDetails').trigger('click')">
						<div class="small-box bg-green pa-small-box-green pa-small-box-2">
							<div class="inner">
								<h3 id="deviceStatus" style="margin-left: 0em"> -- </h3>
							</div>
							<div class="icon"> <i id="deviceStatusIcon" class=""></i> </div>
							<div class="small-box-footer pa-small-box-footer"> Current Status <i
									class="fa fa-arrow-circle-right"></i> </div>
						</div>
					</a>
				</div>


				<!--  top small box 4 ------------------------------------------------------ -->
				<div class="col-lg-3 col-sm-6 col-xs-6">
					<a href="#" onclick="javascript: $('#tabEvents').trigger('click');">
						<div class="small-box bg-red pa-small-box-red pa-small-box-2">
							<div class="inner">
								<h3 id="deviceDownAlerts"> -- </h3>
							</div>
							<div class="icon"> <i class="fa fa-warning"></i> </div>
							<div class="small-box-footer pa-small-box-footer"> Down Alerts <i
									class="fa fa-arrow-circle-right"></i> </div>
						</div>
					</a>
				</div>

			</div>
			<!-- /.row -->
<!-- form -->
<form action="server/device.php" method='POST' id="deviceForm">
			<!-- tab control------------------------------------------------------------ -->
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<!-- <div class="box-transparent"> -->
					<div class="row">
						<!-- column 1 -->
						<div class="col-lg-4 col-sm-6 col-xs-12">
							<h4 class="bottom-border-aqua">Main Info</h4>
							<div class="box-body form-horizontal">

								<!-- MAC -->
								<div class="form-group">
									<label class="col-sm-3 control-label">MAC</label>
									<div class="col-sm-9">
										<input class="form-control" id="mac" name="mac" type="text" readonly value="--">
										<span data-toggle="tooltip" data-placement="right" title="Random MAC">
											<i id="isMacRandom" style="font-size: 15px;"
												class="glyphicon glyphicon-random"></i>
										</span>
									</div>
								</div>

								<!-- Vendor -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Vendor</label>
									<div class="col-sm-9">
										<input class="form-control" id="vendor" name="vendor" type="text" readonly value="--">
									</div>
								</div>

								<!-- Description -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
									<div class="col-sm-9">
										<input class="form-control" id="description" name="description" type="text" value="--">
									</div>
								</div>




								<!-- Owner -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Owner</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input class="form-control" id="owner_value" name="owner" readonly type="text"
												value="--">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="owner" class="dropdown-menu dropdown-menu-right">

												</ul>
											</div>
										</div>
									</div>
								</div>

								<!-- Type -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Type</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input class="form-control" id="device_type_value" name="device_type" readonly type="text"
												value="--">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="device_type" class="dropdown-menu dropdown-menu-right">
												</ul>
											</div>
										</div>
									</div>
								</div>



								<!-- Location -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Location</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input class="form-control" id="location_value" name="location" readonly type="text"
												value="--">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="location" class="dropdown-menu dropdown-menu-right">
												</ul>
											</div>
										</div>
									</div>
								</div>

								<!-- Comments -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Comments</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="3" id="comments" name="comments"></textarea>
									</div>
								</div>

							</div>
						</div>

						<!-- column 2 -->
						<div class="col-lg-4 col-sm-6 col-xs-12">
							<h4 class="bottom-border-aqua">Session Info</h4>
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

						<!-- column 3 -->
						<div class="col-lg-4 col-sm-6 col-xs-12">
							<h4 class="bottom-border-aqua">Events & Alerts config</h4>
							<div class="box-body form-horizontal">


								<!-- Alert Down -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Alert Down:</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<input class="checkbox red" id="alert_down" name="alert_down" type="checkbox">
									</div>
								</div>


								<!-- New Device -->
								<div class="form-group">
									<label class="col-sm-5 control-label">New Device:</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<input class="checkbox orange " id="is_new" name="is_new" type="checkbox">
									</div>
								</div>

								<!-- Archived -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Archived:</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<input class="checkbox blue " id="archived" name="archived" type="checkbox">
									</div>
								</div>


							</div>
						</div>

						<!-- Buttons -->
						<div class="col-xs-12">
							<div class="pull-right">
								<button type="submit" class="btn btn-success pa-btn" style="margin-left:6px; "
									id="btnSave" name="action" value="save"> Save </button> 
								<button type="button" class="btn btn-danger pa-btn" style="margin-left:0px;"
									id="btnDelete" name="action" value="delete" onclick="deleteButton_click()"> Delete Device
								</button> 
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
<script src="utils.js"></script>
<script src="device.js"></script>


<script>
	load();
</script>