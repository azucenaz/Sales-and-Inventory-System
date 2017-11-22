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
                        ?>
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Add Users</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal" method="post" action="./execute/adduser.php" parsley-validate>
                                      <fieldset>
                                        <legend>Fill up form </legend>
                                         <div class="control-group">
                                          <label class="control-label" for="focusedInput">Username</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="username" type="text" required parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1">
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="focusedInput">Password</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" id="password" name="password" type="password" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Re Password</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="password" type="password" required parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" parsley-equalto="#password">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Firstname</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="firstname" type="text" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Lastname</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="text" name="lastname" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="disabledInput">Address</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="text" name="address" required>
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="disabledInput">Contact No.</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="text" name="contact" required>
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="disabledInput">Email</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="email" name="email" required>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="selectError">Type</label>
                                          <div class="controls">
                                            <select id="selectError" required name="type">
                                              <option value="">Choose Type</option>
                                              <option value="admin">Administrator</option>
                                              <option value="cashier">Cashier</option>
                                             
                                            </select>
                                            
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label" for="selectError">Status</label>
                                          <div class="controls">
                                            <select id="selectError" required name="status">
                                              <option value="">Choose Type</option>
                                              <option value="active">Active</option>
                                              <option value="disable">Disable</option>
                                             
                                            </select>
                                            
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <input type="submit" class="btn btn-primary btn-large" name="submit" value="ADD USER">
                                          <button type="reset" class="btn btn-danger btn-large">RESET</button>
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

