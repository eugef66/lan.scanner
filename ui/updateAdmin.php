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
	

	$config ="
import os

EMULATE=True

ALERT_NEW_DEVICE = " . ($hbody["ALERT_NEW_DEVICE"]== 1?"True":"False") . "
ALERT_DOWN_DEVICE = ". ($hbody["ALERT_DOWN_DEVICE"]== 1?"True":"False") ."
ALERT_DOWN_THRESHOLD = " . $hbody["ALERT_DOWN_THRESHOLD"] . "
ALERT_FROM = '" . $hbody["ALERT_FROM"] . "'
ALERT_SUBJECT='" . $hbody["ALERT_SUBJECT"] . "'
ALERT_TO ='" . $hbody["ALERT_TO"] . "'
SMTP_SERVER = '" . $hbody["SMTP_SERVER"] . "'
SMTP_PORT = " . $hbody["SMTP_PORT"] . "
SMTP_USERNAME = '" . $hbody["SMTP_USERNAME"] . "'
SMTP_PASSWORD = '" . $hbody["SMTP_PASSWORD"] . "'
WEB_ADMIN_DEVICE_URL = '" . $hbody["WEB_ADMIN_DEVICE_URL"] . "'";

	$config_file = fopen('../back/config.py', 'w');
	fwrite($config_file, $config);
	fclose($config_file);

	echo $config;
}

?>