<?php

session_start();
include 'connection.php';

if (isset($_POST['submit'])) 
{

	$getstocks = $dbConn->query("SELECT * FROM products where id = '".$_POST['stock_id']."' ");
	
	$distocks = $getstocks->fetch(PDO::FETCH_ASSOC);

	$checkcart = $dbConn->query("SELECT * FROM sales where stock_id = '".$_POST['stock_id']."' AND transaction_id = '".$_SESSION['trans_id']."' ");
	
	$discart = $checkcart->fetch(PDO::FETCH_ASSOC);

	if ($checkcart->rowCount() == 1) 
	{

		$newcart = $discart['quantity'] + $_POST['quantity'];

		if ($distocks['quantity'] >= $newcart) 
		{
			# code...
		

			if ($newcart >= 5) 
			{

				echo $newprice = $newcart * $distocks['wholesale_price'];
				 $updatecart = $dbConn->query("UPDATE sales SET quantity = '".$newcart."',price= '".$distocks['wholesale_price']."',total = '".$newprice."' where stock_id = '".$_POST['stock_id']."' AND transaction_id = '".$_SESSION['trans_id']."'  ");
				 header("location:sales.php?p=sales");
			}
			else
			{
				 echo $newprice = $newcart * $distocks['retail_price'];
				$updatecart = $dbConn->query("UPDATE sales SET quantity = '".$newcart."',price= '".$distocks['retail_price']."' where stock_id = '".$_POST['stock_id']."' AND transaction_id = '".$_SESSION['trans_id']."' ");
				header("location:sales.php?p=sales");
			}
		}
		else
		{
			$_SESSION['usermsg'] = '<div class="alert alert-error">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Error!</strong> Limit '.$distocks['quantity'].'
									</div>';
			header("location:sales.php?p=sales");
		}	
	}
	else
	{
		if ($_POST['quantity'] >= 5) 
		{

			$newprice = $_POST['quantity'] * $distocks['wholesale_price'];
			$insertcart = $dbConn->query("INSERT INTO sales (transaction_id,quantity,stock_id,price,total,product_name,unit) VALUES('".$_SESSION['trans_id']."','".$_POST['quantity']."','".$_POST['stock_id']."','".$distocks['wholesale_price']."','".$newprice."','".$distocks['product_name']."','".$distocks['unit']."')");
			header("location:sales.php?p=sales");
		}
		else
		{
			echo $newprice = $_POST['quantity'] * $distocks['retail_price'];
			$insertcart = $dbConn->query("INSERT INTO sales (transaction_id,quantity,stock_id,price,total,product_name,unit) VALUES('".$_SESSION['trans_id']."','".$_POST['quantity']."','".$_POST['stock_id']."','".$distocks['retail_price']."','".$newprice."','".$distocks['product_name']."','".$distocks['unit']."')");
			header("location:sales.php?p=sales");
		}
	}

}


// $insertcart = $dbConn->query("INSERT INTO sales (transaction_id,quantity,stock_id,customer_id) VALUES ('".$_SESSION['trans_id']."','".$_POST['quantity']."','".$_POST['stock_id']."','') ");

// header("location:sales.php");

?>