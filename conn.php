<?php 
// Turn some of these into functions
// Connection to the database
$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpass = "123";
$db = "tomasinoblog";
$dport = "3307";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db, $dport);
?>