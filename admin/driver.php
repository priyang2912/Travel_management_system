<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<html>

<head>

</head>

<body>
<div class="content-wrapper">

  <!-- Edit Modal -->
  <div class="modal fade" id="editDriverModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDriverModalLabel">Driver Edit Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="row">
              <input type="hidden" name="edit_id" id="edit_id">
              <input type="hidden" name="edit_oldlic_doc" id="edit_oldlic_doc">
              <input type="hidden" name="edit_oldadd_doc" id="edit_oldadd_doc">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Driver Name *</label>
                  <input type="text" name="d_name" id="edit_name" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Mobile *</label>
                  <input type="tel" maxlength="10" name="mobile" id="edit_mobile" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Age *</label>
                  <input type="text" maxlength="2" name="age" id="edit_age" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">License No *</label>
                  <input type="text" maxlength="16" name="license" id="edit_license" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">License Expir Date *</label>
                  <input type="date" name="exp_dt" id="edit_exp_dt" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Aadharcard No *</label>
                  <input type="text" maxlength="14" name="aadharno" id="edit_aadharno" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Total Experience *</label>
                  <input type="number" maxlength="2" name="total_exp" id="edit_total_exp" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Date Of Joining *</label>
                  <input type="date" name="doj" id="edit_doj" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Reference *</label>
                  <input type="text" name="ref" id="edit_ref" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Address </lable>
                    <textarea class="form-control" autocomplete="off" placeholder="Address" id="edit_address"
                      name="address"></textarea>
                </div>
              </div>
              <div class="col-md-4">
                            <div class="form-group">
                                <label>License Document </lable>
                                <input type="file" name="lic_doc" id="edit_lic_doc" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address Document </lable>
                                <input type="file" name="add_doc" id="edit_add_doc" class="form-control">
                            </div>
                        </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status</lable>&nbsp;
                    <select id="edit_status" name="d_status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                </div>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" name="close" class="btn btn-secondary" data-dismiss="modal"> Close</button>
              <button type="submit" name="driver_update_btn" class="btn btn-success">Update</button>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit End Modal -->

  <!-- View Modal -->
  <div class="modal fade" id="driverVIEWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Driver Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="driver_viewing_data">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!--View Modal end -->
  <!-- Delete Modal start -->
  <div class="modal fade" id="deleteDriverModal" tabindex="-1" role="dialog" aria-labelledby="deleteDriverModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteDriverModalLabel">Driver Delete Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="d_id" id="delete_id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_driver" class="btn btn-danger">Yes.! Delete</button>
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
            <h1 class="m-0 text-dark">Driver Info
            </h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Driver Info</li>
            </ol>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <?php

if (isset($_SESSION['status'])) {
?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Driver</strong>
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
              <strong>Driver</strong>
              <?php echo $_SESSION['w_status']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
  unset($_SESSION['w_status']);

}

?>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table card-table table-vcenter text-nowrap">
                <thead>
                  <tr>
                    <th hidden>Id</th>
                    <th class="w-1">S.No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>License No</th>
                    <th>License Exp Date</th>
                    <th>Date of Joining</th>
                    <th>Status</th>
                    <th>Is Active</th>

                  </tr>
                </thead>
                <tbody>
                  <?php

                  $query = "SELECT * FROM driver ";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    $count=1;
                    foreach ($query_run as $row) {
                      //echo $row['name'];
                      ?>

                      <tr>
                        <td class="d_id" hidden>
                          <?php echo $row['d_id']; ?>
                        </td>
                        <td><?php echo $count; $count++;?></td>

                        <td>
                          <?php echo $row['d_name']; ?>
                        </td>
                        <td>
                          <?php echo $row['d_mobile']; ?>
                        </td>
                        <td>
                          <?php echo $row['d_licenceno']; ?>
                        </td>
                        <td>
                          <?php $lic_dt = date("d-m-Y", strtotime($row['d_licence_expdate']));
                                            echo $lic_dt; ?>
                        </td>
                        <td>
                          <?php $doj = date("d-m-Y", strtotime($row['d_doj']));
                                            echo $doj; ?>
                        </td>
                        <td>
                          <?php
                          if ($row['d_status'] == "1") {
                            echo "<span class='badge badge-success'>Active</span>";
                          } else {
                            echo "<span class='badge badge-danger'>Inactive</span>";
                          }
                          ?>
                        </td>
                        <td>
                          <a href="#" class="badge badge-primary view_btn"><i class="fa fa-eye"></i></a> &nbsp;|
                          <a href="#" class="badge badge-info edit_btn"><i class="fa fa-edit"></i></a>&nbsp;|
                          <a href="#" class="badge badge-danger delete_btn"><i class="fa fa-trash-alt"></i></a>
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
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </section>
  </div>

  <!-- /.content -->

  <body>

</html>
<?php include('includes/script.php'); ?>

<?php
include('includes/footer.php');
?>


<script>
  $(document).ready(function () {

    $('.delete_btn').click(function (e) {
      e.preventDefault();

      var d_id = $(this).closest('tr').find('.d_id').text();
      //console.log(d_id);
      $('#delete_id').val(d_id);
      $('#deleteDriverModal').modal('show');
    });

    $('.edit_btn').click(function (e) {
      e.preventDefault();
      var d_id = $(this).closest('tr').find('.d_id').text();
      // console.log(d_id);
      //alert('hello');

      $.ajax({
        type: "POST",
        url: "database.php",
        data: {
          'checking_edit_btn': true,
          'driver_id': d_id,

        },
        success: function (response) {
          //console.log(response);
          $.each(response, function (key, value) {
            //console.log(value['d_name']);
            $('#edit_id').val(value['d_id']);
            $('#edit_name').val(value['d_name']);
            $('#edit_mobile').val(value['d_mobile']);
            $('#edit_age').val(value['d_age']);
            $('#edit_license').val(value['d_licenceno']);
            $('#edit_exp_dt').val(value['d_licence_expdate']);
            $('#edit_aadharno').val(value['d_aadharno']);
            $('#edit_total_exp').val(value['d_total_exp']);
            $('#edit_doj').val(value['d_doj']);
            $('#edit_ref').val(value['d_ref']);
            $('#edit_address').val(value['d_address']);
            $('#edit_oldlic_doc').val(value['d_licence_doc']);
            $('#edit_oldadd_doc').val(value['d_address_doc']);
            $('#edit_status').val(value['d_status']);

          });

          $('#editDriverModal').modal('show');
        }

      });

    });


    $('.view_btn').click(function (e) {
      e.preventDefault();
      var d_id = $(this).closest('tr').find('.d_id').text();
      //console.log(d_id);
      //alert('hello');

      $.ajax({
        type: "POST",
        url: "database.php",
        data: {
          'checking_viewbtn': true,
          'driver_id': d_id,
        },
        success: function (response) {
          //console.log(response);
          $('.driver_viewing_data').html(response);
          $('#driverVIEWModal').modal('show');
        }

      });

    });
  });
</script>