<?php

include './inc/connection/db-user.php';
date_default_timezone_set('Asia/Manila');
$nowTimeStamp = date("Y-m-d H:i:s");
$previousStartTime = $_SESSION["startTime"];

$id = $_SESSION["id"]; 
$logout_Querry = "UPDATE accesslog SET timeLogout = '$nowTimeStamp'  WHERE( timeLogin = '$previousStartTime ' AND userID = $id)";
if ($conn->query($logout_Querry)) {   
                                                    echo 'Success';
                                                } else{
                                                        echo'Error';    
                                                    }   
// Unset all of the session variables
$_SESSION = array();
// Destroy the session.
session_destroy();
// Redirect to login page
header("location: login.php");
exit;

?>