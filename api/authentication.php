<?php

/*
  __  __           _        _             ______ _                 _____ ____  
 |  \/  |         | |      | |           |  ____| |               / ____/ __ \ 
 | \  / | __ _  __| | ___  | |__  _   _  | |__  | | __ _ _ __ ___| |   | |  | |
 | |\/| |/ _` |/ _` |/ _ \ | '_ \| | | | |  __| | |/ _` | '__/ _ \ |   | |  | |
 | |  | | (_| | (_| |  __/ | |_) | |_| | | |    | | (_| | | |  __/ |___| |__| |
 |_|  |_|\__,_|\__,_|\___| |_.__/ \__, | |_|    |_|\__,_|_|  \___|\_____\____/ 
                                   __/ |                                       
                                  |___/                                        
Company: Flare Media (Holdings) Corp. [US].
Support: support@flareco.net
Contact: https://www.flareco.net/legal/contact-us
Impressum: https://www.flareco.net/legal/imprint
Spenden: https://www.flareco.net/donate
*/


session_start();
include '../includes/config.php';



$time = time();
if(!isset($_REQUEST['service'])){
	die(json_encode(array("status" => "error", "message" => "No Service selected.")));
} else {
	$email = "";
	$service = htmlentities($_REQUEST['service']);
	
	if($service == "registration"){
		
		if(isset($_REQUEST['email'])){
			if(isset($_REQUEST['username'])){
				if(isset($_REQUEST['password'])){
					if(isset($_REQUEST['repass'])){
						if(isset($_REQUEST['agreement'])){
							
							$email = htmlspecialchars($_REQUEST['email']);
							$username = htmlspecialchars($_REQUEST['username']);
							$password = hash("sha1", htmlspecialchars($_REQUEST['password']));
							$repass = hash("sha1", htmlspecialchars($_REQUEST['repass']));
							$agreement = htmlspecialchars($_REQUEST['agreement']);
							
							if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
								if(strlen($password) < 6){
									die(json_encode(array("status" => "error", "message" => "Please choose another Password (Min. 6)")));
								} else {
									
									if($password == $repass){
										
										$sql = "SELECT username FROM accounts WHERE username = '$username' LIMIT 1";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												die(json_encode(array("status" => "error", "message" => "Username already in use!")));
											}
										}
										
										$sql = "SELECT email FROM accounts WHERE email = '$username' LIMIT 1";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												die(json_encode(array("status" => "error", "message" => "Email is already in use!")));
											}
										}
										
										
										$regip = $_SERVER['REMOTE_ADDR'];
										$sql = "INSERT INTO accounts(id, username, email, password, otsecret, status, isMod, isAdmin, comment, balance, share, firstip, lastip, lastlogin, firstlogin, session_token, creation_time)VALUES('', '$username', '$email', '$password', 'none', 'Pending', 'false', 'false', 'New Account', '0', '0', '$regip', '$regip', '$time', '$time', 'XXXXXXXXXXXXXXXX', '$time')";
										if ($conn->query($sql) === TRUE) {
											die(json_encode(array("status" => "success", "message" => "Account created, you can now login!")));
										} else {
											die(json_encode(array("status" => "error", "message" => "We solving Database issues.")));
										}
										
									} else {
										die(json_encode(array("status" => "error", "message" => "Passwords doesnt match each other.")));
									}
								}
							} else {
								die(json_encode(array("status" => "error", "message" => "We cant verify your Email.")));
							}
						} else {
							die(json_encode(array("status" => "error", "message" => "Please accept the agreement!")));
						}
					} else {
						die(json_encode(array("status" => "error", "message" => "We cant verify your Re-typed Password.")));
					}
				} else {
					die(json_encode(array("status" => "error", "message" => "We cant verify your Password.")));
				}
			} else {
				die(json_encode(array("status" => "error", "message" => "We cant verify your Username.")));
			}
		} else {
			die(json_encode(array("status" => "error", "message" => "We cant verify your Email.")));
		}
	} elseif($service == "login"){
		if(isset($_REQUEST['user'])){
			if(isset($_REQUEST['password'])){
				$user = htmlspecialchars($_REQUEST['user']);
				$password = hash("sha1", htmlspecialchars($_REQUEST['password']));
				
				if($user == ""){
					die(json_encode(array("status" => "error", "message" => "Paranormal Email or Username detected!")));
				}
				if($password == ""){
					die(json_encode(array("status" => "error", "message" => "Paranormal Password detected!")));
				}
				if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
					$sql = "SELECT * FROM accounts WHERE email = '$user' AND password = '$password' LIMIT 1";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							if($row['otsecret'] == "none"){
								$session_token = hash("sha1", md5("".time().rand("1", "999999999").md5($user)));
								$sql = "UPDATE accounts SET session_token = '$session_token' WHERE email = '$user'";
								if ($conn->query($sql) === TRUE) {
									
									if($row['status'] == "Suspended"){
										die(json_encode(array("status" => "error", "message" => "Account wurde Gesperrt!")));
									}
									if($row['status'] == "Terminated"){
										die(json_encode(array("status" => "error", "message" => "Account wurde Gebannt!")));
									}
									if($row['status'] == "Pending"){
										die(json_encode(array("status" => "error", "message" => "Account ist nicht Aktiv!")));
									}
									
									$_SESSION['token'] = $session_token;
									$ip = $_SERVER['REMOTE_ADDR'];
									$time = time();
									$sql = "UPDATE accounts SET lastip = '$ip' WHERE email = '$user'";
									$res = $conn->query($sql);
									$sql = "UPDATE accounts SET lastlogin = '$time' WHERE email = '$user'";
									$res = $conn->query($sql);
									die(json_encode(array("status" => "success", "message" => "Verification success, logging in.....")));
								} else {
									die(json_encode(array("status" => "error", "message" => "We solving Database issues.")));
								}
							} else {
								die(json_encode(array("status" => "error", "message" => "OTP Service not available!")));
							}
						}
					} else {
						die(json_encode(array("status" => "error", "message" => "Authentication Credentials mismatch.")));
					}
				} else {
					$sql = "SELECT * FROM accounts WHERE username = '$user' AND password = '$password' LIMIT 1";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							if($row['otsecret'] == "none"){
								$session_token = hash("sha1", md5("".time().rand("1", "999999999").md5($user)));
								$sql = "UPDATE accounts SET session_token = '$session_token' WHERE username = '$user'";
								if ($conn->query($sql) === TRUE) {
									
									if($row['status'] == "Suspended"){
										die(json_encode(array("status" => "error", "message" => "Dein Account wurde Beurlaubt!")));
									}
									if($row['status'] == "Terminated"){
										die(json_encode(array("status" => "error", "message" => "Account wurde Gebannt!")));
									}
									if($row['status'] == "Pending"){
										die(json_encode(array("status" => "error", "message" => "Account ist nicht Aktiv!")));
									}
									
									$_SESSION['token'] = $session_token;
									$ip = $_SERVER['REMOTE_ADDR'];
									$time = time();
									$sql = "UPDATE accounts SET lastip = '$ip' WHERE username = '$user'";
									$res = $conn->query($sql);
									$sql = "UPDATE accounts SET lastlogin = '$time' WHERE username = '$user'";
									$res = $conn->query($sql);
									die(json_encode(array("status" => "success", "message" => "Verification success, logging in.....")));
								} else {
									die(json_encode(array("status" => "error", "message" => "We solving Database issues.")));
								}
							} else {
								die(json_encode(array("status" => "error", "message" => "OTP Service not available!")));
							}
						}
					} else {
						die(json_encode(array("status" => "error", "message" => "Authentication Credentials mismatch.")));
					}	
				}
			} else {
				die(json_encode(array("status" => "error", "message" => "Paranormal Password detected, please verify.")));
			}
		} else {
			die(json_encode(array("status" => "error", "message" => "Paranormal Username/Email detected, please verify.")));
		}
	} 
}


?>