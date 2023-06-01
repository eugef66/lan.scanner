
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
	ajaxGet("../db/db.json", "application/json", function (response) {
		var data = JSON.parse(response);
		_data = data;
		// Load metadata
		ajaxGet("../db/metadata.json", "application/json", function (response) {
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
	_location.selectedIndex = 0;

    _editForm.show();
	


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

function filterNewDevices(){
	var table = $('#devices').DataTable();


	var filteredData = table
    	.column(7)
    	.data()
    	.filter( function ( value, index ) {
 	       return value == "true" ? true : false;
	    } );

	table.data = filteredData;



}
function filterDownDevices(){
	alert ("Filter Down Devices");
}
function filterReset(){
	alert ("Reset Filter");
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
			, "alert_down": _data[mac]["alert_down"]
			, "description": _data[mac]["description"]
			, "vendor": _data[mac]["vendor"]
			, "ip_last": ip_last
			, "hostname": _data[mac]["hostname"]
			, "is_new": _data[mac]["is_new"]
		};
	}
	);
	//Populate DataTable
	$('#devices').DataTable({
		data: _dataDT,
		paging: false,
		searching:false,
		columns: [
			{ title: "IP Addres", data: "ip", orderData: [3] },
			{
				title: "Description", data: "description", render: function (data, type, row, meta) {
					return "<a href='javascript:loadDevice(\"" + row["mac"] + "\")'>" + data + "</a>";
				}
			},
			{ title: "MAC Address", data: "mac" },
			{ title: "ip last number", data: "ip_last", visible: false },
			
			{ title: "Vendor", data: "vendor" },
			{ title: "is online", data: "is_online", visible: true },
			{ title: "alert down", data: "alert_down", visible: true },
			{ title: "new device", data: "is_new", visible: true },
		]
	});

	//Refresh counters
	
	var devices = Object.entries(_data);

	//console.log(devices[0][1].ip);


	var all_count = document.getElementById("all_count");
	var new_count = document.getElementById("new_count");
	var down_count = document.getElementById("down_count");
	
	all_count.innerText = devices.length;
	new_count.innerText = devices.filter(([mac,device]) => device.is_new).length;
	down_count.innerText = devices.filter(([mac,device]) => device.alert_down && !device.is_online).length;


	
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