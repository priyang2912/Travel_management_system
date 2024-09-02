<?php
session_start();
include('./config/dbcon.php');



if(isset($_POST['logout_btn']))
{
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status']="Logged Out Successfully";
    header('Location: login.php');
    exit(0);
}

/* Start Employee Add */
if(isset($_POST['emp_add_btn']))
{
    $name=$_POST['emp_name'];
    $mobile=$_POST['emp_mobile'];
    $email=$_POST['emp_email'];
    $usename=$_POST['username'];
    $pass=$_POST['password'];
    $com_pass=$_POST['confirmpassword'];
    $role=$_POST['role'];
    $emp_status=$_POST['emp_status'];
    

    if($pass == $com_pass)
    {
        $checkuser="SELECT e_username FROM employee WHERE e_username='$usename'";
        $checku=mysqli_query($con,$checkuser);
        if(mysqli_num_rows($checku)>0)
        {
            $_SESSION['w_status']="Username is Alreday Taken";
            header("Location: employee.php"); 
            exit;
        }

        $checkmail="SELECT e_email FROM employee WHERE e_email='$email'";
        $check=mysqli_query($con,$checkmail);
        if(mysqli_num_rows($check)>0)
        {
            $_SESSION['w_status']="Email is Alreday Taken";
            header("Location: employee.php"); 
            exit;
        }

        $emp="INSERT INTO `employee`( `e_name`, `e_mobile`, `e_email`, `e_username`, `e_password`, `e_con_password`, `e_role`, `e_status`) 
        VALUES('$name','$mobile','$email','$usename','$pass','$com_pass','$role','$emp_status') ";
    $query=mysqli_query($con,$emp);
        
            $_SESSION['status']="Added Successfully";
            header("Location: employee.php"); 
    }
    else{
        $_SESSION['w_status']="Password Not Matched";
            header("Location: employee.php");

    }
   
    
}

/*End Employee Add */

/* Start Update Employee */
if(isset($_POST['emp_upd_btn']))
{
    $id=$_POST['e_id'];
    $name=$_POST['emp_name'];
    $mobile=$_POST['emp_mobile'];
    $email=$_POST['emp_email'];
    $usename=$_POST['username'];
    $pass=$_POST['password'];
    $com_pass=$_POST['confirmpassword'];
    $role=$_POST['role'];
    $emp_status=$_POST['emp_status'];
    



    if($pass == $com_pass)
    {
       
    $upd="UPDATE `employee` SET `e_name`='$name',`e_mobile`='$mobile',`e_email`='$email',`e_username`='$usename',`e_password`='$pass',`e_con_password`='$com_pass',`e_role`='$role',`e_status`='$emp_status' WHERE e_id='$id'";

        $query=mysqli_query($con,$upd);    


    $_SESSION['status']="Update Successfully";
            header("Location: employee.php"); 
    }
    else{
        $_SESSION['w_status']="Password Not Matched";
            header("Location: employee.php");

    }
    

}

/* End Employee Update */

/* Start Delet Employee Form */
if (isset($_POST['emp_delete_btn'])) {
    $id = $_POST['e_id'];

    $query = "DELETE FROM `employee` WHERE e_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status']=" Not Deleted !Fail";
        header("Location: employee.php");
        

    } else {
        $_SESSION['status']="Deleted Successfully";
        header("Location: employee.php");
        
    }
}
/* End Delete Employee Form */



/* Vehicle Add Form*/

if (isset($_POST['addvehicle_btn'])) {

    $reg = $_POST['reg_no'];
    $type = $_POST['type'];
    $cha = $_POST['cha_no'];
    $eng = $_POST['eng_no'];
    $reg_dt = $_POST['reg_dt'];
    $per_dt = $_POST['per_dt'];
    $fit_dt = $_POST['fit_dt'];
    $ins_dt = $_POST['ins_dt'];
    $puc_dt = $_POST['puc_dt'];
    $status=$_POST['v_status'];
    $rc_doc = $_FILES['rc_doc']['name'];
    $rc_tmp = $_FILES['rc_doc']['tmp_name'];
    $fit_doc = $_FILES['fit_doc']['name'];
    $fit_tmp = $_FILES['fit_doc']['tmp_name'];
    $per_doc = $_FILES['per_doc']['name'];
    $per_tmp = $_FILES['per_doc']['tmp_name'];
    $ins_doc = $_FILES['ins_doc']['name'];
    $ins_tmp = $_FILES['ins_doc']['tmp_name'];
    $puc_doc = $_FILES['puc_doc']['name'];
    $puc_tmp = $_FILES['puc_doc']['tmp_name'];
    $data = [];
    $data = [$rc_doc];
    $data1 = [$fit_doc];
    $data2 = [$per_doc];
    $data3 = [$ins_doc];
    $data4 = [$puc_doc];
    $image = implode('', $data);
    $image1 = implode('', $data1);
    $image2 = implode('', $data2);
    $image3 = implode('', $data3);
    $image4 = implode('', $data4);



    $query = "INSERT INTO `vehicle`(`reg_no`, `seat`, `cha_no`, `eng_no`,`reg_dt`,`per_dt`,`fit_dt`,`ins_dt`,`puc_dt`,`rc_doc`,`fit_doc`,`per_doc`,`ins_doc`,`puc_doc`,`v_status`) 
    VALUES ('$reg','$type','$cha','$eng','$reg_dt','$per_dt','$fit_dt','$ins_dt','$puc_dt','$image','$image1','$image2','$image3','$image4','$status')";

    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Not Added !Fail" . mysqli_connect_error();
        header("Location: vehicle.php");

    } else {
        $location = "vehicle_doc/";
        move_uploaded_file($rc_tmp, "vehicle_doc/" . $rc_doc);
        move_uploaded_file($fit_tmp, "vehicle_doc/" . $fit_doc);
        move_uploaded_file($per_tmp, "vehicle_doc/" . $per_doc);
        move_uploaded_file($ins_tmp, "vehicle_doc/" . $ins_doc);
        move_uploaded_file($puc_tmp, "vehicle_doc/" . $puc_doc);
        $_SESSION['status'] = "Addes Successfully";
        header("Location:vehicle.php");
    }

}
/*---End Vehicle Add Form----*/

