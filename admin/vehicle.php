<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<div class="content-wrapper">
<!-- Delete Modal start -->
<div class="modal fade" id="deleteVehicleModal" tabindex="-1" role="dialog" aria-labelledby="deleteVehicleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteVehicleModalLabel">Vehicle Delete Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id" id="delete_id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_vehicle_btn" class="btn btn-danger">Yes.! Delete</button>
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
                    <h3 class="m-0 text-dark">Vehicle's Management</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Vehicle List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
 
    <div class="container-fluid">
    <?php

if (isset($_SESSION['status'])) {
?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Vehicle</strong>
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
              <strong>Vehicle</strong>
              <?php echo $_SESSION['w_status']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
  unset($_SESSION['w_status']);

}

?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Types Of Vehicle List</h3>
                        <a href="addvehicle.php" class="btn btn-outline-info float-right">Vehicle Add</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th hidden>ID</th>
                                  <th>S.No</th>
                                    <th>Vehicle No</th>
                                    <th>Type</th>
                                    <th>Register</th>
                                    <th>Permit Ex</th>
                                    <th>Fitness Ex</th>
                                    <th>Insurance Ex </th>
                                    <th>Puc Ex</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    
                    $query = " SELECT * FROM vehicle";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                    ?>           
                  <tr>
                  <td class="id" hidden>
                          <?php echo $row['id'];?>
                        </td>
                        <td><?php echo $count; $count++;?></td>
                    <td> 
                    <b><?php echo $row['reg_no']; ?></b>
                    </td>
                    <td>
                    <?php echo $row['seat']; ?>

                    </td>
                    <td>
                    <?php
                      $booking_dt = date("d-m-Y", strtotime($row['reg_dt']));
                      echo $booking_dt; ?>
                                          </td>
                    <td>
                    <?php
                      $booking_dt = date("d-m-Y", strtotime($row['per_dt']));
                      echo $booking_dt; ?>                    </td>
                    <td>
                    <?php
                      $booking_dt = date("d-m-Y", strtotime($row['fit_dt']));
                      echo $booking_dt; ?>                    </td>
                    <td>
                    <?php
                      $booking_dt = date("d-m-Y", strtotime($row['ins_dt']));
                      echo $booking_dt; ?>                    </td>
                    <td>
                    <?php
                      $booking_dt = date("d-m-Y", strtotime($row['puc_dt']));
                      echo $booking_dt; ?>
                    </td>
                    <td>
                    <?php 
                      if($row['v_status']=="1"){
                        echo "<span class='badge badge-success'>Active</span>";
                      }elseif($row['v_status']=="0"){
                        echo "<span class='badge badge-danger'>Inactive</span>";
                      } ?>
                      </td>
                    <td>
                    <a href="vehicle_view.php?id=<?php echo $row['id']; ?>" ><i class="fa fa-eye"></i></a>&nbsp; |&nbsp;
                    <a href="#" class="badge badge-danger delete_vehicle_btn"><i class="fa fa-trash-alt"></i></a>
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
</div>
<?php include('includes/script.php'); ?>

<?php
include('includes/footer.php');
?>

<script>
  $(document).ready(function () {

    $('.delete_vehicle_btn').click(function (e) {
      e.preventDefault();

      var id = $(this).closest('tr').find('.id').text();
      //console.log(id);
      $('#delete_id').val(id);
      $('#deleteVehicleModal').modal('show');
    });
  });

  </script>