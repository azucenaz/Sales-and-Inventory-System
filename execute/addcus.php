<?php
session_start();
include '../connection.php';

if (isset($_POST['submit'])) 
{
	$checkcustomer = $dbConn->query("SELECT * FROM customers where firstname  = '".$_POST['firstname']."' and lastname = '".$_POST['lastname']."' ");
	if ($checkcustomer->rowCount() == 1) 
	{
		$_SESSION['errorcustomer'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Customer Already Exist.
									</div>';
		header("location:../addcustomer.php"); 
	}
	else
	{
		$insertacc = $dbConn->query("INSERT INTO customers(firstname,lastname,contact_no,address,email) VALUES ('".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['contact_no']."','".$_POST['address']."','".$_POST['email']."') ");
		if ($insertacc) 
		{
			$_SESSION['errorcustomer'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Done Registered. '.$_POST['firstname'].' '.$_POST['lastname'].'
									</div>';
			header("location:../addcustomer.php");
		}
		else
		{
			$_SESSION['errorcustomer'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Something Wrong Please Try Again
									</div>';
			header("location:../addcustomer.php");
		}
	}
}

?>