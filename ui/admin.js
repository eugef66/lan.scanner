

function load() {

	//$('#theme_color').colorpicker();
	loadMetadata();
	loadAppirence();
	loadServerConfigs();
	
	
}
function loadAppirence()
{
	console.log("load Appirence ");
}

function updateAppirence() {
	alert("update Appirence");
}


function loadMetadata()
{
	ajaxCall("GET", "../db/metadata.json", "application/json", null, function (response) {
		var mdata = JSON.parse(response);
		_metadata = mdata;
		initializeDropdown("owner", "owner", "owner_value");
		initializeDropdown("device-type", "device_type", "device_type_value");
		initializeDropdown("location", "location", "location_value");
		initializeiCheckBoxes();

	});
}


function upsertMetadata(metadataInputId) {
	alert("upsert Metadata:" + metadataInputId);
}

// ************ Server Configurations ****************//

function loadServerConfigs()
{
	ajaxCall("GET"
				,"server/admin.php?action=serverConfig"
				,"application/json"
				,null
				,function (response){

					server_config = JSON.parse(response);
					for (var key in server_config)
					{
						//console.log(key);
						//console.log(server_config[key]);
						element = document.getElementById(key);
						if (element) element.value=server_config[key];
					}

					




				});
}

function saveServerConfigs() {

	_body = {
		ALERT_NEW_DEVICE: $("#ALERT_NEW_DEVICE").prop("checked"),
		ALERT_DOWN_DEVICE: $("#ALERT_DOWN_DEVICE").prop("checked"),
		ALERT_DOWN_THRESHOLD: document.getElementById("ALERT_DOWN_THRESHOLD").value,
		ALERT_FROM: document.getElementById("ALERT_FROM").value,
		ALERT_SUBJECT: document.getElementById("ALERT_SUBJECT").value,
		ALERT_TO: document.getElementById("ALERT_TO").value,
		SMTP_SERVER: document.getElementById("SMTP_SERVER").value,
		SMTP_PORT: document.getElementById("SMTP_PORT").value,
		SMTP_USERNAME: document.getElementById("SMTP_USERNAME").value,
		SMTP_PASSWORD: document.getElementById("SMTP_PASSWORD").value,
		WEB_ADMIN_DEVICE_URL: document.getElementById("WEB_ADMIN_DEVICE_URL").value
	};

	//console.log(JSON.stringify(_body));

	ajaxCall("PATCH", "server/admin.php?action=serverConfig", "application/json", JSON.stringify(_body), function (response) {
		showMessage("Success");
	});
}


