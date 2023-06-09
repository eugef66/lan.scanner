var _data = null;
var _edit_form = null;

function ajaxGet(url, mimeType, callback) {
	var xobj = new XMLHttpRequest();
	xobj.overrideMimeType(mimeType);
	xobj.open('GET', url);
	xobj.setRequestHeader('Cache-Control', 'no-cache');
	xobj.onreadystatechange = function () {
		if (xobj.readyState == 4 && xobj.status == "200") {
			if (callback != null) callback(xobj.responseText);
		}
	}
	xobj.send(null);
}


function load() {

	//Load db.json
	ajaxGet("../db/db.json", "application/json", function (response) {
		var data = JSON.parse(response);
		_data = data;
		// Load metadata
		ajaxGet("../db/metadata.json", "application/json", function (response) {
			var mdata = JSON.parse(response);
			_metadata = mdata;
			initializeDropdown("owner", "owner", "owner_value");
			initializeDropdown("device-type", "device_type", "device_type_value");
			initializeDropdown("location", "location", "location_value");
			initializeiCheckBoxes();

			const _mac = (new URLSearchParams(location.search)).get("mac");
			loadDevice(_mac);


		});
	});


}

function loadDevice(mac) {

	(document.getElementById("mac")).value = mac;
	(document.getElementById("ip")).value = _data[mac]["ip"];
	(document.getElementById("description")).value = _data[mac]["description"];
	(document.getElementById("vendor")).value = _data[mac]["vendor"];
	(document.getElementById("status")).value = (_data[mac]["is_online"] ? "On-line" : "Offline");
	$("#alert_down").iCheck((_data[mac]["alert_down"]?'check':'uncheck'));
	$("#is_new").iCheck((_data[mac]["is_new"]?'check':'uncheck'));
	(document.getElementById("location_value")).value = (_data[mac]["location"] == null ? " -- " : _data[mac]["location"]);
	(document.getElementById("owner_value")).value = (_data[mac]["owner"] == null ? " -- " : _data[mac]["owner"]);
	(document.getElementById("device_type_value")).value = (_data[mac]["device-type"] == null ? " -- " : _data[mac]["device-type"]);
	(document.getElementById("comments")).value = _data[mac]["comments"];


}

function saveDevice(mac) {

	var mac = document.getElementById("mac").value;
	var alert_down = document.getElementById("alert_down").checked
	var new_device = document.getElementById("new_device").checked;
	var description = document.getElementById("description").value;

	var device = _data[mac];
	device["description"] = description;
	device["alert_down"] = alert_down;
	device["is_new"] = new_device;

	//TODO: ajax call to save data

	displayMessage("Saved", "success");
	_editForm.hide();
}


function initializeDropdown(meta_attribute, dropdown_name, textbox_name) {

	var sel_owner = document.getElementById(dropdown_name);
	sel_owner.innerHTML = "<li><a href='javascript:void(0)' onclick=setTextValue('" + textbox_name + "',' -- ')> -- </a></li>";
	_metadata[meta_attribute].forEach(l => {
		sel_owner.innerHTML += "<li><a href='javascript:void(0)' onclick=setTextValue('" + textbox_name + "','" + l + "')>" + l + "</a></li>";
	});
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


function setTextValue(textElement, textValue) {
	$('#' + textElement).val(textValue);
}