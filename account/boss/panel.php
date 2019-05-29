<?php
session_start();
include '../../includes/config.php';
include '../../includes/hasPerms.php';

if($rank == "Boss"){}elseif($rank == "Admin"){} else { header("Location: $website_url/account/profile"); exit;}

if(isset($_REQUEST['activate'])){
	$email = htmlspecialchars($_REQUEST['activate']);
	$sql = "UPDATE accounts SET status = 'Active' WHERE email = '$email' AND status = 'Pending'";
	$res = $conn->query($sql);
	$event_activate = '<center><p class="alert alert-success">Aktiviert</p></center>';
}
if(isset($_REQUEST['vacation'])){
	if(isset($_REQUEST['approve'])){
		
		$tokenID = htmlspecialchars($_REQUEST['approve']);
		$sql = "UPDATE vacation SET status = 'Approved' WHERE token = '$tokenID'";
		$res = $conn->query($sql);
		
		header("Location: ?o=Erfolgreich%20Angenommen&tok=$tokenID&ol=".$conn->error);
		exit;
		
	}
	if(isset($_REQUEST['deny'])){
		
		$tokenID = htmlspecialchars($_REQUEST['deny']);
		$sql = "UPDATE vacation SET status = 'Denied' WHERE token = '$tokenID'";
		$res = $conn->query($sql);
		
		header("Location: ?o=Erfolgreich%20Abgelehnt.&tok=$tokenID&ol=".$conn->error);
		exit;
	}
	if($change == "sperren"){
		if($sperrung_status == "enabled"){
			$sql = "UPDATE accounts SET status = 'Suspended' WHERE status = 'Active'";
			$res = $conn->query($sql);
			$sql = "UPDATE accounts SET status = 'Active' WHERE isAdmin = 'true'";
			$res = $conn->query($sql);
			$sql = "UPDATE accounts SET session_token = 'NONE' WHERE status = 'Suspended'";
			$res = $conn->query($sql);
			$sql = "UPDATE config SET sperrung_status = 'disabled' WHERE id = '1'";
			$res = $conn->query($sql);	
			header("Location: ?locked");
			exit;
		} else {
			$sql = "UPDATE accounts SET status = 'Active' WHERE status = 'Suspended'";
			$res = $conn->query($sql);
			$sql = "UPDATE config SET sperrung_status = 'enabled' WHERE id = '1'";
			$res = $conn->query($sql);
			header("Location: ?unlocked");
			exit;
		}	
	}
	
}

include '../../includes/header.authed.php';
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="panel panel-primary">
					<center>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#home" data-toggle="tab">Firmen Informationen</a>
							</li>
							<li>
								<a href="#farben" data-toggle="tab">Urlaubsanträge</a>
							</li>
							<li>
								<a href="#lack" data-toggle="tab">Aktiviere User Accounts</a>
							</li>
							<li>
								<a href="#member" data-toggle="tab">Mitarbeiter Beföderungen</a>
							</li>
							<li>
								<a href="#vertrag" data-toggle="tab">Aktuelle Vertragspartner</a>
							</li>
							<li>
								<a href="#vertragend" data-toggle="tab">Vertragspartner Hinzufügen & Löschen</a>
							</li>
						</ul>
					</center>
					
					<div class="tab-content tpl-tabs-cont">
						<div class="tab-pane fade active in" id="home">
							<div class="section">
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-primary">
											<div class="panel panel-heading">
												<center>Firmen Informationen</center>
											</div>
