

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


function setTextValue(textElement, textValue) {
	$('#' + textElement).val(textValue);
	$('#' + textElement).prop("readonly", !(textValue == ''));

	//TODO: Add condition to check which dropdown is clicked
	if (textElement == "device_type_value") {
		$("#btnTypeDelete").prop("disabled", (textValue == ''));
	}
	if (textElement == "owner_value") {
		$("#btnOwnerDelete").prop("disabled", (textValue == ''));
	}
	if (textElement == "location_value") {
		$("#btnLocationDelete").prop("disabled", (textValue == ''));
	}

}