/*Vehicale Update Form*/
if (isset($_POST['vehicle_update_btn'])) {

    $id = $_POST['id'];
    $reg = $_POST['reg_no'];
    $type = $_POST['type'];
    $cha = $_POST['cha_no'];
    $eng = $_POST['eng_no'];
    $reg_dt = $_POST['reg_dt'];
    $per_dt = $_POST['per_dt'];
    $fit_dt = $_POST['fit_dt'];
    $ins_dt = $_POST['ins_dt'];
    $puc_dt = $_POST['puc_dt'];
    $status=$_POST['v_status'];
    $oldrc_doc = $_POST['old_rc_doc'];
    $rc_doc = $_FILES['rc_doc']['name'];
    $oldfit_doc = $_POST['old_fit_doc'];
    $fit_doc = $_FILES['fit_doc']['name'];
    $oldper_doc = $_POST['old_per_doc'];
    $per_doc = $_FILES['per_doc']['name'];
    $oldins_doc = $_POST['old_ins_doc'];
    $ins_doc = $_FILES['ins_doc']['name'];
    $oldpuc_doc = $_POST['old_puc_doc'];
    $puc_doc = $_FILES['puc_doc']['name'];


    if ($rc_doc == "") {
        $path1 = $oldrc_doc;
    } else {
        $path1 = $rc_doc;
        $tmp1 = $_FILES['rc_doc']['tmp_name'];
    }
    if ($fit_doc == "") {
        $path2 = $oldfit_doc;
    } else {
        $path2 = $fit_doc;
        $tmp2 = $_FILES['fit_doc']['tmp_name'];
    }
    if ($per_doc == "") {
        $path3 = $oldper_doc;
    } else {
        $path3 = $per_doc;
        $tmp3 = $_FILES['per_doc']['tmp_name'];
    }
    if ($ins_doc == "") {
        $path4 = $oldins_doc;
    } else {
        $path4 = $ins_doc;
        $tmp4 = $_FILES['ins_doc']['tmp_name'];
    }
    if ($puc_doc == "") {
        $path5 = $oldpuc_doc;
    } else {
        $path5 = $puc_doc;
        $tmp5 = $_FILES['puc_doc']['tmp_name'];
    }

    $update = "UPDATE `vehicle` SET `reg_no`='$reg', `seat`='$type', `cha_no`='$cha', `eng_no`='$eng',`reg_dt`='$reg_dt',`per_dt`='$per_dt',`fit_dt`='$fit_dt',`ins_dt`='$ins_dt',`puc_dt`='$puc_dt',`rc_doc`='$path1',`fit_doc`='$path2',`per_doc`='$path3',`ins_doc`='$path4',`puc_doc`='$path5',`v_status`='$status' WHERE id='$id' ";
    $update_run = mysqli_query($con, $update);

    if (!$update_run) {
        $_SESSION['w_status'] = "Not Updated !fail " . mysqli_connect_error();
        header("Location: vehicle_view.php?id=" . $id);
    } else {
        if ($rc_doc != "") {
            move_uploaded_file($tmp1, "vehicle_doc/" . $rc_doc);
        }
        if ($fit_doc != "") {
            move_uploaded_file($tmp2, "vehicle_doc/" . $fit_doc);
        }
        if ($per_doc != "") {
            move_uploaded_file($tmp3, "vehicle_doc/" . $per_doc);
        }
        if ($ins_doc != "") {
            move_uploaded_file($tmp4, "vehicle_doc/" . $ins_doc);
        }
        if ($puc_doc != "") {
            move_uploaded_file($tmp5, "vehicle_doc/" . $puc_doc);
        }
        $_SESSION['status'] = "Update Successfully.";
        header("Location: vehicle_view.php?id=" . $id);
    }
}

/*----------End Vehicle Update Form------------*/
/* Start Delet Vehicle Form */
if (isset($_POST['delete_vehicle_btn'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM `vehicle` WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Not Deleted !fail " . mysqli_connect_error();
        header("Location: vehicle.php");

    } else {
        $_SESSION['status'] = "Deleted Successfully.";
        header("Location: vehicle.php");
    }
}
/* End Delete Vehicle Form */

/* Driver Add Form */

if (isset($_POST['driver_btn'])) {

    $d_name = $_POST['d_name'];
    $d_mobile = $_POST['d_mobile'];
    $d_age = $_POST['d_age'];
    $d_licenceno = $_POST['d_licenseno'];
    $d_licence_expdate = $_POST['d_license_expdate'];
    $d_aadharno = $_POST['d_aadharno'];
    $d_total_exp = $_POST['d_total_exp'];
    $d_doj = $_POST['d_doj'];
    $d_ref = $_POST['d_ref'];
    $d_address = $_POST['d_address'];
    $d_licence_doc = $_POST['d_licence_doc'];
    $d_address_doc = $_POST['d_address_doc'];
    $d_status = $_POST['d_status'];

    $d_licence_doc = $_FILES['d_licence_doc']['name'];
    $lic_tmp = $_FILES['d_licence_doc']['tmp_name'];
    $d_address_doc = $_FILES['d_address_doc']['name'];
    $add_tmp = $_FILES['d_address_doc']['tmp_name'];

    $data = [];
    $data = [$d_licence_doc];
    $data1 = [$d_address_doc];

    $image = implode('', $data);
    $image1 = implode('', $data1);

    $query = "INSERT INTO `driver`(`d_name`,`d_mobile`,`d_age`,`d_licenceno`,`d_licence_expdate`,`d_aadharno`,`d_total_exp`,`d_doj`,`d_ref`,`d_address`,`d_licence_doc`,`d_address_doc`,`d_status`) 
    VALUES ('$d_name','$d_mobile','$d_age','$d_licenceno','$d_licence_expdate','$d_aadharno','$d_total_exp','$d_doj','$d_ref','$d_address','$image','$image1','$d_status')";

    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Not Added !fail" . mysqli_connect_error();
        header("Location: driver_add.php");

    } else {
        move_uploaded_file($lic_tmp, "driver_doc/" . $d_licence_doc);
        move_uploaded_file($add_tmp, "driver_doc/" . $d_address_doc);

        $_SESSION['status'] = "Added Successfully";
        header("Location: driver.php");
    }

}
/* End Add Driver form  */
/* Start update Driver form */

