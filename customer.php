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
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Customer Lists</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="addcustomer.php"><button class="btn btn-success">Add New <i class="icon-plus icon-white"></i></button></a>
                                      </div>
                                    
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $getcustomer = $dbConn->query("SELECT * FROM customers");
                                                while($discustomer = $getcustomer->fetch(PDO::FETCH_ASSOC))
                                                {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $discustomer['customer_id'];?></td>
                                                <td><?php echo $discustomer['firstname'].' '.$discustomer['lastname'];?></td>
                                                <td><?php echo $discustomer['address'];?></td>
                                                <td class="center"><?php echo $discustomer['contact_no'];?></td>
                                                <td class="center"><a class="btn btn-success" href="#<?php echo $discustomer['customer_id'];?>" data-toggle="modal"><label class="icon icon-edit icon-white"></label></a></td>
                                            </tr>
                                                    <div id="<?php echo $discustomer['customer_id'];?>" class="modal hide" aria-hidden="true" >
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Update Customer</h3>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="execute/updatecus.php">
                                                <p>
                                                <input type="hidden" name="customer_id" value="<?php echo $discustomer['customer_id'];?>"> 
                                                Firstname: <input  type="text" required value="<?php echo $discustomer['firstname'];?>" name="firstname"><br>
                                                Lastname: <input  type="text" required value="<?php echo $discustomer['lastname'];?>" name="lastname"><br>
                                                Address: <input  type="text" required value="<?php echo $discustomer['address'];?>" name="address"><br>Contact: <input  type="text" required value="<?php echo $discustomer['contact_no'];?>" name="contact_no"><br>
                                                
                                                
                                                
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="UPDATE" name="submit"> 
                                                </form>
                                            </div>
                                        </div>
                                           <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
          
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
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

