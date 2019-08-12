<?php
/* $host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$dbname = 'dbtest';
$conn = new mysqli($host, $user, $pass, $dbname); */
$user = 'root';
$pass = 'rootpassword';
$conn = new PDO('mysql:host=mysql;dbname=dbtest', $user, $pass);


echo json_encode($conn);