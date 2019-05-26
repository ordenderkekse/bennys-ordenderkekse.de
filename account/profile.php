<?php
session_start();
include '../includes/config.php';
include '../includes/hasPerms.php';

$curtime = time();

if(isset($_REQUEST['vacation'])){
	if(isset($_REQUEST['start'])){
		if(isset($_REQUEST['end'])){
			if(isset($_REQUEST['reason'])){
			
				$start = htmlspecialchars($_REQUEST['start']);
				$end = htmlspecialchars($_REQUEST['end']);
				$reason = htmlspecialchars($_REQUEST['reason']);
				
				if($reason == ""){$reason = "Urlaub in EUROPA.";}
				
				$maxmonth = "12";
				$maxdays = "31";
				
				$st = explode("-", $start);
				$stdays = $st[0];
				$stmonth = $st[1];
				$styears = $st[2];
				
				$en = explode("-", $end);
				$endays = $en[0];
				$enmonth = $en[1];
				$enyears = $en[2];
				
				if(!is_numeric($stdays)){ header("Location: ?o=0x0"); exit;}
				if(!is_numeric($stmonth)){ header("Location: ?o=0x1"); exit;}
				if(!is_numeric($styears)){ header("Location: ?o=0x2"); exit;}
				if(!is_numeric($endays)){ header("Location: ?o=0x3"); exit;}
				if(!is_numeric($enmonth)){ header("Location: ?o=0x4"); exit;}
				if(!is_numeric($enyears)){ header("Location: ?o=0x5"); exit;}
				
				if($stdays <= $maydays && $stdays >= "1"){ header("Location: ?o=0x6"); exit; }
				if($stmonth >= $maxmonth && $stmonth <= "1"){ header("Location: ?o=0x7"); exit; } // 15-05-2019
				
				if($endays <= $maydays && $endays >= "1"){ header("Location: ?o=0x8"); exit; }
				if($enmonth >= $maxmonth && $enmonth <= "1"){ header("Location: ?o=0x9"); exit; }
				
				$timestart = strtotime("$stdays-$stmonth-$styears");
				$timeend = strtotime("$endays-$enmonth-$enyears");
				
				$sql = "SELECT * FROM vacation WHERE user = '$username' LIMIT 1";
				$res = $conn->query($sql);
				if ($res->num_rows > 0) {
					while($row = $res->fetch_assoc()) {
						
						$sql = "UPDATE vacation SET vacstart = '$timestart' WHERE user = '$username'";
						$res = $conn->query($sql);
						$sql = "UPDATE vacation SET vacend = '$timeend' WHERE user = '$username'";
						$res = $conn->query($sql);
						$sql = "UPDATE vacation SET status = 'onHold' WHERE user = '$username'";
						$res = $conn->query($sql);
						$sql = "UPDATE vacation SET timestamp = '$curtime' WHERE user = '$username'";
						$res = $conn->query($sql);
						$sql = "UPDATE vacation SET reason = '$reason' WHERE user = '$username'";
						$res = $conn->query($sql);
						
						header("Location: ?o=1x0");
						exit;
						
						
					}
				} else {
					$sha1 = hash("sha1", $curtime.$username.$timestart);
					$sql = "INSERT INTO vacation(id, token, vacstart, vacend, user, status, reason, timestamp)VALUES('', '$sha1', '$timestart', '$timeend', '$username', 'onHold', '$reason', '$curtime')";
					echo $sql."</br>";
					$res = $conn->query($sql);
					header("Location: ?o=1x1");
					exit;
				}
			}
		}
	}
}

if(isset($_REQUEST['o'])){
	
	$switcher = $_REQUEST['o'];
	switch($switcher){
		case "0x0":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x1":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x2":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x3":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x4":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x5":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x6":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x7":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x8":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "0x9":
			$omessage = '<center><p class="alert alert-warning">Urlaubs Format Ungültig.</p></center></br>';
			break;
		case "1x0":
			$omessage = '<center><p class="alert alert-warning">Urlaub erfolgreich angefragt. 1x0</p></center></br>';
			break;
		case "1x1":
			$omessage = '<center><p class="alert alert-warning">Urlaub erfolgreich angefragt. 1x1</p></center></br>';
			break;
		default:
			$omessage = '<center><p class="alert alert-warning">0w0</p></center></br>';
	}
	
}



