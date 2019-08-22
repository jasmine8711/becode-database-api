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
 
$title = $_GET["title"];
$content = $_GET["content"];

if( $_SERVER['REQUEST_METHOD'] == "OPTIONS") {
 	http_response_code(204);
	return;
}

if( $_SERVER['REQUEST_METHOD'] != "POST") {
	http_response_code(400);
	return;
}

// make sure data is not empty
if( !empty($title) && !empty($content) ){
    $note = new Note($conn, $title, $content);
 
    // create the product
    if($note->save()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
} else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>
