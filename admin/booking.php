<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<div class="content-wrapper">

<!-- Delete Modal start -->
<div class="modal fade" id="deleteBookingModal" tabindex="-1" role="dialog" aria-labelledby="deleteBookingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteBookingModalLabel">Booking data Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="b_id" id="b_id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="book_delete_btn" class="btn btn-danger">Yes.! Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Delete End modal-->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Booking</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <?php

if (isset($_SESSION['status'])) {
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Booking</strong>
    <?php echo $_SESSION['status']; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
  unset($_SESSION['status']);

}

?>
<?php

if (isset($_SESSION['w_status'])) {
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Booking</strong>
    <?php echo $_SESSION['w_status']; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
  unset($_SESSION['w_status']);

}

?>
            <div class="col-md-12">
                <div class="card">
                    
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th hidden>Id.</th>
                                    <th>S.No</th>
                                    <th>Invoice No</th>
                                    <th>Name</th>
                                    <th>Trip Satrt Date</th>
                                    <th>Total Days</th>
                                    <th>Bus Type</th>
                                    <th>Route</th>
                                    <th>Price</th>
                                    <th>Deposite</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    $query = "SELECT * FROM booking";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                    ?>
                            
                               
                  <tr>
                    <td class="b_id" hidden>
                        <?php echo $row['b_id']; ?>
                      </td>
                      <td><?php echo $count; $count++;?></td>

                    <td>
                    <a href="booking_view.php?b_id=<?php echo $row['b_id']; ?>" ><?php echo $row['b_invoice']; ?></a>
                    </td>
                    <td>
                      <?php echo $row['b_name']; ?>
                    </td>
                    <td>
                      <?php
                      $booking_dt = date("d-m-Y", strtotime($row['b_trip_start']));
                      echo $booking_dt; ?>
                    </td>
                    <td>
                      <?php echo $row['b_total_days']; ?>
                    </td>
                    <td>
                      <?php echo $row['b_type']; ?>
                    </td>
                    <td>
                      <?php echo $row['b_route']; ?>
                    </td>
                    <td>
                      <?php echo $row['b_price']; ?>
                    </td>
                    <td>
                      <?php echo $row['b_deposite']; ?>
                    </td>
                    <td>
                    <?php 
                      if($row['b_status']=="0"){
                        echo "<span class='badge badge-danger'>UNPAID</span>";
                      }elseif($row['b_status']=="1"){
                        echo "<span class='badge badge-warning'>PARTIALLY PAID</span>";
                      }elseif($row['b_status']=="2"){
                        echo "<span class='badge badge-success'>FULLY PAID</span>";
                      } ?>
                      </td>
                    <td>
                    <a href="bills.php?b_id=<?php echo $row['b_id']; ?>" class="badge badge-info"><i class="fas fa-print"></i></a>&nbsp;|
                    <a href="booking_detail.php?b_id=<?php echo $row['b_id']; ?>" class="badge badge-success"><i class="fas fa-rupee-sign"></i></a>&nbsp;|
                    <a href="#" class="badge badge-danger book_delete_btn"><i class="fa fa-trash-alt"></i></a>
                      </td>
                                </tr>
                                <?php
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
<?php include('includes/script.php'); ?>

<?php
include('includes/footer.php');
?>

<script type ="text/javascript">
  $(document).ready(function () {

    $(document).on ("click",".book_delete_btn",function (e) {
      e.preventDefault();

      var id = $(this).closest('tr').find('.b_id').text();
      //console.log(id);
      $('#b_id').val(id);
      $('#deleteBookingModal').modal('show');
    });
  });
    </script>