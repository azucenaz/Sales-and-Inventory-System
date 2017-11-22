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
                     <h2>
                         Choose: <div class="btn-group ">
                                       <select class="form-control" name="search_name" required placeholder="Choose">
                                            <option value=""></option>
                                            <option value="customer_id">Customer Name</option>
                                            <option value="transaction_id">Transaction ID</option>
                                       </select>
                                      </div>
                                      Name: <div class="btn-group ">
                                     <input type="text" class="form-control" placeholder="eg. Anna" name="search_specific" >
                                    
                                      </div>
                     </h2>
                     <h2>
                              Date From: 
                                      <div class="btn-group ">
                                        <input type="date" class="form-control" placeholder="Date From" name="datefrom">
                                      </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;Date to: 
                                      <div class="btn-group">
                                        <input type="date" class="form-control" placeholder="Date to" name="dateto">
                                      </div>
                                      <div class="btn-group">
                                        <input type="submit" name="search" class="btn btn-primary btn-large" value="SEARCH">
                                      </div>
                     </h2>
                        <!-- block -->
                        <?php echo 
                        isset($_SESSION['usermsg']) ? $_SESSION['usermsg'] : '';
                        unset($_SESSION['usermsg']);
                         ?>
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Reports</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                              
                                   </div>
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>INVOICE ID</th>
                                                <th>CUSTOMER NAME</th>
                                                <th>AMOUNT TENDER</th>
                                                <th>DATE TRANSACTIONS</th>
                                                <th>TOTAL PAYMENT</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getcategory = $dbConn->query("SELECT * FROM transactions INNER JOIN customers ON transactions.customer_id = customers.customer_id");
                                            while ($discategory = $getcategory->fetch(PDO::FETCH_ASSOC)) 
                                            {
                                               
                                            
                                             ?>
                                            <tr>
                                                <td><a href="retrieve.php?id=<?php echo $discategory['transaction_id']?>" target="_blank" class="btn btn-primary"><?php echo $discategory['transaction_id']?></a></td>

                                                <td><?php echo $discategory['firstname'].' '.$discategory['lastname'];?></td>

                                                <td><?php echo number_format($discategory['amount_tender'],2);?></td>
                                                <td><?php echo $discategory['date_transaction'];?></td>
                                                

                                                <td><?php echo number_format($discategory['total_paid'],2);?></td>
                                                <td><a class="btn btn-danger" data-toggle="modal" href="#del<?php echo $discategory['id']; ?>">VOID</a></td>
                                            </tr>
                                            <div aria-hidden="true" style="display: none;" id="del<?php echo $discategory['id']; ?>" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Void <?php echo $discategory['transaction_id']; ?> ? </h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to void this transactions?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="execute/void.php">

                                                  
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

