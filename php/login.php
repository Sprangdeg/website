<?php
	require 'database.php';
	
session_start();
$userName = $password = "";
$error='';

echo "username " . $_POST['userName'] . "<br>";
echo "username " . $_POST['password'] . "<br>";

if (empty($_POST['userName']) || empty($_POST['password'])) {
	$error = "Username or Password is invalid";
}

else{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$userName = test_input($_POST["userName"]);
		$password = test_input($_POST["password"]);
		echo "Logged <br>";
		if(login($userName, $password)){
			echo "Logged in <br>";
			$_SESSION['userName']=$userName;
			echo "loading header";
			header("location: profile.php");
		} else {
			$error = "Login failed! <br>Username or Password is invalid <br>";
			echo $error;
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function login($userName, $password) {
	$dbConnection = db_create_connection();
	$login = false;
	$sql = "SELECT userName, password FROM userData
			WHERE userName = '$userName' and password = '$password'";
			
	$result = $dbConnection -> query($sql);
	
	if ($result -> num_rows > 0) {
		$login = true;
	}
	$dbConnection -> close();
	return $login;
}
?>