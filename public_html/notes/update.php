<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type,X-Requested-With,origin, Authorization");
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../object/notes.php';
$database = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$conn = $database->getConnection();
$data = json_decode(file_get_contents('php://input'), true);

$notes = Note::find_by_id($conn, $data["id"]);

if(count($notes) < 1) {
    die;
}

$newTitle = $data["title"];
$newContent = $data["content"];
$notes[0]->update($newTitle, $newContent);





