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
                            <li class="breadcrumb-item"><a href="booking.php">Booking</a></li>
                            <li class="breadcrumb-item active">Add Bill</li>
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
                            <!--<form id="form1" method="GET" action="bills.php" class="form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-4">
                                        <span class="input-group-text">Invoice</span>
                                            <select class="form-control" name="b_inv">
                                                <?php
                                                $st = mysqli_query($con,"SELECT * FROM booking");
                                                while($sf = mysqli_fetch_assoc($st)){ ?>
                                                <option value="<?php echo $sf['b_id']; ?>"
                                                ><?php echo $sf['b_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <input type="number" value="<?php #if (isset($_SESSION['invoice_no'])) {
                                                #echo $_SESSION['invoice_no'];
                                                #unset($_SESSION['invoice_no']);
                                            #} ?>" name="b_inv" maxlength="4" class="form-control" id="b_invoice"
                                         placeholder="Invoice No" form-required> 
&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary" id="submitBtn"
                                            name="billf_btn">Search</button>
                                            </div>

                                    </div>
                                    
                                        
                                </div>
                            </form>-->
                            <div class="row">
                                <?php
                                if (isset($_GET['b_id'])) {
                                    $id = $_GET['b_id'];
                                    $_SESSION['invoice_no'] = $id;
                                    $query = "SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>

                                            <div class="col-mb-3">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" >Invoice No</span>
                                                    <input type="text" maxlength="20" class="form-control"
                                                    style="color:blue;" value="<?php echo $row['b_invoice']; ?>" placeholder="Enter Name" disabled>&nbsp;&nbsp;
                                        
                                                    <span class="input-group-text">Name</span>
                                                    <input type="text"class="form-control" style="color:blue;"
                                                        value="<?php echo $row['b_name']; ?>" placeholder="Enter Name" readonly>
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
                                        <input type="text" maxlength="20" class="form-control Sl" name="vehicle_type[]"
                                            id="vehicle_type" placeholder="Type">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Bus No</label>
                                        <select name="type[]" class="form-control" id="type">
                                            <option value="" selected hidden>Vehicle No</option>
                                            <?php
                                            $sd = "SELECT * FROM vehicle WHERE v_status='1'";
                                            $ff = mysqli_query($con, $sd);
                                            while ($ft = mysqli_fetch_assoc($ff)) {
                                                ?>
                                                          <option value="<?php echo $ft['id']; ?>"> <?php echo $ft['reg_no'];?> </option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <!-- <input type="text" class="form-control Sl" name="type[]" id="type"
                                                placeholder="56 ac/n-ac"> -->
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Start ODM</label>
                                        <input type="number" maxlength="7" class="form-control Sl" name="start_odm[]"
                                            id="start_odm0" placeholder="Start KM" >
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">End ODM</label>
                                        <input type="number" maxlength="7" class="form-control Sl" onblur="totalodm(0)" name="end_odm[]"
                                            id="end_odm0" placeholder="End KM" >
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Total ODM</label>
                                        <input type="number" maxlength="6" class="form-control Sl" name="total_odm[]"
                                            id="total_odm0" placeholder="Total KM">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Rate Km/Fix</label>
                                        <input type="text" maxlength="8" class="form-control Sl" name="rate[]" id="rate0"
                                            placeholder="Rate KM/Fix" pattern="[0-9]+([\.,][0-9]+)?" step="0.01">&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Toll Tax</label>
                                        <input type="text" maxlength="6" min="0" class="form-control Sl" name="toll[]"
                                            id="toll0" placeholder="Toll Tax" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Driver Allowance</label>
                                        <input type="text" maxlength="6" class="form-control Sl" name="da[]" id="da0"
                                            placeholder="Driver Allowance" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">City Permission</label>
                                        <input type="text" maxlength="6" class="form-control Sl" name="permission[]"
                                            id="permission0" placeholder="City Permission" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Tax Charge</label>
                                        <input type="text" maxlength="6" class="form-control Sl"  onblur="totalamount(0)" name="tax[]" id="tax0"
                                            placeholder="Other State Tax Charge" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="">Total Amount</label>
                                        <input type="text" maxlength="8" class="form-control Sl" name="total_amount[]"
                                            id="total_amount0" placeholder="Total Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                    </div>
                                    <div><br>
                                        <div id="next"></div>

                                        <button type="button" name="addrow" id="addrow"
                                            class="btn btn-success pull-right">Add New</button></br></br>
                                        
                                        <!-- <button type="submit" name="bill_detail_submit"
                                            class="btn btn-info pull-right">Submit</button> -->
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3 float-sm-right">
                            <div class="form-group">
                            <div class="input-group mb-2">
                                        <span class="input-group-text">Sub Total</span>
                            <input type="text" maxlength="12" name="sub_total_amount" class="form-control"
                                    placeholder="Sub Total Amount" value="" pattern="[0-9]+(\\.[0-9][0-9]?)?" form-required>
                            </div>
                            <div class="input-group mb-2">
                                        <span class="input-group-text">Discount</span>
                                <input type="text" maxlength="12" name="discount" class="form-control"
                                    placeholder="Discount" value="" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                            </div>
                            <div class="input-group mb-2">
                            <span class="input-group-text">Net Total</span>
                                <input type="text" maxlength="12" name="net_total" class="form-control"
                                    placeholder="Net Total" value="" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                        </div>
                                        <div class="input-group mb-2">
                                        <span class="input-group-text">Advance Paid</span>
                                <input type="text" maxlength="12" name="avd_paid" class="form-control"
                                    placeholder="Advance Paid" pattern="[0-9]+(\\.[0-9][0-9]?)?" value="">
                                        </div>
                                        <div class="input-group mb-2">
                                        <span class="input-group-text">Due Amount</span>
                                <input type="text" maxlength="14" name="due_amount" class="form-control"
                                    placeholder="Due Amount" value="" pattern="[0-9]+(\\.[0-9][0-9]?)?">
                                        </div>
                        </div>
                       
                        <div class="card-footer">
                            <!-- <button type="submit" class="btn btn-primary" name="bill_btn">Add Bill</button> -->
                            <button type="submit" class="btn btn-primary" name="submit">Submit Bill</button>
                        </div>
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
            var newrow = $('#next').append('<div class="row"><div class="col-sm-1"><label for="">Sl No.</label><input type="text" class="form-control sl" name="slno[]" value="' + i + '" readonly=""></div><div class="col-sm-2"><label for="">Vehicle Type</label><input type="text" maxlength="20" class="form-control Sl" name="vehicle_type[]" id="vehicle_type' + i +'" placeholder="Type"></div><div class="col-sm-2"><label for="">Bus Type</label><select class="form-control" name="type[]" id="type' + i + '"><option value="" selected hidden>Vehicle No</option><?php $sd = "SELECT * FROM vehicle WHERE v_status='1'";
            $fd = mysqli_query($con, $sd);
            while ($ft = mysqli_fetch_assoc($fd)) {
             ?><option value="<?php echo $ft['id']; ?>"><?php echo $ft['reg_no'];?> </option><?php } ?></select></div><div class="col-sm-2"><label for="">Start ODM</label><input type="number" maxlength="7" class="form-control Sl" name="start_odm[]" id="start_odm' + i + '" placeholder="Start KM" ></div><div class="col-sm-2"><label for="">End ODM</label><input type="number" maxlength="7" class="form-control Sl" onblur="totalodm(' + i + ')" name="end_odm[]" id="end_odm' + i + '" placeholder="End KM" ></div><div class="col-sm-2"><label for="">Total ODM</label><input type="tel" maxlength="6" class="form-control Sl" name="total_odm[]" id="total_odm' + i + '" placeholder="Total KM"></div><div class="col-sm-2"><label for="">Rate Km/Fix</label><input type="text" maxlength="8" class="form-control Sl" name="rate[]" id="rate' + i + '" placeholder="Rate KM/Fix" pattern="[0-9]+(\\.[0-9][0-9]?)?">&nbsp;&nbsp;&nbsp;</div> <div class="col-sm-2"><label for="">Toll Tax</label><input type="text" maxlength="6" min="0" class="form-control Sl" name="toll[]" id="toll' + i + '" placeholder="Toll Tax" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">Driver Allowance</label><input type="text" maxlength="6" class="form-control Sl" name="da[]" id="da' + i + '" placeholder="Driver Allowance" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">City Permission</label><input type="text" maxlength="6" class="form-control Sl" name="permission[]" id="permission' + i + '" placeholder="City Permission" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">Tax Charge</label><input type="text" maxlength="6" class="form-control Sl" onblur="totalamount('+ i +')" name="tax[]" id="tax' + i + '" placeholder="Other State Tax Charge" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><div class="col-sm-2"><label for="">Total Amount</label><input type="text" maxlength="8" class="form-control Sl" name="total_amount[]" id="total_amount' + i + '" placeholder="Total Amount" pattern="[0-9]+(\\.[0-9][0-9]?)?"></div><input type="button" class="btnRemove btn btn-danger" value="Remove"/></div></br>');
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
        </script>
</body>
</html>
<?php
    // include('includes/footer.php');
    ?>