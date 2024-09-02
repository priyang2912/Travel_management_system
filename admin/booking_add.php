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
            <h1 class="m-0 text-dark">Add Booking
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="booking.php">Booking</a></li>
              <li class="breadcrumb-item active">Add Booking</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form method="POST" action="database.php" class="card">
         <div class="card-body">
            <div class="row">
               
               <div class="col-sm-6 col-md-3">
                  <label class="form-label">Invoice No.<span class="form-required">*</span></label>
                  <div class="form-group">
                     <input type="number" name="b_invoice" maxlength="4" class="form-control" placeholder="Enter Invoice No" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Booking Date<span class="form-required">*</span></label>
                     <input type="date" name="b_book_date" class="form-control" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Name<span class="form-required">*</span></label>
                     <input type="text" name="b_name" maxlength="40" class="form-control" placeholder="Enter Name" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Address<span class="form-required">*</span></label>
                     <textarea class="form-control" autocomplete="off" placeholder="Address" maxlength="90"  name="b_address" ></textarea>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Mobile No<span class="form-required">*</span></label>
                     <input type="tel" name="b_mobile1" maxlength="10" class="form-control" placeholder="Enter Mobile No." form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Mobile No.</label>
                     <input type="tel" name="b_mobile2" maxlength="10" class="form-control" placeholder="Enter Mobile No." >
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Pickup Location<span class="form-required">*</span></label>
                     <input type="text" name="b_pickup" maxlength="50" class="form-control" placeholder="Enter Pickup Location" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Trip Date & Time<span class="form-required">*</span></label>
                     <input type="datetime-local" name="b_trip_start" class="form-control" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">End Trip Date & Time<span class="form-required">*</span></label>
                     <input type="datetime-local" name="b_trip_end" class="form-control" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Total Days<span class="form-required">*</span></label>
                     <input type="text" maxlength="2" max="31" pattern="[0-9]+" name="b_total_days" class="form-control" placeholder="Enter Total Days " form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Total Members<span class="form-required">*</span></label>
                     <input type="text" maxlength="2" name="b_member" pattern="[0-9]+" class="form-control" placeholder="Enter Total Member" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Bus / Car Type<span class="form-required">*</span></label>
                     <input type="text" maxlength="50" name="b_type" class="form-control" placeholder="Enter Vehicle Type" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                 <div class="form-group">
                     <label class="form-label">Total Bus/car</label>
                     <select name="b_total" required="true" class="form-control">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="10">11</option>
                      <option value="10">12</option>
                      <option value="10">13</option>
                      <option value="10">14</option>
                      <option value="10">15</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Route<span class="form-required">*</span></label>
                     <input type="text" maxlength="50" name="b_route" class="form-control" placeholder="Enter Route details" form-required>
                  </div>
               </div>
                <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">KM Price/ Fix Rate<span class="form-required">*</span></label>
                     <input type="text" maxlength="14" name="b_price" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" placeholder="Enter KM / Fix price" form-required>
                  </div>
               </div>
               
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Reference</label>
                     <input type="text" maxlength="16" name="b_reference" class="form-control" placeholder="Enter Reference Name">
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Deposite<span class="form-required">*</span></label>
                     <input type="text" maxlength="14" name="b_deposite" class="form-control" pattern="[0-9]+(\\.[0-9][0-9]?)?" placeholder="Enter Deposite" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                     <label class="form-label">Note/ Any Information</label>
                     <input type="text" maxlength="28" name="b_note" class="form-control" placeholder="Enter Note">
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                     <label class="form-label">Payment Status</label>
                     <select name="b_status" class="form-control">
                        <option value="" selected hidden>Status</option>
                        <option value="0">UNPAID</option>
                        <option value="1">PARTIALLY PAID</option>
                        <option value="2">FULLY PAID</option> 
                     </select>
                  </div>
               </div>
               </div>

               <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary" name="booking_btn">Add Booking</button>
                </div>
             
</div>      
      </form>
             </div>
    </section>
</div>
    <!-- /.content -->

    <?php include('includes/script.php'); ?>

    <?php
include('includes/footer.php');
?>