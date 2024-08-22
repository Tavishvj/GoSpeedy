<!-- footer -->
<div class="container-fluid px-4 bg-dark mt-5 w-100 text-light">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2 px-0 px-md-0 px-lg-4 text-justify"><?php echo $settings_r['site_title']?></h3>
      <p class="px-0 px-md-0 px-lg-4" style="text-align: justify;"><?php echo $settings_r['site_about']?></p>

    </div>
    <div class="col-lg-2 p-4 ">
      <h5 class="mb-3 fw-bold px-0 px-md-0 px-lg-4">Links</h5>
      <a href="index.php" class="d-inline-block mb-2 text-decoration-none text-light px-0 px-md-0 px-lg-4">-Home</a><br>
      <a href="jewellery.php" class="d-inline-block mb-2 text-decoration-none text-light px-0 px-md-0 px-lg-4">-Vehicle</a><br>
      <a href="about.php" class="d-inline-block mb-2 text-decoration-none text-light px-0 px-md-0 px-lg-4">-About Us</a><br>
      <a href="contact.php" class="d-inline-block mb-2 text-decoration-none text-light px-0 px-md-0 px-lg-4">-Contact Us</a><br>
    </div>
    <div class="col-lg-2 p-4">
      <h5 class="mb-3 fw-bold px-0 px-md-0 px-lg-4 ">Follow Us</h5>
      <a href="<?php echo $contact_r['insta'] ?>" target="_blank"  class="px-0 px-md-0 px-lg-4 mb-2 d-inline-block mb-2 text-decoration-none text-light" >
        <i class="bi bi-instagram"></i>&nbsp;&nbsp; Instagram</a><br>
          <a href="<?php echo $contact_r['fb'] ?>" target="_blank"  class="px-0 px-md-0 px-lg-4 d-inline-block mb-2 text-decoration-none text-light" >
          <i class="bi bi-facebook"></i>&nbsp;&nbsp; Facebook</a>
      

    </div>

    <div class="col-lg-2 p-4 ">
      <h5 class="mb-3 fw-bold">Contact Us</h5>
      <a href="tel: +919636670570" class=" d-inline-block mb-2 text-decoration-none text-white" >
          <i class="bi bi-telephone-outbound-fill"></i>&nbsp;&nbsp;+91 8000254103</a><br>
          <a href="tel: +919636670570" class=" d-inline-block mb-2 text-decoration-none text-white">
          <i class="bi bi-telephone-outbound-fill"></i>&nbsp;&nbsp;+91 9352416613</a>
          <h5 class="mt-2"><b>Mail</b></h5>
        <a href="mailto: gargvertika469@gmail.com" class=" d-inline-block mb-2 text-decoration-none text-white" >
        <i class="bi bi-envelope-at-fill"></i>-tavishvijay05@gmail.com</a><br>
    </div>
    <div class="col-lg-2 p-4 ">
      <h5 class="mb-3 fw-bold">Address</h5>
      <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115548.28003474014!2d75.84696495!3d25.173402799999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396f9b30c41bb44d%3A0x5f5c103200045588!2sKota%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1695133688598!5m2!1sen!2sin"  height="220px"  loading="lazy"></iframe>
    </div>
  </div>

</div>
<h6 class="text-center bg-light text-dark p-3 m-0 fw-bold">Designed and Developed by Tavishvijay</h6>
<!-- footer end-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<script>

let register_form = document.getElementById('register-form');

  register_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phone',register_form.elements['phone'].value);
    
    data.append('address',register_form.elements['address'].value);
    data.append('pincode',register_form.elements['pincode'].value);
    data.append('dob',register_form.elements['dob'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('cpass',register_form.elements['cpass'].value);
    // data.append('profile',register_form.elements['profile'].files[0]);
    data.append('register','');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'pass_mismatch')
      {
        alert('password mismatch');
      }
      else if(this.responseText == 'email_already')
      {
        alert('email already exists');
      }
      else if(this.responseText == 'phone_already')
      {
        alert('phone number already exists');
      }
      else if(this.responseText == 'ins_failed')
      {
        alert('insertion failed');
      }
      else{
        alert('Registered! Email verification Link Has Been Sent ');
        register_form.reset();
      }
      

    }

    xhr.send(data);
 });


 let login_form = document.getElementById('login-form');

 login_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('email_mob',login_form.elements['email_mob'].value);
    data.append('pass',login_form.elements['pass'].value);
    data.append('login','');

    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email_mob')
      {
        alert('Invalid Email Address or Mobile No.!');
      }
      else if(this.responseText == 'not_verified')
      {
        alert('Email Not Verified!');
      }
      else if(this.responseText == 'inactive')
      {
        alert('Account Suspended!');
      }
      else if(this.responseText == 'invalid_pass')
      {
        alert('Please Check Password!');
      }
      else{
       window.location = window.location.pathname;
      }
      

    }

    xhr.send(data);
 });

 let forgot_form = document.getElementById('forgot-form');

 forgot_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('email',forgot_form.elements['email'].value);
    data.append('forgot_pass','');

    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email')
      {
        alert('Invalid Email Address!');
      }
      else if(this.responseText == 'not_verified')
      {
        alert('Email Not Verified!');
      }
      else if(this.responseText == 'inactive')
      {
        alert('Account Suspended!');
      }
      else if(this.responseText == 'inv_link')
      {
        alert('invalid link');
      }
      else{
       alert('link sent');
       forgot_form.reset();
      }
      

    }

    xhr.send(data);
 });


 function checkLogin(status,jewellery_id)
 {
  if(status){
    window.location.href='confirm_booking.php?id='+jewellery_id;
  }
  else{
    alert('Please login to book Vehicle!');
  }
 }


</script>

