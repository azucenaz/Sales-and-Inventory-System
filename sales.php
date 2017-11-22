<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['trans_id'])) 
{
    function numberletter() 
{
          $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          srand((double)microtime()*1000000);
          $i = 0;
          $passii = '' ;
          while ($i <= 8) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $passii = $passii . $tmp;
            $i++;
          }
          return $passii;
}

$_SESSION['trans_id'] = numberletter();

}

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
                        <?php 
                        $total = $dbConn->query("SELECT sum(total) FROM sales where transaction_id = '".$_SESSION['trans_id']."' ");
                        $distotal = $total->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <h1>TOTAL: PHP <?php echo isset($distotal['sum(total)']) ? number_format($distotal['sum(total)'],2) : '0.00' ;?></h1>
                        <?php echo 
                       
                        isset($_SESSION['usermsg']) ? $_SESSION['usermsg'] : '';
                        unset($_SESSION['usermsg']);
                         ?>
                          <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Cart Details</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table class="table">
						              <thead>
						                <tr>
						                  
						                  <th>Product Name</th>
                                          <th>Unit</th>
						                  <th>Price</th>
						                  <th>Qty</th>
						                  <th>Total</th>
						                  <th>Actions</th>
						                </tr>
						              </thead>
						              <tbody>
                                        <?php 
                                        // KUHA OG TRANSACTIONS
                                        isset($_SESSION['trans_id']) ? $get = $_SESSION['trans_id'] : '';
                                        // KUHA TANAN GI ORDER
                                        $getcart = $dbConn->query("SELECT * FROM sales where transaction_id = '".$get."' ");
                                        while ($discart = $getcart->fetch(PDO::FETCH_ASSOC)) 
                                        {
                                            // $getprod = $dbConn->query("SELECT * FROM stocks where stocks_id = '".$discart['stock_id']."' ");
                                            // $disprod = $getprod->fetch(PDO::FETCH_ASSOC);

                                        ?>
                                        <!-- GI CHECK IF LAPAS QUANTITY OG 5 -->
                                        <tr <?php if ($discart['quantity'] >= 5) 
                                        {
                                            echo 'class="info"';
                                        }?>>
                                          <td><?php echo $discart['product_name'];?></td>
                                          <td><?php echo $discart['unit'];?></td>
                                          <td><?php echo $discart['price'];?></td>
                                          <td><?php echo $discart['quantity'];?></td>
                                          <td><?php echo $discart['total'];?></td>
                                          <td><a  href="#edit<?php echo $discart['id'];?>" data-toggle="modal">Edit </a> | <a href="remove.php?id=<?php echo $discart['stock_id'];?>">Cancel</a></td>
                                        </tr>
                                        <div id="edit<?php echo $discart['id'];?>" class="modal hide" aria-hidden="true" style="display: none;width:300px;left:63%;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Quantity</h3>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="updatecart.php?id=<?php echo $discart['id'];?>">
                                                <p>
                                                <input type="number" name="quantity" min="1" max="<?php echo $discart['quantity'];?>" required>

                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="UPDATE" name="submit"> 
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
                        <div class="row">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php 
                                echo isset($distotal['sum(total)']) ? '<button class="btn btn-success" data-toggle="modal" data-target="#customer">Customer</button> ' : ' ' ;
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?php 
                            if (isset($_SESSION['cus_fullname'])) 
                            {
                                echo isset($distotal['sum(total)']) ? 'Customer: '.$_SESSION['cus_fullname'] : ' ' ;
                            }
                            
                        ?>
                        <?php 
                                echo isset($distotal['sum(total)']) ? '<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#pay">PROCEED</button> ' : ' ' ;
                        ?>
                        
                        <div id="pay" class="modal hide" aria-hidden="true" style="display: none;width:300px;left:63%;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type=" button">X</button>
                                                <h3>Amount</h3>             
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="savetrans.php">
                                                <p>
                                                <input type="number" name="amount" step="0.01" min="<?php echo $distotal['sum(total)'];?>" required>

                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="PAY" name="submit"> 
                                                </form>
                                            </div>
                                        </div>  
                                         <div id="customer" class="modal hide" aria-hidden="true" style="display: none;width:300px;left:63%;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Customer List</h3>             
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="execute/customeradd.php">
                                                <p>
                                                <select class="form-control" name="customer_id" required>
                                                    <option value="">Choose</option>
                                                    <?php 
                                                    $getcus = $dbConn->query("SELECT * FROM customers");
                                                    while($discus = $getcus->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                    ?>
                                                    <option value="<?php echo $discus['customer_id'];?>"><?php echo $discus['firstname']. ' '.$discus['lastname'];?></option>
                                                    <?php 
                                                }
                                                ?>

                                                </select>

                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-info" value="ADD" name="submit"> 
                                                </form>
                                            </div>
                                        </div>                            
                        </div>

</div>
                        

                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Product Lists</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                  
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Retail Price</th>
                                                <th>Wholesale Price</th>
                                                <th>Quantity Left</th>
                                                <th>Unit</th><!-- 
                                                <th>Date Expired</th> -->
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

                                        $getstocks = $dbConn->query("SELECT * FROM products where quantity != '0' ");
                                        while($disstocks = $getstocks->fetch(PDO::FETCH_ASSOC)) 
                                        {
                                            # code...
                                        
                                      ?>
                                        <tr>
                                            <td><?php echo $disstocks['product_name'];?></td>
                                            <td><?php echo $disstocks['retail_price'];?></td>
                                            <td><?php echo $disstocks['wholesale_price'];?></td>
                                            <td><?php echo $disstocks['quantity'];?></td>
                                            <td><?php echo $disstocks['unit'];?></td>
                                            
                                            <!-- <td><?php echo $disstocks['date_expiry'];?></td> -->
                                            <td><a class="btn btn-success" href="#<?php echo $disstocks['id'];?>" data-toggle="modal"><label class="icon icon-shopping-cart icon-white"></label></a></td>                    
                                        </tr>
                                        <div id="<?php echo $disstocks['id'];?>" class="modal hide" aria-hidden="true" style="display: none;width:300px;left:60%;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Quantity</h3>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="cart.php">
                                                <p>
                                                <input type="hidden" value="<?php echo $disstocks['id'];?>" name="stock_id">
                                                <input type="hidden" value="<?php echo $disstocks['product_name'];?>" name="stocks_name">
                                                <input type="number" name="quantity" min="1" max="<?php echo $disstocks['quantity'];?>" required>

                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="ADD" name="submit"> 
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
      
    </body>

</html>

