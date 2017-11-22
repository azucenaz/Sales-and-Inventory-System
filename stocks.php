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
                                         <button class="btn btn-primary" data-toggle="modal" data-target="#addstocks"> ADD STOCKS</button>
                                      </div>
                                     
                                   </div>
                                    <!-- add stocks  -->
                                       <div id="addstocks" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Add Stocks</h3>
                                            </div>
                                            <form class="form-horizontal" method="post" action="./execute/addstocks.php" parsley-validate>
                                      
                                     
                                            <div class="modal-body">
                                          
                                                <p>
                                               <!--    <div class="control-group">
                                          <label class="control-label">Unit</label>
                                          <div class="controls">
                                            <select class="form-control" name="unit" required>
                                                <option value=""> Choose</option>
                                                <option value="pcs">PCS</option>
                                                <option value="set">SET</option>
                                            </select>
                                         </div>
                                        </div> -->
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
                                            <input type="number" class="form-control" name="quantity" step="1" min="1" required>
                                         </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label">Expiry Date</label>
                                          <div class="controls">
                                            <input type="date" class="form-control" name="expiry_date" required>
                                         </div>
                                        </div>

                                          <div class="control-group">
                                          <label class="control-label">Supplier Name</label>
                                          <div class="controls">
                                          <select class="form-control" name="supplier_name" required>
                                              <option value="">Choose</option>
                                              <?php
                                              $getsupplier = $dbConn->query("SELECT * FROM suppliers");
                                              while($dissupplier = $getsupplier->fetch(PDO::FETCH_ASSOC))
                                              {
                                              ?>
                                              <option value="<?php echo $dissupplier['id'];?>"><?php echo $dissupplier['name'];?></option>

                                              <?php } ?>
                                          </select>
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
                                               
                                                <th>Quantity</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $getstocks = $dbConn->query("SELECT * FROM products");
                                            while($disstocks = $getstocks->fetch(PDO::FETCH_ASSOC))
                                            {
                                            ?>
                                             <?php 
                                                $getsum = $dbConn->query("SELECT sum(quantity) FROM stocks where category_name = '".$disstocks['category_name']."' AND stocks_name = '".$disstocks['product_name']."'");
                                                $dissum = $getsum->fetch(PDO::FETCH_ASSOC);

                                                $getsum1 = $dbConn->query("SELECT * FROM stocks where category_name = '".$disstocks['category_name']."' AND stocks_name = '".$disstocks['product_name']."'");
                                                $dissum1 = $getsum->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                            <tr <?php if($dissum['sum(quantity)'] == 0){ echo 'class="error"'; }?>>
                                                <td><?php echo $disstocks['product_name'];?></td>
                                               
                                                <td><?php echo isset($dissum['sum(quantity)']) ? $dissum['sum(quantity)'] : '0';?></td>
                                                <td><a href="view.php?category=<?php echo $disstocks['category_name'];?>&product=<?php echo $disstocks['product_name'];?>&p=stocks" class="btn btn-primary"><label  class="icon icon-eye-open icon-white"></label></a></td>

                                            </tr>
                                          
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

