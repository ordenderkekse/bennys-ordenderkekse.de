<?php

$profit = "0";

// Total Orders
$result = $conn->query("SELECT count(*) FROM baskets");
$row = mysqli_fetch_row($result);
$total_orders_private = $row[0];
$result = $conn->query("SELECT count(*) FROM staats");
$row = mysqli_fetch_row($result);
$total_orders_staat = $row[0];

// Profit
$result = $conn->query("SELECT share FROM accounts");
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$profit = $profit+$row['share'];
	}
} else {
	$profit = "0";
}
?>