<?php if($_REQUEST['u']){ echo '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><center>Mitarbeiter-'.str_replace("_", " ", $_REQUEST['u']).'</div></p></center>';} ?>
<?php if($_REQUEST['z']){ echo '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button><center>Mitarbeiter-'.str_replace("_", " ", $_REQUEST['z']).'</div></p></center>'; } ?>
											<div class="panel panel-body">
												<div class="col-md-6">
													<div class="panel panel-primary">
														<div class="panel panel-heading">
															<center>Mitarbeiter Firmen & Verdienst</center>
														</div>
														<div class="panel panel-body">
															<?php echo $event_activate; ?>
																<div class="table-responsive">
																	<table id="activate" class="table table-responsive">
																		<thead>
																			<tr>
																				<th>Username</th>
																				<th>Firmen Gewinnen</th>
																				<th>Mitarbeiter Gewinnen</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php

																				$sql = "SELECT * FROM accounts WHERE status = 'Active' AND comment != 'Admin'";
																				$res = $conn->query($sql);
																				if ($res->num_rows > 0) {
																					while($row = $res->fetch_assoc()) {

																						$uname = $row['username'];
																						$share = $row['share'];
																						$balance = $row['balance'];

																						echo "<tr>";
																						echo "<td>$uname</td>";
																						echo "<td>$share $</td>";
																						echo "<td>$balance $</td>";
																						echo "</tr>";
																					}
																				} else {

																				}

																			?>
																		</tbody>
																	</table>
																</div>
														</div>
														<div class="panel-footer"></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="panel panel-primary">
														<div class="panel panel-heading">
															<center>Firmen Fahrzeuge</center>
														</div>
														<div class="panel panel-body">
															<?php echo $event_activate; ?>
															<div class="table-responsive">
																<table id="activate" class="table table-responsive">
																	<thead>
																			<tr>
																			<th>Fahrezeug Typ</th>
																			<th>KFZ Zeichen</th>
																			<th>Motortyp</th>
																		</tr>
																	</thead>
																	<tbody>
																			<?php

																				$sql = "SELECT * FROM vehicle";
																				$res = $conn->query($sql);
																				if ($res->num_rows > 0) {
																					while($row = $res->fetch_assoc()) {

																						$vtyp = $row['vehicletyp'];
																						$kfz = $row['kfz'];
																						$etyp = $row['enginetype'];

																						echo "<tr>";
																						echo "<td>$vtyp</td>";
																						echo "<td>$kfz</td>";
																						echo "<td>$etyp</td>";
																						echo "</tr>";
																					}
																				} else {

																				}

																			?>
																	</tbody>
																</table>
																</br><hr></hr>
																<div class="form-group">
																	<div class="col-lg-4">
																		<label for="select" class="control-label">*Fahrezeug Typ</label>
																		<input type="text" name="anzahl" disabled placeholder="Noch nicht verfügbar" class="form-control" />
																	</div>
																	<div class="col-lg-4">
																		<label for="select" class="control-label">Kennzeichen</label>
																		<input type="text" name="anzahl" disabled placeholder="Noch nicht verfügbar" class="form-control"/>
																	</div>
																	<div class="form-group">
																		<label for="select" class="col-lg-2 control-label">Motortyp</label>
																		<div class="col-lg-4">
																			<select class="form-control" disabled id="select">
																				<option>Benzin</option>
																				<option>Diesel</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="panel-footer">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tab-pane fade" id="farben">
							<div class="section">
								<div class="row">
									<section class="page-section" id="farben">
										<div class="col-md-12">
											<div class="panel panel-primary">
												<div class="panel panel-heading">
													<center>Urlaub</center>
												</div>
												<div class="panel panel-body">
													<div class="col-md-1"> </div>
														<div class="col-md-10">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Urlaub Anträge</center>
															</div>
															<div class="panel panel-body">
																<?php echo $event_activate; ?>
																<div class="table-responsive">
																	<table id="activate" class="table table-responsive">
																		<thead>
																			<tr>
																				<th>Username</th>
																				<th>Grund</th>
																				<th>Von</th>
																				<th>Bis</th>
																				<th>Status</th>
																				<th>Optionen</th>					
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																				 
																				$sql = "SELECT * FROM vacation WHERE  status = 'onHold'";
																				$res = $conn->query($sql);
																				if ($res->num_rows > 0) {
																					while($row = $res->fetch_assoc()) {

																						$user = $row['user'];
																						$reason = $row['reason'];
																						$vacstart = $row['vacstart'];
																						$vacend = $row['vacend'];
																						$status = $row['status'];
																						$tokenID = $row['token'];
																							
																						$timestart = date("d/m/Y", $vacstart);
																						$timeend = date("d/m/Y", $vacend);

																						echo "<tr>";
																						echo "<td>$user</td>";
																						echo "<td>$reason</td>";
																						echo "<td>$timestart</td>";
																						echo "<td>$timeend</td>";
																						echo "<td>$status</td>";
																						echo "<td><a href='?vacation&approve=$tokenID' class='btn btn-success'>Annehmen</a></td> <td><a href='?vacation&deny=$tokenID' class='btn btn-warning'>Ablehnen</a></td>";
																						echo "</tr>";
																					}
																				} else {
																					echo "<tr>";
																					echo "<td>-/-</td>";
																					echo "<td>-/-</td>";
																					echo "<td>-/-</td>";
																					echo "<td>-/-</td>";
																					echo "<td>-/-</td>";
																					echo "<td><a href='#' class='btn btn-success'>Annehmen</a></td> <td><a href='#' class='btn btn-warning'>Ablehnen</a></td>";
																					echo "</tr>";
																				}

																			?>
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
													<div class="col-md-1"></div>
												</div>
											</div>
										</div>		
									</section>	
								</div>
							</div>
						</div>
						
						
						<div class="tab-pane fade" id="lack">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="lack">
										<div class="col-md-12">
											<div class="panel panel-primary">
												<div class="panel panel-heading">
													<center>Aktiviere User Accounts</center>
												</div>
												<div class="panel panel-body">
													<div class="col-md-1"> </div>
													<div class="col-md-5">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Register Status</center>
															</div>
															<div class="panel panel-body">
																<?php echo $event_activate; ?>
																<div class="table-responsive">
																	<table id="activate" class="table table-responsive">
																		<thead>
																			<tr>
																				<th>Username</th>
																				<th>Email</th>
																				<th>Optionen</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php

																				$sql = "SELECT * FROM accounts WHERE status = 'Pending'";
																				$res = $conn->query($sql);
																				if ($res->num_rows > 0) {
																					while($row = $res->fetch_assoc()) {

																						$uname = $row['username'];
																						$uemail = $row['email'];
																						$uid = $row['id'];

																						echo "<tr>";
																						echo "<td>$uname</td>";
																						echo "<td>$uemail</td>";
																						echo "<td><a href='?activate=$uemail&uid=$uid' class='btn btn-success'>Aktivieren</a></td>";
																						echo "</tr>";
																					}
																				} else {

																				}

																			?>
																		</tbody>
																	</table>
																</div>	
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
													<div class="col-md-5">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Login Status</center>
															</div>
															<div class="panel panel-body">
																<?php if($_REQUEST['u']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['u']).'</p></center>';} ?>
																<div class="table-responsive">
																	<table id="activate" class="table table-responsive">
																		<thead>
																			<tr>
																				<th>Username</th>
																				<th>Status</th>
																				<th>Optionen</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php

																				$sql = "SELECT * FROM accounts WHERE status != 'Pending' AND isAdmin = 'false'";
																				$res = $conn->query($sql);
																				if ($res->num_rows > 0) {
																					while($row = $res->fetch_assoc()) {

																						$uname = $row['username'];
																						$uid = $row['id'];
																						
																						$state = $row['status'];
																						if($state == "Active"){
																							$stateme = "danger";
																							$youhavehax = "Sperren";
																							$pornhub = "<label class='label label-success' style='display: inline;'>Aktiv</label>";
																						} else {
																							$stateme = "success";
																							$youhavehax = "Aktivieren";
																							$pornhub = "<label class='label label-danger' style='display: inline;'>GESPERRT</label>";
																						}

																						echo "<tr>";
																						echo "<td>$uname</td>";
																						echo "<td>$pornhub</td>";
																						echo "<td><a href='$website_url/api/system?userState=NULL&isMode=admin&userID=".$uname."' class='btn btn-".$stateme."'>".$youhavehax."</a></td>";
																						echo "</tr>";
																					}
																				} else {

																				}

																			?>
																		</tbody>
																	</table>
																</div>	
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
						
						<div class="tab-pane fade" id="member">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="lack">
										<div class="col-md-12">
											<div class="panel panel-primary">
												<div class="panel panel-heading">
													<center>Beföderungen</center>
												</div>
												<div class="panel panel-body">
													<div class="col-md-1"> </div>
													<div class="col-md-10">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Mitarbeiter Beföderungen</center>
															</div>
															<div class="panel panel-body">
															<?php if($_REQUEST['z']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['z']).'</p></center></br>'; } ?>
																<div class="table-responsive">
																	<table id="activate" class="table table-responsive">
																		<thead>
																			<tr>
																				<th>Username</th>
																				<th>Rang</th>
																				<th>Beföderung</th>
																				<th>Optionen</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php

																				$sql = "SELECT * FROM accounts";
																				$res = $conn->query($sql);
																				if ($res->num_rows > 0) {
																					while($row = $res->fetch_assoc()) {

																						

																						echo "<form action='".$website_url."/api/system'><tr><input type='hidden' name='userID' value='".$row['username']."'/>";
																						echo "<td>".$row['username']."</td>";
																						echo "<td>".$row['comment']."</td>";
																						echo "<td><select class='form-control' name='newRank'>
																						<option disable value=''>Bitte auswählen</option>
																						<option value='Boss'>Boss</option>
																						<option value='Investor'>Investor/in</option>
																						<option value='Ausbilder'>Ausbilder</option>
																						<option value='Meister'>Meister</option>
																						<option value='Mechaniker'>Mechaniker</option>
																						<option value='Azubi'>Azubi</option>
																						<option value='Praktikant'>Praktikant</option>
																						</select></td>";
																						echo "<td><input type='submit' name='changeRank' class='btn btn-info' value='Rang Speichern'/></td>";
																						echo "</tr></form>";
																					}
																				} else {

																				}

																			?>
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
						
						<div class="tab-pane fade" id="vertrag">
							<div class="section">
								<div class="row">
									<section class="page-section" id="vertrag">
										<div class="col-md-12">
											<div class="panel panel-primary">
												<div class="panel panel-heading">
													<center>Vertragspartner</center>
												</div>
												<div class="panel panel-body">
													<div class="col-md-12">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Aktuelle Vertragspartner</center>
															</div>
															<div class="panel panel-body">
																<?php if($_REQUEST['w']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['w']).'</p></center>';} ?>
																
																<center><h4>Rabatte Bro's :</h4></center>
																<li>
																	Brotherhood
																</li>
																<li>
																	DUST MC
																</li>
																<li>
																	Highway Express
																</li>
																<li>
																	Tom Bradley
																</li>
																
																<center><h4>Rabatte - 10% :</h4></center>
																<li>
																	Grove Street
																</li>
																<li>
																	Ballas
																</li>
																<li>
																	Pipeline Automotives
																</li>
																
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
												</div>
											</div>
										</div>		
									</section>	
								</div>
							</div>
						</div>
						
						<div class="tab-pane fade" id="vertragend">
							<div class="section">
								<div class="row">
									<section class="page-section" id="vertragend">
										<div class="col-md-12">
											<div class="panel panel-primary">
												<div class="panel panel-heading">
													<center>Vertragspartner</center>
												</div>
												<div class="panel panel-body">
													<div class="col-md-6">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Vertragspartner Hinzufügen</center>
															</div>
															<div class="panel panel-body">
																<?php if($_REQUEST['w']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['w']).'</p></center>';} ?>
																
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Vertragspartner Löschen</center>
															</div>
															<div class="panel panel-body">
																<?php if($_REQUEST['w']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['w']).'</p></center>';} ?>
																
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
												</div>
											</div>
										</div>		
									</section>	
								</div>
							</div>
						</div>
					
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
