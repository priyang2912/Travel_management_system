<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Maintenance Add
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="maintanance.php">Maintenace</a></li>
            <li class="breadcrumb-item active">Add Maintenance</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 
  <!-- Main content -->
  <section class="content">
  <?php

if (isset($_SESSION['status'])) {
?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Maintanance </strong>
              <?php echo $_SESSION['status']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
  unset($_SESSION['status']);

}

?>
    <div class="container-fluid">
      
      <form method="POST" id="maintanance" class="card" action="database" enctype="multipart/form-data" autocomplete="off">
        <div class="card-body">

          <div class="row">
            <div class="col-sm-6 col-md-2">
            
              <label class="form-label">Vechicle<span class="form-required">*</span></label>
              <div class="form-group">
                <select id="vehicle" class="form-control selectized" name="vehicle" required="true">
                  <option value="" selected hidden>Select Vechicle</option>
                  <?php 
                  $select_v=("SELECT * FROM vehicle");
                  $query_run = mysqli_query($con,$select_v);

                  while($row=mysqli_fetch_array($query_run))
                  {
          ?>
          <option value="<?php echo $row['id'] ?>"> <?php echo $row['reg_no']; ?> </option>
          <?php } ?>
                  

                </select>
              </div>
            </div>
            <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Repair Date *</label>
                                <input type="date" name="rep_date" class="form-control" required>
                            </div>
                        </div>
            
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Material</label>
                                <input type="text" name="material" maxlength="100" class="form-control"
                                    placeholder="Material Name" />
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="number" name="qut" max="90" min="0"
                                    class="form-control" placeholder="1" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Store/vendor Name</label>
                                <input type="text" name="vendor" maxlength="70" class="form-control"
                                    placeholder="Vendor Name" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Description *</label>
                                <input type="text" name="part" maxlength="100"
                                    class="form-control" placeholder="Service Description" >
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Mechanic Name *</label>
                                <input type="text" name="mechanic" maxlength="70" class="form-control"
                                    placeholder="Mechanic Name" required />
                            </div>
                        </div>
                                   
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Labor Charge *</label>
                                <input type="text" name="charge" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="[0-9]+(\\.[0-9][0-9]?)?" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Bill No</label>
                                <input type="text" name="bill_no" maxlength="60"
                                    class="form-control" placeholder="Bill NO" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Material Price</label>
                                <input type="text" name="material_price" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                            </div>
                        </div>
                   
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Total Amount *</label>
                                <input type="text" name="total_amount" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="[0-9]+(\\.[0-9][0-9]?)?" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                        <label class="form-label">Upload Bill</label>
                        <input type="file" name="m_bill_doc" id="m_bill_doc"  class="form-control" placeholder="Upload Bill" >
                      </div>
                    </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Odometer</label>
                                <input type="tel" name="odm" maxlength="8" min="0" class="form-control"
                                    placeholder="455678">
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="">Payment</label></br>
                <select id="m_status" name="m_status" class="form-control" require="true" onchange="changeDropdown(this.value);">
                <option value="none" selected disabled hidden>Select</option>
                  <option value="0">Paid</option>
                  <option value="1">Due Payment</option>
                </select>
              </div>
                        <div class="col-md-2">
                            <div class="form-group" id="m_due_amounts">
                                <label for="p_due_amount">Due Payment</label>
                                <input type="text" name="m_due_amount" id="m_due_amount" maxlength="8" min="0" class="form-control"
                                    placeholder="1000.00"pattern="[0-9]+(\\.[0-9][0-9]?)?">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Payment Date *</label>
                                <input type="date" name="pay_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Comments</label>
                                <input type="text" name="comment" maxlength="200" class="form-control"
                                    placeholder="any">
                            </div>
                        </div>
          </div>
          <div class="modal-footer">
          <input type="reset" value="Reset" class="btn btn-danger" />
            <button type="submit" class="btn btn-primary" name="maintanance_add_btn">Add Maintanance</button>
          </div>
            </div>
      </form>
    </div>
  </section>
  <!-- /.content -->
</div>
<?php
include('includes/footer.php');
?>
    <?php include('includes/script.php'); ?>

<script>
function changeDropdown()
{
    var status=document.getElementById("m_status").value;
    if(status=="1" || status=="none"){
        document.getElementById("m_due_amounts").style.visibility='visible';
    }
    else{
        document.getElementById("m_due_amounts").style.visibility='hidden';

    }
}

    </script>

