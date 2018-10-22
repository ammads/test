<?php
// used to connect to the database
$host = "localhost";
$db_name = "flixnet";
$username = "root";
$password = "";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
  
// control de excepciones
catch(Exception $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>