<?php
session_start();
include 'connection.php';

if (isset($_SESSION['username'])) 
{
  header("location:index.php?p=dashboard");
}

?>
<html>
  <head>
    <title>Admin Login</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
      <form class="form-signin" action="checkaccount.php" method="post">
        <h2 class="form-signin-heading">WELCOME</h2>
          <?php echo isset($_SESSION['errorlogin']) ? $_SESSION['errorlogin'] : '';
                unset($_SESSION['errorlogin']);
           ?>
   
        <input type="text" name="username" class="input-block-level" placeholder="username" required>
        <input type="password" name="password" class="input-block-level" placeholder="password" required>
        
        <input type="submit" class="btn btn-large btn-primary" name="submit"  value="LOGIN">

        <input type="reset" class="btn btn-large btn-danger" name="submit"  value="CLEAR">
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>