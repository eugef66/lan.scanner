

function load() {

	//$('#theme_color').colorpicker();

	//Load db.json
	ajaxCall("GET","../db/metadata.json", "application/json", function (response) {
		var mdata = JSON.parse(response);
		_metadata = mdata;
		initializeDropdown("owner", "owner", "owner_value");
		initializeDropdown("device-type", "device_type", "device_type_value");
		initializeDropdown("location", "location", "location_value");
		initializeiCheckBoxes();
		
	});

	

}


