<?php
session_start();

include '../connection.php';

if (isset($_POST['submit'])) 

{
	$checkcategory = $dbConn->query("SELECT * FROM products where category_name  = '".$_POST['category_name']."' AND product_name = '".$_POST['product_name']."' ");
	if ($checkcategory->rowCount() > 1) 
	{
		$_SESSION['message'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Product Name Already Exist.
									</div>';
		header("location:../products.php"); 
	}
	else
	{
		$insertacc = $dbConn->query("INSERT INTO products(category_name,product_name,retail_price,wholesale_price,unit) VALUES ('".$_POST['category_name']."','".$_POST['product_name']."','".$_POST['retail_price']."','".$_POST['wholesale_price']."','".$_POST['unit']."') ");
		if ($insertacc) 
		{
			$_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Done Added Product Name. '.$_POST['product_name'].'  
									</div>';
			header("location:../products.php");
		}
		else
		{
			$_SESSION['message'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Something Wrong Please Try Again
									</div>';
			header("location:../products.php");
		}
	}

}



?>