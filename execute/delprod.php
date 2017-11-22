<?php
session_start();
include '../connection.php';

if (isset($_POST['submit'])) 
{
	$dbConn->query("DELETE FROM products where id = '".$_POST['product_id']."' ");
	$_SESSION['message'] = '<div class="alert alert-warning">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Deleted!</strong> 
									</div>';
									header("location:../products.php");
}
?>