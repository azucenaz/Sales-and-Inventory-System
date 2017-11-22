n<?php
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
                                <div class="muted pull-left">Supplier Lists</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="addsuppliers.php"><button class="btn btn-success">Add New <i class="icon-plus icon-white"></i></button></a>
                                      </div>
                                 
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Supplier ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getsupplier = $dbConn->query("SELECT * FROM suppliers");
                                            while ($dissupplier = $getsupplier->fetch(PDO::FETCH_ASSOC)) 
                                            {
                                               
                                            
                                             ?>
                                            <tr>
                                                <td><?php echo $dissupplier['supplier_id']?></td>
                                                <td><?php echo $dissupplier['name'];?></td>
                                                <td><?php echo $dissupplier['address'];?></td>
                                                <td><?php echo $dissupplier['contact'];?></td>
                                                <td><a class="btn btn-primary" href="editsuppliers.php?id=<?php echo $dissupplier['supplier_id'];?>&p=supplier"><i class="icon-pencil icon-white"></i></a> <a class="btn btn-danger" data-toggle="modal" href="#del<?php echo $dissupplier['supplier_id']; ?>"><i class="icon-remove icon-white"></i></a></td>
                                            </tr>
                                            <div aria-hidden="true" style="display: none;" id="del<?php echo $dissupplier['supplier_id']; ?>" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Delete <?php echo $dissupplier['supplier_id']; ?> ? </h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="execute/deletesuppliers.php">
                                                    <input type="hidden" value="<?php echo $dissupplier['supplier_id'];?>" name="supplier_id">
                                                <input type="submit" class="btn btn-danger" href="#" value="CONFIRM" name="submit">
                                                <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                                            </form>
                                            </div>
                                        </div>
                                            <?php } ?>
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

