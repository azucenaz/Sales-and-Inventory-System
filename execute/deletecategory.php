<?php
session_start();

include '../connection.php';

if (isset($_POST['submit'])) 
{
	$deletecategory = $dbConn->query("DELETE FROM category where id = '".$_POST['category_id']."' ");
	if ($deletecategory) 
	{
		$_SESSION['usermsg'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Successfully Delete!</strong> Category name : '.$_POST['category_name'].'
									</div>';
		header("location:../category.php");
	}
}

?>