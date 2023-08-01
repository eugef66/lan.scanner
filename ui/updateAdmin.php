<?php


if (isset($_POST["action"])){
	$action = $_POST["action"];

	switch ($action){
		case "meta-owner": 
			break;
		case "meta-device-type": 
			break;
		case "meta-location": 
			break;
		case "server-config": 
			break;
		case "appirence": 
			break;
		}


}

//Read db
$db = loadMetadata();

//Write db
saveMetadata($db);

//Redirect to index.php
header("Location: index.php");

function loadMetadata(){
	return json_decode(file_get_contents('../db/metadata.json'), true);
}

function saveMetadata($db){
	$db_file = fopen('../db/metadata.json', 'w');
	fwrite($db_file, json_encode($db, JSON_PRETTY_PRINT));
	fclose($db_file);
}

?>