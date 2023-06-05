<?php include("header.php")?>


<form id="editForm">

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
						<input type="submit" class="btn btn-lg btn-success" id="save" value="Save"/>
						<a class="btn btn-lg btn-danger" id="cancel" href="index.php">Cancel</a>
					</div>
</form>
			

<?php include("footer.php")?>