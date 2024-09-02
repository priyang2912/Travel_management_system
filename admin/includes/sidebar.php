<?php
$page= substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1);

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link navbar-primary">
      <img src="assets/dist/img/bus_logo.png" alt="Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light"><b>Travel System</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-2 mb-2 d-flex">
        <div class="image">
          <img src="assets/dist/img/user_icon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
          <?php
    if(isset($_SESSION['auth']))
    {
      echo $_SESSION['auth_user']['user_name'];
    }
    else{
      echo "Not Logged In ";
    }
    ?></a>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link <?= $page == "index.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "vehicle.php" ? 'active bg-gradient-primary' : '';?><?= $page == "addvehicle.php" ? 'active bg-gradient-primary' : '';?><?= $page == "vehicle_view.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-bus"></i>
              <p>
                Vehicle
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vehicle.php" class="nav-link <?= $page == "vehicle.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vehicle List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addvehicle.php" class="nav-link <?= $page == "addvehicle.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Vehicle</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "driver.php" ? 'active bg-gradient-primary' : '';?><?= $page == "driver_add.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Driver's
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="driver.php" class="nav-link <?= $page == "driver.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Driver List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="driver_add.php" class="nav-link <?= $page == "driver_add.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Driver</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "booking.php" ? 'active bg-gradient-primary' : '';?><?= $page == "booking_add.php" ? 'active bg-gradient-primary' : '';?><?= $page == "booking_detail.php" ? 'active bg-gradient-primary' : '';?><?= $page == "bills.php" ? 'active bg-gradient-primary' : '';?><?= $page == "booking_view.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-road"></i>
              <p>
                Bookings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="booking.php" class="nav-link <?= $page == "booking.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="booking_add.php" class="nav-link <?= $page == "booking_add.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Booking</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "fuel.php" ? 'active bg-gradient-primary' : '';?><?= $page == "fuel_add.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-gas-pump"></i>
              <p>
                Fuel
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="fuel.php" class="nav-link <?= $page == "fuel.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fuel List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fuel_add.php" class="nav-link <?= $page == "fuel_add.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Fuel</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "part.php" ? 'active bg-gradient-primary' : '';?><?= $page == "part_add.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Part Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="part.php" class="nav-link <?= $page == "part.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Part List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="part_add.php" class="nav-link <?= $page == "part_add.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Part</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "maintanance.php" ? 'active bg-gradient-primary' : '';?><?= $page == "maintanance_add.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Maintenance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="maintanance.php" class="nav-link <?= $page == "maintanance.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maintenance List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="maintanance_add.php" class="nav-link <?= $page == "maintanance_add.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Maintenance</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "income_expence.php" ? 'active bg-gradient-primary' : '';?><?= $page == "addincomeexpence.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-rupee-sign"></i>
              <p>
                Income & Expenses
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="income_expence.php" class="nav-link <?= $page == "income_expence.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Income & Expense List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addincomeexpence.php" class="nav-link <?= $page == "addincomeexpence.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Income/ Expense</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "fuel_reports.php" ? 'active bg-gradient-primary' : '';?><?= $page == "income_expence_report.php" ? 'active bg-gradient-primary' : '';?><?= $page == "bookings_reports.php" ? 'active bg-gradient-primary' : '';?><?= $page == "maintanance_reports.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="income_expence_report.php" class="nav-link <?= $page == "income_expence_report.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Income & Expenses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fuel_reports.php" class="nav-link <?= $page == "fuel_reports.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fuel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="bookings_reports.php" class="nav-link <?= $page == "bookings_reports.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bookings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="maintanance_reports.php" class="nav-link <?= $page == "maintanance_reports.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Maintenances</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page == "employee.php" ? 'active bg-gradient-primary' : '';?>">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                User's Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="employee.php" class="nav-link <?= $page == "employee.php" ? 'active bg-secondary' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              
            </ul>
          </li>
              </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>