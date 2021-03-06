<?php
session_start();
include '../../includes/config.php';
include '../../includes/hasPerms.php';

if($rank == "Praktikant"){
	header("Location: https://bennys-ordenderkekse.de/account/aufträge/privat");
	exit;
}

	if(isset($_REQUEST['type'])){
		if(isset($_REQUEST['tasks'])){
			if(isset($_REQUEST['additional'])){
				if(isset($_REQUEST['description'])){
					if(isset($_REQUEST['besitzer'])){
						if(isset($_REQUEST['zeichen'])){
							if(isset($_REQUEST['div'])){
								$description = htmlentities($_REQUEST['description']);
								$zeichen = htmlentities($_REQUEST['zeichen']);
								$besitzer = htmlentities($_REQUEST['besitzer']);
								if($_REQUEST['type'] == ""){
									header("Location: ?error=type");
									die();
								}
								if($_REQUEST['tasks'] == ""){
									header("Location: ?error=tasks");
									die();
								}
								if($_REQUEST['additional'] == ""){
									header("Location: ?error=additional");
									die();
								}
								if($_REQUEST['description'] == ""){
									$description = htmlentities("Fehlt");
								}
								if($_REQUEST['besitzer'] == ""){
									$besitzer = htmlentities("XXX");
								}
								if($_REQUEST['zeichen'] == ""){
									$zeichen = htmlentities("MY-UL");
								}
								if($_REQUEST['div'] == "Unbezahlt"){
									$status = "Unbezahlt";
								} elseif($_REQUEST['div'] == "Bezahlt"){
									$status = "Bezahlt";
								} else {
									$status = "Bezahlt";
								}
								$salary = 0; // User Verdienst oder auch das Gemüse auch wens mit "ie" am ende geschrieben wird.
								$companyprofit = 0; // Firmen Profit
								
								$warenkorbID = hash("md5", time());
								$time = time();
								$type = htmlentities($_REQUEST['type']);
								$sql = "INSERT INTO baskets(id, token, fraktion, employee, status, timestamp)VALUES('', '$warenkorbID', '$type', '$username', '$status', '$time')";
								$result = $conn->query($sql);
								
								foreach($_REQUEST['tasks'] as $task){
									$obj = explode("-", $task);
									$item = htmlentities($obj[0]);
									
									$price = htmlentities($obj[1]);
									$share = htmlentities($obj[2]);
									
									$companyprofit = $companyprofit+$share;
									$salary = $salary+$price-$share;
									
									$sql = "INSERT INTO basket_entrys(id, token, item, price, share, timestamp)VALUES('', '$warenkorbID', '$item', '$price', '$share', '$time')";
									$result = $conn->query($sql);
								}
								
								$add = explode("-", $_REQUEST['additional']);
								$addprice = $add[1];
								$addshare = $add[2];
								
								$companyprofit = $companyprofit+$addshare;
								$salary = $salary+$addprice-$addshare;
								
								$companyprofit = $companyprofit+$addshare;
								
								$sql = "INSERT INTO basket_entrys(id, token, item, price, share, timestamp)VALUES('', '$warenkorbID', 'Anfahrtspauschale', '$addprice', '$addshare', '$time')";
								$result = $conn->query($sql);
								$sql = "INSERT INTO basket_kfz(id, token, besitzer, zeichen, timestamp)VALUES('', '$warenkorbID', '$besitzer', '$zeichen', '$time')";
								$result = $conn->query($sql);
								$sql = "UPDATE accounts SET balance = balance + '$salary' WHERE username = '$username'";
								$res = $conn->query($sql);
								$sql = "UPDATE accounts SET share = share + '$companyprofit' WHERE username = '$username'";
								$res = $conn->query($sql);
								
								header("Location: $website_url/account/aufträge/privat?token=$warenkorbID");
								die();
							}
						}
					}
				}
			}
		}
	
	}
	
include '../../includes/header.authed.php';


