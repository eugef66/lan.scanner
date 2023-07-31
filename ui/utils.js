
function ajaxCall(http_method, url, mimeType, callback) {
	var xobj = new XMLHttpRequest();
	xobj.overrideMimeType(mimeType);
	xobj.open(http_method, url);
	xobj.setRequestHeader('Cache-Control', 'no-cache');
	xobj.onreadystatechange = function () {
		if (xobj.readyState == 4 && xobj.status == "200") {
			if (callback != null) callback(xobj.responseText);
		}
	}
	xobj.send(null);
}



function escapeString(s){

	return s.replace("\'","\\\'").replace("\"","\\\"");

}

// -----------------------------------------------------------------------------
function initializeiCheckBoxes() {
	// Blue
	$('input[type="checkbox"].blue').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass: 'iradio_flat-blue',
		increaseArea: '20%'
	});

	// Orange
	$('input[type="checkbox"].orange').iCheck({
		checkboxClass: 'icheckbox_flat-orange',
		radioClass: 'iradio_flat-orange',
		increaseArea: '20%'
	});

	// Red
	$('input[type="checkbox"].red').iCheck({
		checkboxClass: 'icheckbox_flat-red',
		radioClass: 'iradio_flat-red',
		increaseArea: '20%'
	});

	// When toggle iCheck
	$('input').on('ifToggled', function (event) {
		// Hide / Show Events
		if (event.currentTarget.id == 'chkHideConnectionEvents') {
			getDeviceEvents();
			setParameter(parEventsHide, event.currentTarget.checked);
		} else {
			// Activate save & restore
			//   activateSaveRestoreData();

			// Ask skip notifications
			// if (event.currentTarget.id == 'chkArchived' ) {
			//   askSkipNotifications();
			// }
		}
	});
}

function initializeDropdown(meta_attribute, dropdown_name, textbox_name) {

	var sel_owner = document.getElementById(dropdown_name);
	sel_owner.innerHTML = "<li><a href='javascript:void(0)' onclick=setTextValue('" + textbox_name + "',' -- ')> -- </a></li>";
	_metadata[meta_attribute].forEach(l => {
		var _value=escapeString(l);
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