<?php
require 'header.php';
?>

<script src="device.js"></script>

<script>
	load();
</script>

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

				<!-- top small box 2 ------------------------------------------------------- -->
				<div class="col-lg-3 col-sm-6 col-xs-6">
					<a href="#" onclick="javascript: $('#tabSessions').trigger('click');">
						<div class="small-box bg-aqua pa-small-box-aqua pa-small-box-2">
							<div class="inner">
								<h3 id="deviceSessions"> -- </h3>
							</div>
							<div class="icon"> <i class="fa fa-plug"></i> </div>
							<div class="small-box-footer pa-small-box-footer"> Online <i
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
										<input class="form-control" id="mac" type="text" readonly value="--"><span
											id="iconRandomMACinactive" data-toggle="tooltip" data-placement="right"
											title="Random MAC is Inactive">
											<i style="font-size: 24px;"
												class="text-gray glyphicon glyphicon-random"></i> &nbsp &nbsp </span><a
											href="https://github.com/pucherot/Pi.Alert/blob/main/docs/RAMDOM_MAC.md"
											target="_blank" style="color: #777;">
											<i class="fa fa-info-circle"></i> </a>
									</div>
								</div>

								<!-- Vendor -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Vendor</label>
									<div class="col-sm-9">
										<input class="form-control" id="vendor" type="text" readonly value="--">
									</div>
								</div>

								<!-- Description -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
									<div class="col-sm-9">
										<input class="form-control" id="description" type="text" value="--">
									</div>
								</div>


								<!-- Owner -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Owner</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input class="form-control" id="owner" type="text" value="--">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="dropdownOwner" class="dropdown-menu dropdown-menu-right">
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
											<input class="form-control" id="device_type" type="text" value="--">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="dropdownDeviceType" class="dropdown-menu dropdown-menu-right">
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtDeviceType','Smartphone')">
															Smartphone </a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtDeviceType','Laptop')"> Laptop
														</a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtDeviceType','PC')"> PC </a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtDeviceType','Others')"> Others
														</a></li>
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
											<input class="form-control" id="location" type="text" value="--">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false">
													<span class="fa fa-caret-down"></span></button>
												<ul id="dropdownLocation" class="dropdown-menu dropdown-menu-right">
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtLocation','Bathroom')">
															Bathroom</a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtLocation','Bedroom')"> Bedroom</a>
													</li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtLocation','Hall')"> Hall</a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtLocation','Kitchen')"> Kitchen</a>
													</li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtLocation','Living room')"> Living
															room</a></li>
													<li class="divider"></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtLocation','Others')"> Others</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								<!-- Comments -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Comments</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="3" id="txtComments"></textarea>
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
										<input class="form-control" id="txtStatus" type="text" readonly value="--">
									</div>
								</div>

								<!-- IP -->
								<div class="form-group">
									<label class="col-sm-5 control-label">IP Address</label>
									<div class="col-sm-7">
										<input class="form-control" id="ip" type="text" readonly value="--">
									</div>
								</div>


							</div>
						</div>

						<!-- column 3 -->
						<div class="col-lg-4 col-sm-6 col-xs-12">
							<h4 class="bottom-border-aqua">Events & Alerts config</h4>
							<div class="box-body form-horizontal">

								<!-- Scan Cycle -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Scan Cycle</label>
									<div class="col-sm-7">
										<div class="input-group">
											<input class="form-control" id="txtScanCycle" type="text" value="--"
												readonly style="background-color: #fff;">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false"
													id="dropdownButtonScanCycle">
													<span class="fa fa-caret-down"></span></button>
												<ul id="dropdownScanCycle" class="dropdown-menu dropdown-menu-right">
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtScanCycle','1 min')"> Scan 1 min
															every 5 min</a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtScanCycle','15 min');"> Scan 12
															min every 15 min</a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtScanCycle','0 min');"> Don't
															Scan</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								<!-- Alert events -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Alert All Events</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<input class="checkbox blue hidden" id="chkAlertEvents" type="checkbox">
									</div>
								</div>

								<!-- Alert Down -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Alert Down</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<input class="checkbox red hidden" id="chkAlertDown" type="checkbox">
									</div>
								</div>

								<!-- Skip Notifications -->
								<div class="form-group">
									<label class="col-sm-5 control-label"
										style="padding-top: 0px; padding-left: 0px;">Skip repeated notifications
										during</label>
									<div class="col-sm-7">
										<div class="input-group">
											<input class="form-control" id="txtSkipRepeated" type="text" value="--"
												readonly style="background-color: #fff;">
											<div class="input-group-btn">
												<button type="button" class="btn btn-info dropdown-toggle"
													data-toggle="dropdown" aria-expanded="false"
													id="dropdownButtonSkipRepeated">
													<span class="fa fa-caret-down"></span></button>
												<ul id="dropdownSkipRepeated" class="dropdown-menu dropdown-menu-right">
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtSkipRepeated','0 h (notify all events)');">
															0 h (notify all events)</a></li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtSkipRepeated','1 h');"> 1 h</a>
													</li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtSkipRepeated','8 h');"> 8 h</a>
													</li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtSkipRepeated','24 h');"> 24 h</a>
													</li>
													<li><a href="javascript:void(0)"
															onclick="setTextValue('txtSkipRepeated','168 h (one week)');">
															168 h (one week)</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								<!-- New Device -->
								<div class="form-group">
									<label class="col-sm-5 control-label">New Device:</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<input class="checkbox orange hidden" id="chkNewDevice" type="checkbox">
									</div>
								</div>

								<!-- Archived -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Archived:</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<input class="checkbox blue hidden" id="chkArchived" type="checkbox">
									</div>
								</div>

								<!-- Randomized MAC -->
								<div class="form-group">
									<label class="col-sm-5 control-label">Random MAC:</label>
									<div class="col-sm-7" style="padding-top:6px;">
										<span id="iconRandomMACinactive" data-toggle="tooltip" data-placement="right"
											title="Random MAC is Inactive">
											<i style="font-size: 24px;"
												class="text-gray glyphicon glyphicon-random"></i> &nbsp &nbsp </span>

										<span id="iconRandomMACactive" data-toggle="tooltip" data-placement="right"
											title="Random MAC is Active" class="hidden">
											<i style="font-size: 24px;"
												class="text-yellow glyphicon glyphicon-random"></i> &nbsp &nbsp </span>

										<a href="https://github.com/pucherot/Pi.Alert/blob/main/docs/RAMDOM_MAC.md"
											target="_blank" style="color: #777;">
											<i class="fa fa-info-circle"></i> </a>
									</div>
								</div>

							</div>
						</div>

						<!-- Buttons -->
						<div class="col-xs-12">
							<div class="pull-right">
								<button type="button" class="btn btn-default pa-btn pa-btn-delete"
									style="margin-left:0px;" id="btnDelete" onclick="askDeleteDevice()"> Delete Device
								</button>
								<button type="button" class="btn btn-default pa-btn" style="margin-left:6px;"
									id="btnRestore" onclick="getDeviceData(true)"> Reset Changes </button>
								<button type="button" disabled class="btn btn-primary pa-btn" style="margin-left:6px; "
									id="btnSave" onclick="setDeviceData()"> Save </button>
							</div>
						</div>

					</div>
					<!-- </div> -->
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