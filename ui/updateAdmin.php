<?php


if (isset($_GET["action"])){
	$action = $_GET["action"];

	switch ($action){
		case "metaOwner": 
			break;
		case "metaDeviceType": 
			break;
		case "metaLocation": 
			break;
		case "serverConfig": 
			saveServerConfigurations();
			break;
		case "appirence": 
			break;
		}


}



//Write db

//Redirect to index.php
//header("Location: admin.php");

function saveMetadata(){
	//Read db
	$db = json_decode(file_get_contents('../db/metadata.json'), true);
	
	$db_file = fopen('../db/metadata.json', 'w');
	fwrite($db_file, json_encode($db, JSON_PRETTY_PRINT));
	fclose($db_file);
}

function saveServerConfigurations()
{
	$hbody = json_decode((file_get_contents('php://input')), true);
	//echo ($hbody["ALERT_NEW_DEVICE"]== 1?"True":"False");

	$config ="
import os

EMULATE=True

ALERT_NEW_DEVICE = " . ($hbody["ALERT_NEW_DEVICE"]== 1?"True":"False") . "
ALERT_DOWN_DEVICE = ". ($hbody["ALERT_DOWN_DEVICE"]== 1?"True":"False") ."
ALERT_DOWN_THRESHOLD = " . $hbody["ALERT_DOWN_THRESHOLD"] . "

ALERT_FROM = 'lan.scanner alert'
ALERT_SUBJECT='lan.scanner report'
ALERT_TO =''
SMTP_SERVER = 'smtp.mailserver.com'
SMTP_PORT = 587
SMTP_USERNAME = 'user@example.com'
SMTP_PASSWORD = 'password'
WEB_ADMIN_DEVICE_URL = 'http://192.168.1.31/lanscanner/ui/device.php?mac='";

	$config_file = fopen('../back/config.py', 'w');
	fwrite($config_file, $config);
	fclose($config_file);
}

?>