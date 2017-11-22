<?php

session_start();

include '../connection.php';

$updateuser = $dbConn->query("UPDATE users SET password = '".$_POST['password']."',firstname = '".$_POST['firstname']."',lastname = '".$_POST['lastname']."',address = '".$_POST['address']."',contact = '".$_POST['contact']."',status = '".$_POST['status']."',type = '".$_POST['type']."',email = '".$_POST['email']."' where username = '".$_POST['username']."' ");

if ($updateuser) 
{
	$_SESSION['usermsg'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Done Update. '.$_POST['username'].'
									</div>';
									header("location:../users.php");
}

?>