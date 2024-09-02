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
          <h1 class="m-0 text-dark">Fuel Add
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="fuel.php">Fuel</a></li>
            <li class="breadcrumb-item active">Add Fuel</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form method="POST" id="fuel" class="card" action="database">
        <div class="card-body">

          <div class="row">
            <input type="hidden" name="fuel_id" id="fuel_id" value="">

            <div class="col-sm-6 col-md-3">
              <label class="form-label">Vechicle<span class="form-required">*</span></label>
              <div class="form-group">
                <select id="id" class="form-control selectized" name="id" required="true">
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
                <label class="form-label">Added Driver<span class="form-required">*</span></label>
                <select id="f_driver" required="true" class="form-control selectized" name="f_driver">
                  <option value="" selected hidden>Select Driver</option>
                  <?php 
                  $select_v=("SELECT `d_name` FROM driver WHERE d_status='1'");
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
                <input type="date" required="true" class="form-control datepicker" id="f_filldate"
                  name="f_filldate" value="" placeholder="Fuel Fill Date">

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Quantity<span class="form-required">*</span></label>
                <input type="text" class="form-control" id="f_quantity" name="f_quantity" value=""
                  placeholder="Quantity" step="any" maxlength="6" pattern="^[0-9]+\.?[0-9]{0,2}$" required>

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Odometer Reading<span class="form-required">*</span></label>
                <input type="tel" class="form-control" id="f_odm" name="f_odm" value=""
                  placeholder="Odometer Reading" maxlength="8" pattern="[0-9]+" required>

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Amount<span class="form-required">*</span></label>
                <input type="text" class="form-control" id="f_price" value="" name="f_price"
                  placeholder="Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?" maxlength="12" required>
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Comment</label>
                <input type="text" class="form-control" id="f_comments" value="" name="f_comments"
                  placeholder="Fuel Comments">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="fuel_add_btn">Add Fuel</button>
          </div>
            </div>
      </form>
    </div>
  </section>
  <!-- /.content -->
</div>
<?php include('includes/script.php'); ?>

<?php
include('includes/footer.php');
?>