include '../includes/header.authed.php';

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">
                        <center>Persönliche Daten</center>
                    </div>
                    <div class="panel panel-body">
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel panel-heading">
                                    <center>Profile</center>
                                </div>
                                <div class="panel panel-body">
									<div class="row">
										<div class="col-md-12">
											<form>
												<div class="form-group">
													<label class=""><p>Username</p></label>
													<input type="text" class="form-control" id="inputUsername" readonly value="<?php echo $username; ?>" placeholder="Username">
												</div>
												<div class="form-group">
													<label class=""><p>Email</p></label>
													<input type="text" class="form-control" id="inputEmail" readonly value="<?php echo $email; ?>" placeholder="Email">
												</div>
												<div class="form-group">
													<label class=""><p>Mitarbeiter seit</p></label>
													<input type="text" class="form-control" id="inputEmail" readonly value="<?php echo date("d/m/Y", $since); ?>" placeholder="Email">
												</div>
												<div class="form-group">
													<label class=""><p>Verdienst</p></label>
													<input type="text" class="form-control" id="inputEmail" readonly value="<?php echo $balance; ?> $" placeholder="Email">
												</div>
											</form>
										</div>
									</div>
                                </div>
                                <div class="panel-footer">
                                </div>
                            </div>
                        </div>

						<div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel panel-heading">
                                    <center>Passwort</center>
                                </div>
                                <div class="panel panel-body">
									<?php if($_REQUEST['e']){ echo '<center><p class="alert alert-warning">'.str_replace("%20", " ", $_REQUEST['e']).'</p></center></br>'; } ?>
									
									<form action="<?php echo $website_url; ?>/api/system.php?changePassword" method="POST">
										<div class="form-group">
											<label class=""><p>Altes Passwort</p></label>
											<input type="password" class="form-control" id="inputOldPasswort" name="oldPass" value="" placeholder="Altes Passwort">
										</div>
										<div class="form-group">
											<label class=""><p>Neues Passwort</p></label>
											<input type="password" class="form-control" id="inputNewPass" name="newPass" value="" placeholder="Neues Passwort">
										</div>
										<div class="form-group">
											<label class=""><p>Wiederholung Passwort</p></label>
											<input type="password" class="form-control" id="inputNewPass2" name="newPass2" value="" placeholder="Neues Passwort">
										</div>
										<center><button type="submit" class="btn btn-warning">Passwort änderen</button></center>
									</form>	
									<div class="panel-footer"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="panel panel-primary">
                                <div class="panel panel-heading">
                                    <center>Urlaubsplan</center>
                                </div>				
                                <div class="panel panel-body">
                                    <div class="form-group">
										<?php if($omessage){ echo $omessage; } ?>
									
                                        <form>
											<input type="hidden" name="vacation"/>
											<div class="form-group">
												<label class=""><p>Von wann?</p></label>
												<input type="text" name="start" class="form-control" placeholder="Format: DD-MM-YYYY (Ex: 01-01-2000)">
											</div>
											<div class="form-group">
												<label class=""><p>Bis wann?</p></label>
												<input type="text" name="end" class="form-control" placeholder="Format: DD-MM-YYYY (Ex: 01-12-2099)">
											</div>
											<div class="form-group">
												<label class=""><p>Grund</p></label>
												<input type="text" class="form-control" name="reason" placeholder="Begründung">
											</div>
											<center><button type="submit" class="btn btn-warning">Beantragen</button> <button type="submit" disabled class="btn btn-info">In Bearbeitung</button></center>
										</form>
									</div>
                                <div class="panel-footer">
                                    <center>
                                       
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include '../includes/footer.php';
?>

