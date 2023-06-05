<?php include("header.php")?>





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

		<div class="col-sm-3">

		</div>
		<div class="col-sm-2">
			<a class="btn btn-outline-primary btn-md" href="index.php">
				All Devices <span class="badge badge-light" id="all_count">N/A</span>
			</a>
		</div>
		<div class="col-sm-2">
			<a class="btn btn-outline-success btn-md" href="index.php?filter=new">
				New Devices <span class="badge badge-light" id="new_count">N/A</span>
			</a>
		</div>
		<div class="col-sm-2">
			<a class="btn btn-outline-danger btn-md" href="index.php?filter=down">
				Down Devices <span class="badge badge-light" id="down_count">N/A</span>
			</a>
		</div>
		</div>
		<div class="col-sm-3">

		</div>
	</div>
	<!-- Devices list -->
	<div class="row">
	<div class="col-sm-1">
	</div>
		<div class="col-sm-10">
			<table id="devices" class="table table-bordered hover"></table>
		</div>
	</div>
	<div class="col-sm-1">
	</div>
</body>

<?php include("footer.php")?>