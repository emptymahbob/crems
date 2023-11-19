<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'crems';
$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    die('Connection error'.$con->connect_error);
}

?>