<?php
session_start();
include '../connection.php';

if (isset($_POST['submit'])) 
{
	$getinfo = $dbConn->query("SELECT * FROM customers where customer_id = '".$_POST['customer_id']."' ");
	$disinfo = $getinfo->fetch(PDO::FETCH_ASSOC);

	$_SESSION['customer_id'] = $disinfo['customer_id'];
	$_SESSION['cus_fullname'] = $disinfo['firstname'].' '.$disinfo['lastname'];

	header("location:../sales.php?p=sales");
}

?>