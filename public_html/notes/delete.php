<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Allow-Headers: Content-Type,X-Requested-With,origin, Authorization");
include_once '../config/database.php';
include_once '../object/notes.php';

$database = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$conn = $database->getConnection();

$title = $_GET["title"];
$notes = Note::find_by_title($conn, $title);
foreach($notes as $note) {
    $note->delete();
}
?>
