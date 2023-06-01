<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />




</head>

<body onload="load()">



	<!-- Toast Message-->
	<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 5">
		<div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive"
			aria-atomic="true" id="message">
			<div class="d-flex">
				<div class="toast-body" id="message_text">
					Hello, world! This is a toast message.
				</div>
				<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
					aria-label="Close"></button>
			</div>
		</div>
	</div>
	<!-- Cards -->
	<div class="row">

		<div class="col-md-4">

		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-outline-primary btn-lg">
				All Devices <span class="badge badge-light" id="all_count">1111</span>
			</button>
			<button type="button" class="btn btn-outline-success btn-lg">
				New Devices <span class="badge badge-light" id="new_count">11111</span>
			</button>
			<button type="button" class="btn btn-outline-danger btn-lg">
				Down Devices <span class="badge badge-light" id="down_count">11111</span>
			</button>
		</div>
		<div class="col-md-4">

		</div>









	</div>
	<!-- Devices list -->
	<div class="row">
		<div class="col-md-12">
			<table id="devices" class="table table-bordered hover"></table>
		</div>
	</div>
	<!-- Pop-up Modal-->
	<div class="modal fade" tabindex="-1" role="dialog" id="editForm">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">Device Details</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="mac">MAC:</label>
						<input type="text" class="form-control" id="mac" readonly>
					</div>
					<div class="form-group">
						<label for="description">Description:</label>
						<input type="text" class="form-control" id="description">
					</div>

					<div class="form-group">
						<label for="description">Location:</label>
						<select class="form-select" aria-label="Default select example" id="location">
						</select>
					</div>

					<div class="form-group">
						<label for="description">Device Type:</label>
						<select class="form-select" aria-label="Default select example" id="device_type">
						</select>
					</div>

					<div class="form-group">
						<label for="description">Owner:</label>
						<select class="form-select" aria-label="Default select example" id="owner">
						</select>
					</div>


					<div class="form-group">
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" id="alert_down">
							<label class="form-check-label" for="alert_down">
								Alert when "Down"
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" id="new_device">
							<label class="form-check-label" for="new_device">
								New Device
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="ip">Last IP:</label>
						<input type="text" class="form-control form-control-sm" id="ip" readonly>
					</div>

					<div class="form-group">
						<label for="vendor">Vendor:</label>
						<input type="text" class="form-control form-control-sm" id="vendor" readonly>
					</div>

					<div class="form-group">
						<label for="hostname">Hostname:</label>
						<input type="text" class="form-control form-control-sm" id="hostname" readonly>
					</div>

					<div class="form-group">
						<input type="button" class="btn btn-lg btn-primary" id="save" value="Save"
							onclick="saveDevice();" />
						<input type="button" class="btn btn-lg btn-default" id="cancel" value="Cancel"
							onclick="_editForm.hide();" />
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
<script src="index.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


</html>