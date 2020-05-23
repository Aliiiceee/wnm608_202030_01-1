<?php	

	function connectToDB() { //mysqli
		$serverName = "localhost";
		$username = "root";
		$password = "root";
		$dbName = "Artomia_product";
		$conn = new mysqli($serverName, $username, $password, $dbName);

		return $conn;
	}
?>