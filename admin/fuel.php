<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<div class="content-wrapper">

<!-- Delete Modal start -->
<div class="modal fade" id="deleteFuelModal" tabindex="-1" role="dialog" aria-labelledby="deleteFuelModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteFuelModalLabel">Fuel data Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="f_id" id="f_id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="fuel_delete_btn" class="btn btn-danger">Yes.! Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Delete End modal-->
   <!-- Edit Modal -->
   <div class="modal fade" id="editFuelModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFuelModalLabel">Fuel Edit Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
          
            <div class="row">
              <input type="hidden" name="edit_f_id" id="edit_f_id" value="" readonly>
              <div class="col-sm-6 col-md-3">
              <label class="form-label">Vechicle<span class="form-required">*</span></label>
              <div class="form-group">

              
           <input type="text" name="id" value="" id="edit_id" class="form-control" readonly>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Added Driver<span class="form-required">*</span></label>
                <select id="edit_f_driver" required="true" class="form-control selectized" name="f_driver">
                  <option value="" selected hidden>Select Driver</option>
                  <?php 
                  $select_v=("SELECT `d_name` FROM driver");
                  $query_run = mysqli_query($con,$select_v);

                  while($row=mysqli_fetch_array($query_run))
                  {
                      $inv=$row['d_name'];
          ?>
          <option><?php echo $inv; ?> </option>
          <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Fill Date<span class="form-required">*</span></label>
                <input type="date" required="true" class="form-control datepicker"
                  name="f_filldate" id="edit_f_filldate" placeholder="Fuel Fill Date">

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Quantity<span class="form-required">*</span></label>
                <input type="text" class="form-control" id="edit_f_quantity" name="f_quantity"
                  placeholder="Quantity" step="any" maxlength="6" pattern="^[0-9]+\.?[0-9]{0,2}$" required>

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Odometer Reading<span class="form-required">*</span></label>
                <input type="tel" class="form-control" id="edit_f_odm" name="f_odm" 
                  placeholder="Odometer Reading" pattern="[0-9]+" maxlength="8" required>

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Amount<span class="form-required">*</span></label>
                <input type="tel" class="form-control" id="edit_f_price" name="f_price"
                  placeholder="Amount" maxlength="12" pattern="^[0-9]+\.?[0-9]{0,2}$" required>
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Comment</label>
                <input type="text" class="form-control" id="edit_f_comments" name="f_comments"
                  placeholder="Fuel Comments">
              </div>
            </div>
          </div>

            <div class="modal-footer">
              <button type="button" name="close" class="btn btn-secondary" data-dismiss="modal"> Close</button>
              <button type="submit" name="fuel_update_btn" class="btn btn-success">Update</button>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit End Modal -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Fuel List</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Fuel List</li>
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
    <strong>Fuel</strong>
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
    <strong>Fuel</strong>
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
                        <h3 class="card-title">Fuel Data</h3>
                        <a href="fuel_add.php" class="btn btn-outline-info float-right">Fuel Add</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th hidden>Id.</th>
                                    <th>S.No</th>
                                    <th>Vehicle No</th>
                                    <th>Driver</th>
                                    <th>Fill Date</th>
                                    <th>Quantity</th>
                                    <th>Odometer</th>
                                    <th>Fuel Price</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    
                    $query = " SELECT * FROM fuel ORDER BY f_filldate";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                        $id = $row['id'];
                        $sql = "SELECT reg_no FROM vehicle WHERE id='$id'";
                        $res = mysqli_query($con,$sql);
                        $fetch = mysqli_fetch_assoc($res);

                        ?>
                            
                               
                  <tr >
                    <td class="f_id" hidden>
                        <?php echo $row['f_id']; ?>
                      </td>
                      <td><?php echo $count; $count++;?></td>

                    <td>
                      
                    <?php echo $fetch['reg_no']; ?>
                    </td>
                    <td>
                      <?php echo $row['f_driver']; ?>
                    </td>
                    <td>
                      <?php
                      $booking_dt = date("d-m-Y", strtotime($row['f_filldate']));
                      echo $booking_dt; ?>
                    </td>
                    <td>
                      <?php echo $row['f_quantity']; ?>
                    </td>
                    <td>
                      <?php echo $row['f_odm']; ?>
                    </td>
                    <td>
                      <?php echo $row['f_price']; ?>
                    </td>
                    <td>
                      <?php echo $row['f_comments']; ?>
                    </td>
                    <td>
                    <a href="#" class="badge badge-info fuel_edit_btn"><i class="fa fa-edit"></i></a>&nbsp;|
                          <a href="#" class="badge badge-danger fuel_delete_btn"><i class="fa fa-trash-alt"></i></a>
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
<script type ="text/javascript">
  $(document).ready(function () {

    $(document).on ("click",".fuel_delete_btn",function (e) {
      e.preventDefault();

      var id = $(this).closest('tr').find('.f_id').text();
      //console.log(id);
      $('#f_id').val(id);
      $('#deleteFuelModal').modal('show');
    });

    $(document).on("click",".fuel_edit_btn",function (e) {
      e.preventDefault();
      var id = $(this).closest('tr').find('.f_id').text();
       //console.log(id);
      //alert('hello');

      $.ajax({
        type: "POST",
        url: "database.php",
        data: {
          'checking_editfuel_btn': true,
          'fuel_id': id,

        },
        success: function (response) {
          //console.log(response);
          $.each(response, function (key, value) {
            //console.log(value['d_name']);
            $('#edit_f_id').val(value['f_id']);
            $('#edit_id').val(value['id']);
            $('#edit_f_driver').val(value['f_driver']);
            $('#edit_f_filldate').val(value['f_filldate']);
            $('#edit_f_quantity').val(value['f_quantity']);
            $('#edit_f_odm').val(value['f_odm']);
            $('#edit_f_price').val(value['f_price']);
            $('#edit_f_comments').val(value['f_comments']);
            

          });

          $('#editFuelModal').modal('show');
        }

      });

    });
    
   
  });

  </script>