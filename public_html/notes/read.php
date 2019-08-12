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
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $notes_arr=array();
    $notes_arr["title"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $notes_item=array(
            "title" => $title,
            "note" => $note,
        );
 
        array_push($notes_arr["title"], $notes_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($notes_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}