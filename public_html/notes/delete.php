<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

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