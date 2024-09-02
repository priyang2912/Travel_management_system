<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<div class="content-wrapper">

<!-- Delete Modal start -->
<div class="modal fade" id="deleteEmpModal" tabindex="-1" role="dialog" aria-labelledby="deleteFuelModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteEmpModalLabel">User's Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="e_id" id="e_id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="emp_delete_btn" class="btn btn-danger">Yes.! Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Delete End modal-->
   <!-- Edit Modal -->
   <div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFuelModalLabel">Add User Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
          
            <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>Employee Name *</lable>
                                <input type="text" name="emp_name" maxlength="30" class="form-control" placeholder="Employee Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile No *</lable>
                                <input type="tel" name="emp_mobile" maxlength="10" class="form-control" placeholder="Mobile Number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email Id *</lable>
                                <input type="text" name="emp_email" class="form-control" placeholder="Email Id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Username </lable>
                                <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password *</lable>
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirm Password *</lable>
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Role *</lable>
                                <select name="role" id="role" required="true" class="form-control">
                                <option value="" selected hidden>Select Role</option>    
                                <option value="0">Employee</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status *</lable>
                                <select name="emp_status" id="emp_status" required="true" class="form-control">
                                    <option value="" selected hidden>Select Status</option>
                                    <option value="0">Active</option>
                                    <option value="1">InActive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                        <div class="modal-footer">
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>

                        <button type="submit" name="emp_add_btn" class="btn btn-primary">Submit</button>
                    </div>
                                            </div>
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
                    <h3 class="m-0 text-dark">User's List</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User's</li>
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
              <strong>Employee</strong>
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
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Employee</strong>
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
                        <h3 class="card-title">Employee Info</h3>
                        <a href="#" data-toggle="modal" data-target="#addform"
                                class="btn btn-primary float-right">Add Employee</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th hidden>Id.</th>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    
                    $query = " SELECT * FROM employee ";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                    ?>
                            
                               
                  <tr>
                    <td class="e_id" hidden>
                        <?php echo $row['e_id']; ?>
                      </td>
                      <td >
                        <?php echo $count; $count++; ?>
                      </td>
                    <td>
                      
                    <?php echo $row['e_name']; ?>
                    </td>
                    <td>
                      <?php echo $row['e_mobile']; ?>
                    </td>
                                        <td>
                      <?php echo $row['e_email']; ?>
                    </td>
                    <td>
                      <?php echo $row['e_username']; ?>
                    </td>
                    <td>
                      <?php echo $row['e_password']; ?>
                    </td>
                    <td>
                    <?php 
                      if($row['e_role']=="1"){
                        echo "<span class='badge badge-primary'>Admin</span>";
                      }elseif($row['e_role']=="0"){
                        echo "<span class='badge badge-warning'>Employee</span>";
                      } ?>                    </td>
                    <td>
                    <?php 
                      if($row['e_status']=="0"){
                        echo "<span class='badge badge-success'>Active</span>";
                      }elseif($row['e_status']=="1"){
                        echo "<span class='badge badge-danger'>Inactive</span>";
                      } ?>
                    </td>
                    <td>
                    <a href="employee_edit.php?e_id=<?php echo $row['e_id']; ?>" class="badge badge-info"><i class="fa fa-edit"></i></a>&nbsp;|
                          <a href="#" class="badge badge-danger emp_delete_btn"><i class="fa fa-trash-alt"></i></a>
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

    $('.emp_delete_btn').click(function (e) {
      e.preventDefault();

      var id = $(this).closest('tr').find('.e_id').text();
      //console.log(id);
      $('#e_id').val(id);
      $('#deleteEmpModal').modal('show');
    });
   
  });

  </script>