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
include '../includes/hasPerms.php';


if(isset($_REQUEST['changePassword'])){
	if(isset($_REQUEST['oldPass'])){
		if(isset($_REQUEST['newPass'])){
			if(isset($_REQUEST['newPass2'])){
				
				$oldPass = hash("sha1", htmlspecialchars($_REQUEST['oldPass']));
				$newPass = hash("sha1", htmlspecialchars($_REQUEST['newPass']));
				$newPass2 = hash("sha1", htmlspecialchars($_REQUEST['newPass2']));
				
				$sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$oldPass' LIMIT 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						
						if($newPass == $newPass2){
							
							$sql = "UPDATE accounts SET password = '$newPass' WHERE username = '$username'";
							if ($conn->query($sql) === TRUE) {
								header("Location: $website_url/account/profile?e=Password%20geändert");
								exit;
							} else {
								header("Location: $website_url/account/profile?e=DB%20Fehler");
								exit;
							}
							
						} else {
							header("Location: $website_url/account/profile?e=Passwörter%20stimmen%20nicht%20überein");
							exit;
						}	
					}
				} else {
					header("Location: $website_url/account/profile?e=password%20nicht%20richtig");
					exit;
				}
			} else {
				header("Location: $website_url/account/profile?e=Neues Password Kontrolle Fehlt.");
				exit;
			}
		} else {
			header("Location: $website_url/account/profile?e=Altes%20Password%20fehlt.");
			exit;
		}
	} else {
		header("Location: $website_url/account/profile?e=Altes%20Password%20fehlt.");
		exit;
	}
}


if(isset($_REQUEST['changeRank'])){
	if(isset($_REQUEST['userID'])){
		if(isset($_REQUEST['newRank'])){
			
			$allrank = array("Praktikant", "Azubi", "Mechaniker", "Meister", "Ausbilder", "Investor", "Boss", "Admin");
			$userID = htmlspecialchars($_REQUEST['userID']);
			$newRank = htmlspecialchars($_REQUEST['newRank']);
			
			if(in_array($newRank, $allrank)){
				
				$sql = "UPDATE accounts SET comment = '$newRank' WHERE username = '$userID'";
				
				if ($conn->query($sql) === TRUE) {
					header("Location: $website_url/account/boss/panel?z=Rang_gesetzt!");
					exit;
				} else {
					header("Location: $website_url/account/boss/panel?z=DB_Probleme!");
					exit;
				}
			} else {
				header("Location: $website_url/account/boss/panel?z=Rang_nicht_gefunden!");
				exit;
			}
			
		} else {
			header("Location: $website_url/account/boss/panel?z=Fehler_bitte_Admin_kontaktieren!");
			exit;
		}
	} else {
		header("Location: $website_url/account/boss/panel?z=Fehler_bitte_Admin_kontaktieren!");
		exit;
	}
}

if(isset($_REQUEST['userState'])){
		if(isset($_REQUEST['isMode'])){
			$userID = htmlspecialchars($_REQUEST['userID']);
			$isMode = htmlspecialchars($_REQUEST['isMode']);
			if($isMode == "Boss"){
				$specops = "admin";
			} else {
				$specops = "boss";
			}
			$sql = "SELECT * FROM accounts WHERE username = '$userID' LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					
					$state = $row['status'];
					
					if($state == "Suspended"){
						$sql = "UPDATE accounts SET status = 'Active' WHERE username = '$userID'";
						$res = $conn->query($sql);
						
						header("Location: $website_url/account/$specops/panel?u=Account_freigegeben.");
						exit;
					} elseif($state == "Active") {
						$sql = "UPDATE accounts SET status = 'Suspended' WHERE username = '$userID'";
						$res = $conn->query($sql);
						$rand = "TÖTET ES BEVOR ES EIER LEGT! ".rand("1", "99999999");
						$sql = "UPDATE accounts SET session_token = '$rand' WHERE username = '$userID'";
						$res = $conn->query($sql);
						
						header("Location: $website_url/account/$specops/panel?u=Account_gesperrt.");
						exit;
					} else {
						$sql = "UPDATE accounts SET status = 'Active' WHERE username = '$userID'";
						$res = $conn->query($sql);
						
						header("Location: $website_url/account/$specops/panel?u=Account_freigegeben.");
						exit;
					}
					
				}
			} else {
				header("Location: $website_url/account/$specops/panel?u=Fehler_bitte_Admin_kontaktieren!");
				exit;
			}
		}
}

if(isset($_REQUEST['deleteOrder'])){
	if(isset($_REQUEST['type'])){
		if(isset($_REQUEST['token'])){
			$token = htmlspecialchars($_REQUEST['token']);
			$type = htmlspecialchars($_REQUEST['type']);
			if($type == "staat"){
				$sql = "DELETE FROM staats WHERE token = '$token'";
				$res = $conn->query($sql);
				header("Location: $website_url/account/admin/panel?q=Erfolgreich_gelöscht!");
				exit;	
			} elseif($type == "privat"){
				$sql = "DELETE FROM baskets WHERE token = '$token'";
				$res = $conn->query($sql);
				header("Location: $website_url/account/admin/panel?w=Erfolgreich_gelöscht!");
				exit;	
			} else {
				header("Location: $website_url/account/admin/panel?q=Typ_fehlerhaft&w=Typ_fehlerhaft");
				exit;
			} 
		}
	}
}

?>