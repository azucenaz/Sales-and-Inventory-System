<?php
session_start();
include 'connection.php';


if (isset($_POST['submit'])) 
{
	// mag query sa users
	$checkuser = $dbConn->query("SELECT * FROM users where username = '".$_POST['password']."' and password = '".$_POST['password']."' ");
	// iya e check kung exist iya account
	if($checkuser->rowCount() == 1) 
	{
		
		$getuser = $checkuser->fetch(PDO::FETCH_ASSOC);

		// if active iya account
		if ($getuser['status'] == 'active') 
		{
			// are mag store og sessions
			$_SESSION['username'] = $getuser['username'];
			$_SESSION['fullname'] = $getuser['firstname'].' '.$getuser['lastname'];
 			$_SESSION['type']	= $getuser['type'];
 			// kani mo redirect og sa home page or index page
			header("location:index.php?p=dashboard");
		}
		// are dli na active iya account
		else
		{
			// mao ni ang message sa error
			$_SESSION['errorlogin'] = '<font color="red">Sorry youre account isnt active anymore</font>';
			// mo redirect sa login page
			header("location:login.php");
		}
		
	}
	// if wala sa database ang account or wrong account or wrong password
	else
	{	
			// mao ni ang message sa error 
			$_SESSION['errorlogin'] = '<font color="red">Wrong username or Password</font>';
			// mo redirect sa login page
			header("location:login.php");
	}

}

?>