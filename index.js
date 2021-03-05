
var _data = null;
var _device = [
	["Description","VZ Router"], 
	["MAC","12:12:12:12:12:12"], 
	["IP","192.168.1.1"]
	];

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
		//sort data by IP

		//Convert Dict to Array
		_data = Object.keys(_data).map(function (mac) {
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
		// Sort data array by IP
		_data = _data.sort(function (a, b) {
			return (a.ip_last <= b.ip_last ? -1 : 1);
		});

		refrehDT();

	});

}


function loadDevice(mac) {
	$('#device').DataTable({
		data: _device,
		orderding: false,
		paging: false,
		searching: false,
		info: false,
		processing: false,
		columns:[
			{title: "", orderable: false},
			{title: "", orderable: false, render: function (data, type, row, meta) {
										return '<input type="text" class="input input-lg" value="' + data + '" />';
								}}
		]

	});
}

function refrehDT() {

	$('#devices').DataTable({

		data: _data,
		columns: [
			{
				title: "Description", data: "description", render: function (data, type, row, meta) {
					return "<a href='javascript:loadDevice(\"" + row["mac"] + "\")'>" + data + "</a>";
				}
			},
			{ title: "MAC", data: "mac" },
			{ title: "ip last number", data: "ip_last", visible: false },
			{ title: "IP", data: "ip", orderData: [2] },
			{ title: "Vendor", data: "vendor" },
			//{title: "Host", data: "hostname"},


		]

	});

	
}