<?php

$http_method = $_SERVER['REQUEST_METHOD'];


if (isset($_GET["action"])) {
	$action = $_GET["action"];


	switch ($action) {
		case "serverConfig":
			if ($http_method == "PATCH")
				saveServerConfigurations();
			if ($http_method == "GET")
				loadServerConfigurations();
			break;
		case "metadata":
			if ($http_method=="GET") loadMetadata();
			if ($http_method=="POST") saveMetadata("insert");
			if ($http_method=="DELETE") saveMetadata("delete");
	}
}


// ******* Metadata **************//
function loadMetadata()
{
	$md = file_get_contents('../../db/metadata.json');
	header('Content-Type: application/json');
	echo ($md);
}



function saveMetadata($action)
{

	// Read HTTP Body
	$hbody = json_decode((file_get_contents('php://input')), true);

	//Open DB file
	$db = json_decode(file_get_contents('../../db/metadata.json'), true);

	foreach($hbody as $key => $value)
	{
		if ($action=="insert" && !array_search($value, $db[$key])) array_push($db[$key],$value);
		if ($action=="delete" && $del_key = array_search($value, $db[$key])) unset($db[$key][$del_key]);
	}
	//Write to db
	$db_file = fopen('../../db/metadata.json', 'w');
	fwrite($db_file, json_encode($db, JSON_PRETTY_PRINT));
	fclose($db_file);
}

// ******* Server Configurations **************//
function loadServerConfigurations()
{

	$server_config_array = array();

	$config_file = fopen('../../back/config.py', 'r');

	while (!feof($config_file)) {
		$line = explode("=", fgets($config_file));

		if (count($line) > 1) {
			$key = str_replace("'", "", $line[0]);
			$value = str_replace("'", "", $line[1]);
			$server_config_array[trim($key)] = trim($value);
			
		}
	}
	$server_config = json_encode($server_config_array);
	fclose($config_file);
	header('Content-Type: application/json');
	echo ($server_config);




}

function saveServerConfigurations()
{
	$hbody = json_decode((file_get_contents('php://input')), true);


	$config = "
import os

EMULATE=False

ALERT_NEW_DEVICE = " . ($hbody["ALERT_NEW_DEVICE"] == 1 ? "True" : "False") . "
ALERT_DOWN_DEVICE = " . ($hbody["ALERT_DOWN_DEVICE"] == 1 ? "True" : "False") . "
ALERT_DOWN_THRESHOLD = " . $hbody["ALERT_DOWN_THRESHOLD"] . "
ALERT_FROM = '" . $hbody["ALERT_FROM"] . "'
ALERT_SUBJECT='" . $hbody["ALERT_SUBJECT"] . "'
ALERT_TO ='" . $hbody["ALERT_TO"] . "'
SMTP_SERVER = '" . $hbody["SMTP_SERVER"] . "'
SMTP_PORT = " . $hbody["SMTP_PORT"] . "
SMTP_USERNAME = '" . $hbody["SMTP_USERNAME"] . "'
SMTP_PASSWORD = '" . $hbody["SMTP_PASSWORD"] . "'
WEB_ADMIN_DEVICE_URL = '" . $hbody["WEB_ADMIN_DEVICE_URL"] . "'";

	$config_file = fopen('../../back/config.py', 'w');
	fwrite($config_file, $config);
	fclose($config_file);

	echo $config;
}

?>