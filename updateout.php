<?php

include 'connection.php';
session_start();
if (isset($_POST['submit'])) 
{

	$dbConn->query("UPDATE stocks SET status = 'out' where stocks_id = '".$_POST['stock_id']."' ");
	header("location:stocks.php?p=stocks");

	$getstocks = $dbConn->query("SELECT * FROM stocks where stocks_id = '".$_POST['stock_id']."' ");
	$disstocks = $getstocks->fetch(PDO::FETCH_ASSOC);

	$getprod = $dbConn->query("SELECT * FROM products where category_name = '".$disstocks['category_name']."' AND product_name = '".$disstocks['stocks_name']."'  ");
	$disprod = $getprod->fetch(PDO::FETCH_ASSOC);

	echo $newqty = $disstocks['quantity'] + $disprod['quantity'];

	$dbConn->query("UPDATE products SET quantity = '".$newqty."' where category_name = '".$disstocks['category_name']."' AND product_name = '".$disstocks['stocks_name']."' ");
}

?>