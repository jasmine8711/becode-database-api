<?php
define(DB_HOST, "mysql");
define(DB_NAME, "dbtest");
define(DB_USER, "root");
define(DB_PASSWORD, "rootpassword");

class Database{
    private $host;
    private $username;
    private $password;
    private $dbname;

    private $conn;

    function __construct($host, $username, $password, $dbname) {
        $this->conn = NULL;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    function __destruct() {
        $this->conn = NULL;
    }

    private function connect($host, $username, $password, $dbname) {
        try {
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $username, $password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
    }
 
    // get the database connection
    public function getConnection(){
        if($this->conn == NULL) {
            $this->connect($this->host, $this->username, $this->password, $this->dbname);
        }
        return $this->conn;
    }
}
?>