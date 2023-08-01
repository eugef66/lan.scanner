
var _data = null;
var _metadata=null;


function load() {

	//Load db.json
	ajaxCall("GET", "../db/db.json", "application/json", null, function (response) {
		var data = JSON.parse(response);
		_data = data;
		// Load metadata
		ajaxCall("GET","../db/metadata.json", "application/json", null, function (response) {
			var mdata = JSON.parse(response);
			_metadata = mdata;
			initializeDataTable();
		});
	});
	
}





function initializeDataTable() {
	//Convert Dict to Array

	var _device_count =0;
	var _new_count = 0;
	var _down_count = 0;
	var _online_count=0;

	var _dataArray = Object.keys(_data).map(function (mac) {
		//Get last digit of IP and convert to Number
		var ip = _data[mac]["ip"]
		var s = ip.lastIndexOf(".") + 1;
		var l = ip.length;
		var ip_last = Number(ip.substring(s, l));
		_device_count++;
		if (_data[mac]["is_new"]) _new_count++;
		if (_data[mac]["alert_down"] && !_data[mac]["is_online"]) _down_count++;
		if (_data[mac]["is_online"]) _online_count++;
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
			, "owner": _data[mac]["owner"]
			, "location": _data[mac]["location"]
			, "device-type": _data[mac]["device-type"]
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
		case "online":
			_dataArray = _dataArray.filter(device => device.is_online);
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
			{ title: "Owner", data: "owner" },
			{ title: "Location", data: "location" },
			{ title: "Type", data: "device-type" }
		]
	});


		
	//Refresh counters
	console.log(_online_count);

	$('#all_count').text(_device_count);
	$('#new_count').text(_new_count);
	$('#down_count').text(_down_count);
	$('#online_count').text(_online_count);
	


	
}
