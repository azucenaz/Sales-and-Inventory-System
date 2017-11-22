<?php
session_start();
include 'connection.php';

?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Sales Management System</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">
    </head>
    
    <body>
   <?php 
        include 'header.php';
        ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                 <?php

                 switch ($_SESSION['type']) 
                 {
                     case 'default':
                        include 'admin.php';
                             break;
                     case 'admin':
                        include 'admin.php';
                         break;
                         case 'cashier':
                        include 'cashier.php';
                             break;
                     default:
                         # code...
                         break;
                 }

                    ?>
                </div>
                
                <!--/span-->
                 <div class="span9" id="content">
                      <!-- morris stacked chart -->
                    <div class="row-fluid">
                        <!-- block -->
                        <?php echo isset($_SESSION['erroruser']) ? $_SESSION['erroruser']: '';
                        unset($_SESSION['erroruser']);
                        $getuser = $dbConn->query("SELECT * FROM users where user_id = '".$_GET['id']."' ");
                        $disuser = $getuser->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Edit Users</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal" method="post" action="./execute/editusers.php" parsley-validate>
                                      <fieldset>
                                         <div class="control-group">
                                          <label class="control-label" for="focusedInput">Username</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="username" type="text" required parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" readonly value="<?php echo $disuser['username'];?>">
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="focusedInput">Password</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" id="password" value="<?php echo $disuser['password'];?>" name="password" type="password" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Re Password</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="password" type="password" required parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" value="<?php echo $disuser['password'];?>" parsley-equalto="#password">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Firstname</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" value="<?php echo $disuser['firstname'];?>" name="firstname" type="text" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Lastname</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" value="<?php echo $disuser['lastname'];?>" type="text" name="lastname" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="disabledInput">Address</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="text" value="<?php echo $disuser['address'];?>" name="address" required>
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="disabledInput">Contact No.</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="text" name="contact" value="<?php echo $disuser['contact'];?>" required>
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="disabledInput">Email</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="email" value="<?php echo $disuser['email'];?>" name="email" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="selectError">Type</label>
                                          <div class="controls">
                                            <select id="selectError" required name="type">
                                              <option value="">Choose Type</option>
                                              <option <?php if($disuser['type'] == 'admin'){ echo 'selected ';}?>value="admin">Administrator</option>
                                              <option  <?php if($disuser['type'] == 'cashier'){ echo 'selected ';}?>value="cashier">Cashier</option>
                                             
                                            </select>
                                            
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="selectError">Status</label>
                                          <div class="controls">
                                            <select id="selectError" required name="status">
                                              <option value="">Choose Type</option>
                                              <option  <?php if($disuser['status'] == 'active'){ echo 'selected ';}?> value="active">Active</option>
                                              <option  <?php if($disuser['status'] == 'disable'){ echo 'selected ';}?> value="disable">Disable</option>
                                             
                                            </select>
                                            
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <input type="submit" class="btn btn-primary btn-large" name="submit" value="UPDATE USER">
                                          <a href="users.php" class="btn btn-danger btn-large">CANCEL</a>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                    

               

                     <!-- validation -->
                 <!-- /validation -->


                </div>
            </div>
            <hr>
          
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>

         <script src="vendors/parsley.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>
    </body>

</html>