?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <!----- Formular für die Berechnung des Preises ------>
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Auftragsrechner Privat</div>
                    <div class="panel panel-body">
                        <form class="form-horizontal" method="POST" action="">
								  <fieldset>
									<legend>Auftragsrechner</legend>
									<div class="form-group">
									  <div class="col-lg-12">
									  <label for="select" class="control-label">Kunde</label>
										<select class="form-control" id="select" name="type" onChange="flareco();">
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == ""){ echo "selected"; }} else { echo "selected"; } ?> disabled>Bitte Typ auswählen!</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Privat"){ echo "selected"; }} ?> value="Privat">⮚ Privat</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Mitarbeiter"){ echo "selected"; }} ?> value="Mitarbeiter">⮚ Mitarbeiter</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Brotherhood"){ echo "selected"; }}?> value="Brotherhood">⮚ Brotherhood</option>	
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Dust MC"){ echo "selected"; }} ?> value="Dust MC">⮚ DUST MC</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Highway Express"){ echo "selected"; }}?> value="Highway Express">⮚ Highway Express</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Tom Bradley"){ echo "selected"; }}?> value="Tom Bradley">⮚ Tom Bradley</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Grove"){ echo "selected"; }}?> value="Grove">⮚ Grove</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Pipeline Automotives"){ echo "selected"; }} ?> value="Pipeline Automotives">⮚ Pipeline Automotives</option>
										</select>
									  </div>
									</div>
									<?php
									
									if(isset($_REQUEST['type'])){
										$types = array("Privat", "Mitarbeiter", "Brotherhood", "Grove", "Dust MC", "Tom Bradley", "Highway Express", "Pipeline Automotives");
										$type = htmlentities($_REQUEST['type']);
										if(in_array($type, $types)){
											
											
											$sql = "SELECT * FROM pricing WHERE type = '$type' Order By Id ASC";
											
											?>
									<div class="form-group">
										<div class="col-lg-12">
											<label for="select" class="control-label">Tätigkeiten (Multi Select)</label>
												<select multiple class="form-control myactivity" size="20" style="height: 75%;" name="tasks[]">
											<?php
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													
													
													$name = ucfirst($row['name']);
													$price = $row['price'];
													$share = $row['share'];
													$category = $row['isCategory'];
													
													if($category == "true"){
														$listname = "$name";
														$disabled = "disabled";
														$active = "";
													} else {
														$listname = "$name";
														$disabled = "enabled";
														$active = "⮚";
													}
													
													echo '<option '.$disabled.' value="'.$name.'-'.$price.'-'.$share.'">'.$active.' '.$listname.'</option>';

													
												}
											?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-6">
											<label for="select" class="control-label">Anzahl</label>
											<input type="text" name="anzahl" disabled placeholder="XX" class="form-control"/>
										</div>
										<div class="col-lg-6">
											<label for="select" class="control-label">Tätigkeiten</label>
											<input type="text" name="anzahl" disabled placeholder="XX" class="form-control"/>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-lg-12">
											<label for="select" class="control-label">Anfahrtspauschale / Werkstatt</label>
												<select class="form-control myactivity" name="additional">
													<option selected disabled value="Fehler-0-0">Bitte Auswählen</option>
													<option value="Werkstatt-0-0">Werkstatt</option>
													<option value="Anfahrtspauschale-0-0">⮚ 0$</option>
													<option value="Anfahrtspauschale-50-50">⮚ 50$</option>
													<option value="Anfahrtspauschale-100-100">⮚ 100$</option>
													<option value="Anfahrtspauschale-150-150">⮚ 150$</option>
												</select>
										</div>
									</div>	
									<div class="form-group">
										<div class="col-lg-12">
											<label for="select" class="control-label">Besitzer</label>
											<input type="text" name="besitzer" placeholder="Benny" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-12">
											<label for="select" class="control-label">KFZ-Zeichen</label>
											<input type="text" name="zeichen" placeholder="MY-UL" class="form-control"/>
										</div>
									</div>
									<input type="hidden" name="description" readonly value="NA DU SCHLINGEL!"/>
									<div class="form-group">
										<div class="col-lg-12">
											<label for="select" class="control-label">Rabatt-Preis     (*Kein Sonderzeichen)</label>
											<input type="text" name="sale" placeholder="1000" disabled class="form-control"/>
										</div>
									</div>
									<div class="form-group">
									  <div class="col-lg-12">
										<button type="reset" class="btn btn-default btnreset">Reset</button>
										<button type="submit" name="div" value="Bezahlt" class="btn btn-primary">Bezahlt</button>
										<button type="submit" name="div" value="Unbezahlt" class="btn btn-warning">Auf Rechnung</button>
									  </div>
									</div>
										<?php
											} else {
												echo '<center><p class="alert alert-danger">Datenbank Fehler bitte Kontaktiere Sie uns nicht, es interressiert uns nicht!</p></center>';
											}
											
										} else {
											echo '<center><p class="alert alert-danger">Ungültige Verbraucher Gruppe!</p></center>';
										}
									}
									
									?>
								  </fieldset>
								</form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Ansicht</div>
                    <div class="panel panel-body">
                        <table id="meta" class="table table-striped table-hover ">
                            <thead>
                                <tr class='info'>
                                    <th>Tätigkeiten</th>
                                    <th></th>
                                    <th>Gebühr</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <tr class='info'>
                                    <td><strong>Total</strong></td>
                                    <td></td>
                                    <td>0$</td>
                                    <td>0$</td>
                                </tr>
                            </tbody>
                        </table>
                        </br>
                        <p>
                            <h5>
									*Gebühr = Anteil an der Summe die zum Unternehmen gehen.</br>
									*Total = Endbetrag den der Kunde bezahlt.</h5></p>
                        <p>
                            <h5>
									*Werkstatt = Arbeiten in der Werkstatt</br>
									*Anfahrtspauschale 0$ = unter 1km</br>
									*Anfahrtspauschale 50$ = innerhalb der Stadt</br>
									*Anfahrtspauschale 100$ = bis Sandy Shores</br>
									*Anfahrtspauschale 150$ = bis Paleto Bay</br>
							</h5>
						</p>
                    </div>

                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>


<script type="text/javascript">


function flareco(){
	var type = document.getElementById("select").value;
	window.location.href = "<?php echo $website_url; ?>/account/rechner/privat?type=" + type;
}


$(document).ready(function() {        
	$(".btnreset").click(function(event) {
		document.getElementById("table").innerHTML = "";
		$("#table").append("<tr class='info'><td><strong>Total</strong></td><td></td><td>0$</td><td>0$</td></tr>");
	});
    $(".myactivity").click(function(event) {
        var total = 0;
		var sharetotal = 0;
		document.getElementById("table").innerHTML = "";
        $(".myactivity option:selected").each(function() {
			var obj = $(this).val();
			var parse = obj.split("-");
			var item = parse[0];
			var price = parse[1];
			var share = parse[2];
            total += parseInt(price);
			sharetotal += parseInt(share);
			$("#table").append("<tr><td>" + item + "</td><td></td><td>" + share + "$</td><td>" + price + "$</td></tr>");
        });
        $("#table").append("<tr class='info'><td><strong>Total</strong></td><td></td><td>" + sharetotal + "$</td><td>" + total + "$</td></tr>");
        if (total == 0) {
            $('#amount').val('0$');
        } else {                
            $('#amount').val(total + "$");
        }
    });
});  

$('option').mousedown(function(e) {
    e.preventDefault();
    $(this).prop('selected', !$(this).prop('selected'));
    return false;
});  
</script>
