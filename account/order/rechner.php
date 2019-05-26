<?php
session_start();
include '../../includes/config.php';
include '../../includes/hasPerms.php';

if($rank == "Prakitikant"){
	header("Location: https://bennys-ordenderkekse.de/account/dashboard");
	exit;
}

	if(isset($_REQUEST['type'])){
		if(isset($_REQUEST['tasks'])){
			if(isset($_REQUEST['additional'])){
				if(isset($_REQUEST['description'])){
					if(isset($_REQUEST['besitzer'])){
						if(isset($_REQUEST['zeichen'])){
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
							
							$companyloss = 0; // Firmen Verlust
							
							$warenkorbID = hash("md5", time());
							$time = time();
							$type = htmlentities($_REQUEST['type']);
							$sql = "INSERT INTO order(id, token, fraktion, employee, timestamp)VALUES('', '$warenkorbID', '$type', '$username', '$time')";
							$result = $conn->query($sql);
							
							foreach($_REQUEST['tasks'] as $task){
								$obj = explode("-", $task);
								$item = htmlentities($obj[0]);
								
								$price = htmlentities($obj[1]);
								
								$companyloss = $companyloss+$share;
								$salary = $salary+$price-$share;
								
								$sql = "INSERT INTO order_entrys(id, token, item, price, timestamp)VALUES('', '$warenkorbID', '$item', '$price', '$time')";
								$result = $conn->query($sql);
							}
							
							$add = explode("-", $_REQUEST['additional']);
							$addprice = $add[1];
							$addshare = $add[2];
							
							$companyloss = $companyloss+$addshare;
							$salary = $salary+$addprice-$addshare;
							
							$companyloss = $companyloss+$addshare;
							
							$sql = "INSERT INTO order_entrys(id, token, item, price, share, timestamp)VALUES('', '$warenkorbID', 'Anfahrtspauschale', '$addprice', '$addshare', '$time')";
							$result = $conn->query($sql);
							
							header("Location: $website_url/account/aufträge/order?token=$warenkorbID");
							die();
						}
					}
				}
			}
		}
	
	}
if($rank == "Boss"){}elseif($rank == "Admin"){} else { header("Location: $website_url/account/dashboard"); exit;}
include '../../includes/header.authed.php';

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <!----- Formular für die Berechnung des Preises ------>
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Firmen Bestellung</div>
                    <div class="panel panel-body">
                        <form class="form-horizontal" method="POST" action="">
								  <fieldset>
									<legend>Bestell Rechnung</legend>
									<div class="form-group">
									  <div class="col-lg-12">
									  <label for="select" class="control-label">Spedition</label>
										<select class="form-control" id="select" name="type" onChange="flareco();"> <!-- Bei welcher Spedi wurde bestelllt -->
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Ungültige"){ echo "selected"; }} else { echo "selected"; } ?> disabled>Bitte Spedition auswählen!</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == "Highway Express"){ echo "selected"; }}?> disabled value="Spedi">⮚ Highway Express</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == ""){ echo "selected"; }}?>  value="Spedi">⮚ ??</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == ""){ echo "selected"; }}?> disabled value="Spedi">⮚ ??</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == ""){ echo "selected"; }} ?> disabled  value="Spedi">⮚ ??</option>
										  <option <?php if(isset($_REQUEST['type'])){if($_REQUEST['type'] == ""){ echo "selected"; }} ?> disabled value="Spedi">⮚ ??</option>
										</select>
									  </div>
									</div>
									<div class="alert alert-dismissible alert-danger">
										<strong>Leider ist das</strong> <a href="#" class="alert-link">Bestell System</a> nicht verfügbar.
									</div>
									<?php
									
									if(isset($_REQUEST['type'])){
										$types = array("Spedi");
										$type = htmlentities($_REQUEST['type']);
										if(in_array($type, $types)){
											
											
											$sql = "SELECT * FROM order_pricing WHERE type = '$type' Order By Id ASC";
											
											?>
									<div class="form-group">
										<div class="col-lg-12">
											<label for="select" class="control-label">Material (Multi Select)</label>
												<select multiple class="form-control myactivity" size="20" style="height: 55%;" name="tasks[]">
											<?php
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													
													
													$name = ucfirst($row['name']);
													$price = $row['price'];
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
													
													echo '<option '.$disabled.' value="'.$name.'-'.$price.'">'.$active.' '.$listname.'</option>';

													
												}
											?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-6">
											<label for="select" class="control-label">Anzahl</label>
											<input type="text" name="anzahl" placeholder="XX" class="form-control"/>
										</div>
										<div class="col-lg-6">
											<label for="select" class="control-label">Material</label>
											 <div class="form-group">
											  <div class="col-lg-12">
												<select class="form-control" id="select">
												  <option>1</option>
												  <option>2</option>
												  <option>3</option>
												  <option>4</option>
												  <option>5</option>
												</select>
											  </div>
											</div>
										</div>
									</div>
									<div class="form-group">
									  <div class="col-lg-12">
										<button type="reset" class="btn btn-default btnreset">Reset</button>
										<button type="submit" disabled class="btn btn-primary">Speichern</button>
									  </div>
									</div>
										<?php
											} else {
												echo '<center><p class="alert alert-danger">Datenbank Fehler bitte Kontaktiere Sie uns, es interressiert uns!</p></center>';
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
                                    <th>Bestellung</th>
                                    <th></th>
                                    <th>Anzahl</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <tr class='info'>
                                    <td><strong>Total</strong></td>
                                    <td></td>
                                    <td>0</td>
                                    <td>0$</td>
                                </tr>
                            </tbody>
                        </table>
                        </br>
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
	window.location.href = "<?php echo $website_url; ?>/account/order/rechner?type=" + type;
}


$(document).ready(function() {        
	$(".btnreset").click(function(event) {
		document.getElementById("table").innerHTML = "";
		$("#table").append("<tr class='info'><td><strong>Total</strong></td><td></td><td>0</td><td>0$</td></tr>");
	});
    $(".myactivity").click(function(event) {
        var anzahl = 0;
        var total = 0;

		document.getElementById("table").innerHTML = "";
        $(".myactivity option:selected").each(function() {
			var obj = $(this).val();
			var parse = obj.split("-");
			var item = parse[0];
			var price = parse[1];
			$("#table").append("<tr><td>" + item + "</td><td></td><td>" + price + "$</td></tr>");
        });
        $("#table").append("<tr class='info'><td><strong>Total</strong></td><td></td><td>" + total + "$</td><td>" + total + "$</td></tr>");
        if (total == 0) {
            $('#amount').val('0$');
        }
    });
});  

$('option').mousedown(function(e) {
    e.preventDefault();
    $(this).prop('selected', !$(this).prop('selected'));
    return false;
});  
</script>
