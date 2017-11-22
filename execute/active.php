<?php

session_start();
include '../connection.php';

$update = $dbConn->query("UPDATE users SET status = 'active' where user_id = '".$_GET['id']."' ");

if ($update) 
{
	$_SESSION['usermsg'] = '<div class="alert alert-success alert-block">
										<a class="close" data-dismiss="alert" href="#">×</a>
										<h4 class="alert-heading">Account Activate!</h4>
										
									</div>	
									';
	header("location:../users.php");
}
else
{
	

}


?>