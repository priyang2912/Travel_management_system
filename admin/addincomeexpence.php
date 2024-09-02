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
          <h1 class="m-0 text-dark">Add Income/ Expense
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="income_expence.php">Income & Expense</a></li>
            <li class="breadcrumb-item active">Add income-Expense</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form method="POST" id="add_income_expence" class="card" action="database.php">
        <div class="card-body">

          <div class="row">

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
                <label class="form-label">Type<span class="form-required">*</span></label>
                <select id="type" required="true" class="form-control selectized" name="type">
                  <option value="" selected hidden>Select Type</option>
          <option value="0">Income</option>
          <option value="1">Expence</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Date<span class="form-required">*</span></label>
                <input type="date" required="true" class="form-control datepicker" id="i_date"
                  name="i_date" value="">

              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label class="form-label">Amount<span class="form-required">*</span></label>
                <input type="text" class="form-control" id="i_amount" name="i_amount"
                  placeholder="Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?" maxlength="12" required>
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="form-group">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" id="i_comments" name="i_comments"
                  placeholder="Discription">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="income_add_btn">Add Income/Expence</button>
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