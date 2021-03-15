
var _data = null;
var _metadata=null;
var _editForm = null;
var  _toast = null;
var _message=null;

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
	ajaxGet("db.json", "application/json", function (response) {
		var data = JSON.parse(response);
		_data = data;
		// Load metadata
		ajaxGet("metadata.json", "application/json", function (response) {
			var mdata = JSON.parse(response);
			_metadata = mdata;
			refrehDT();
			refreshMetaData();
		});
	});

	_editForm = new bootstrap.Modal(document.getElementById('editForm'), {backdrop:'static'});
	_toast = document.getElementById("message");
	
	_message = new bootstrap.Toast(_toast,{
		animation: true,
		autohide: true,
		delay: 3000
	})
	
}

function displayMessage(message, style_name)
{

	document.getElementById("message_text").innerHTML=message;
	_message.show();

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
	_new_device.checked = _data[mac]["new_device"];

	var _location = document.getElementById("location");

	//TODO: Fix to select real value
	_location.selectedIndex = 3;

	
    _editForm.show();
	


}



function saveDevice(mac) {
	
	displayMessage("Saved","success");
    _editForm.hide();
	/*
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
	_new_device.checked = _data[mac]["new_device"];
	*/
}

function refrehDT() {

	//Convert Dict to Array
	var _dataDT = Object.keys(_data).map(function (mac) {
		//Get last digit of IP and convert to Number
		var ip = _data[mac]["ip"]
		var s = ip.lastIndexOf(".") + 1;
		var l = ip.length;
		var ip_last = Number(ip.substring(s, l));
		return {
			"mac": mac
			, "ip": _data[mac]["ip"]
			, "is_online": _data[mac]["is_online"]
			, "description": _data[mac]["description"]
			, "vendor": _data[mac]["vendor"]
			, "ip_last": ip_last
			, "hostname": _data[mac]["hostname"]
			, "is_new": _data[mac]["is_new"]
		};
	}
	);


	$('#devices').DataTable({

		data: _dataDT,
		paging: false,
		searching:false,
		columns: [
			{ title: "IP", data: "ip", orderData: [3] },
			{
				title: "Description", data: "description", render: function (data, type, row, meta) {
					return "<a href='javascript:loadDevice(\"" + row["mac"] + "\")'>" + data + "</a>";
				}
			},
			{ title: "MAC", data: "mac" },
			{ title: "ip last number", data: "ip_last", visible: false },
			
			{ title: "Vendor", data: "vendor" },
			//{title: "Host", data: "hostname"},


		]

	});

	
}
function refreshMetaData(){

	var sel = document.getElementById("location");

	_metadata["Location"].forEach(l => {
		var opt = document.createElement('option');
		opt.text=l;
		opt.value=l;
		sel.add(opt);
	});

	sel = document.getElementById("device_type");

	_metadata["DeviceType"].forEach(l => {
		var opt = document.createElement('option');
		opt.text=l;
		opt.value=l;
		sel.add(opt);
	});

	sel = document.getElementById("owner");

	_metadata["Owner"].forEach(l => {
		var opt = document.createElement('option');
		opt.text=l;
		opt.value=l;
		sel.add(opt);
	});



}