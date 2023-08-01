var _mac=null;
var _data = null;
var _edit_form = null;




function load() {

	//Load db.json
	ajaxCall("GET","../db/db.json", "application/json", null, function (response) {
		var data = JSON.parse(response);
		_data = data;
		// Load metadata
		ajaxCall("GET","../db/metadata.json", "application/json", null, function (response) {
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







