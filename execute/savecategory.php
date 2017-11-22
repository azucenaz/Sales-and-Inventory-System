<?php
session_start();

include '../connection.php';

if (isset($_POST['submit'])) 

{
	$checkcategory = $dbConn->query("SELECT * FROM category where category_name  = '".$_POST['category_name']."'");
	if ($checkcategory->rowCount() == 1) 
	{
		$_SESSION['usermsg'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> category Name Already Exist.
									</div>';
		header("location:../products.php"); 
	}
	else
	{
		$insertacc = $dbConn->query("INSERT INTO category(category_name) VALUES ('".$_POST['category_name']."') ");
		if ($insertacc) 
		{
			$_SESSION['usermsg'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Done Added Category. '.$_POST['category_name'].'  
									</div>';
			header("location:../products.php");
		}
		else
		{
			$_SESSION['usermsg'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Something Wrong Please Try Again
									</div>';
			header("location:../products.php");
		}
	}

}



?>