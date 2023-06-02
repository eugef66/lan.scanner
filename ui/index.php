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
	<!-- Top Buttons -->
	<div class="row">

		<div class="col-md-4">

		</div>
		<div class="col-md-4">
			<a class="btn btn-outline-primary btn-md" href="index.php">
				All Devices <span class="badge badge-light" id="all_count">N/A</span>
			</a>
			<a class="btn btn-outline-success btn-md" href="index.php?filter=new">
				New Devices <span class="badge badge-light" id="new_count">N/A</span>
			</a>
			<a class="btn btn-outline-danger btn-md" href="index.php?filter=down">
				Down Devices <span class="badge badge-light" id="down_count">N/A</span>
			</a>
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
</body>
<script src="index.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


</html>