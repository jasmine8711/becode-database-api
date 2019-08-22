<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type,X-Requested-With,origin, Authorization");
// required headers
// include database and object files
include_once '../config/database.php';
include_once '../object/notes.php';
 
// instantiate database and product object
// $database = new Database();
$database = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$conn = $database->getConnection();
 
// initialize object
//$notes = new Notes($conn);// query products
$id = $_GET["id"];
$title = $_GET["title"];
$notes = [];
if ($id != "") {
	$notes = Note::find_by_id($conn, $id);
} else {
	$notes = Note::find_by_title($conn, $title);
}
http_response_code(200);
echo json_encode($notes);
