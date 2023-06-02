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
			refreshMetaData();

			const _mac = (new URLSearchParams(location.search)).get("mac");
			loadDevice(_mac);


		});
	});


}

function loadDevice(mac) {

	console.log(_metadata);

	var _mac= document.getElementById("mac");
	_mac.value = mac;
	var _ip = document.getElementById("ip");
	_ip.value=_data[mac]["ip"];
	var _description = document.getElementById("description");
	_description.value=_data[mac]["description"];
	var _vendor = document.getElementById("vendor");
	_vendor.value=_data[mac]["vendor"];
	var _hostname = document.getElementById("hostname");
	_hostname.value=_data[mac]["hostname"];
	var _alert_down = document.getElementById("alert_down");
	_alert_down.checked = _data[mac]["alert_down"];
	var _new_device = document.getElementById("new_device");
	_new_device.checked = _data[mac]["is_new"];

	var _location = document.getElementById("location");

	//TODO: Fix to select real value
	_location.selectedIndex = 0;

	


}

function saveDevice(mac) {
	
	var mac= document.getElementById("mac").value;
	var alert_down = document.getElementById("alert_down").checked
	var new_device = document.getElementById("new_device").checked;
	var description = document.getElementById("description").value;
	
	var device = _data[mac];
	device["description"]=description;
	device["alert_down"]=alert_down;
	device["is_new"]=new_device;

	//TODO: ajax call to save data

	displayMessage("Saved","success");
    _editForm.hide();
}


function refreshMetaData(){

	// Location 
	var sel_location = document.getElementById("location");
	var sel_deviceType = document.getElementById("device_type");
	var sel_owner = document.getElementById("owner");
	

	//Add empty value to all lists
	var opt = null;
	
	sel_location.add(Object.assign(document.createElement('option'),{text:"", value:""}));
	sel_deviceType.add(Object.assign(document.createElement('option'),{text:"", value:""}));
	sel_owner.add(Object.assign(document.createElement('option'),{text:"", value:""}));
	

	//Location
	_metadata["location"].forEach(l => {
		opt = document.createElement('option')
		opt.text=l;
		opt.value=l;
		sel_location.add(opt);
	});

	// Device Type
	_metadata["device-type"].forEach(l => {
		opt = document.createElement('option');
		opt.text=l;
		opt.value=l;
		sel_deviceType.add(opt);
	});

	//Owner
	_metadata["owner"].forEach(l => {
		opt = document.createElement('option');
		opt.text=l;
		opt.value=l;
		sel_owner.add(opt);
	});



}