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
          <h1 class="m-0 text-dark">Part Detail Add
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="part.php">Parts</a></li>
            <li class="breadcrumb-item active">Add Part</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form method="POST" id="part" class="card" action="database" enctype="multipart/form-data">
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
          <option value="<?php echo $row['id'] ?>"> <?php echo $row['reg_no']; ?> </option>
          <?php } ?>
                  

                </select>
              </div>
            </div>
            <div class="col-md-3">
                            <div class="form-group">
                                <label for="buy_date">Buy Date *</label>
                                <input type="date" name="p_buy_date" id="p_buy_date" class="form-control" required>
                            </div>
                        </div>
            
           
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="p_part">Discription Part*</label>
                                <input type="text" name="p_part" maxlength="100" id="p_part" class="form-control" placeholder="part name" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_quantity">Quantity*</label>
                                <input type="number" name="p_quantity" maxlength="20" max="90" min="1" id="p_quantity" class="form-control" placeholder="1" required>
                            </div>
                        </div>
            
                                  <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_vendor">Store/vendor Name </label>
                                <input type="text" name="p_vendor" id="p_vendor" maxlength="70" class="form-control" placeholder="Vendor Name" />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_bill_no">Bill No*</label>
                                <input type="text" name="p_bill_no" id="p_bill_no" maxlength="60" class="form-control" placeholder="Bill NO" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                        <label class="form-label">Upload Bill</label>
                        <input type="file" name="p_bill_doc" id="p_bill_doc"  class="form-control" placeholder="Upload Bill" >
                      </div>
                    </div>
            
                                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_warranty_dt">Warranty Expire Date </label>
                                <input type="date" name="p_warranty_dt" id="p_warranty_dt" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_price">Part Price*</label>
                                <input type="tel" name="p_price" id="p_price" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="[0-9]+(\\.[0-9][0-9]?)?" required>
                            </div>
                        </div>
                          
                    <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_odm">Odomeater</label>
                                <input type="tel" name="p_odm" id="p_odm" maxlength="7" min="1" class="form-control"
                                    placeholder="455678" pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_total_amount">Total Amount*</label>
                                <input type="tel" name="p_total_amount" id="p_total_amount" maxlength="8" class="form-control"
                                    placeholder="10,000.00" pattern="[0-9]+(\\.[0-9][0-9]?)?" required>
                            </div>
                        </div>
                        <div class="form-group">
                <label for="">Payment</label></br>
                <select id="p_status" name="p_status" class="form-control" require="true" onchange="changeDropdown(this.value);">
                <option value="none" selected disabled hidden>Select</option>
                  <option value="0">Paid</option>
                  <option value="1">Due Payment</option>
                </select>
              </div>

                        <div class="col-md-2">
                            <div class="form-group" id="p_due_amounts">
                                <label for="p_due_amount">Due Payment</label>
                                <input type="number" name="p_due_amount" id="p_due_amount" maxlength="8" min="0" class="form-control" pattern="[0-9]+(\\.[0-9][0-9]?)?"
                                    placeholder="1000.00">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_payment_dt">Payment Date</label>
                                <input type="date" name="p_payment_dt" id="p_payment_dt" class="form-control">
                            </div>
                        </div>
                       
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="p_comment">Comment </label>
                                <input type="text" name="p_comment" maxlength="200" class="form-control" id="p_comment" placeholder="any">
                            </div>
                        </div>
          </div>
          <div class="modal-footer">
          <input type="reset" value="Reset" class="btn btn-danger" />
            <button type="submit" class="btn btn-primary" name="part_add_btn">Add Part</button>
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

<script>
function changeDropdown()
{
    var status=document.getElementById("p_status").value;
    if(status=="1" || status=="none"){
        document.getElementById("p_due_amounts").style.visibility='visible';
    }
    else{
        document.getElementById("p_due_amounts").style.visibility='hidden';

    }
}
    </script>