if (isset($_POST['driver_update_btn'])) {

    $id = $_POST['edit_id'];
    $d_name = $_POST['d_name'];
    $d_mobile = $_POST['mobile'];
    $d_age = $_POST['age'];
    $d_licenceno = $_POST['license'];
    $d_licence_expdate = $_POST['exp_dt'];
    $d_aadharno = $_POST['aadharno'];
    $d_total_exp = $_POST['total_exp'];
    $d_doj = $_POST['doj'];
    $d_ref = $_POST['ref'];
    $d_address = $_POST['address'];
    $oldlic_doc = $_POST['edit_oldlic_doc'];
    $oldadd_doc = $_POST['edit_oldadd_doc'];
    $d_licence_doc = $_FILES['lic_doc']['name'];
    $d_address_doc = $_FILES['add_doc']['name'];
    $d_status = $_POST['d_status'];
    if ($d_licence_doc == "") {
        $path1 = $oldlic_doc;
    } else {
        $path1 = $d_licence_doc;
        $tmp1 = $_FILES['lic_doc']['tmp_name'];
    }
    if ($d_address_doc == "") {
        $path2 = $oldadd_doc;
    } else {
        $path2 = $d_address_doc;
        $tmp2 = $_FILES['add_doc']['tmp_name'];
    }

    // $update_driver = "UPDATE driver SET d_name='$d_name' WHERE  d_id='$id'";
    $update_driver = "UPDATE `driver` SET `d_name`='$d_name',`d_mobile`='$d_mobile',`d_age`='$d_age',`d_licenceno`='$d_licenceno',`d_licence_expdate`='$d_licence_expdate',`d_aadharno`='$d_aadharno',`d_total_exp`='$d_total_exp',`d_doj`='$d_doj',`d_ref`='$d_ref',`d_address`='$d_address',`d_licence_doc`='$path1',`d_address_doc`='$path2',`d_status`='$d_status' WHERE `d_id`='$id'";
    $update_run = mysqli_query($con, $update_driver);

    if (!$update_run) {
        $_SESSION['w_status'] = "Not Updated !Fail" . mysqli_connect_error();
        header("Location: driver.php");
    } else {
        if ($d_licence_doc != "") {
            move_uploaded_file($tmp1, 'driver_doc/' . $d_licence_doc);
        }
        if ($d_address_doc != "") {
            move_uploaded_file($tmp2, 'driver_doc/' . $d_address_doc);
        }
        $_SESSION['status'] = "Update Successfully"; 
        header("Location: driver.php");
    }

}
/* End Update Driver form */

/* Start Delet Driver Form */
if (isset($_POST['delete_driver'])) {
    $id = $_POST['d_id'];

    $query = "DELETE FROM `driver` WHERE d_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Not Deleted !Fail" . mysqli_connect_error();
        header("Location: driver.php");
    } else {
        $_SESSION['status'] = "Deleted Successfully";
        header("Location: driver.php");
    }
}
/* End Delete Driver Form */

/* start View Driver */
if (isset($_POST['checking_viewbtn'])) {
    $d_id = $_POST['driver_id'];
    //echo $return = $d_id;

    $query = "SELECT * FROM driver WHERE d_id='$d_id' ";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            echo $return = '
        <h5><b>Driver Id :</b>  ' . $row['d_id'] . '</h5>
        <h5><b>Name :</b>  ' . $row['d_name'] . '</h5>
        <h5><b>Mobile :</b>  ' . $row['d_mobile'] . '</h5>
        <h5><b>Age :</b>  ' . $row['d_age'] . '</h5>
        <h5><b>License No :</b>  ' . $row['d_licenceno'] . '</h5>
        <h5><b>License Expire Date :</b>  ' . $row['d_licence_expdate'] . '</h5>
        <h5><b>Aadharcard No :</b>  ' . $row['d_aadharno'] . '</h5>
        <h5><b>Expirence :</b>  ' . $row['d_total_exp'] . '</h5>
        <h5><b>Joining Date :</b>  ' . $row['d_doj'] . '</h5>
        <h5><b>Reference :</b>  ' . $row['d_ref'] . '</h5>
        <h5><b>Address :</b>  ' . $row['d_address'] . '</h5>
        <h5><b>Licence Doc :</b> <a href=driver_doc/' . $row['d_licence_doc'] . ' download>Download' . '</a></h5>
        <h5><b>Address Proof :</b> <a href=./driver_doc/' . $row['d_address_doc'] . ' download>Download' . '</a></h5>';

        }
    } else {

        echo $return = "No record Found";

    }

}


/*----End Driver View Form-----*/


/*---- Edit Driver Form ----*/

if (isset($_POST['checking_edit_btn'])) {
    $d_id = $_POST['driver_id'];
    //echo $return = $d_id;
    $result_array = [];

    $query = "SELECT * FROM driver WHERE d_id='$d_id' ";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            array_push($result_array, $row);
            header('content-type: application/json');
            echo json_encode($result_array);

        }
    } else {

        echo $return = "No record Found";

    }

}

/*----End Driver Edit Form-----*/

/* Start Add Booking Form */

