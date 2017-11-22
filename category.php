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
                                <div class="muted pull-left">Category</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                   
                                         <button class="btn btn-success" data-toggle="modal" data-target="#addcategory">Add Category <i class="icon-plus icon-white"></i></button>
                                      
                                         <!-- add category -->
                                         <div id="addcategory" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Add Category</h3>
                                            </div>
                                            <div class="modal-body">
                                          
                                                <p>
                                               <form class="form-horizontal" method="post" action="./execute/savecategory.php" parsley-validate>
                                    
                                     
                                       
                                     
                                        <div class="control-group">
                                          <label class="control-label">Category Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" type="text" name="category_name" required>
                                          </div>
                                        </div>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                
                                          <input type="submit" class="btn btn-primary btn-large" name="submit" value="ADD">
                                                </form>
                                            </div>
                                            </div>


                                    
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Category Name</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getcategory = $dbConn->query("SELECT * FROM category");
                                            while ($discategory = $getcategory->fetch(PDO::FETCH_ASSOC)) 
                                            {
                                               
                                            
                                             ?>
                                            <tr>
                                                <td><?php echo $discategory['category_name']?></td>
                                                <td><a class="btn btn-primary" href="editcategory.php?id=<?php echo $discategory['id'];?>"><i class="icon-pencil icon-white"></i></a> <a class="btn btn-danger" data-toggle="modal" href="#del<?php echo $discategory['id']; ?>"><i class="icon-remove icon-white"></i></a></td>
                                            </tr>
                                            <div aria-hidden="true" style="display: none;" id="del<?php echo $discategory['id']; ?>" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Delete <?php echo $discategory['category_name']; ?> ? </h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="execute/deletecategory.php">

                                                    <input type="hidden" value="<?php echo $discategory['category_name'];?>" name="category_name">
                                                    <input type="hidden" value="<?php echo $discategory['id'];?>" name="category_id">
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

