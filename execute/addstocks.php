<?php
session_start();

include '../connection.php';

if (isset($_POST['submit'])) 

{
	
	$getproduct = $dbConn->query("SELECT * FROM products where id = '".$_POST['product_name']."' ");
	$disproduct = $getproduct->fetch(PDO::FETCH_ASSOC);

	$dbConn->query("INSERT INTO stocks (category_name,stocks_name,quantity,retail_price,wholesale_price,date_added,date_expiry,status,suppliers_id,unit) VALUES ('".$disproduct['category_name']."','".$disproduct['product_name']."','".$_POST['quantity']."','".$disproduct['retail_price']."','".$disproduct['wholesale_price']."','".date("Y-m-d")."','".$_POST['expiry_date']."','in','".$_POST['supplier_name']."','".$_POST['unit']."') ");
	header("location:../stocks.php?p=stocks");
	
}



?>