if (isset($_POST['booking_btn'])) {

    $b_invoice = $_POST['b_invoice'];
    $b_book_date = $_POST['b_book_date'];
    $b_name = $_POST['b_name'];
    $b_address = $_POST['b_address'];
    $b_mobile1 = $_POST['b_mobile1'];
    $b_mobile2 = $_POST['b_mobile2'];
    $b_pickup = $_POST['b_pickup'];
    $b_trip_start = $_POST['b_trip_start'];
    $b_trip_end = $_POST['b_trip_end'];
    $b_total_days = $_POST['b_total_days'];
    $b_member = $_POST['b_member'];
    $b_type = $_POST['b_type'];
    $b_total = $_POST['b_total'];
    $b_price = $_POST['b_price'];
    $b_route = $_POST['b_route'];
    $b_reference = $_POST['b_reference'];
    $b_deposite = $_POST['b_deposite'];
    $b_note = $_POST['b_note'];
    $b_status=$_POST['b_status'];

    $query = "INSERT INTO `booking`(`b_invoice`, `b_book_date`, `b_name`, `b_address`, `b_mobile1`, `b_mobile2`, `b_pickup`, `b_trip_start`, `b_trip_end`,`b_total_days`, `b_member`, `b_type`, `b_total`, `b_price`, `b_route`, `b_reference`, `b_deposite`, `b_note`,`b_status`)
     VALUES ('$b_invoice','$b_book_date','$b_name','$b_address','$b_mobile1','$b_mobile2','$b_pickup','$b_trip_start','$b_trip_end','$b_total_days','$b_member','$b_type','$b_total','$b_price','$b_route','$b_reference','$b_deposite','$b_note','$b_status')";

    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Not Added !Fail" . mysqli_connect_error();
        header("Location: booking.php");


    } else {

        $_SESSION['status'] = " Add Successfully";
        header("Location: booking.php");
    }

}

/* End Add Booking Form */

/* End Update Booking Form */

if(isset($_POST['booking_update_btn'])){

    $b_id=$_POST['b_id'];
    $b_invoice = $_POST['b_invoice'];
    $b_book_date = $_POST['b_book_date'];
    $b_name = $_POST['b_name'];
    $b_address = $_POST['b_address'];
    $b_mobile1 = $_POST['b_mobile1'];
    $b_mobile2 = $_POST['b_mobile2'];
    $b_pickup = $_POST['b_pickup'];
    $b_trip_start = $_POST['b_trip_start'];
    $b_trip_end = $_POST['b_trip_end'];
    $b_total_days = $_POST['b_total_days'];
    $b_member = $_POST['b_member'];
    $b_type = $_POST['b_type'];
    $b_total = $_POST['b_total'];
    $b_price = $_POST['b_price'];
    $b_route = $_POST['b_route'];
    $b_reference = $_POST['b_reference'];
    $b_deposite = $_POST['b_deposite'];
    $b_note = $_POST['b_note'];
    $b_status=$_POST['b_status'];


    $update="UPDATE `booking` SET `b_invoice`='$b_invoice',`b_book_date`='$b_book_date',`b_name`='$b_name',`b_address`='$b_address',`b_mobile1`='$b_mobile1',`b_mobile2`='$b_mobile2',`b_pickup`='$b_pickup',`b_trip_start`='$b_trip_start',`b_trip_end`='$b_trip_end',`b_total_days`='$b_total_days',`b_member`='$b_member',`b_type`='$b_type',`b_total`='$b_total',`b_price`='$b_price',`b_route`='$b_route',`b_reference`='$b_reference',`b_deposite`='$b_deposite',`b_note`='$b_note',`b_status`='$b_status' WHERE b_id='$b_id'";
    $query=mysqli_query($con,$update);

    if (!$query) {
        $_SESSION['w_status'] = "Not Update !Fail" . mysqli_connect_error();
        header("Location: booking_view.php?b_id=$b_id");


    } else {

        $_SESSION['status'] = " Successfully";
        header("Location: booking_view.php?b_id=$b_id");
    }

}

/* End Update Booking Form */

/*Start Fuel Add */
if (isset($_POST['fuel_add_btn'])) {
    $vehicle = $_POST['id'];
    $driver = $_POST['f_driver'];
    $filldate = $_POST['f_filldate'];
    $quantity = $_POST['f_quantity'];
    $odm = $_POST['f_odm'];
    $price = $_POST['f_price'];
    $comments = $_POST['f_comments'];

    $query = "INSERT INTO `fuel` (`id`, `f_driver`, `f_filldate`, `f_quantity`, `f_odm`, `f_price`, `f_comments`) 
    VALUES ('$vehicle','$driver','$filldate','$quantity','$odm','$price','$comments')";

    $query_run = mysqli_query($con, $query);

if($query_run==1)
{
    $ins="INSERT INTO `income_expence`(v_id,i_type,i_date,i_amount,i_description)
    VALUES('$vehicle','1','$filldate','$price','$comments')";
    $quer=mysqli_query($con,$ins);

    if ($quer==1) {
        
        $_SESSION['status'] = " Added Successfully";
        header("Location: fuel.php");

    }
 } else {
    $_SESSION['w_status'] = "Not Added !Fail" . mysqli_connect_error();
    header("Location: fuel_add.php");
       
    }

}


/* End Fuel Add */

/* Start Delet Fuel Form */
if (isset($_POST['fuel_delete_btn'])) {
    $id = $_POST['f_id'];

    $query = "DELETE FROM `fuel` WHERE f_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Not Deleted !Fail ";
        header("Location: fuel.php");

    } else {
        $_SESSION['status'] = "Data Deleted Successful ";
        header("Location: fuel.php");
    }
}
/* End Delete Fuel Form */
/*---- Edit Fuel Form ----*/

if (isset($_POST['checking_editfuel_btn'])) {
    $id = $_POST['fuel_id'];
    //echo $return = $d_id;
    $result_array = [];

    $query = "SELECT * FROM fuel WHERE f_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            array_push($result_array, $row);
            header('content-type: application/json');
            echo json_encode($result_array);

        }
    } else {

        echo $return = "No record Found";

    }

}

/*----End Fuel Edit Form-----*/
/*---Start Update Fuel Form-----*/

if(isset($_POST['fuel_update_btn']))
{
    $f_id=$_POST['edit_f_id'];
    $id=$_POST['id'];
    $driver=$_POST['f_driver'];
    $filldate=$_POST['f_filldate'];
    $quantity=$_POST['f_quantity'];
    $odm=$_POST['f_odm'];
    $price=$_POST['f_price'];
    $comments=$_POST['f_comments'];

    $update_fuel="UPDATE `fuel` SET `id`='$id',`f_driver`='$driver',`f_filldate`='$filldate',`f_quantity`='$quantity',`f_odm`='$odm',`f_price`='$price',`f_comments`='$comments' WHERE f_id='$f_id'";
    $update_run = mysqli_query($con, $update_fuel);

    if (!$update_run) {
        $_SESSION['w_status'] = "Data Not Updated !Fail ";
        header("Location: fuel.php");
    } else {
        $_SESSION['status'] = "Data Updated Successful ";       
        header("Location: fuel.php");
    }

}
/*---- End Update Fuel Form------*/

