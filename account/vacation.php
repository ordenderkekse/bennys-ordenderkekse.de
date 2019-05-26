<?php
session_start();
include '../includes/config.php';
include '../includes/hasPerms.php';

if(isset($_REQUEST[''])){
	
}


include '../includes/header.authed.php';

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">
                        <center>Urlaub</center>
                    </div>
					<div class="panel panel-body">
					<?php
					
						$sql = "SELECT * FROM vacation Order By status != 'Ended'";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								
								$startvac = $row['vacstart'];
								$vacend = $row['vacend'];
								$userx = $row['user'];
								$status = $row['status'];
								
								$x = date("d/m/Y", $startvac); // Urlaub Start als Datum
								$y = date("d/m/Y", $vacend); // Urlaub Ende als Datum
								$z = date("d/m/Y", time()); // Aktuelle Zeit als Datum
								
								$cho = $startvac/3600/24;
								$dho = $vacend/3600/24;
								$urlaub = $dho-$cho;
								
								$td = $y-$x; // Totale Urlaubszeit in Tagen // W
								$og = $x-$y;
								$tz = $y-$z; // Übrige Urlaubszeit in Tagen // G
								
								$percent = 100/$td; // 14,20
								$percent2 = $percent*$tz; // 100
								$percent3 = 100-$percent2;
								
								if($status == "Approved"){
									$statuslabel = "success";
									$status = "Apprv.";
								} elseif($status == "Denied"){
									$statuslabel = "danger";
									$percent3 = "100";
									$td = "0";
								} elseif($status == "onHold") {
									$statuslabel = "info";
									$td = "0";
									$percent3 = "100";
								} else {
									$statuslabel = "info";
									$td = "0";
									$percent3 = "100";
								}
							

								echo '<div class="col-md-4">';
								echo '	<div class="panel panel-primary">';
								echo '		<div class="panel panel-body">';
								echo '			<div class="row">';
								echo '				<div class="col-md-9">';
								echo '					<p>Mitarbeiter: '.$userx.'</br>';
								echo '					Start: '.$x.'</br>';
								echo '					Ende: '.$y.'</p>';
								echo '				</div>';
								echo '				<div class="col-md-1">';
								echo '					<center><h2><label class="label label-'.$statuslabel.'">'.$status.'</label></h2></center>';
								echo '				</div>';
								echo '			</div>';
								echo '		</div>';
								echo '		<div class="panel-footer">';
								echo '			<p>Verbleibende Urlaubszeit: <!---'.$td.' / '.$og.' /---> '.$urlaub.' Tage</p>';
								echo '			<!---<div class="progress progress-striped active">';
								echo '				<div class="progress-bar progress-bar-'.$statuslabel.'" style="width: '.$percent3.'%"></div>';
								echo '			</div>---->';
								echo '		</div>';
								echo '	</div>';
								echo '</div>';
								
								
							}
						} else {
							
						}
						
						
					
					?>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel panel-body">
									<div class="row">
										<div class="col-md-9">
											<p>Mitarbeiter: -/-</br>
											Start: -/-</br>
											Ende: -/-</p>
										</div>
										<div class="col-md-1">
											<center><h2><label class="label label-danger">-/-</label></h2></center>
										</div>
									</div>
                                </div>
                                <div class="panel-footer">
									<p>Verbleibende Urlaubszeit: -/- Tage</p>
									<div class="progress progress-striped active">
										<div class="progress-bar" style="width: 0%"></div>
									</div>
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