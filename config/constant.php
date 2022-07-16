<?php
//start session
session_start();

define('URL','http://localhost/res');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASS','');
define('DB_NAME','foodappdb');



$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASS) or die(mysqli_error());
$db=mysqli_select_db($conn,DB_NAME)or die(mysqli_error());
?>