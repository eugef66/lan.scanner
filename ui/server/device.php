<?php


//Read db
$db = load();
$mac = $_POST["mac"];
$action = $_POST["action"];



if ($action == "delete") {

	unset($db[$mac]);
	if (count($db) == 0) {
		$db = new stdClass();
	}
} elseif ($action == "save") {
	//Update attributes
	$db[$mac]["description"] = $_POST["description"];
	$db[$mac]["comments"] = $_POST["comments"];
	$db[$mac]["owner"] = $_POST["owner"];
	$db[$mac]["location"] = $_POST["location"];
	$db[$mac]["device-type"] = $_POST["device_type"];
	$db[$mac]["alert_down"] = isset($_POST["alert_down"]) ? true : false;
	$db[$mac]["is_new"] = isset($_POST["is_new"]) ? true : false;
	//$db[$mac]["archived"]= (isset($_POST["archived"])?true:false);
}
//Write db
save($db);
//Redirect to index.php
header("Location: ../index.php");

function load(){
	return json_decode(file_get_contents('../../db/db.json'), true);
}

function save($db){
	$db_file = fopen('../../db/db.json', 'w');
	fwrite($db_file, json_encode($db, JSON_PRETTY_PRINT));
	fclose($db_file);
}


?>