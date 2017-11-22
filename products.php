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
                        isset($_SESSION['message']) ? $_SESSION['message'] : '';
                        unset($_SESSION['message']);
                         ?>
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Products</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                   
                                         <button class="btn btn-primary" data-toggle="modal" data-target="#addproduct">Add Products <i class="icon-plus icon-white"></i></button>
                                      
                                         <!-- add category -->
                                         <div id="addproduct" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Add Product</h3>
                                            </div>
                                            <div class="modal-body">
                                          
                                                <p>
                                               <form class="form-horizontal" method="post" action="./execute/saveproduct.php" parsley-validate>
                                      <fieldset>
                                     
                                       
                                     
                                        <div class="control-group">
                                          <label class="control-label">Category Name</label>
                                          <div class="controls">
                                           <select class="form-control" name="category_name">
                                            <option value=""> Choose </option>
                                            <?php 
                                            $getcat = $dbConn->query("SELECT * FROM category");
                                            while($discat = $getcat->fetch(PDO::FETCH_ASSOC))
                                            {

                                            ?>

                                            <option value="<?php echo $discat['category_name'];?>"><?php echo $discat['category_name'];?></option>
                                            <?php }?>
                                           </select>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Product Name</label>
                                          <div class="controls">
                                          <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required>
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label">Retail Price</label>
                                          <div class="controls">
                                          <input type="number" min="0.01" step="0.01" name="retail_price" class="form-control" placeholder="Enter Product Price" required>
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label">Whole Sale Price</label>
                                          <div class="controls">
                                          <input type="number" min="0.01" step="0.01" name="wholesale_price" class="form-control" placeholder="Enter Product Price" required>
                                          </div>
                                        </div>
                                           <div class="control-group">
                                          <label class="control-label">Unit</label>
                                          <div class="controls">
                                       <select class="form-control" required name="unit">
                                         <option value=""></option>
                                         <option value="pcs">PCS</option>
                                         <option value="unit">UNIT</option>
                                       </select>
                                          </div>
                                        </div>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                
                                          <input type="submit" class="btn btn-primary btn-large" name="submit" value="SUBMIT">
                                                </form>
                                            </div>
                                            </div>


                                  
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Category Name</th>
                                                <th>Product Name</th>
                                                <th>Retail Price</th>
                                                <th>Whosale Price</th>
                                                <th>Quantity</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $getprod = $dbConn->query("SELECT * FROM products");
                                        while($disprod = $getprod->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $disprod['category_name']?></td>
                                            <td><?php echo $disprod['product_name']?></td>
                                            <td><?php echo $disprod['retail_price']?></td>

                                            <td><?php echo $disprod['wholesale_price']?></td>
                                            <td><?php echo $disprod['quantity']?></td>
                                            
                                            <td><button class="btn btn-primary" data-target="#update<?php echo $disprod['id'];?>" data-toggle="modal"><label class="icon icon-pencil icon-white"></label></button> <!-- <button class="btn btn-danger" data-target="#del<?php echo $disprod['id'];?>" data-toggle="modal"><label class="icon icon-remove icon-white"></label></button> --></td>

                                        </tr>

                                        <!-- update product -->
                                           <div id="update<?php echo $disprod['id'];?>" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Update Product</h3>
                                            </div>
                                            <div class="modal-body">
                                          
                                                <p>
                                               <form class="form-horizontal" method="post" action="./execute/updateprod.php" parsley-validate>
                                      
                                     
                                        <input  type="hidden" value="<?php echo $disprod['id'];?>" name="product_id">
                                     
                                        <div class="control-group">
                                          <label class="control-label">Category Name</label>
                                          <div class="controls">
                                           <select class="form-control" name="category_name">
                                            <option value=""> Choose </option>
                                            <?php 
                                            $getcat = $dbConn->query("SELECT * FROM category");
                                            while($discat = $getcat->fetch(PDO::FETCH_ASSOC))
                                            {

                                            ?>

                                            <option value="<?php echo $discat['category_name'];?>" <?php if($disprod['category_name'] == $discat['category_name']){ echo 'selected';}?>><?php echo $discat['category_name'];?></option>
                                            <?php }?>
                                           </select>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Product Name</label>
                                          <div class="controls">
                                          <input type="text" value="<?php echo $disprod['product_name'];?>" name="product_name" class="form-control" placeholder="Enter Product Name" required>
                                          </div>
                                        </div>
                                         <div class="control-group">
                                          <label class="control-label">Retail Price</label>  
                                          <div class="controls">
                                          <input type="number" value="<?php echo $disprod['retail_price']?>" min="0.01" step="0.01" name="retail_price" class="form-control" placeholder="Enter Product Price" required>
                                          </div>
                                        </div>
                                          <div class="control-group">
                                          <label class="control-label">Wholesale Price</label>  
                                          <div class="controls">
                                          <input type="number" value="<?php echo $disprod['wholesale_price']?>" min="0.01" step="0.01" name="wholesale_price" class="form-control" placeholder="Enter Product Price" required>
                                          </div>
                                        </div>
                                        
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                
                                          <input type="submit" class="btn btn-primary btn-large" name="submit" value="UPDATE">
                                                </form>
                                            </div>
                                            </div>
                                            <!-- delete product -->
                                              <div id="del<?php echo $disprod['id'];?>" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3><?php echo $disprod['product_name']?></h3>
                                            </div>
                                            <div class="modal-body">
                                          
                                                <p>
                                               <form class="form-horizontal" method="post" action="./execute/delprod.php" parsley-validate>
                                      
                                     
                                        <input  type="hidden" value="<?php echo $disprod['id'];?>" name="product_id">
                                        Are you sure to delete this item?
                                        
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                
                                          <input type="submit" class="btn btn-danger btn-large" name="submit" value="YES">
                                                </form>
                                            </div>
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


