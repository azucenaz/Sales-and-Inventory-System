<?php
session_start();

include '../connection.php';

if (isset($_POST['submit'])) 

{
	$checksupplier = $dbConn->query("SELECT * FROM suppliers where name  = '".$_POST['supplier_name']."'");
	if ($checksupplier->rowCount() == 1) 
	{
		$_SESSION['erroruser'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Suppluer Name Already Exist.
									</div>';
		header("location:../addsuppliers.php"); 
	}
	else
	{
		$insertacc = $dbConn->query("INSERT INTO suppliers(supplier_id,name,contact,address) VALUES ('".$_POST['supplier_id']."','".$_POST['supplier_name']."','".$_POST['contact']."','".$_POST['address']."') ");
		if ($insertacc) 
		{
			$_SESSION['usermsg'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Done Added Supplier. '.$_POST['supplier_id'].'  
									</div>';
			header("location:../supplier.php");
		}
		else
		{
			$_SESSION['erroruser'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Something Wrong Please Try Again
									</div>';
			header("location:../addsuppliers.php");
		}
	}

}



?>