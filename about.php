<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSpeedy-About</title>
    <?php require('inc/links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>


<body class="bg-light">
<?php
require('inc/header.php');
?>


<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">ABOUT US</h2>
  <div class="h-line bg-dark"></div>
  <p style="text-align: justify;" class="text-center mt-3 fw-bold"><br>
    
  </p>
</div>

<br><br>


<div class="container bg-white p-4">
  <div class="row justify-content-between align-items-center">
    <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
      <h3 class="mb-3">Know More....</h3>
      <p style="text-align: justify;">
      Welcome to GoSpeedy, where convenience meets quality in the world of vehicle rentals,
       Whether you're planning a road trip<br> need a reliable two wheeler for your daily,
        or require a fleet of vehicles for business purposes.we've got you covered.<br>
        At GoSpeedy, we pride ourselves on offering a wide selection of well-maintained vehicles 
        to suit every need and budget. <br> our fleet is meticulously maintained to ensure your safety and 
        comfort on the road.<br>
        What sets us apart is our commitment to exceptional customer service. Our knowledgeable team is dedicated
         to making your rental experience seamless from start to finish. Whether you have questions about our vehicles,
         need assistance with booking, or require support during your rental period, we're here to help.<br>
            
    </div>
    <div class="col-lg-4 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
      <img src="images/about/1.jpg" class="w-100">
    </div>
  </div>
</div>
<br><br>

<div class="container bg-dark p-4 shadow mt-5">
  <div class="row">
    <div class="col-lg-3 col-md-6 px-4 mb-4 mt-4">
       <div class="bg-light rounded shadow p-4 border-top border-4 text-center">
        <img src="images/about/2.jpg" width="70px">
        <h4 class="mt-3">10+Branches</h4>
       </div>
    </div>
    <div class="col-lg-3 col-md-6 px-4 mb-4 mt-4">
       <div class="bg-light rounded shadow p-4 border-top border-4 text-center">
        <img src="images/about/3.jpg" width="70px">
        <h4 class="mt-3">500+ Orders</h4>
       </div>
    </div>
    <div class="col-lg-3 col-md-6 px-4 mb-4 mt-4">
       <div class="bg-light rounded shadow p-4 border-top border-4 text-center">
        <img src="images/about/4.jpg" width="70px">
        <h4 class="mt-3">700+ Clients</h4>
       </div>
    </div>
    <div class="col-lg-3 col-md-6 px-4 mb-4 mt-4">
       <div class="bg-light rounded shadow p-4 border-top border-4 text-center">
        <img src="images/about/5.jpg" width="70px">
        <h4 class="mt-3">100+ Ratings</h4>
       </div>
    </div>
  </div>
</div>
<br><br>

<h2 class="my-5 fw-bold h-font text-center">Our Team</h2>
<div class="container px-4">
<div class="swiper Swiper-about">
    <div class="swiper-wrapper mb-5">
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/12.jpg" class="w-100">
        <h5 class="mt-2 fw-bold">Kiran Gupta</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/11.jpg" class="w-100">
        <h5 class="mt-2 fw-bold">Naina Sharma</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/13.jpg" class="w-100">
        <h5 class="mt-2 fw-bold">Aniket Biswas</h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/10.jpg" class="w-100">
        <h5 class="mt-2 fw-bold">Rohan Mehra</h5>
      </div>
      

    </div>
    <br>
    <div class="swiper-pagination"></div>
  </div>
</div>

<br>
<?php
require('inc/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".Swiper-about", {
      slidesPerView: 4,
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 4,
        },
      }
    });
  </script>


</body>
</html>