/*-------Start Part Add Form------*/
if(isset($_POST['part_add_btn']))
{
    $vehicle=$_POST['id'];
    $buy_date=$_POST['p_buy_date'];
    $part=$_POST['p_part'];
    $quantity=$_POST['p_quantity'];
    $vendor=$_POST['p_vendor'];
    $bill=$_POST['p_bill_no'];
    $bill_doc=$_FILES['p_bill_doc']['name'];
    $warranty=$_POST['p_warranty_dt'];
    $price=$_POST['p_price'];
    $odm=$_POST['p_odm'];
    $total_amount=$_POST['p_total_amount'];
    $d_status=$_POST['p_status'];
    $due_amount=$_POST['p_due_amount'];
    $payment_dt=$_POST['p_payment_dt'];
    $comment=$_POST['p_comment'];

    $bill_doc = $_FILES['p_bill_doc']['name'];
    $bill_tmp = $_FILES['p_bill_doc']['tmp_name'];

    $data=[$bill_doc];
    $image = implode('', $data);


    $query="INSERT INTO `part`( `vehicle_id`, `p_buy_date`, `p_part`, `p_quantity`, `p_vendor`, `p_bill_no`, `p_bill_doc`, `p_warranty_dt`, `p_price`, `p_odm`, `p_total_amount`, `p_status`, `p_due_amount`, `p_payment_dt`, `p_comment`) 
    VALUES('$vehicle','$buy_date','$part','$quantity','$vendor','$bill','$image','$warranty','$price','$odm','$total_amount','$d_status','$due_amount','$payment_dt','$comment')";

    $query_run=mysqli_query($con,$query);

    if($query_run==1)
    {
        $ins="INSERT INTO `income_expence`(v_id,i_type,i_date,i_amount,i_description)
        VALUES('$vehicle','1','$buy_date','$total_amount','$comment')";
        $quer=mysqli_query($con,$ins);
    
        if ($quer==1) {
            move_uploaded_file($bill_tmp, "bill_doc/" . $bill_doc);
            $_SESSION['status'] = " Added Successfully";
            header("Location: part.php");   
        }
    } 
    else
    {
        $_SESSION['w_status'] = "Not Added !Fail" . mysqli_connect_error();
        header("Location: part.php");
    } 

}


/*-------End Part Add Form---------*/
/* Start Delete Part Form */
if (isset($_POST['part_delete_btn'])) {
    $id = $_POST['p_id'];

    $query = "DELETE FROM `part` WHERE p_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = " Not Deleted  !Fail" . mysqli_connect_error();
        header("Location: part.php");

    } else {
        $_SESSION['status'] = " Deleted  Successfully";
        header("Location: part.php");
    }
}
/* End Delete Part Form */

/* start View Part */
if (isset($_POST['checking_partviewbtn'])) {
    $p_id = $_POST['part_id'];
    //echo $return = $d_id;

    $query = "SELECT * FROM part WHERE p_id='$p_id' ";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            echo $return = '
        <h5><b>Part Id :</b>  ' . $row['p_id'] . '</h5>
        <h5><b>Buy Date :</b>  ' . date("d-m-Y", strtotime($row['p_buy_date'])). '</h5>
        <h5><b>Part :</b>  ' . $row['p_part'] . '</h5>
        <h5><b>Quantity :</b>  ' . $row['p_quantity'] . '</h5>
        <h5><b>Vendor :</b>  ' . $row['p_vendor'] . '</h5>
        <h5><b>Bill No :</b>  ' . $row['p_bill_no'] . '</h5>
        <h5><b>Bill Document :</b> <a href=bill_doc/' . $row['p_bill_doc'] .' download>Download'.'</a></h5>
        <h5><b>Warranty Date :</b>  ' .date("d-m-Y", strtotime($row['p_warranty_dt'])). '</h5>
        <h5><b>Price :</b>  ' . $row['p_price'] . '</h5>
        <h5><b>Odometer :</b>  ' . $row['p_odm'] . '</h5>
        <h5><b>Total Amount :</b>  ' . $row['p_total_amount'] . '</h5>
        <h5><b>Due Amount :</b>  ' . $row['p_due_amount'] . '</h5>
        <h5><b>Payment Date :</b>  ' .date("d-m-Y", strtotime($row['p_payment_dt'])). '</h5>
        <h5><b>Comments :</b>  ' . $row['p_comment'] . '</h5>';
        }
    } else {

        echo $return = "No record Found";

    }

}

/*----End Part View Form-----*/
/*---- Edit Part Form ----*/

