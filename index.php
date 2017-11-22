<?php
session_start();
include 'connection.php';
include 'auth.php';
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
         <script type="text/javascript">
          <?php 

            $total = $dbConn->query("SELECT sum(total_paid) FROM transactions");
            $distotal = $total->fetch(PDO::FETCH_ASSOC);
        ?>
           <?php 

            $total1 = $dbConn->query("SELECT sum(total_paid) FROM transactions where date_transaction = '".date('Y-M')."' ");
            $distotal1 = $total1->fetch(PDO::FETCH_ASSOC);
        ?>
  window.onload = function () {
    
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Dashboard"    
      },
      animationEnabled: true,
      axisY: {
        title: ""
      },
      legend: {
        verticalAlign: "top",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [

      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Monthly Sales",
        dataPoints: [     
        {y: <?php echo isset($distotal['sum(total_paid)']) ? $distotal['sum(total_paid)'] : '0';?>, label: "Total Sales"},
        {y: <?php echo isset($distotal1['sum(total_paid)']) ? $distotal1['sum(total_paid)'] : '0';?>, label: "Monthly Sales"},
        
        ]
      }   
      ]
    });

    chart.render();
  }
  </script>
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
                <script type="text/javascript" src="canvasjs.min.js"></script>

                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">DashBoard</div>
                              
                            </div>
                            <div class="block-content collapse in">
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>

                                
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
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>
