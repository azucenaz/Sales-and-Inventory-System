<?php
include '../connection.php';
if (isset($_POST['submit'])) 
{
	$dbConn->query("UPDATE customers SET firstname = '".$_POST['firstname']."',lastname = '".$_POST['lastname']."',address = '".$_POST['address']."',contact_no = '".$_POST['contact_no']."' where customer_id = '".$_POST['customer_id']."' ");
	$_SESSION['message'] = '';
	header("location:../customer.php");
}

?>