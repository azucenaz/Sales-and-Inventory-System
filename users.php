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
                        <?php echo 
                        isset($_SESSION['usermsg']) ? $_SESSION['usermsg'] : '';
                        unset($_SESSION['usermsg']);
                         ?>
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">User Lists</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="addusers.php?p=users"><button class="btn btn-success">Add New <i class="icon-plus icon-white"></i></button></a>
                                      </div>
                                   
                                    
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $getusers = $dbConn->query("SELECT * FROM users where type != 'default' ");
                                                while($disusers = $getusers->fetch(PDO::FETCH_ASSOC))
                                                {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo '<a href="#show'.$disusers['user_id'].'" data-toggle="modal" class="btn btn-primary">'.$disusers['username'].'</a>'?></td>
                                                <td><?php echo $disusers['firstname'].' '.$disusers['lastname'];?></td>
                                                <td><?php echo $disusers['address'];?></td>
                                                <td class="center"><?php echo $disusers['contact'];?></td>
                                                <td class="center"><?php  
                                                if ($disusers['status'] == 'active') 
                                                {
                                                echo '<a href="execute/disable.php?id='.$disusers['user_id'].'" class="btn btn-danger"><label class="icon icon-ban-circle"></label></a> | ';
                                                }
                                                else
                                                {
                                                echo '<a href="execute/active.php?id='.$disusers['user_id'].'" class="btn btn-success"><label class="icon icon-ok"></label></a> | ';
                                                }
                                                echo '<a href="editusers.php?id='.$disusers['user_id'].'" class="btn"><label class="icon icon-edit"></label></a>';
                                                ?></td>
                                            </tr>
                                            <div id="show<?php echo $disusers['user_id'];?>" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">&times;</button>
                                                <h3>Account Details</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>Name:<?php echo $disusers['firstname'].' '.$disusers['lastname'];?><br>
                                                    Contact: <?php echo $disusers['contact']; ?> <br>
                                                     Address: <?php echo $disusers['address']; ?> <br>
                                                      Type: <?php echo $disusers['type']; ?> <br>
                                                       Status: <?php echo $disusers['status']; ?> <br>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                
                                                <a data-dismiss="modal" class="btn btn-danger" href="#">CLOSE</a>
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

