

function load() {

	//$('#theme_color').colorpicker();

	//Load db.json
	ajaxCall("GET","../db/metadata.json", "application/json", function (response) {
		var mdata = JSON.parse(response);
		_metadata = mdata;
		initializeDropdown("owner", "owner", "owner_value");
		initializeDropdown("device-type", "device_type", "device_type_value");
		initializeDropdown("location", "location", "location_value");
		
		
	});

	

}

function initializeDropdown(meta_attribute, dropdown_name, textbox_name) {

	var sel_owner = document.getElementById(dropdown_name);
	sel_owner.innerHTML = "<li><a href='javascript:void(0)' onclick=setTextValue('" + textbox_name + "','')>{new}</a></li>";
	_metadata[meta_attribute].forEach(l => {
		var _value = escapeString(l);
		sel_owner.innerHTML += "<li><a href=\"javascript:void(0)\" onclick=\"setTextValue(\'" + textbox_name + "\',\'" + _value + "\')\">" + l + "</a></li>";
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