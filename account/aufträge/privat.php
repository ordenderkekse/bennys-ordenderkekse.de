<?php
session_start();
include '../../includes/config.php';
include '../../includes/hasPerms.php';


if(isset($_REQUEST['affID'])){
	if(isset($_REQUEST['update'])){
		if(isset($_REQUEST['typus'])){
			if($_REQUEST['update'] == "bezahlt"){
				if($_REQUEST['typus'] == "private"){
					
					$ordertoken = htmlspecialchars($_REQUEST['affID']);
					
					$sql = "UPDATE baskets SET status = 'Bezahlt' WHERE token = '$ordertoken'";
					$res = $conn->query($sql);
					header("Location: ?ok");
					die();
				}
			}
		}
	}
}






include '../../includes/header.authed.php';



?>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-warning">
                    <div class="panel panel-heading">Alle Aufträge</div>
                    <div class="panel panel-body">
                        <table id="tasks" class="table-responsive">
                            <thead>
								<th>#</th>
                                <th>Datum</th>
                                <th>AuftragsID</th>
                                <th>Besitzer</th>
                                <th>Kennzeichen</th>
                                <th>Mitarbeiter</th>
                                <th>Optionen</th>
                            </thead>
                            <tbody>
                                <?php
										$counter = 1;
										$sql = "SELECT * FROM baskets Order By Id DESC";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
													$orderID = $row['token'];
													$dateoforder = date("d/m/Y G:i ", $row['timestamp']);
													$mitarbeiter = $row['employee'];
													$statuspayment = $row['status'];
													$resq = "SELECT * FROM basket_kfz WHERE token = '$orderID' LIMIT 1";
													$res = $conn->query($resq);
													$flareisbest = substr($row['token'], 0, 10);
													if ($res->num_rows > 0) {
														while($flocke = $res->fetch_assoc()) {
															$kennzeichen = $flocke['zeichen'];
															$besitzer = $flocke['besitzer'];
														}
													} else {
														$kennzeichen = "MY-UL";
														$besitzer = "XXX";
													}
													echo "<tr>\n";
													echo "<td>$counter</td>";
													echo "<td>$dateoforder</td>\n";
													echo "<td>$flareisbest</td>\n";
													echo "<td>$besitzer</td>\n";
													echo "<td>$kennzeichen</td>\n";
													echo "<td>$mitarbeiter</td>\n";
													$counter++;
													?>
												<td>
													<a class="btn btn-success btn-xs" onClick="catchme('<?php echo $orderID; ?>')" href="#">Anschauen</a> 
													<?php
													if($statuspayment == "Unbezahlt"){ ?>
													<a class="btn btn-danger btn-xs" href="?affID=<?php echo $orderID; ?>&update=bezahlt&typus=private">Bezahlen</a>
													<?php } else { ?>
													<a class="btn btn-success btn-xs" disabled href="#">Bezahlt</a>
													<?php } ?>
												</td>
                                    <?php
													echo "</tr>\n";
											}  
										} else { ?>
                                        <tr>
											<td>1</td>
                                            <td>00/00/0000</td>
                                            <td>Keine Aufträge vorhanden</td>
                                            <td>XXX</td>
                                            <td>XXX</td>
                                            <td>BENNYXXX</td>
                                            <td>XXX</td>
                                            <td><a class="btn btn-success" disabled onClick="catchme('XXXXXXXXXXX')" href="#">Anschauen</a> <a disabled class="btn btn-success" href="">Bearbeiten</a></td>
                                        </tr>
                                        <?php }

									?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title">Rechnungen-erstellen</h3>
                            <center>
                    </div>
                    <div class="panel-body">
                        <p>Passen Sie die nachfolgenden Felder in der exemplarischen Rechnung an, </p>
                        <p>klicken Sie den Button "PDF-Rechnung jetzt downloaden" und schon ist Ihre Rechnung fertig. </p>
                        <p>Weiter unten finden Sie noch mehr Informationen zum Thema Rechnung schreiben.</p>
                        <center><a href="https://rechnungen-muster.de/rechnung-schreiben">Rechnungen</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function catchme(token) {
        var windowcase = window.open("<?php echo $website_url; ?>/account/viewer?token=" + token + "&type=Privat", "", "width=500,height=500");
    }

    $(document).ready(function() {
        $('#tasks').DataTable();
    });
</script>