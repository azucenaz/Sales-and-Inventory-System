 <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'dashboard' ? 'class="active"':'' ?>>
                            <a href="index.php?p=dashboard"><i class="icon-chevron-right"></i> Dashboard</a>
                        </li>
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'sales' ? 'class="active"':'' ?>>
                            <a href="sales.php?p=sales"><i class="icon-chevron-right"></i> Sales</a>
                        </li>
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'customer' ? 'class="active"':'' ?>>
                            <a href="customer.php?p=customer"><i class="icon-chevron-right"></i>Customers</a>
                        </li>
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'stocks' ? 'class="active"':'' ?>>
                            <a href="stocks.php?p=stocks"><i class="icon-chevron-right"></i> Stocks</a>
                        </li>
                        
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'products' ? 'class="active"':'' ?>>
                            <a href="products.php?p=products"><i class="icon-chevron-right"></i>Products</a>
                        </li>
                          <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'category' ? 'class="active"':'' ?>>
                            <a href="category.php?p=category"><i class="icon-chevron-right"></i>Category</a>
                        </li>
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'users' ? 'class="active"':'' ?>>
                            <a href="users.php?p=users"><i class="icon-chevron-right"></i>Users</a>
                        </li>
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'supplier' ? 'class="active"':'' ?>>
                            <a href="supplier.php?p=supplier"><i class="icon-chevron-right"></i>Suppliers</a>
                        </li>
                        <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'reports' ? 'class="active"':'' ?>>
                            <a href="reports.php?p=reports"><i class="icon-chevron-right"></i>Reports</a>
                        </li>
                        <!--  <li <?php echo isset($_GET['p'])  && $_GET['p'] == 'settings' ? 'class="active"':'' ?>>
                            <a href="settings.php?p=settings"><i class="icon-chevron-right"></i>Settings</a>
                        </li> -->
                    </ul>