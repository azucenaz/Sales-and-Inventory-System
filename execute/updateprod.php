<?php
session_start();
include '../connection.php';

if (isset($_POST['submit'])) 
{

	$dbConn->query("UPDATE products SET product_name = '".$_POST['product_name']."',category_name = '".$_POST['category_name']."',retail_price = '".$_POST['retail_price']."',wholesale_price = '".$_POST['wholesale_price']."' where id = '".$_POST['product_id']."' ");
	$_SESSION['message'] = '<div class="alert alert-info">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Updated!</strong> Product Name: '.$_POST['product_name'].'
									</div>';
	header("location:../products.php");
}


?>