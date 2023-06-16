var _mac=null;
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

			_mac = (new URLSearchParams(location.search)).get("mac");
			loadDevice();


		});
	});


}

function loadDevice() {

	$("#mac").val(_mac);

	$("#isMacRandom").addClass((["2","6","A","E","a","e"].includes(_mac.charAt(1))? "text-yellow": "text-gray"));
	document.getElementById("ip").value = _data[_mac]["ip"];
	document.getElementById("description").value = _data[_mac]["description"];
	document.getElementById("vendor").value = _data[_mac]["vendor"];
	document.getElementById("status").value = (_data[_mac]["is_online"] ? "On-line" : "Offline");
	document.getElementById("deviceStatus").innerText = (_data[_mac]["is_online"] ? "On-line" : "Offline");
	document.getElementById("deviceStatus").innerText = (_data[_mac]["is_online"] ? "On-line" : "Offline");
	document.getElementById("deviceDownAlerts").innerText = (_data[_mac]["alert_down"] && !_data[_mac]["is_online"] ?'Offline':' -- ')
	$("#alert_down").iCheck((_data[_mac]["alert_down"]?'check':'uncheck'));
	$("#is_new").iCheck((_data[_mac]["is_new"]?'check':'uncheck'));
	document.getElementById("location_value").value = (_data[_mac]["location"] == null ? " -- " : _data[_mac]["location"]);
	document.getElementById("owner_value").value = (_data[_mac]["owner"] == null ? " -- " : _data[_mac]["owner"]);
	document.getElementById("device_type_value").value = (_data[_mac]["device-type"] == null ? " -- " : _data[_mac]["device-type"]);
	document.getElementById("comments").value = _data[_mac]["comments"];




}

function deleteButton_click()
{
	// Ask delete device
	showModalDanger ('Delete Device'
					, 'Are you sure you want to delete this device?'
					,'Cancel'
					, 'Delete'
					, 'deleteDevice'
					);
}

function deleteDevice()
{
	var _form = $("#deviceForm");
	_form.append('<input type="hidden" name="action" value="delete" />');
	_form.submit();
	
	
}



function initializeDropdown(meta_attribute, dropdown_name, textbox_name) {

	var sel_owner = document.getElementById(dropdown_name);
	sel_owner.innerHTML = "<li><a href='javascript:void(0)' onclick=setTextValue('" + textbox_name + "',' -- ')> -- </a></li>";
	_metadata[meta_attribute].forEach(l => {
		var _value=escapeString(l);
		sel_owner.innerHTML += "<li><a href=\"javascript:void(0)\" onclick=\"setTextValue(\'" + textbox_name + "\',\'" + _value + "\')\">" + l + "</a></li>";
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