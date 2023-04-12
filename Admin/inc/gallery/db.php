<?php
//Configure database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'my_password';
$dbName = '3a';

//Connection database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//check connection

if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

?>