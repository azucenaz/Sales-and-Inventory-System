<?php
session_start();

include '../connection.php';

if (isset($_POST['submit'])) 
{
	$deletesuppliers = $dbConn->query("DELETE FROM suppliers where supplier_id = '".$_POST['supplier_id']."' ");
	if ($deletesuppliers) 
	{
		$_SESSION['usermsg'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Successfully Delete!</strong> Suppplier ID : '.$_POST['supplier_id'].'
									</div>';
		header("location:../supplier.php");
	}
}

?>