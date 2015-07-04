<?php
	require ('database.php');

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$dbConnection = db_create_connection();
// Selecting Database
//$db = mysql_select_db("company", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['userName'];
// SQL Query To Fetch Complete Information Of User
	$sql = "SELECT * FROM userData
			WHERE userName = 'daniel'";

$result = $dbConnection -> query($sql);
$row = $result->fetch_assoc();

$login_session = $row['userName'];

if(!isset($login_session)){
$dbConnection -> close(); // Closing Connection
header('Location: index.html'); // Redirecting To Home Page
}
?>