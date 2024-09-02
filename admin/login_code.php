<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $e_last_time=$_POST['last_time'];

    $email = stripcslashes($email);
    $password = stripcslashes($password);
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    $log_query="SELECT * FROM employee WHERE e_status='0' AND e_email='$email' AND e_password='$password' LIMIT 1";
    $log_query_run = mysqli_query($con, $log_query);

    if(mysqli_num_rows($log_query_run)>0)
    {
        foreach($log_query_run as $row){
            $user_id = $row['e_id'];
            $user_name = $row['e_name'];
            $user_email = $row['e_email'];
            $user_mobile = $row['e_mobile'];

        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'user_email' => $user_email
        ];
        

        $_SESSION['status'] = "Loggged In Successfull";
        header('Location: index.php');
    }
    else{
        $_SESSION['w_status'] = "Invalid Email or Password";
        header('Location: login.php');
    }
    $tim="UPDATE employee SET e_last_time =now() WHERE e_id=".$_SESSION['e_id'];
    $qu=mysqli_query($con,$tim);
}
else{
    $_SESSION['w_status'] = "Access Denied";
    header('Location: login.php');
}

?>