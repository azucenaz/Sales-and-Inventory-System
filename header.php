<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Sales Management System</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php echo $_SESSION['fullname'];?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                   
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Low Stocks 
                                <b style="font-size:25px;"> 
                                (<?php 
                                $count = $dbConn->query("SELECT * FROM products where quantity <= 5 ");
                                echo $count->rowCount();
                                ?>)</b>
                                <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                <?php 
                                  if ($count->rowCount() == 0) 
                                {
                                   echo '
                                    <li>
                                        <a href="#">NONE</a>
                                    </li>';
                                }
                                else
                                {

                                while ($row = $count->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    
                                ?>

                                    <li>
                                        <a href="stocks.php?p=stocks"><?php echo $row['product_name'].' Quantity Left: <font color="red"> '.$row['quantity'].'</font>';?></a>
                                    </li>
                                  

                                    <?php } }?>
                                </ul>
                            </li>
                             <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Item Expired 
                                <b style="font-size:25px;"> 
                                (<?php 
                                    $now = date("Y-m-d");
                                $count1 = $dbConn->query("SELECT * FROM stocks where date_expiry <= '".$now."' ");
                                echo $count1->rowCount();
                                ?>)</b>
                                <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                <?php 

                                if ($count1->rowCount() == 0) 
                                {
                                   echo '
                                    <li>
                                        <a href="#">NONE</a>
                                    </li>';
                                }
                                else
                                {

                                while ($row1 = $count1->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    
                                ?>

                                    <li>
                                        <a href="stocks.php?p=stocks"><?php echo $row1['stocks_name'].' Date Expired: <font color="red"> '.$row1['date_expiry'].'</font>';?></a>
                                    </li>
                                  

                                    <?php }
                                    }?>
                                </ul>
                            </li>
                          
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>