<?php
session_start();
include('includes/header.php');
if(isset($_SESSION['auth']))
{
    $_SESSION['status'] = "You are already logged In";
    header('Location: index.php');
    exit(0);
}
?>
<html>
    <head>
    
</head>
    <body>
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
            <?php
if(isset($_SESSION['w_status']))
{
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hey!</strong> <?php echo $_SESSION['w_status']; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    
<?php
    unset($_SESSION['w_status']);
}
?>
<?php
if(isset($_SESSION['status']))
{
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    
<?php
    unset($_SESSION['status']);
}
?>

<?php
$rand = rand(9999,1000);
?>
                <div class="card my-5">
                    <div class="card-header bg-light">
                    <h5 align="center"><img src="assets/dist/img/bus_logo.png" height="40px" width="40px" alt="Logo" >Travel Management System</h5>
                    </div>
                    <div class="card-body">
                    
                        <form action="login_code.php" method="POST">
                            <div class="form-group">
                            <i class="fas fa-envelope"></i>
                                <label for="">Email Id</label>
                                <input type="email" name="email" class="form-control" placeholder="abcde123@xyz.com" required>
                            </div>
                            <div class="form-group">
                            <i class="fas fa-lock"></i>
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="password" autocomplete="off" required>
                            </div>
                            <input type="datetime-local" name="last_time" class="form_control" hidden>
                            <hr>
                            <div class="form-group">
                                <button type="submit" name="login_btn" class="btn btn-primary btn-block">Login</button>
    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php include('includes/script.php'); ?>

<?php include('includes/footer.php'); ?>