if (isset($_POST['checking_part_btn'])) {
    $id = $_POST['part_id'];
    //echo $return = $d_id;
    $result_array = [];

    $query = "SELECT * FROM part WHERE `p_id`='$id'";
    $query_run = mysqli_query($con,$query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            array_push($result_array, $row);
            header('content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        echo $return = "No record Found";
    }
}
/*----End Part Edit Form-----*/
/*-----Start Update PArt Form------*/
if(isset($_POST['part_update_btn']))
{
    $p_id=$_POST['p_id'];
    $vehicle=$_POST['vehicle_id'];
    $buy_date=$_POST['p_buy_date'];
    $part=$_POST['p_part'];
    $quantity=$_POST['p_quantity'];
    $vendor=$_POST['p_vendor'];
    $bill=$_POST['p_bill_no'];
    $oldbill_doc = $_POST['edit_oldbill_doc'];
    $bill_doc=$_FILES['p_bill_doc']['name'];
    $warranty=$_POST['p_warranty_dt'];
    $price=$_POST['p_price'];
    $odm=$_POST['p_odm'];
    $total_amount=$_POST['p_total_amount'];
    $status=$_POST['p_status'];
    $due_amount=$_POST['p_due_amount'];
    $payment_dt=$_POST['p_payment_dt'];
    $comment=$_POST['p_comment'];

   if ($bill_doc == "") {
        $path2 = $oldbill_doc;
    } else {
        $path2 = $bill_doc;
        $tmp2 = $_FILES['p_bill_doc']['tmp_name'];
    }
    
    $update_part= "UPDATE `part` SET `vehicle_id`='$vehicle',`p_buy_date`='$buy_date',`p_part`='$part',`p_quantity`='$quantity',`p_vendor`='$vendor',`p_bill_no`='$bill',`p_bill_doc`='$path2',`p_warranty_dt`='$warranty',`p_price`='$price',`p_odm`='$odm',`p_total_amount`='$total_amount',`p_status`='$status',`p_due_amount`='$due_amount',`p_payment_dt`='$payment_dt',`p_comment`='$comment' WHERE `p_id`='$p_id'";
    $query_run=mysqli_query($con,$update_part);
    
    if (!$query_run) {
        $_SESSION['w_status'] = " Not Updated !Fail" . mysqli_connect_error();
        header("Location: part.php");
    } else {
        if ($bill_doc != "") {
            move_uploaded_file($tmp2, 'bill_doc/' . $bill_doc);
        }
        $_SESSION['status'] = " Deleted Successfully";
        header("Location: part.php");
        
    }
}

/*----End Update Part Form---------*/

/*------Start Add Maintanace Form-------*/
if(isset($_POST['maintanance_add_btn']))
{
   $vehicle=$_POST['vehicle'];
    $rep_date=$_POST['rep_date'];
    $material=$_POST['material'];
    $qut=$_POST['qut'];
    $vendor=$_POST['vendor'];
    $part=$_POST['part'];
    $mechnic=$_POST['mechanic'];
    $charge=$_POST['charge'];
    $boll_no=$_POST['bill_no'];
    $matrial_price=$_POST['material_price'];
    $total_amount=$_POST['total_amount'];
    $odm=$_POST['odm'];
    $status=$_POST['m_status'];
    $due_amount=$_POST['m_due_amount'];
    $pay_dt=$_POST['pay_date'];
    $comment=$_POST['comment'];
    
    $bill_doc = $_FILES['m_bill_doc']['name'];
    $bill_tmp = $_FILES['m_bill_doc']['tmp_name'];

    $data=[$bill_doc];
    $image = implode('', $data);

    $query="INSERT INTO `maintanance`( `m_vehicle`, `m_repair_dt`, `m_material`, `m_quantity`, `m_vendor`, `m_description`, `m_mechanic`, `m_labour_charge`, `m_bill_no`, `m_material_price`, `m_total_amount`, `m_bill_doc`, `m_odm`, `m_status`, `m_due_payment`,`m_payment_dt`, `m_comment`) 
    VALUES('$vehicle','$rep_date','$material','$qut','$vendor','$part','$mechnic','$charge','$boll_no','$matrial_price','$total_amount','$image','$odm','$status','$due_amount','$pay_dt','$comment')";

    $query_run=mysqli_query($con,$query);

    if($query_run==1)
    {
        $ins="INSERT INTO `income_expence`(v_id,i_type,i_date,i_amount,i_description)
        VALUES('$vehicle','1','$rep_date','$total_amount','$comment')";
        $quer=mysqli_query($con,$ins);
        
        if($query_run)
        {
        move_uploaded_file($bill_tmp, "main_bill_doc/" . $bill_doc);
        $_SESSION['status'] = "Data Add Successful ";
        header("Location: maintanance.php");
        }

    }
    else{

        
        $_SESSION['w_status'] = "Something Wrong";
        header("Location: maintanance_add.php");
    }
}

/*--------End Add Maintanace Form---------*/
/* Start Delete Maintanace Form */
if (isset($_POST['main_delete_btn'])) {
    $id = $_POST['m_id'];

    $query = "DELETE FROM `maintanance` WHERE m_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Something Wrong";
        header("Location: maintanance.php");

    } else {
        $_SESSION['status'] = "Data Delete Successful ";
        header("Location: maintanance.php");
    }
}
/* End Delete Maintanace Form */
/* start View Maintanance */
if (isset($_POST['checking_mainviewbtn'])) {
    $m_id = $_POST['main_id'];
    //echo $return = $d_id;

    $query = "SELECT * FROM maintanance WHERE m_id='$m_id' ";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            echo $return = '
        <h5><b>Id :</b>  ' . $row['m_id'] . '</h5>
        <h5><b>Repair Date :</b>  ' . date("d-m-Y", strtotime($row['m_repair_dt'])). '</h5>
        <h5><b>Material :</b>  ' . $row['m_material'] . '</h5>
        <h5><b>Quantity :</b>  ' . $row['m_quantity'] . '</h5>
        <h5><b>Vendor :</b>  ' . $row['m_vendor'] . '</h5>
        <h5><b>Description :</b>  ' . $row['m_description'] . '</h5>
        <h5><b>Mechanic :</b>  ' . $row['m_mechanic'] . '</h5>
        <h5><b>Labour Charge :</b>  ' . $row['m_labour_charge'] . '</h5>
        <h5><b>Bill No :</b>  ' . $row['m_bill_no'] . '</h5>
        <h5><b>Bill Document :</b> <a href=main_bill_doc/' . $row['m_bill_doc'] . ' download>Download' . '</a></h5>
        <h5><b>Material Price :</b>  ' . $row['m_material_price'] . '</h5>
        <h5><b>Odometer :</b>  ' . $row['m_odm'] . '</h5>
        <h5><b>Total Amount :</b>  ' . $row['m_total_amount'] . '</h5>
        <h5><b>Due Amount :</b>  ' . $row['m_due_payment'] . '</h5>
        <h5><b>Payment Date :</b>  ' .date("d-m-Y", strtotime($row['m_payment_dt'])). '</h5>
        <h5><b>Comments :</b>  ' . $row['m_comment'] . '</h5>';
    
    }
    } else {

        echo $return = "No record Found";

    }

}

/*----End Maintanance View Form-----*/
/*---- Edit Maintanance Form ----*/

