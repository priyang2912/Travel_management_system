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
                    <h3 class="m-0 text-dark">Add Vehicle</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="vehicle.php">Vehicle</a></li>
                        <li class="breadcrumb-item active">Add Vehicle</li>
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


                            <form action="database.php" method="POST" id="add_vehicle" autocomplete="off"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Registration No *</lable>
                                                <input type="text" name="reg_no" maxlength="10" class="form-control"
                                                    placeholder="Registration Number" pattern="^[A-Z|a-z]{2}\s?[0-9]{1,2}\s?[A-Z|a-z]{0,3}\s?[0-9]{4}$"
 required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Vehical Type / Seat *</lable>
                                                <input type="text" name="type" class="form-control"
                                                    placeholder="Vehicle Type" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Chassis No *</lable>
                                                <input type="text" name="cha_no" class="form-control"
                                                    placeholder="Chassis Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Engine No *</lable>
                                                <input type="text" name="eng_no" class="form-control"
                                                    placeholder="Engine Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Register Date *</lable>
                                                <input type="date" name="reg_dt" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Permit Expire Date </lable>
                                                <input type="date" name="per_dt" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fitness Expire Date *</lable>
                                                <input type="date" name="fit_dt" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Insurance Expire Date *</lable>
                                                <input type="date" name="ins_dt" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>PUC Expire Date *</lable>
                                                <input type="date" name="puc_dt" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>RC Document </lable>
                                                <input type="file" name="rc_doc" id="rc_doc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fitness Document </lable>
                                                <input type="file" name="fit_doc" id="fit_doc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Permit Document </lable>
                                                <input type="file" name="per_doc" id="per_doc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Insurance Document </lable>
                                                <input type="file" name="ins_doc" id="ins_doc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>PUC Document </lable>
                                                <input type="file" name="puc_doc" id="puc_doc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Vehicle Status</label>
                                            <select id="v_status" name="v_status" class="form-control" required="true">
                                                <option value="" hidden>Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal-footer">
                                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>

                                        <button type="submit" name="addvehicle_btn" class="btn btn-primary">Submit
                                            Data</button>
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