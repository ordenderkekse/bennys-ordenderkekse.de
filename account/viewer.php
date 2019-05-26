<?php
session_start();
include '../includes/config.php';
include '../includes/hasPerms.php';


$price = 0;
$share = 0;

if(isset($_REQUEST['token'])){
	if(isset($_REQUEST['type'])){
		$orderID = htmlentities($_REQUEST['token']);
		$type = htmlentities(strtolower($_REQUEST['type']));
		if($type == strtolower("Staat")){
			$sql = "SELECT * FROM staats_entrys WHERE token = '$orderID'";
		} elseif($type == strtolower("Privat")){
			$sql = "SELECT * FROM basket_entrys WHERE token = '$orderID'";
		} else {
			die("Error: Invalid Type (Staat/Privat)");
		}
	} else {
		die("Error: Missing Type (Staat/Privat)");
	}
} else {
	die("Error: Missing Token");
}

?>
<head>
	<title>Auftragsarbeiten - <?php echo $orderID; ?></title>
	<link rel="stylesheet" href="https://bootswatch.com/3/cosmo/bootstrap.css"/>
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">Auftragsarbeiten Übersicht</div>
					<div class="panel panel-body">
						<table id="tasks" class="table table-responsive">
							<thead>
								<tr class="table-warning">
									<th>Item</th>
									<th>Gebühr</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										echo "<tr>\n";
										echo "<td>".$row['item']."</td>\n";
										echo "<td>".$row['share']."$</td>\n";
										echo "<td>".$row['price']."$</td>\n";
										echo "</tr>\n";
										$price = $price + $row['price'];
										$share = $share + $row['share'];
									}
									echo "<tr>\n";
									echo "<td><strong>Total</strong></td>";
									echo "<td><strong>$share$</strong></td>";
									echo "<td><strong>$price$</strong></td>";
									echo "</tr>\n";
								} else {
									echo "<tr>";
									echo "<td><strong>Total</strong></td>";
									echo "<td><strong>0$</strong></td>";
									echo "<td><strong>0$</strong></td>";
									echo "</tr>";
								}
								
								?>
							</tbody>
						</table>
					</div>
					<div class="panel panel-footer">OrderID: <?php echo $orderID; ?></div>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
$(document).ready( function () {
    $('#tasks').DataTable();
} );
</script>