<?php
    require('admin/db_config.php');
    require('admin/ess.php');
    
    



    
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
    $settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));

    if($settings_r['shutdown']){
      echo<<<alertbar
      <div class='bg-danger text-center p-2 fw-bold'>
      <i class="bi bi-exclamation-triangle-fill"></i>  Bookings are temporarily closed. Please try later.
      </div>
      alertbar;
    }
?>
 
 
 <!-- navigation bar -->
 <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-dark text-light px-lg-3 py-lg-2 shadow sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 text-light h-font" href="index.php"><?php echo $settings_r['site_title']?></a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link  me-3  text-light" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 text-light" href="jewellery.php">Vehicle</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 text-light" href="about.php">About Us</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link me-3 text-light" href="contact.php">Contact Us</a>
        </li>
      </ul>
      <div class="d-flex">
      <?php
      
      if(isset($_SESSION['login']) && $_SESSION['login'] == true)
      {
        echo<<<data
          <div class="btn-group">
            <button type="button" class="btn btn-success shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
              Hello $_SESSION[uName]
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="my_bookings.php">Bookings</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </div>

        data;
      }else{
        echo<<<data
        <button type="button" class="btn btn-outline-light shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
            LOGIN
        </button>
        <button type="button" class="btn btn-outline-light shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#registerModal">
          REGISTER
        </button>

        data;


      }
     
      ?>
        
    </div>
    </div>
  </div>
</nav>
  <!-- navigation bar end -->


  <!-- login modal -->
<div class="modal fade shadow-none" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form">
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-light">
      <div class="mb-3">
        <label class="form-label">Email / Mobile no.</label>
        <input type="text" name="email_mob" required class="form-control shadow-none">
     </div>
     <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="pass" required class="form-control shadow-none">
     </div>
     <div class="d-flex align-items-center justify-content-between mb-2"> 
      <button type="submit" class="btn btn-dark shadow-none bg-light text-dark">login</button>
      <button type="button" class="btn btn-dark text-danger fw-bold shadow-none me-lg-2 me-3 p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
          Forgot Password?
      </button>
      
     </div>
     </div>
    </form>
    </div>
  </div>
</div>
 <!-- login modal end  -->


<!-- registration modal -->
<div class="modal fade shadow-none" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form">
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-fill-check fs-3 me-2"></i>User Registration</h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark text-light">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Phone</label>
            <input type="number" name="phone" class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Address</label>
            <textarea name="address" required rows="1" class="form-control shadow-none"></textarea>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pincode</label>
            <input name="pincode" type="number" class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Date Of Birth</label>
            <input name="dob" type="date" class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Password</label>
            <input name="pass" type="password" class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Confirm Password</label>
            <input name="cpass" type="password" class="form-control shadow-none" required>
          </div>
         </div>
      </div>
      <div class="text-center">
      <button type="submit" class="btn btn-dark shadow-none bg-light text-dark my-1">Register</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- registration modal end -->



<div class="modal fade shadow-none" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="forgot-form">
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-lock-fill"></i>&nbsp;&nbsp;Forgot Password</h5>
      
      </div>
      <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap mt-3">
        NOTE: A link will be sent to your registered email to reset your password.
      </span>
      <div class="modal-body bg-dark text-light">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" required class="form-control shadow-none">
     </div>
     <div class="mb-2 text-end"> 
     
      <button type="button" class="btn bg-light text-dark shadow-none " data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
          Cancel
      </button>
      <button type="submit" class="btn btn-dark shadow-none bg-light text-dark">Send Link</button>
      
     </div>
     </div>
    </form>
    </div>
  </div>
</div>