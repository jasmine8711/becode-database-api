<?php 
class Notes{
    // database connection and table name
    static $conn;
    private $table_name = "notes";
 
    // object properties
    public $title;
    public $note;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }



public static function create() {
       // query to insert record
       $query = "INSERT INTO
       " . self::$conn->table_name . "
   SET
       title=:title, note=:note";

// prepare query
$stmt =self::$conn->conn->prepare($query);

// sanitize
$this->title=htmlspecialchars(strip_tags($this->title));
$this->note=htmlspecialchars(strip_tags($this->note));

// bind values
$stmt->bindParam(":title", $this->title);
$stmt->bindParam(":note", $this->note);


// execute query
if($stmt->execute()){
return true;
}

return false;
}

 
     
         
    
    function read(){
        // select all query
        $query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories c
                            ON p.category_id = c.id
                ORDER BY
                    p.created DESC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    
    }
}


// create product

