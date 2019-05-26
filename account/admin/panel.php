<?php
session_start();
include '../../includes/config.php';
include '../../includes/hasPerms.php';

if($rank != "Admin"){
	header("Location: $website_url/account/profile");
	exit;
}

if(isset($_REQUEST['activate'])){
	$email = htmlspecialchars($_REQUEST['activate']);
	$sql = "UPDATE accounts SET status = 'Active' WHERE email = '$email' AND status = 'Pending'";
	$res = $conn->query($sql);
	$event_activate = '<center><p class="alert alert-success">Aktiviert</p></center>';
}

if(isset($_REQUEST['change'])){
	$change = htmlspecialchars($_REQUEST['change']);
	
	if($change == "login"){
		if($login_status == "enabled"){
			$sql = "UPDATE config SET login_status = 'disabled' WHERE id = '1'";
			$conn->query($sql);
			header("Location: ?changed");
			exit;
		} else {
			$sql = "UPDATE config SET login_status = 'enabled' WHERE id = '1'";
			$conn->query($sql);		
			header("Location: ?changed");
			exit;
		}
	}
	if($change == "maintenance"){
		if($maintenance_mode == "enabled"){
			$sql = "UPDATE config SET maintenance_mode = 'disabled' WHERE id = '1'";
			$conn->query($sql);
			header("Location: ?changed");
			exit;
		} else {
			$sql = "UPDATE config SET maintenance_mode = 'enabled' WHERE id = '1'";
			$conn->query($sql);		
			header("Location: ?changed");
			exit;
		}
	}
	if($change == "register"){
		if($register_status == "enabled"){
			$sql = "UPDATE config SET register_status = 'disabled' WHERE id = '1'";
			$conn->query($sql);
			header("Location: ?changed");
			exit;
		} else {
			$sql = "UPDATE config SET register_status = 'enabled' WHERE id = '1'";
			$conn->query($sql);	
			header("Location: ?changed");
			exit;
		}
	}
	if($change == "ordersystem"){
		$sql = "TRUNCATE TABLE baskets";
		$res = $conn->query($sql);
		
		$sql = "TRUNCATE TABLE basket_entrys";
		$res = $conn->query($sql);
		
		$sql = "TRUNCATE TABLE basket_kfz";
		$res = $conn->query($sql);
		header("Location: ?ordertruncated");
		exit;
	}
	if($change == "orderbooks"){
		$sql = "TRUNCATE TABLE baskets";
		$res = $conn->query($sql);
		
		$sql = "TRUNCATE TABLE basket_entrys";
		$res = $conn->query($sql);
		
		$sql = "TRUNCATE TABLE basket_kfz";
		$res = $conn->query($sql);
		header("Location: ?privattruncated");
		exit;
	}
	if($change == "staatorderbooks"){		
		$sql = "TRUNCATE TABLE staats";
		$res = $conn->query($sql);
		
		$sql = "TRUNCATE TABLE staats_entrys";
		$res = $conn->query($sql);
		
		$sql = "TRUNCATE TABLE staats_kfz";
		$res = $conn->query($sql);
		header("Location: ?staattruncated");
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
								<a href="#home" data-toggle="tab">Website Status</a>
							</li>
							<li>
								<a href="#farben" data-toggle="tab">Datenbanken</a>
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
												<center>Website Status</center>
											</div>
											<div class="panel panel-body">
												<div class="col-md-4">
													<div class="panel panel-primary">
														<div class="panel panel-heading">
															<center>Login Status</center>
														</div>
														<div class="panel panel-body">
															<div class="form-group">
																<center>
																	<p>Login:
																		<?php echo $login_status; ?>
																	</p>
																</center>
																<center><a class="btn btn-warning" href="?change=login">Change Login Status</a></center></br>
															</div>
														</div>
														<div class="panel-footer"></div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="panel panel-primary">
														<div class="panel panel-heading">
															<center>Wartungsarbeiten Login Status</center>
														</div>
														<div class="panel panel-body">
															<div class="form-group">
																<center>
																	<p>Wartungsarbeiten:
																		<?php echo $maintenance_mode; ?>
																	</p>
																</center>
																<center><a class="btn btn-warning" href="?change=maintenance">Change Wartungsarbeiten Status</a></center>
															</div>
														</div>
														<div class="panel-footer"></div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="panel panel-primary">
														<div class="panel panel-heading">
															<center>Register Status</center>
														</div>
														<div class="panel panel-body">
															<div class="form-group">
																<center>
																	<p>Register:
																		<?php echo $register_status; ?>
																	</p>
																</center>
																<center><a class="btn btn-warning" href="?change=register">Change Register Status</a></center>
															</div>
														</div>
														<div class="panel-footer"></div>
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
													<center>Datenbank</center>
												</div>
												<div class="panel panel-body">
													<div class="col-md-4">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Bestell-Bücher</center>
															</div>
															<div class="panel panel-body">
																<?php if($_REQUEST['w']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['o']).'</p></center>';} ?>
																<div class="form-group">
																	<center>
																		<p>!Achtung kann nicht rückganig gemacht werden!</p>
																	</center>
																	<form action="<?php echo $website_url; ?>/api/system">
																		<div class="form-group">
																			<label class=""><p></p></label>
																			<input type="hidden"  class="form-control" name="deleteOrder">
																			<input type="hidden"  class="form-control" name="type" value="order">
																		</div>
																		<div class="form-group">
																			<label class=""><p></p></label>
																			<input type="text" disabled class="form-control" id=""  name="token" placeholder="Bestell-Bücher-ID">
																		</div>
																			<center><button disabled class="btn btn-danger">Nur den Auftrag löschen</button></center>
																	</form>
																	</br>
																	<div class="panel panel-body">
																		<div class="form-group">
																			<center>
																				<p>!Achtung kann nicht rückganig gemacht werden!</p>
																			</center>
																				<center><a class="btn btn-danger" disabled href="?change=ordersystem">Alle Bestell-Bücher leeren.</a></center>
																				</div>
																	</div>
																</div>
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
													<div class="col-md-4">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Privat-Bücher</center>
															</div>
															<div class="panel panel-body">
																<?php if($_REQUEST['w']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['w']).'</p></center>';} ?>
																<div class="form-group">
																			<center>
																				<p>!Achtung kann nicht rückganig gemacht werden!</p>
																			</center>
																			<form action="<?php echo $website_url; ?>/api/system">
																				<div class="form-group">
																					<label class=""><p></p></label>
																					<input type="hidden"  class="form-control" name="deleteOrder">
																					<input type="hidden"  class="form-control" name="type" value="privat">
																				</div>
																				<div class="form-group">
																					<label class=""><p></p></label>
																					<input type="text"  class="form-control" id="" name="token" placeholder="Privat-Auftrags-ID">
																				</div>
																					<center><button class="btn btn-danger">Nur den Auftrag löschen</button></center>
																			</form>
																			</br>
																	<div class="panel panel-body">
																		<div class="form-group">
																			<center>
																				<p>!Achtung kann nicht rückganig gemacht werden!</p>
																			</center>
																		<center><a class="btn btn-danger" href="?change=orderbooks">Alle Privat Auftragsbücher leeren.</a></center>
																		</div>
																	</div>
																</div>
															</div>
															<div class="panel-footer"></div>
														</div>
													</div>
													<div class="col-md-4">
														<div class="panel panel-primary">
															<div class="panel panel-heading">
																<center>Staats-Bücher</center>
															</div>
															<div class="panel panel-body">
																<?php if($_REQUEST['q']){ echo '<center><p class="alert alert-warning">'.str_replace("_", " ", $_REQUEST['q']).'</p></center>';} ?>
																<div class="form-group">
																			<center>
																				<p>!Achtung kann nicht rückganig gemacht werden!</p>
																			</center>
																			<form action="<?php echo $website_url; ?>/api/system">
																				<div class="form-group">
																					<label class=""><p></p></label>
																					<input type="hidden"  class="form-control" name="deleteOrder">
																					<input type="hidden"  class="form-control" name="type" value="staat">
																				</div>
																				<div class="form-group">
																					<label class=""><p></p></label>
																					<input type="text"  class="form-control" id="" name="token" placeholder="Staats-Auftrags-ID">
																				</div>
																					<center><button class="btn btn-danger">Nur den Auftrag löschen</button></center>
																			</form>
																			</br>
																	<div class="panel panel-body">
																		<div class="form-group">
																			<center>
																				<p>!Achtung kann nicht rückganig gemacht werden!</p>
																			</center>
																			<center><a class="btn btn-danger" href="?change=staatorderbooks">Alle Staat Auftragsbücher leeren.</a></center>
																		</div>
																	</div>
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
																						<option value='Admin'>Admin</option>
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
													<!---------->
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
													<!-------->
													</div>
													<!--------->
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