if (isset($_POST['checking_main_btn'])) {
    $id = $_POST['main_id'];
    //echo $return = $d_id;
    $result_array = [];

    $query = "SELECT * FROM maintanance WHERE `m_id`='$id'";
    $query_run = mysqli_query($con,$query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            array_push($result_array, $row);
            header('content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        echo $return = "No record Found";
    }
}
/*----End Maintanance Edit Form-----*/
/*------Start Update Maintanance Form--------------*/
if(isset($_POST['main_update_btn']))
{
    $id=$_POST['m_id'];
    $vehicle=$_POST['m_vehicle'];
    $rep_date=$_POST['rep_date'];
    $material=$_POST['material'];
    $qut=$_POST['qut'];
    $vendor=$_POST['vendor'];
    $part=$_POST['part'];
    $mechnic=$_POST['mechanic'];
    $charge=$_POST['charge'];
    $bill_no=$_POST['bill_no'];
    $matrial_price=$_POST['material_price'];
    $total_amount=$_POST['total_amount'];
    $odm=$_POST['odm'];
    $status=$_POST['m_status'];
    $due_amount=$_POST['m_due_amount'];
    $pay_dt=$_POST['pay_date'];
    $comment=$_POST['comment']; 
    $oldbill_doc = $_POST['edit_oldbill_doc'];
    $bill_doc=$_FILES['m_bill_doc']['name'];  

    if ($bill_doc == "") {
        $path2 = $oldbill_doc;
    } else {
        $path2 = $bill_doc;
        $tmp2 = $_FILES['m_bill_doc']['tmp_name'];
    }

    $up="UPDATE `maintanance` SET `m_vehicle`='$vehicle',`m_repair_dt`='$rep_date',`m_material`='$material',`m_quantity`='$qut',`m_vendor`='$vendor',`m_description`='$part',`m_mechanic`='$mechnic',`m_labour_charge`='$charge',`m_bill_no`='$bill_no',`m_material_price`='$matrial_price',`m_total_amount`='$total_amount',`m_bill_doc`='$path2',`m_odm`='$odm',`m_status`='$status',`m_due_payment`='$due_amount',`m_payment_dt`='$pay_dt',`m_comment`='$comment' WHERE m_id='$id'";
    $query_run=mysqli_query($con,$up);

    if (!$query_run) {
        $_SESSION['w_status'] = " Not Updated !Fail ";
        header("Location: maintanance.php");
    } else {
        if ($bill_doc != "") {
            move_uploaded_file($tmp2, 'main_bill_doc/' . $bill_doc);
        }
        $_SESSION['status'] = "Data Updated Successfully ";
        header("Location: maintanance.php");
        
    }


}
/*--------End Update Maintanace Form----------------*/
/*---------Start Travel Agency Form Add -----------*/
if(isset($_POST['travel_agency']))
{
    $agency=$_POST['agency_name'];
    $name=$_POST['name'];
    $mobile1=$_POST['mobile1'];
    $mobile2=$_POST['mobile2'];
    $address=$_POST['address'];
    $detail=$_POST['vehicle_detail'];
    
    $query="INSERT INTO `travel_agency`(`agency_name`, `owner_name`, `mobile1`, `mobile2`, `address`, `vehicle_detail`) 
    VALUES ('$agency','$name','$mobile1','$mobile2','$address','$detail')";

    $query_run=mysqli_query($con,$query);

    if(!$query_run)
    {
        $_SESSION['w_status'] = "Something Wrong";
        header("Location: travel_agency_detail.php");
    }
    else{

        $_SESSION['status'] = "Data Add Successful ";
        header("Location: travel_agency_detail.php");
    }

}
/*---------End Travel Agency Form Add -----------*/
/* Start Delete Maintanace Form */
if (isset($_POST['travel_agency_del_btn'])) {
    $id = $_POST['t_id'];

    $query = "DELETE FROM `travel_agency` WHERE t_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Something Wrong";
        header("Location: travel_agency_detail.php");

    } else {
        $_SESSION['status'] = "Data Delete Successful ";
        header("Location: travel_agency_detail.php");
    }
}
/* End Delete Maintanace Form */
/* Start Delete Booking Form */
if (isset($_POST['book_delete_btn'])) {
    $id = $_POST['b_id'];

    $query = "DELETE FROM `booking` WHERE b_id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = "Something Wrong";
        header("Location: booking.php");

    } else {
        $_SESSION['status'] = "Data Delete Successful ";
        header("Location: booking.php");
    }
}
/* End Delete Booking Form */
/*     Start Payment Form */

if(isset($_POST['booking_payment']))
{
    $b_id=$_POST['b_id'];
    $amount=$_POST['tp_amount'];
    $mode=$_POST['payment_model'];
    $note=$_POST['tp_notes'];
    $vehicle=$_POST['vehicle'];

    $query="INSERT INTO `booking_payment`(`b_id`,`v_id`, `pay`,`mode`, `Note`, `s_date`) 
    VALUES ('$b_id','$vehicle','$amount','$mode','$note',CURDATE())";
    $quer_run=mysqli_query($con,$query);

    
    if($quer_run==1)
    {
        $ins="INSERT INTO `income_expence`(v_id,i_type,i_date,i_amount,i_description)
        VALUES('$vehicle','0',CURDATE(),'$amount','$note')";
        $quer=mysqli_query($con,$ins);
    
        if ($quer==1) {
            $_SESSION['status'] = "Data Added Successful";
    header("Location: booking_detail.php?b_id=$b_id");
        }
    } 
    else {
    $_SESSION['w_status'] = "Something Wrong";
    header("Location: booking_detail.php?b_id=$b_id");

    }
    

}
/*     End Payment Form */

/*    start Add Income_expence Form  */
if(isset($_POST['income_add_btn']))
{
    $v_id=$_POST['id'];
    $type=$_POST['type'];
    $date=$_POST['i_date'];
    $amount=$_POST['i_amount'];
    $desc=$_POST['i_comments'];

    $income="INSERT INTO `income_expence`( `v_id`, `i_type`, `i_date`, `i_amount`, `i_description`) 
    VALUES ('$v_id','$type','$date','$amount','$desc')";

    $query=mysqli_query($con,$income);

    if (!$quer) {
        $_SESSION['w_status'] = "Something Wrong";
        header("Location: income_expence.php");
    
    } else {
        $_SESSION['status'] = "Data Added Successful ";
        header("Location: income_expence.php");
    }


}

