<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle-Contact</title>
    <?php require('inc/links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>


<body class="bg-light">
<?php
require('inc/header.php');
?>


<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">Contact US</h2>
  <div class="h-line bg-dark"></div>
  <p style="text-align: justify;" class="text-center mt-3 fw-bold"><br>
    Contact us to get best Vehicle at best price.Stay connected with us for the latest updates.<br>If you'd like to know more about our work or process feel free to get in touch.
  </p>
</div>
<br>


<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 mb-5 px-4">
      <div class="bg-white shadow p-4 rounded">
       <iframe class="w-100 rounded mb-4" src="<?php echo $contact_r['iframe'] ?>"  height="330px"  loading="lazy"></iframe>
        <div class="row px-4">
        <div class="col-lg-5  bg-dark text-light p-4 rounded shadow mb-4">
          <h5><b>Address</b></h5> 
          <a href="<?php echo $contact_r['gmap'] ?>" class="text-decoration-none text-white fw-bold"><i class="bi bi-geo-alt "></i>&nbsp;<?php echo $contact_r['address'] ?></a>
        </div> 
        <div class="col-lg-2  bg-white">

        </div>
    
        <div class="col-lg-5 bg-dark text-light p-4 rounded shadow mb-4">
          <h5><b>Call Us</b></h5>
          <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-light" >
          <i class="bi bi-telephone-outbound-fill"></i>&nbsp;&nbsp;+<?php echo $contact_r['pn1'] ?></a><br>
          <a href="tel: +<?php echo $contact_r['pn2'] ?>" class="d-inline-block mb-2 text-decoration-none text-light" >
          <i class="bi bi-telephone-outbound-fill"></i>&nbsp;&nbsp;+<?php echo $contact_r['pn2'] ?></a>
        </div> 
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 mb-5 px-4">
       <div class="bg-white rounded shadow p-4">
        <form action="" method="POST">
          <h5 class="fw-bold text-center">Send A Message</h5>
          <div class="mt-3">
            <label class="form-label fw-bold">Name</label>
            <input type="text" name="name" required class="form-control shadow-none">
          </div>
          <div class="mt-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" required class="form-control shadow-none">
          </div>
          <div class="mt-3">
            <label class="form-label fw-bold">Address</label>
            <input type="text" name="address" required class="form-control shadow-none">
          </div>
          <div class="mt-3">
            <label class="form-label fw-bold">Message</label>
            <textarea name="message" required class="form-control shadow-none" row="4"></textarea>
          </div>
          <button type="submit" name="submit" class=" mt-3 btn btn-dark custom-bg text-light my-1">Submit</button>
        </form>

       </div>
    </div>
  </div>
</div>



<?php

if(isset($_POST['submit'])){
  $frm_data = filteration($_POST);
  $query = "INSERT INTO `user_queries`(`name`, `email`, `address`, `message`) VALUES (?,?,?,?)";
  $values = [$frm_data['name'],$frm_data['email'],$frm_data['address'],$frm_data['message']];

  $res = insert($query,$values,'ssss');
  if($res==1){
    echo '<script>alert("message sent successfully")</script>'; 
  }else{
    echo '<script>alert("Error in sending message")</script>'; 
  }
  
}
?>

<br>
<?php
require('inc/footer.php');
?>



</body>
</html>