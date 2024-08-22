<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSpeedy- My Profile</title>
    <?php require('inc/links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>


<body class="bg-light">
<?php
  require('inc/header.php');

  if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
    redirect('index.php');
  }

  $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'s');
  if(mysqli_num_rows($u_exist)==0){
    redirect(index.php);
  }
  $u_fetch = mysqli_fetch_assoc($u_exist);

?>




<div class="container mb-4">
  <div class="row">

      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold text-center h-font">MY PROFILE</h2>
        <div class="h-line bg-dark mb-4"></div>
        <div style="font-size: 16px;">
            <a href="index.php" class="text-secondary text-decoration-none  fw-bold">Home</a>
            <span class="text-secondary fw-bold "> > </span>
            <a href="jewellery.php" class="text-secondary text-decoration-none  fw-bold">Profile</a>
        </div>
      </div>

      <div class="col-lg-8 col-md-12 mb-5 px-4">
        <div class="bg-dark p-3 p-md-4 rounded shadow-sm">
          <form id="info-form">
              <h5 class="mb-3 fw-bold text-center text-light">Basic Information</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label text-light fw-bold">Name</label>
                  <input type="text" name="name" value="<?php echo $u_fetch['name']?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-light fw-bold">Phone No.</label>
                  <input type="text" name="phone" value="<?php echo $u_fetch['phone']?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-light fw-bold">Email address</label>
                  <input type="email" name="email" value="<?php echo $u_fetch['email']?>" class="form-control shadow-none" readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-light fw-bold">Address</label>
                  <textarea name="address" required rows="1" class="form-control shadow-none"><?php echo $u_fetch['address']?></textarea>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-light fw-bold">Pincode</label>
                  <input name="pincode" type="number" value="<?php echo $u_fetch['pincode']?>" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-light fw-bold">Date Of Birth</label>
                  <input name="dob" type="date" value="<?php echo $u_fetch['dob']?>" class="form-control shadow-none" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn  shadow-none bg-success text-white fw-bold my-1">Save Changes</button>
                </div>
              </div>
          </form>

        </div>
      </div>

      <div class="col-lg-4 col-md-12 mb-5 px-4">
        <div class="bg-light p-3 p-md-4 rounded shadow">
          <form id="pass-form">
              <h5 class="mb-3 fw-bold text-center mt-3 mb-4">Change Password</h5>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <label class="form-label fw-bold">New Password</label>
                  <input name="new_pass" type="password" class="form-control shadow-none" required>
                </div>
                <div class="col-md-12 mb-4">
                  <label class="form-label fw-bold">Confirm Password</label>
                  <input name="confirm_pass" type="password" class="form-control shadow-none" required>
                </div>


                <div class="text-center">
                  <button type="submit" class="mt-4 mb-4 w-100 btn  shadow-none bg-dark text-white fw-bold my-1">Save</button>
                </div>
              </div>
          </form>

        </div>
      </div>



        
  
    
  </div>
</div>  


<br>
<?php
require('inc/footer.php');
?>

<script>


  let info_form = document.getElementById('info-form');

  info_form.addEventListener('submit',function(e){
    e.preventDefault();
    let data = new FormData();

    data.append('info_form','');
    data.append('name',info_form.elements['name'].value);
    data.append('phone',info_form.elements['phone'].value);
    data.append('address',info_form.elements['address'].value);
    data.append('pincode',info_form.elements['pincode'].value);
    data.append('dob',info_form.elements['dob'].value);

    let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/profile.php",true);
  
        xhr.onload = function(){
          if(this.responseText == 'phone_already')
          {
            alert('phone number already exists');
          }
          else if(this.responseText == 0)
          {
            alert('no changes made');
          }
          else
          {
            window.location.href="profile.php";
          }
        }

        xhr.send(data);

  });

  let pass_form = document.getElementById('pass-form');
  pass_form.addEventListener('submit',function(e){
    e.preventDefault();

    let new_pass = pass_form.elements['new_pass'].value;
    let confirm_pass = pass_form.elements['confirm_pass'].value;

    // if(new_pass!=confirm_pass){
    //   alert('Password Mismatched! Please write same pasword');
    //   return false;
    // }

    let data = new FormData();

    data.append('pass_form','');
    data.append('new_pass',new_pass);
    data.append('confirm_pass',confirm_pass);
   

    let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/profile.php",true);
  
        xhr.onload = function(){
          if(this.responseText == 'mismatch')
          {
            alert('password do not match!');
          }
          else if(this.responseText == 0)
          {
            alert('Failed To change password');
          }
          else
          {
            alert('Password change successfully!');
            pass_form.reset();
          }
        }

        xhr.send(data);

  });


</script>


</body>
</html>