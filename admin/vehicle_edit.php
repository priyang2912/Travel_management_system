<?php
//session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<html>
    <head>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    </head>
</body>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Modal -->
    

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0 text-dark">FUEL ADD Filter</h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="http://localhost/Loginform/admin/">Home</a></li>
                        <li class="breadcrumb-item active"><a >Fuel Add</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_SESSION['status'])) {
                        echo "<h4>" . $_SESSION['status'] . "</h4>";
                        unset($_SESSION['status']);
                    }

                    ?>

                    <div class="card">
                        <div class="card-header">
                            <form action="#" method="POST"><!--download excel file just type in action="booking_export.php" -->
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">From Date</label>
                      <input type="date" name="from_date"
                        value="<?php if (isset($_POST['from_date'])) {
            echo $_POST['from_date'];
          } else {
          } ?>"
                        class="form-control" placeholder="From Date" required>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">To Date</label>
                      <input type="date" name="to_date"
                        value="<?php if (isset($_POST['to_date'])) {
            echo $_POST['to_date'];
          } else {
          } ?>"
                        class="form-control" placeholder="To Date" required>
                    </div>
                  </div>
                 <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Vehicle</label>
                      <select name="vehicle" id="vehicle" class="form-control">
<option value="0" selected>All Vehicle</option>
<?php 
                  $select_v=("SELECT * FROM vehicle");
                  $query_run = mysqli_query($con,$select_v);
            
                  while($row=mysqli_fetch_array($query_run))
                  {
                    
          ?>
          <option value="<?php echo $row['id']; ?>"> <?php echo $row['reg_no'];?> </option>
          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Check</label></br>
                      <button type="submit" class="btn btn-primary" name="check">Submit</button>
                    </div>
                  </div>    
                 
        </div>
        </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <h4 style="color:blue;">BOOKING LIST :-</h4><h5>
                <?php if (isset($_POST['from_date'])) {
                  $fill_dt = date("d-m-Y", strtotime($_POST['from_date']));
                                            echo $fill_dt;
                } else {
                } ?> TO
                <?php if (isset($_POST['to_date'])) {
                   $to_date = date("d-m-Y", strtotime($_POST['to_date']));
                                            echo $to_date;
                 } else {
                 } ?>
                &nbsp;Vehicle No: <?php 
                              if(isset($_POST['vehicle'])){
                                $vehicle=$_POST['vehicle'];
                                $select_v=("SELECT * FROM vehicle WHERE id=$vehicle");
                                $query_run = mysqli_query($con,$select_v);
                          
                                while($row=mysqli_fetch_array($query_run))
                                {
                  echo $row['reg_no'];
                 }
                }
                 ?>
              </h5>
              <div class="table-responsive">
                            <table id="expo_rent" class="table table-bordered table-striped">
                                <thead>
                                    
                                    <tr>
                                    <th style="text-align:center">No.</th>
                                        <th style="text-align:center">Vehical No.</th>
                                        <th style="text-align:center">Driver</th>
                                        <th style="text-align:center">Fill Date</th>
                                        <th style="text-align:center">Quantity</th>
                                        <th style="text-align:center">Fuel Amount</th>
                                        <th style="text-align:center">Km Read</th>
                                        <th style="text-align:center">Comment</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                    if (isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['vehicle'])) {


                      if (strtotime($_POST['from_date']) <= strtotime($_POST['to_date'])) {
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        if($_POST['vehicle'] == "0"){
                          $query = "SELECT * FROM fuel WHERE f_filldate BETWEEN '$from_date' AND '$to_date' order by f_filldate ";
                        }
                        else{
                          $sid = $_POST['vehicle'];
                          $query = "SELECT * FROM fuel WHERE id='$sid' AND f_filldate BETWEEN '$from_date' AND '$to_date' order by f_filldate";
                        }
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                            $id = $row['id'];
                        $sql = "SELECT reg_no FROM vehicle WHERE id='$id'";
                        $res = mysqli_query($con,$sql);
                        $fetch = mysqli_fetch_assoc($res);
                          
                    ?>
                                    <tr>
                                    <td>
                                                        <?php echo $row['f_id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $fetch['reg_no']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['f_driver']; ?>
                                                    </td>
                                                    <td>
                                                        <?php $fill_dt = date("d-m-Y", strtotime($row['f_filldate']));
                                            echo $fill_dt; ?>
                                                    </td>
                                                    <td><font color="red">
                                                        <?php echo $row['f_quantity']; ?></font>
                                                    </td>
                                                    <td><font color="green">
                                                        <?php echo $row['f_price']; ?></font>
                                                    </td>                                 
                                                    <td>
                                                        <?php echo $row['f_odm']; ?>
                                                    </td>     
                                                    <td>
                                                        <?php echo $row['f_comments']; ?>
                                                    </td>
                                                   


                                    </tr>
                                    <?php
                                        }
                                    }
                                    } else {
                                    ?>
                                    <tr>
                                        <td>No record Found</td>
                                    </tr>
                                    <?php
                                    }
                                    
                                    ?>


                                </tbody>
                                
                            </table>
                                  </div>
                           <?php
                    }
                
              ?>
                        </div>
                    </div>
                </div>
    </section>
</div>
    </body>
</html>


<?php include('includes/footer.php'); ?>

<script>
    $(document).ready(function () {
      $('#expo_rent').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>
  