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
            <h3 class="m-0 text-dark">User Update</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
<div class="container-fluid">
<div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="row">


                <form action="database.php" method="POST">
          <div class="modal-body">
          <?php
        if(isset($_GET['e_id']))
        {
            $id=$_GET['e_id'];
            $query="SELECT * FROM employee WHERE e_id='$id' LIMIT 1";
            $query_run = mysqli_query($con,$query);

            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    ?>
                    <input type="text" name="e_id" value="<?php echo $row['e_id'] ?> " readonly>
            <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <div class="form-group">
                                <label>Employee Name *</lable>
                                <input type="text" name="emp_name" value="<?php echo $row['e_name']?>" maxlength="30" class="form-control" placeholder="Employee Name" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile No *</lable>
                                <input type="tel" name="emp_mobile" value="<?php echo $row['e_mobile']?>" maxlength="10" class="form-control" placeholder="Mobile Number" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email Id *</lable>
                                <input type="text" name="emp_email" class="form-control" value="<?php echo $row['e_email']?>" placeholder="Email Id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Username </lable>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['e_username']?>" autocomplete="off" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password *</lable>
                                <input type="password" name="password" class="form-control" value="<?php echo $row['e_password']?>" placeholder="Password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Confirm Password *</lable>
                                <input type="password" name="confirmpassword" class="form-control" value="<?php echo $row['e_con_password']?>" placeholder="Confirm Password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Role *</lable>
                                <select name="role" id="role" required="true" class="form-control">
                                <option value="" selected hidden>Select Role</option>    
                                <option value="0"  <?php if ($row["e_role"] == '0') {
            echo "selected";}?>>Employee</option>
                                    <option value="1"  <?php if ($row["e_role"] == '1') {
            echo "selected";}?>>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status *</lable>
                                <select name="emp_status" id="emp_status" required="true" class="form-control">
                                    <option value="" selected hidden>Select Status</option>
                                    <option value="0"  <?php if ($row["e_status"] == '0') {
            echo "selected";}?>>Active</option>
                                    <option value="1"  <?php if ($row["e_status"] == '1') {
            echo "selected";}?>>InActive</option>
                                </select>
                            </div>
                        </div>
                        <?php
                }
            }
            else{
                echo "no record found";
            }
        }
        ?>
                        <div class="col-md-12">
                        <div class="modal-footer">

                        <button type="submit" name="emp_upd_btn" class="btn btn-primary">Update</button>
                    </div>
                                            </div>
</div>
          </div>
        </form>
</div>

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