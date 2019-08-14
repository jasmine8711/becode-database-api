<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
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
$title = $_GET["title"];
$notes = Note::find_by_title($conn, $title);
echo json_encode($notes);
die;
