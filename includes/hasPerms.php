<?php

if(isset($_SESSION['token'])){
	$token = $_SESSION['token'];
	$sql = "SELECT * FROM accounts WHERE session_token = '$token' LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			if($row['comment'] == "Admin"){
				$rank = "Admin";
			} elseif($row['comment'] == "Boss"){
				$rank = "Boss";
			} elseif($row['comment'] == "Ausbilder"){
				$rank = "Ausbilder";
			} elseif($row['comment'] == "Meister"){
				$rank = "Meister";
			} elseif($row['comment'] == "Mechaniker"){
				$rank = "Mechaniker";
			} elseif($row['comment'] == "Azubi"){
				$rank = "Azubi";
			} elseif($row['comment'] == "Praktikant"){
				$rank = "Praktikant";
			} else {
				$rank = "Praktikant";
			}
			
			$username = $row['username'];
			$email = $row['email'];
			$since = $row['creation_time'];
			$balance = $row['balance'];
			
		}
	} else {
		session_destroy();
		header("Location: $website_url");
		exit;
	}
} else {
	header("Location: $website_url");
	exit;
}

?>