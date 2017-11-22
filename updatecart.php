<?php 
session_start();
include 'connection.php';

$getquantity = $dbConn->query("SELECT * FROM sales where id = '".$_GET['id']."' ");
$disquantity = $getquantity->fetch(PDO::FETCH_ASSOC);

$newprice = $_POST['quantity'] * $disquantity['price'];

$dbConn->query("UPDATE sales SET quantity = '".$_POST['quantity']."', total = '".$newprice."'  where id = '".$_GET['id']."' ");
header("location:sales.php");
?>