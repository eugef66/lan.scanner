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

			<!-- form -->
			<form  id="adminForm">
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
												<input class="form-control" id="owner_value" name="owner_value" type="text"
													value="">
												<div class="input-group-btn">
													<button type="button" class="btn btn-info dropdown-toggle"
														data-toggle="dropdown" aria-expanded="false">
														<span class="fa fa-caret-down"></span></button>
													<ul id="owner" class="dropdown-menu dropdown-menu-right"></ul>
													<button type=button class="btn btn-success" id="btnOwnerSave"><i
															class="fa fa-floppy-o " onclick="saveMetadata('owner_value','insert')"></i></button>
													<button type=button class="btn btn-danger" disabled
														id="btnOwnerDelete"><i class="fa fa-trash" onclick="saveMetadata('owner_value','delete')"></i></button>
												</div>
											</div>
										</div>
									</div>

									<!-- Type -->
									<div class="form-group">
										<label class="col-sm-3 control-label">Type</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="device_type_value" name="device_type"
													type="text" value="">
												<div class="input-group-btn">
													<button type="button" class="btn btn-info dropdown-toggle"
														data-toggle="dropdown" aria-expanded="false">
														<span class="fa fa-caret-down"></span></button>
													<ul id="device_type" class="dropdown-menu dropdown-menu-right">
													</ul>
													<button type=button class="btn btn-success" id="btnTypeSave"><i
															class="fa fa-floppy-o "></i></button>
													<button type=button class="btn btn-danger" disabled
														id="btnTypeDelete"><i class="fa fa-trash"></i></button>
												</div>
											</div>
										</div>
									</div>



									<!-- Location -->
									<div class="form-group">
										<label class="col-sm-3 control-label">Location</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="location_value" name="location"
													type="text" value="">
												<div class="input-group-btn">
													<button type="button" class="btn btn-info dropdown-toggle"
														data-toggle="dropdown" aria-expanded="false">
														<span class="fa fa-caret-down"></span></button>
													<ul id="location" class="dropdown-menu dropdown-menu-right"></ul>
													<button type=button class="btn btn-success" id="btnLocationSave"><i
															class="fa fa-floppy-o"></i></button>
													<button type=button class="btn btn-danger" disabled
														id="btnLocationDelete"><i class="fa fa-trash"></i></button>
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

									<!-- Skin -->
									<!-- Owner -->
									<div class="form-group">
										<label class="col-sm-5 control-label">Owner</label>
										<div class="col-sm-7">
											<div class="input-group">
												<input class="form-control" id="skin_value" name="owner" type="text"
													value="" readonly>
												<div class="input-group-btn">
													<button type="button" class="btn btn-info dropdown-toggle"
														data-toggle="dropdown" aria-expanded="false">
														<span class="fa fa-caret-down"></span></button>
													<ul id="skin" class="dropdown-menu dropdown-menu-right">
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-black-light')">Black
																Light</a></li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-black')">Black</a>
														</li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-blue-light')">Blue
																Light</a></li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-blue')">Blue</a>
														</li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-green-light')">Green
																Light</a></li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-green')">Green</a>
														</li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-purple-light')">Purple
																Light</a></li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-purple')">Purple</a>
														</li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-red-light')">Red
																Light</a></li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-red')">Red</a>
														</li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-yellow-light')">Yellow
																Light</a></li>
														<li><a href="javascript:void(0)"
																onclick="setTextValue('skin_value','skin-yellow')">Yellow</a>
														</li>
													</ul>
													

												</div>
											</div>
										</div>
									</div>

									<!-- Logo -->
									<div class="form-group">
										<label class="col-sm-5 control-label">Logo</label>
										<div class="col-sm-7">
											<input class="form-control" id="ip" name="ip" type="text" readonly
												value="--">
										</div>
									</div>
									<!-- Logo -->
									<div class="form-group">
									<div class="col-sm-5 control-label"></div>
									<div class="col-sm-7">
									<button type=button class=" btn btn-primary" id="btnSkinApply"><i
															class="fa fa-check "></i> Apply</button>
									</div>
									</div>


								</div>
							</div>


							<!-- Buttons -->
							<!--div class="col-xs-12">
							<div class="pull-right">
								<button type="submit" class="btn btn-success pa-btn" style="margin-left:6px; "
									id="btnSave" name="action" value="save"> Save </button> 
								<a class="btn btn-default pa-btn" style="margin-left:6px;" id="btnCancel"
									href="index.php"> Cancel </a>
							</div>
						</div-->

						</div>
						<!-- /.row -->
						<div class="row">
							<!-- column 1 -->
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<h4 class="bottom-border-aqua">Server Configurations</h4>
								<div class="box-body form-horizontal">

									<!-- >Alert New Devices -->
									
								<div class="form-group">
									<label class="col-sm-3 control-label">Down Device Alert Enabled:</label>
									<div class="col-sm-9" style="padding-top:6px;">
										<input class="checkbox red" id="ALERT_DOWN_DEVICE" name="ALERT_DOWN_DEVICE" type="checkbox">
									</div>
								</div>


								<!-- New Device -->
								<div class="form-group">
									<label class="col-sm-3 control-label">New Device Alert Enabled:</label>
									<div class="col-sm-9" style="padding-top:6px;">
										<input class="checkbox blue " id="ALERT_NEW_DEVICE" name="ALERT_NEW_DEVICE" type="checkbox">
									</div>
								</div>



									<!-- Alert Down Threshlod -->
									<div class="form-group">
										<label class="col-sm-3 control-label">Alert Down Threshlod:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="ALERT_DOWN_THRESHOLD" name="ALERT_DOWN_THRESHOLD"
													type="text" value="">
											</div>
										</div>
									</div>

									<!-- Alert From -->
									<div class="form-group">
										<label class="col-sm-3 control-label">Alert Email From Name:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="ALERT_FROM" name="ALERT_FROM"
													type="text" value="">
											</div>
										</div>
									</div>

									<!-- Alert Subject -->
									<div class="form-group">
										<label class="col-sm-3 control-label">Alert Email Subject:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="ALERT_SUBJECT" name="ALERT_SUBJECT"
													type="text" value="">
											</div>
										</div>
									</div>

									<!-- Alert To -->
									<div class="form-group">
										<label class="col-sm-3 control-label">Alert To Email:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="ALERT_TO" name="ALERT_TO"
													type="text" value="">
											</div>
										</div>
									</div>
									<!-- Web Admin URL -->
									<div class="form-group">
										<label class="col-sm-3 control-label">Device Details URL:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="WEB_ADMIN_DEVICE_URL" name="WEB_ADMIN_DEVICE_URL"
													type="text" value="">
											</div>
										</div>
									</div>

									<!-- SMTP -->
									<div class="form-group">
										<label class="col-sm-3 control-label">SMTP Server:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="SMTP_SERVER" name="SMTP_SERVER"
													type="text" value="">
											</div>
										</div>
									</div>

									<!-- Web Admin URL -->
									<div class="form-group">
										<label class="col-sm-3 control-label">SMTP Port:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="SMTP_PORT" name="SMTP_PORT"
													type="text" value="">
											</div>
										</div>
									</div>

									<!-- Web Admin URL -->
									<div class="form-group">
										<label class="col-sm-3 control-label">SMTP Username:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="SMTP_USERNAME" name="SMTP_USERNAME"
													type="text" value="">
											</div>
										</div>
									</div>

									<!-- Web Admin URL -->
									<div class="form-group">
										<label class="col-sm-3 control-label">SMTP Password:</label>
										<div class="col-sm-9">
											<div class="input-group">
												<input class="form-control" id="SMTP_PASSWORD" name="SMTP_PASSWORD"
													type="password" value="">
											</div>
										</div>
									</div>

									<!-- Buttons -->


									<!-- Web Admin URL -->
									<div class="form-group">
										<div class="col-sm-9">
											<div class="input-group pull-left">
											<button type="button" class="btn btn-primary pa-btn"
																style="margin-left:6px; " id="btnSave" name="action"
																value="apply" onclick="saveServerConfigs();"><i
															class="fa fa-check "></i> Apply </button>
															<!-- a class="btn btn-default pa-btn" style="margin-left:6px;"
																id="btnCancel" href="admin.php"> Cancel </a -->
											</div>
										</div>
									</div>

								</div>
							</div>

							<!-- column 2 -->
							<div class="col-lg-6 col-sm-6 col-xs-12">
							</div>

						</div>
						<!-- /.row -->

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

<script src="admin.js"></script>


<script>
	load();
</script>