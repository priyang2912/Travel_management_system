<?php
//session_start();
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<html>

<body>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Bill Detail
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Vehicle</a></li>
                            <li class="breadcrumb-item active">Bill</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="form1" method="GET" action="bill.php" class="form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-4">
                                        <span class="input-group-text">Invoice</span>
                                            <select class="form-control" name="b_inv">
                                                <?php
                                                $st = mysqli_query($con,"SELECT * FROM booking");
                                                while($sf = mysqli_fetch_assoc($st)){ ?>
                                                <option value="<?php echo $sf['b_id']; ?>"
                                                ><?php echo $sf['b_name'];echo -$sf['b_invoice']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <!-- <input type="number" value="<?php #if (isset($_SESSION['invoice_no'])) {
                                                #echo $_SESSION['invoice_no'];
                                                #unset($_SESSION['invoice_no']);
                                            #} ?>" name="b_inv" maxlength="4" class="form-control" id="b_invoice"
                                         placeholder="Invoice No" form-required> -->
&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary" id="submitBtn"
                                            name="billf_btn">Search</button>
                                            </div>

                                    </div>
                                    
                                        
                                </div>
                            </form>
                            <form method="POST" action="database.php" id="form1">
                            <div class="row">
                                <?php
                                if (isset($_GET['billf_btn'])) {
                                    $id = $_GET['b_inv'];
                                    $_SESSION['invoice_no'] = $id;
                                    $query = "SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>

                                            <div class="col">
                                                <div class="input-group mb-4">
                                                    <span class="input-group-text">No</span>
                                                    <input type="text" name="b_id" maxlength="20" class="form-control"
                                                        value="<?php echo $row['b_id']; ?>" placeholder="Enter Name" form-required>
                                                </div>
                                            </div>
                                            <input type="hidden" name="b_total" value="<?php echo $row['b_total']; ?>">
                                            <div class="col-sm-6 col-md-3">
                                                <div class="input-group mb-4">
                                                    <span class="input-group-text">City</span>
                                                    <input type="text" name="b_name" maxlength="20" class="form-control"
                                                        value="<?php echo $row['b_name']; ?>" placeholder="Enter Name"
                                                        form-required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Mobile</span>
                                                    <input type="tel" name="b_mobile1" maxlength="10" class="form-control"
                                                        value="<?php echo $row['b_mobile1']; ?>" placeholder="Enter Mobile No."
                                                        form-required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Pickup</span>
                                                    <input type="text" name="b_pickup" maxlength="40" class="form-control"
                                                        placeholder="Enter Pickup Location" value="<?php echo $row['b_pickup']; ?>"
                                                        form-required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Trip Date</span>
                                                    <input type="datetime-local" name="b_trip_start" class="form-control"
                                                        value="<?php echo $row['b_trip_start']; ?>" form-required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Trip End</span>
                                                    <input type="datetime-local" name="b_trip_end" class="form-control"
                                                        value="<?php echo $row['b_trip_end']; ?>" form-required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Total Days</span>
                                                    <input type="tel" maxlength="2" max="31" name="b_total_days"
                                                        class="form-control" value="<?php echo $row['b_total_days']; ?>"
                                                        placeholder="Enter Total Days " form-required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Total Vehicle</span>
                                                    <input type="number" maxlength="2" max="31" name="b_total" class="form-control"
                                                         value="<?php echo $row['b_total']; ?>"
                                                        form-required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Vehicle Type</span>
                                                    <input type="text" maxlength="16" name="b_type" class="form-control"
                                                        placeholder="Enter Vehicle Type" value="<?php echo $row['b_type']; ?>"
                                                        form-required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Route</span>
                                                    <input type="text" maxlength="30" name="b_route" class="form-control"
                                                        value="<?php echo $row['b_route']; ?>" placeholder="Enter Route details"
                                                        form-required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Km /Fix Rate</span>
                                                    <input type="tel" maxlength="14" name="b_price" class="form-control"
                                                        value="<?php echo $row['b_price']; ?>" placeholder="Enter KM / Fix price"
                                                        form-required>
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-md-3">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Deposite</span>
                                                    <input type="tel" maxlength="14" name="b_deposite" class="form-control"
                                                        value="<?php echo $row['b_deposite']; ?>" placeholder="Enter Deposite"
                                                        form-required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                            <div class="input-group mb-4">
                                            <span class="input-group-text">Note</span>
                                                    <input type="text" maxlength="28" name="b_note" class="form-control"
                                                        value="<?php echo $row['b_note']; ?>" placeholder="Enter Note">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    } else {
                                        echo "no record found";
                                    }
                                }
                                ?>
                        </div>
                        <form class="" action="database" method="POST" id="form2">
                            <input type="hidden" name="b_id" value="<?php echo $_SESSION['invoice_no']; ?>"/>
                        <div class="card">
                            <div class="card-body">
                                <h4><b>Add Vehicle Bill</b></h4><br>
                                <!-- <form class="form-horizontal" action="database" method="POST" id="bll"> -->
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="">Sl No.</label>
                                        <input type="text" class="form-control sl" name="slno[]" id="slno" value="1"
                                            readonly="">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Vehicle Type</label>
                                        <input type="text" maxlength="20" class="form-control sl" name="vehcile_type[]"
                                            id="vehcile_type" placeholder="Type">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Company name</label>
                                        <select name="travel[]" class="form-control sl" id="travel">
                                            <?php
                                            $sd = "SELECT * FROM travel_agency";
                                            $ff = mysqli_query($con, $sd);
                                            while ($ft = mysqli_fetch_assoc($ff)) {
                                                $in = $ft['agency_name'];
                                                ?>
                                                <option>
                                                    <?php echo $in; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        </div>

                                        <!-- <input type="text" class="form-control Sl" name="type[]" id="type"
                                                placeholder="56 ac/n-ac"> -->

                                    <div class="col-sm-2">
                                        <label for="">Bus No</label>
                                        <select name="type[]" class="form-control sl" id="type">
                                            <?php
                                            $sd = "SELECT * FROM vehicle";
                                            $ff = mysqli_query($con, $sd);
                                            while ($ft = mysqli_fetch_assoc($ff)) {
                                                $in = $ft['reg_no'];
                                                ?>
                                                <option>
                                                    <?php echo $in; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        </div>

                                        <!-- <input type="text" class="form-control Sl" name="type[]" id="type"
                                                placeholder="56 ac/n-ac"> -->
                                                
                                    <div class="col-sm-2">
                                        <label for="">Trip Date</label>
                                        <input type="date" class="form-control Sl" name="trip_date[]"
                                            id="trip_date">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Total Days</label>
                                        <input type="number" max="30" class="form-control Sl" name="day[]"
                                            id="day" placeholder="Total Days">
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="">Start ODM</label>
                                        <input type="tel" maxlength="7" class="form-control Sl" name="start_odm[]"
                                            id="start_odm0" placeholder="Start KM">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">End ODM</label>
                                        <input type="tel" maxlength="7"  onblur="totalodm(0)" class="form-control Sl" name="end_odm[]"
                                            id="end_odm0" placeholder="End KM">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Total ODM</label>
                                        <input type="tel" maxlength="6" class="form-control Sl" name="total_odm[]"
                                            id="total_odm0" placeholder="Total KM">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Rate Km/Fix</label>
                                        <input type="text" maxlength="8" class="form-control Sl" name="rate[]" id="rate0"
                                            placeholder="Rate KM/Fix" pattern="[0-9]+(\\.[0-9][0-9]?)?">&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Toll Tax</label>
                                        <input type="text" maxlength="6" min="0"  class="form-control Sl" name="toll[]"
                                            id="toll0" placeholder="Toll Tax" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Driver Allowance</label>
                                        <input type="text" maxlength="6" class="form-control Sl" name="da[]" id="da0"
                                            placeholder="Driver Allowance"  pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">City Permission</label>
                                        <input type="text" maxlength="6" class="form-control Sl" name="permission[]"
                                            id="permission0" placeholder="City Permission" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Tax Charge</label>
                                        <input type="text" maxlength="6" class="form-control Sl" onblur="totalamount(0)" name="tax[]" id="tax0"
                                            placeholder="Other State Tax Charge"  pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Total Amount</label>
                                        <input type="text" maxlength="8" class="form-control Sl super_total" name="total_amount[]"
                                            id="total_amount0" placeholder="Total Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div><br>
                                        <div id="next"></div>

                                        <button type="button" name="addrow" id="addrow"
                                            class="btn btn-success pull-right">Add New</button></br></br>
                                        <br></br>
                                        <!-- <button type="submit" name="bill_detail_submit"
                                            class="btn btn-info pull-right">Submit</button> -->
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2 float-sm-right">
                            <div class="form-group">
                                <label class="form-label">Sub Total</label>
                                <input type="text" maxlength="12"  name="sub_total_amount" id="sub_total_amount" class="form-control"
                                    placeholder="Sub Total Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?" value="" form-required>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2 float-sm-right">
                            <div class="form-group">
                                <label class="form-label">Discount</label>
                                <input type="text" maxlength="12" name="discount" class="form-control"
                                    placeholder="Discount" pattern="[0-9]+(\\.[0-9][0-9]?)?" value="">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2 float-sm-right">
                            <div class="form-group">
                                <label class="form-label">Net Total</label>
                                <input type="text" maxlength="12" name="net_total" class="form-control" 
                                    placeholder="Net Total" pattern="[0-9]+(\\.[0-9][0-9]?)?" value="">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2 float-sm-right">
                            <div class="form-group">
                                <label class="form-label">Advance Paid</label>
                                <input type="text" maxlength="12" name="avd_paid" class="form-control"
                                    placeholder="Advance Paid" pattern="[0-9]+(\\.[0-9][0-9]?)?" value="">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-2 float-sm-right">
                            <div class="form-group">
                                <label class="form-label">Due Amount</label>
                                <input type="text" maxlength="14" name="due_amount" class="form-control"
                                    placeholder="Due Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?" value="">
                            </div>
                        </div>
                        <!-- <input type="hidden" name="b_id" value="<?php #echo $id; ?>"> -->
                        <div class="card-footer text-right">
                            <!-- <button type="submit" class="btn btn-primary" name="bill_btn">Add Bill</button> -->
                            <button type="submit" class="btn btn-primary" name="submit">Add Bill</button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>
    <!-- /.content -->


    
<?php include('includes/script.php'); ?>

    <script>
        $('#addrow').click(function () {
            var length = $('.sl').length;
            //alert(length);
            var i = parseInt(length) + parseInt(1);
            var newrow = $('#next').append('<div class="row"><div class="col-sm-1"><label for="">Sl No.</label><input type="text" class="form-control sl" name="slno[]" value="' + i + '" readonly=""></div><div class="col-sm-2"><label for="">Vehicle Type</label><input type="text" maxlength="20" class="form-control Sl" name="vehcile_type[]" id="vehcile_type' + i + '" placeholder="Type"></div><div class="col-sm-2"><label for="">Company name</label><select name="travel[]" class="form-control sl" id="travel' + i +'"><?php $sd = "SELECT * FROM travel_agency";
                                            $ff = mysqli_query($con, $sd);
                                            while ($ft = mysqli_fetch_assoc($ff)) {
                                                $in = $ft['agency_name']; ?> <option> <?php echo $in; ?> </option> <?php } ?> </select></div><div class="col-sm-2"><label for="">Bus No</label><select class="form-control" name="type[]" id="type' + i + '" ><?php $sd = "SELECT * FROM vehicle";
            $fd = mysqli_query($con, $sd);
            while ($ft = mysqli_fetch_assoc($fd)) {
                $in = $ft['reg_no']; ?><option><?php echo $in; ?></option><?php } ?></select></div> <div class="col-sm-2"><label for="">Trip Date</label><input type="date" class="form-control Sl" name="trip_date[]" id="trip_date' + i +'"></div><div class="col-sm-2"><label for="">Total Days</label><input type="number" max="30" class="form-control Sl" name="day[]" id="day'+ i + '" placeholder="Total Days"></div><div class="col-sm-2"><label for="">Start ODM</label><input type="tel" maxlength="7" class="form-control Sl" name="start_odm[]" id="start_odm' + i + '" placeholder="Start KM"></div><div class="col-sm-2"><label for="">End ODM</label><input type="tel" maxlength="7" class="form-control Sl" onblur="totalodm(' + i + ')" name="end_odm[]" id="end_odm' + i + '" placeholder="End KM"></div><div class="col-sm-2"><label for="">Total ODM</label><input type="tel" maxlength="6" class="form-control Sl" name="total_odm[]" id="total_odm' + i + '" placeholder="Total KM"></div><div class="col-sm-2"><label for="">Rate Km/Fix</label><input type="text" maxlength="8" class="form-control Sl" name="rate[]" id="rate' + i + '" placeholder="Rate KM/Fix" pattern="[0-9]+(\\.[0-9][0-9]?)?">&nbsp;&nbsp;&nbsp;</div> <div class="col-sm-2"><label for="">Toll Tax</label><input type="text" maxlength="6" min="0" class="form-control Sl" name="toll[]" id="toll' + i + '" placeholder="Toll Tax" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">Driver Allowance</label><input type="text" maxlength="6" class="form-control Sl" name="da[]" id="da' + i + '" placeholder="Driver Allowance" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">City Permission</label><input type="text" maxlength="6" class="form-control Sl" name="permission[]" id="permission' + i + '" placeholder="City Permission" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">Tax Charge</label><input onblur="totalamount('+ i +')" type="text" maxlength="6" class="form-control Sl" name="tax[]" id="tax' + i + '" placeholder="Other State Tax Charge" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">Total Amount</label><input type="text" maxlength="8" class="form-control Sl" name="total_amount[]" id="total_amount' + i + '" placeholder="Total Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><input type="button" class="btnRemove btn btn-danger" value="Remove"/></div></br>');
        });

        $('body').on('click', '.btnRemove', function () {
            $(this).closest('div').remove()
        });

    </script>
    <script>
        function totalodm(val){
            var l = $('.sl').length;
            for(let i = 0;i < l;i++ ){
                if(i == val){
                    var x = document.getElementById(`start_odm${i}`).value;
                    var y = document.getElementById(`end_odm${i}`).value;
                    var z = document.getElementById(`total_odm${i}`);
                    z = Number(y) - Number(x);
                    document.getElementById(`total_odm${i}`).value = z;
                }
            }
        }
        function totalamount(val){
            var l = $('.sl').length;
            for(let i = 0;i < l;i++ ){
                if(i == val){
                    var g = document.getElementById(`total_odm${i}`).value;
                    var f = document.getElementById(`rate${i}`).value;
                    var a = document.getElementById(`toll${i}`).value;
                    var b = document.getElementById(`da${i}`).value;
                    var c = document.getElementById(`permission${i}`).value;
                    var d = document.getElementById(`tax${i}`).value;
                    // var e = document.getElementById(`total_amount${i}`).value;
                    var e = Number(g) * Number(f) +( Number(a) + Number(b) + Number(c) + Number(d));
                    document.getElementById(`total_amount${i}`).value = e ;
                }
            }
        }
        // setInterval(subTotal, 1000);
        // var text = 0;
        // function subTotal(){
        //     var sub_total = document.getElementsByClassName('super_total');
        //         // var sub_total_length = sub_total.length - 1;
        //         for(let j = 0;j <= sub_total.length; j++){
        //             text += Number(sub_total[j].value);
        //         }
        //         console.log(text);
        // }
    </script>

</body>

</html>
<?php include('includes/footer.php'); ?>



<!--<script>
        $('#addrow').click(function () {
            var length = $('.sl').length;
            //alert(length);
            var i = parseInt(length) + parseInt(1);
            var newrow = $('#next').append('<div class="row"><div class="col-sm-1"><label for="">Sl No.</label><input type="text" class="form-control sl" name="slno[]" value="' + i + '" readonly=""></div><div class="col-sm-2"><label for="">Bus Type</label><select class="form-control" name="type[]" id="type' + i + '" ><?php $sd = "SELECT * FROM vehicle";
            $fd = mysqli_query($con, $sd);
            while ($ft = mysqli_fetch_assoc($fd)) {
                $in = $ft['reg_no']; ?><option><?php echo $in; ?></option><?php } ?></select></div><div class="col-sm-2"><label for="">Start ODM</label><input type="tel" maxlength="7" class="form-control Sl" name="start_odm[]" id="start_odm' + i + '" placeholder="Start KM"></div><div class="col-sm-2"><label for="">End ODM</label><input type="tel" maxlength="7" class="form-control Sl" name="end_odm[]" id="end_odm' + i + '" placeholder="End KM"></div><div class="col-sm-2"><label for="">Total ODM</label><input type="tel" maxlength="6" class="form-control Sl" name="total_odm[]" id="total_odm' + i + '" placeholder="Total KM"></div><div class="col-sm-2"><label for="">Rate Km/Fix</label><input type="tel" maxlength="8" class="form-control Sl" name="rate[]" id="rate' + i + '" placeholder="Rate KM/Fix">&nbsp;&nbsp;&nbsp;</div> <div class="col-sm-2"><label for="">Toll Tax</label><input type="tel" maxlength="6" min="0" class="form-control Sl" name="toll[]" id="toll' + i + '" placeholder="Toll Tax"></div><div class="col-sm-2"><label for="">Driver Allowance</label><input type="tel" maxlength="6" class="form-control Sl" name="da[]" id="da' + i + '" placeholder="Driver Allowance"></div><div class="col-sm-2"><label for="">City Permission</label><input type="tel" maxlength="6" class="form-control Sl" name="permission[]" id="permission' + i + '" placeholder="City Permission"></div><div class="col-sm-2"><label for="">Tax Charge</label><input type="tel" maxlength="6" class="form-control Sl" name="tax[]" id="tax' + i + '" placeholder="Other State Tax Charge"></div><div class="col-sm-2"><label for="">Total Amount</label><input type="tel" maxlength="8" class="form-control Sl" name="total_amount[]" id="total_amount' + i + '" placeholder="Total Amount"></div><input type="button" class="btnRemove btn btn-danger" value="Remove"/></div></br>');
        });

        $('body').on('click', '.btnRemove', function () {
            $(this).closest('div').remove()
        });

       
    </script>-->