<?php
session_start();
include 'connection.php';
if (isset($_POST['submit'])) 
{

	$getotal = $dbConn->query("SELECT sum(total) FROM sales where transaction_id = '".$_SESSION['trans_id']."' ");
	$distotal = $getotal->fetch(PDO::FETCH_ASSOC);
	 $change = $_POST['amount'] - $distotal['sum(total)'];
	// echo "<br>";
	// echo $_SESSION['trans_id'];
	// echo "<br>";
	// echo $_POST['amount'];
	// echo "<br>";
	 isset($_SESSION['customer_id']) ? $cus = $_SESSION['customer_id'] : $cus = 'Walk In';
	$dbConn->query("INSERT INTO transactions (transaction_id,customer_id,change1,total_paid,amount_tender,users,date_transaction) VALUES ('".$_SESSION['trans_id']."','".$cus."','".$change."','".$distotal['sum(total)']."','".$_POST['amount']."','".$_SESSION['fullname']."','".date('Y-m-d')."')");

	$getsales = $dbConn->query("SELECT * FROM sales where transaction_id = '".$_SESSION['trans_id']."'  ");
	while($row = $getsales->fetch(PDO::FETCH_ASSOC))
	{	
		$getpro = $dbConn->query("SELECT * FROM products where id = '".$row['stock_id']."' ");
		$dis = $getpro->fetch(PDO::FETCH_ASSOC);
		$newqty =  $dis['quantity'] - $row['quantity'];
		$dbConn->query("UPDATE products SET quantity = '".$newqty."' where id = '".$row['stock_id']."' ");
	}


	$trans = $_SESSION['trans_id'];

	 unset($_SESSION['trans_id']);

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>PRINT RECEIPT</title>
</head>
<body style="font-family:verdana;">
<h3>SALES MANAGEMENT SYSTEM</h3>
<table border="1" cellspacing="0" cellpadding="6">

		<thead>
			<th>ITEM/DESCRIPTION</th>
			<th>QUANTITY</th>
			<th>TOTAL</th>
		</thead>
		<tbody>
			<?php

			$display = $dbConn->query("SELECT * FROM sales where transaction_id = '".$trans."' ");
			while($getdisplay = $display->fetch(PDO::FETCH_ASSOC)) 
			{
			?>
			<tr>
				<td><?php echo $getdisplay['product_name'].' '.$getdisplay['price']; ?></td>
				<td><?php echo $getdisplay['quantity']; ?></td>
				<td><?php echo $getdisplay['total']; ?></td>
			
			</tr>

			<?php } ?>

		</tbody>
</table>
	<?php 

	$getnow = $dbConn->query("SELECT * FROM transactions where transaction_id = '".$trans."' ");
	$disnow = $getnow->fetch(PDO::FETCH_ASSOC);

	?>
<table>
	<tr>
		<td>Amount Tender: <?php echo number_format($disnow['amount_tender'],2)?></td>
		<td>Total Payment: <?php echo number_format($disnow['total_paid'],2)?></td>
	</tr>
	<tr>

		<td>Change: <?php echo number_format($disnow['change1'],2);?></td>
		<td>Cashier: <?php echo $disnow['users'];?></td>
	</tr>
</table>
</body>
</html>