
var _data = null;
var _metadata=null;

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
			initializeDataTable();
			refreshMetaData();
		});
	});


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



function initializeDataTable() {
	//Convert Dict to Array

	var _device_count =0;
	var _new_count = 0;
	var _down_count = 0;

	var _dataArray = Object.keys(_data).map(function (mac) {
		//Get last digit of IP and convert to Number
		var ip = _data[mac]["ip"]
		var s = ip.lastIndexOf(".") + 1;
		var l = ip.length;
		var ip_last = Number(ip.substring(s, l));
		_device_count++;
		if (_data[mac]["is_new"]) _new_count++;
		if (_data[mac]["alert_down"] && !_data[mac]["is_online"]) _down_count++;
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
			, "is_down": (_data[mac]["alert_down"] && !_data[mac]["is_online"])
		};
	}
	);

		

	//Filter based on query string 
	const _filter = (new URLSearchParams(location.search)).get("filter");

	switch (_filter)
	{
		case "down":
			_dataArray = _dataArray.filter(device => device.is_down);
			break;
		case "new":
			_dataArray = _dataArray.filter(device => device.is_new);
			break;
	}

	


	//initializae Data Table
	$('#devices').DataTable({
		data: _dataArray,
		paging: false,
		searching:false,
		columns: [
			{ title: "IP Addres", data: "ip", orderData: [3] },
			{
				title: "Description", data: "description", render: function (data, type, row, meta) {
					return "<a href='device.php?mac=" + row["mac"] + "'>" + data + "</a>";
				}
			},
			{ title: "MAC Address", data: "mac" },
			{ title: "ip last number", data: "ip_last", visible: false },
			
			{ title: "Vendor", data: "vendor" },
			{ title: "is online", data: "is_online", visible: false },
			{ title: "alert down", data: "alert_down", visible: false },
			{ title: "new device", data: "is_new", visible: false, searchable: true},
			{ title: "down device", data: "is_down", visible: false, searchable: true },
		]
	});

	

		
	//Refresh counters
	
	var all_count = document.getElementById("all_count");
	var new_count = document.getElementById("new_count");
	var down_count = document.getElementById("down_count");
	
	all_count.innerText = _device_count;
	new_count.innerText = _new_count;
	down_count.innerText = _down_count;


	
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