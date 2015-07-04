<?php	
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
?>