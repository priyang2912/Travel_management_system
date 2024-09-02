<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<div class="content-wrapper">

   <!-- Edit Modal -->
   <div class="modal fade" id="editIncomeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editIncomeModalLabel">Income/Expence Edit Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST" >
          <div class="modal-body">
          
            <div class="row">
              <input type="hidden" name="edit_i_id" id="edit_i_id" value="" readonly>

            <div class="col-sm-6 col-md-3">
              <label class="form-label">Vechicle<span class="form-required">*</span></label>
              <div class="form-group">
                <select id="edit_v_id" class="form-control selectized" name="v_id" required="true">
                  <option value="" selected hidden>Select Vechicle</option>
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
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Type<span class="form-required">*</span></label>
                <select id="edit_type" required="true" class="form-control selectized" name="type">
                  <option value="" selected hidden>Select Type</option>
          <option value="0">Income</option>
          <option value="1">Expence</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Date<span class="form-required">*</span></label>
                <input type="date" required="true" class="form-control datepicker" id="edit_i_date"
                  name="i_date" value="">

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Amount<span class="form-required">*</span></label>
                <input type="text" class="form-control" id="edit_i_amount" name="i_amount"
                  placeholder="Amount" pattern="^[0-9]+\.?[0-9]{0,2}$" maxlength="12" required>
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" id="edit_i_comments" name="i_comments"
                  placeholder="Discription">
              </div>
            </div>
          </div>

            <div class="modal-footer">
              <button type="button" name="close" class="btn btn-secondary" data-dismiss="modal"> Close</button>
              <button type="submit" name="income_update_btn" class="btn btn-success">Update</button>

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
                    <h3 class="m-0 text-dark">Income/ Expense List</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Income & Expenses</li>
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
    <strong>Income/ Expence</strong>
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
    <strong>Income/ Expence</strong>
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
                        <h3 class="card-title"></h3>
                        <a href="addincomeexpence.php" class="btn btn-outline-info float-right">Add Income/Expence</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th hidden>Id.</th>
                                    <th>S.No</th>
                                    <th>Vehicle No</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    
                    $query = " SELECT * FROM income_expence";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                        $id = $row['v_id'];
                        $sql = "SELECT reg_no FROM vehicle WHERE id='$id'";
                        $res = mysqli_query($con,$sql);
                        $fetch = mysqli_fetch_assoc($res);
                        ?>
                            
                               
                  <tr >
                  <td class="i_id" hidden>
                        <?php echo $row['i_id']; ?>
                      </td>
                    <td >
                        <?php echo $count; $count++; ?>
                      </td>
                    
                    <td>
                      
                    <?php echo $fetch['reg_no']; ?>
                    </td>
                    <td>
                      <?php
                      $booking_dt = date("d-m-Y", strtotime($row['i_date']));
                      echo $booking_dt; ?>
                    </td>
                    <td>
                      <?php echo $row['i_description']; ?>
                    </td>
                    <td>
                      <?php echo $row['i_amount']; ?>
                    </td>
                    <td>
                    <?php 
                      if($row['i_type']=="0"){
                        echo "<span class='badge badge-success'>Income</span>";
                      }elseif($row['i_type']=="1"){
                        echo "<span class='badge badge-danger'>Expence</span>";
                      } ?>
                    </td>
                    <td>
                    <a href="#" class="badge badge-info income_edit_btn"><i class="fa fa-edit"></i></a>
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


    $(document).on("click",".income_edit_btn",function (e) {
      e.preventDefault();
      var id = $(this).closest('tr').find('.i_id').text();
       //console.log(id);
      //alert('hello');

      $.ajax({
        type: "POST",
        url: "database.php",
        data: {
          'checking_editincome_btn': true,
          'i_id': id,

        },
        success: function (response) {
          //console.log(response);
          $.each(response, function (key, value) {
            //console.log(value['d_name']);
            $('#edit_i_id').val(value['i_id']);
            $('#edit_v_id').val(value['v_id']);
            $('#edit_type').val(value['i_type']);
            $('#edit_i_date').val(value['i_date']);
            $('#edit_i_amount').val(value['i_amount']);
            $('#edit_i_comments').val(value['i_description']);
            
          });

          $('#editIncomeModal').modal('show');
        }

      });

    });
    
   
  });

  </script>