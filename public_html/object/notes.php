<?php
class Note implements \JsonSerializable{
 
    // database connection and table name
    private $conn;
 
    // object properties
    private $title;
    private $content;
    private $id;
 
    // constructor with $db as database connection
    public function __construct($db, $title, $content){
        $this->conn = $db;

        $this->title = $title;
        $this->content = $content;
    }

    static function find_by_id($conn, $id) {
        $finder = Note::find_by($conn, "id", $id, "=");
        return $finder();
    }

    static function find_by_title($conn, $title) {
        $finder =  Note::find_by($conn, "title", $title, "LIKE");
        return $finder();
    }

    static function find_by_content($conn, $content) {
        $finder = Note::find_by($conn, "note", $content, "LIKE");
        return $finder();
    }

    static private function find_by($conn, $property_name, $property_value, $comparator) {
        return function() use ($conn, $property_name, $property_value, $comparator) {
            $query = "SELECT title, note, id FROM notes WHERE ".$property_name." ".$comparator." :".$property_name;
            $stmt = $conn->prepare($query);

            if($comparator == "LIKE") {
                $stmt->bindValue(":".$property_name, '%'.$property_value.'%');
            } else {
                $stmt->bindValue(":".$property_name, $property_value);
            }

            $stmt->execute();

            $results = $stmt->fetchAll();
            $notes = [];
            foreach($results as $res){
                $tmp = new Note($conn, $res["title"], $res["note"]);
                $tmp->id = $res["id"];
                array_push($notes, $tmp);
            }

            return $notes;
        };
    }

    public function save(){
        // query to insert record
        $query = "INSERT INTO notes (title, note) VALUES(:title, :note)";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));

        // bind values
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':note', $this->content);

        // execute query
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM notes WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function update($title, $content) {

    }

    public function jsonSerialize() {
        // $vars = get_object_vars($this);
        $vars = array();
        $vars["id"] =  $this->id;
        $vars["title"] =  $this->title;
        $vars["content"] = $this->content;

        return $vars;
    }

    public function __toString() {
        return "ID: " . $this->id . "\nTitle: " . $this->title . "\n\nContent: " . $this->content;
    }
}