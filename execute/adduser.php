<?php
session_start();
include '../connection.php';

if (isset($_POST['submit'])) 
{
	$checkuser = $dbConn->query("SELECT * FROM users where username  = '".$_POST['username']."'");
	if ($checkuser->rowCount() == 1) 
	{
		$_SESSION['erroruser'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> User Already Exist.
									</div>';
		header("location:../addusers.php"); 
	}
	else
	{
		$insertuser = $dbConn->query("INSERT INTO users(username,password,firstname,lastname,address,contact,status,type) VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['address']."','".$_POST['contact']."','".$_POST['status']."','".$_POST['type']."') ");
		if ($insertuser) 
		{
			$_SESSION['erroruser'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Done Registered. '.$_POST['username'].'
									</div>';
			header("location:../addusers.php");
		}
		else
		{
			$_SESSION['erroruser'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Something Wrong Please Try Again
									</div>';
			header("location:../addusers.php");
		}
	}
}

?>