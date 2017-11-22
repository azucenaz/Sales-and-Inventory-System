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
                                <div class="muted pull-left">Add Stocks</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="stocks.php?p=stocks" class="btn btn-primary">BACK</a>
                                      </div>
                                     
                                   </div>
                                    <!-- add stocks  -->
                                       <div id="addstocks" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>Add Stocks</h3>
                                            </div>
                                            <form class="form-horizontal" method="post" action="./execute/addstocks.php" parsley-validate>
                                      
                                     
                                            <div class="modal-body">
                                          
                                                <p>
                                               
                                                  <div class="control-group">
                                          <label class="control-label">Product Name</label>
                                          <div class="controls">
                                            <select name="product_name" class="form-control" required>
                                                <option value="">Choose</option>
                                                <?php 
                                                $getprod = $dbConn->query("SELECT * FROM products");
                                                while($disprod = $getprod->fetch(PDO::FETCH_ASSOC))
                                                {

                                                ?>
                                                <option value="<?php echo $disprod['id'];?>"><?php echo $disprod['product_name'];?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label">Quantity</label>
                                          <div class="controls">
                                            <input type="number" class="form-control" name="quantity" required>
                                         </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label">Expiry Date</label>
                                          <div class="controls">
                                            <input type="date" class="form-control" name="expiry_date" required>
                                         </div>
                                        </div>
                                        
                                        
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                
                                             <input type="submit" class="btn btn-success btn-large" name="submit" value="ADD STOCKS">
                                                </form>
                                            </div>
                                            </div>



                                    <!-- End add stocks -->
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                
                                                <th>Product Name</th>
                                                <th>Retail Price</th>
                                                <th>Whole Sale Price</th>
                                                <th>Date Added</th>
                                                <th>Date Expiry</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $getstocks = $dbConn->query("SELECT * FROM stocks where category_name = '".$_GET['category']."' AND stocks_name = '".$_GET['product']."'  ");
                                            while($disstocks = $getstocks->fetch(PDO::FETCH_ASSOC))
                                            {
                                            ?>
                                            <tr <?php if($disstocks['status'] == 'out'){ echo 'class="info"';}?>>
                                               <td><?php echo $disstocks['stocks_name'];?></td>

                                               <td><?php echo $disstocks['retail_price'];?></td>

                                               <td><?php echo $disstocks['wholesale_price'];?></td>

                                               <td><?php echo $disstocks['date_added'];?></td>
                                               <td><?php echo $disstocks['date_expiry'];?></td>
                                               <td><?php echo $disstocks['quantity'];?></td>
                                               <td><?php 
                                               if ($disstocks['status'] == 'out') 
                                               {
                                                echo '<span class="label label-important">OUT</span>';
                                               }
                                               else
                                               {
                                                echo '<span class="label label-success">IN</span>';
                                               }

                                               ?></td>

                                               <td>

                                               <?php
                                               if ($disstocks['status'] != 'out') 
                                               {
                                               
                                               
                                               ?>

                                               <a class="btn btn-success" href="#<?php echo $disstocks['stocks_id'];?>" data-toggle="modal">STOCK OUT</a>
                                               <?php }else{ echo 'NONE';} ?>

                                               </td>


                                            </tr>
                                            <div id="<?php echo $disstocks['stocks_id'];?>" class="modal hide" aria-hidden="true" style="display: none;width:300px;left:60%;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3><?php echo $disstocks['stocks_name'];?></h3>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="updateout.php">
                                                <p>
                                                <input type="hidden" value="<?php echo $disstocks['stocks_id'];?>" name="stock_id">
                                               <B>STOCKS OUT? YES/NO</B>

                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="YES" name="submit">

                                                </form>
                                            </div>
                                        </div>
                                            <?php 

                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
                <div class="span3" id="content"></div>
            

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

