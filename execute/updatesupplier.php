<?php
session_start();

include '../connection.php';

if (isset($_POST['update']))
{

	$update = $dbConn->query("UPDATE suppliers SET name = '".$_POST['supplier_name']."',address = '".$_POST['address']."',contact = '".$_POST['contact']."' where supplier_id = '".$_POST['supplier_id']."'  ");
	if ($update) 
	{
		$_SESSION['erroruser'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Done Update. '.$_POST['supplier_id'].'
									</div>';
									header("location:../editsuppliers.php?id=".$_POST['supplier_id']."");
	}
}

?>