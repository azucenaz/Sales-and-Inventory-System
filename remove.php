<?php 

session_start();

include 'connection.php';

$dbConn->query("DELETE FROM sales where stock_id ='".$_GET['id']."' AND transaction_id = '".$_SESSION['trans_id']."' ");
header("location:sales.php?p=sales");
?>