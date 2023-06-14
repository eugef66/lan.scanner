<?php
//Read db
$db = load();

//Write db
save($db);

//Redirect to index.php
header("Location: index.php");

function load(){
	return json_decode(file_get_contents('../db/metadata.json'), true);
}

function save($db){
	$db_file = fopen('../db/metadata.json', 'w');
	fwrite($db_file, json_encode($db, JSON_PRETTY_PRINT));
	fclose($db_file);
}

?>