/*    End Add Income_expence Form  */
/*---- Edit Income Form ----*/

if (isset($_POST['checking_editincome_btn'])) {
    $id = $_POST['i_id'];
    //echo $return = $d_id;
    $result_array = [];

    $query = "SELECT * FROM income_expence WHERE `i_id`='$id'";
    $query_run = mysqli_query($con,$query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {

            array_push($result_array, $row);
            header('content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        echo $return = "No record Found";
    }
}
/*----End Income Edit Form-----*/
/*    start Update Income_expence Form  */
if(isset($_POST['income_update_btn']))
{
    $i_id=$_POST['edit_i_id'];
    $v_id=$_POST['edit_i_id'];
    $type=$_POST['type'];
    $date=$_POST['i_date'];
    $amount=$_POST['i_amount'];
    $desc=$_POST['i_comments'];

    $update_in="UPDATE `income_expence` SET `v_id`='$v_id',`i_type`='$type',`i_date`='$date',`i_amount`='$amount',`i_description`='$desc' WHERE i_id='$i_id'";

    $query=mysqli_query($con,$update_in);

    if (!$query) {
        $_SESSION['w_status'] = "Something Wrong";
        header("Location: income_expence.php");
    
    } else {
        $_SESSION['status'] = "Data Added Successful ";
        header("Location: income_expence.php");
    }


}

/*    End Update Income_expence Form  */


/*start Bill Section Detail */
if (isset($_POST['submit'])) {
    $b_id = $_POST['b_id'];
    $due_amount = $_POST['due_amount'];
    $avd_paid=$_POST['avd_paid'];
    $net_total = $_POST['net_total'];
    $discount = $_POST['discount'];
    $sub_total_amount = $_POST['sub_total_amount'];
    //$b_name = $_POST['b_name'];
     //$b_mobile1 = $_POST['b_mobile1'];
     //$b_pickup = $_POST['b_pickup'];
     //$b_trip_start = $_POST['b_trip_start'];
     //$b_trip_end = $_POST['b_trip_end'];
     //$b_total_days = $_POST['b_total_days'];
    //$b_total=$_POST['b_total'];
     //$b_type = $_POST['b_type'];
     //$b_route = $_POST['b_route'];
     //$b_price = $_POST['b_price'];
     //$b_deposite = $_POST['b_deposite'];
     //$b_note = $_POST['b_note'];
     //$b_total = $_POST['b_total'];
     //$sql = "UPDATE `booking` SET `b_name`='$b_name',`b_pickup`='$b_pickup',`b_trip_start`='$b_trip_start',`b_trip_end`='$b_trip_end',`b_total_days`='$b_total_days',`b_total`='$b_total',`b_type`='$b_type',`b_total`='$b_total',`b_price`='$b_price',`b_route`='$b_route',`b_deposite`='$b_deposite',`b_note`='$b_note',b_sub_total='$sub_total_amount',b_discount='$discount',b_net_total='$net_total',b_due_amount='$due_amount' WHERE b_id='$b_id'";
     //$res = mysqli_query($con, $sql);
    //  print_r($_POST['slno']);
    //  print_r($_POST['slno']);
    
    for($i=0;$i<count($_POST['slno']); $i++){
       $v_type = $_POST['vehicle_type'][$i];
        $type = $_POST['type'][$i];
        $start_odm=$_POST['start_odm'][$i];
        $end_odm=$_POST['end_odm'][$i];
        $total_odm = $_POST['total_odm'][$i];
        $rate = $_POST['rate'][$i];
        $toll = $_POST['toll'][$i];
        $da = $_POST['da'][$i];
        $permission = $_POST['permission'][$i];
        $tax = $_POST['tax'][$i];
        $total_amount = $_POST['total_amount'][$i];

        /*$sql="INSERT INTO customer_bill_detail(`b_id`,`vehicle_type`,`start_odm`, `end_odm`, `total_odm`, `rate`, `toll_tax`, `da`, `permission`, `tax_charge`, `total_amount`)
        VALUES('$b_id','$type','$start_odm','$end_odm','$total_odm','$rate','$toll','$da','$permission','$tax','$total_amount')";
        mysqli_query($con,$sql); */
        mysqli_query($con,"INSERT INTO customer_bill_detail(`b_id`,`type`,`vehicle_type`,`start_odm`, `end_odm`, `total_odm`, `rate`, `toll_tax`, `da`, `permission`, `tax_charge`, `total_amount`) VALUES ('$b_id','$v_type','$type','$start_odm','$end_odm','$total_odm','$rate','$toll','$da','$permission','$tax','$total_amount')");
        if($v_type!=='' && $type!=='' && $start_odm!=='' && $end_odm!=='' && $total_odm!=='' && $rate!=='' && $toll!=='' && $da!=='' && $permission!=='' && $tax!== '' && $total_amount!=='' ){

                $sg = "UPDATE booking SET b_sub_total='$sub_total_amount',b_discount='$discount',b_net_total='$net_total',b_adv_paid='$avd_paid',b_due_amount='$due_amount' WHERE b_id='$b_id'";
                $sgrun = mysqli_query($con,$sg);
                header("Location: booking.php");
                echo $return = "Successfull ";
        }
        else{
            header("Location: booking.php");
            echo $return = 'error';
        }
    }
    echo "<script>";
    echo "alert('$b_id')";
    echo "</script>";
}
/*End Bill Section Details */



/* Start Delete Cutomer_bill Form */
if (isset($_POST['billv_delete_btn'])) {
    $id = $_POST['id'];
    $b_id=$_POST['b_id'];

    $query = "DELETE FROM `customer_bill_detail` WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if (!$query_run) {
        $_SESSION['w_status'] = " Not Deleted  !Fail" . mysqli_connect_error();
        header("Location: booking_view.php?b_id=$b_id");

    } else {
        $_SESSION['status'] = " Deleted  Successfully";
        header("Location: booking.php");
    }
}
/* End Delete Cutomer_bill Form */



?>