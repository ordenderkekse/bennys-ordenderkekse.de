<?php

// Basic Website Config

$website_title = "Benny´s Repairs";
$website_url = "https://bennys-ordenderkekse.de";


// Advanced Config


// Database Build
$conn = mysqli_connect("localhost", "original", "", "original");


// Database Configs

$res = $conn->query("SELECT * FROM config WHERE id = '1'");
if ($res->num_rows > 0) {
	while($row = $res->fetch_assoc()) {
		$login_status = $row['login_status'];
		$register_status = $row['register_status'];
		$maintenance_mode = $row['maintenance_mode'];
		$sperrung_status = $row['sperrung_status'];
		$version = $row['version'];
	}
} else {
	die("Cant connect to Database. => SERVICES");
}

?>