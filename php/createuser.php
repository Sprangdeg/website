<?php
// define variables and set to empty values
$userName = $password = $firstName = $lastName = $email = $dateOfBirth = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$userName = test_input($_POST["userName"]);
	$password = test_input($_POST["password1"]);
	$firstName = test_input($_POST["firstName"]);
	$lastName = test_input($_POST["lastName"]);
	$email = test_input($_POST["email"]);
	$dateOfBirth = test_input($_POST["dateOfBirth"]);
	$money = 100;

	if (username_available($userName)) {
		db_create_user($userName, $password, $firstName, $lastName, $email, $dateOfBirth, $money);
		//userCreated();
	} else {
		echo "The username " . $userName . " is not available. Please select another one.";
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function userCreated() {
	echo "Welcome " . $_POST["firstName"] . " " . $_POST["lastName"] . "<br>";
	echo "Your account has been created. Please login with your username and password";
}

function username_available($userName) {

	$dbConnection = db_create_connection();
	$nameAvailable = true;

	$sql = "SELECT userName FROM userData
			WHERE userName = '$userName'";
	$result = $dbConnection->query($sql);

	if ($result->num_rows > 0) {
		$nameAvailable = false;	
	}

	$dbConnection -> close();

	return $nameAvailable;
}

function db_create_connection() {
	$servername = "localhost";
	$username = "bonstrom_webpage";
	$password = "Menion86";
	$dbname = "bonstrom_webpage";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn -> connect_error) {
		die("Connection failed: " . $conn -> connect_error);
	}

	return $conn;
}

function db_create_user($uName, $pwd, $fName, $lName, $e_mail, $dateOfBirth, $money) {

	$dbConnection = db_create_connection();

	$sql = "INSERT INTO userData (userName, password, firstName, lastName, email, birthday, money) 
			VALUES ( '$uName' , '$pwd', '$fName', '$lName', '$email', '$dateOfBirth', '$money')";

	if ($dbConnection -> query($sql) === TRUE) {
		userCreated();
	} else {
		echo "Error: " . $sql . "<br>" . $dbConnection -> error;
	}

	$dbConnection -> close();
}

class User {
	public $userName = "";
	public $password = "";
	public $firstName = "";
	public $lastName = "";
	public $email = "";
	public $birthDate = "";
	public $money = "";
	public $title = "";
}
?>

