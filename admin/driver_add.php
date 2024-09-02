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
            <h1 class="m-0 text-dark">Add Driver
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="driver.php">Driver</a></li>
              <li class="breadcrumb-item active">Add Driver</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form method="POST" id="add_driver" class="card" action="database.php" enctype="multipart/form-data" autocomplete="off">
                <div class="card-body">

                  
                  <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <label class="form-label">Driver Name<span class="form-required">*</span></label>
                      <div class="form-group">
                        <input type="text" name="d_name" id="d_name" maxlength="16" class="form-control" placeholder="Driver Name"  >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Mobile<span class="form-required">*</span></label>
                        <input type="tel" name="d_mobile" maxlength="10" class="form-control" placeholder="Mobile" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Age<span class="form-required">*</span></label>
                        <input type="tel" name="d_age" maxlength="2"  class="form-control" placeholder="Age" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">License No<span class="form-required">*</span></label>
                        <input type="text" name="d_licenseno" class="form-control" maxlength="14" placeholder="License No" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">License Expiry Date<span class="form-required">*</span></label>
                        <input type="date" name="d_license_expdate" class="form-control datepickerpastdisable" placeholder="License Expiry Date" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Aadhar Card No.</label>
                        <input type="text" maxlength="12" name="d_aadharno" class="form-control" placeholder="Aadharcard No" >
                      </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                        <label class="form-label">Total Experiance<span class="form-required">*</span></label>
                        <input type="tel" maxlength="2" name="d_total_exp" class="form-control" placeholder="Total Experiance" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                        <label class="form-label">Date of Joining<span class="form-required">*</span></label>
                        <input type="date" name="d_doj"  class="form-control datepicker" placeholder="Date of Joining" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                        <label class="form-label">Reference/Notes</label>
                        <input type="text" name="d_ref" maxlength="18" class="form-control" placeholder="Reference or Notes" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                        <label class="form-label">Address<span class="form-required">*</span></label>
                        <textarea class="form-control" autocomplete="off" placeholder="Address"  name="d_address"></textarea>
                        
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                        <label class="form-label">Upload Licence<span class="form-required">*</span></label>
                        <input type="file" name="d_licence_doc"  class="form-control" placeholder="Upload Licence" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                        <label class="form-label">Upload Address Proof</label>
                        <input type="file" name="d_address_doc"  class="form-control" placeholder="Upload Address Proof" >
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label for="d_is_active" class="form-label">Driver Status</label>
                        <select id="d_is_active" name="d_status" class="form-control " required="">
                          <option value="" hidden>Select Driver Status</option> 
                          <option value="1">Active</option> 
                          <option value="0">Inactive</option> 
                        </select>
                      </div>
                    </div>
                    </div>
      
                </div>
                  
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary" name="driver_btn">Add Driver</button>
                </div>
              </form>
             </div>
    </section>
</div>
    <!-- /.content -->
    <?php include('includes/script.php'); ?>

    <?php
include('includes/footer.php');
?>



