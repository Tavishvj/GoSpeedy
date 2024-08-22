<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSpeedy-Vehicle Details</title>
    <?php require('inc/links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>


<body class="bg-light">
<?php
require('inc/header.php');
?>

<?php

if(!isset($_GET['id'])){
  redirect('jewellery.php');
}

$data = filteration($_GET);

$jewellery_res = select("SELECT * FROM `jewellery` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

if(mysqli_num_rows($jewellery_res)==0){
  redirect('jewellery.php');
}


$jewellery_data = mysqli_fetch_assoc($jewellery_res);



?>



<br>
<div class="container mb-4">
  <div class="row">

      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold h-font"><?php echo $jewellery_data['name'] ?></h2>
        <div style="font-size: 16px;">
            <a href="index.php" class="text-secondary text-decoration-none fw-bold">HOME</a>
            <span class="text-secondary fw-bold"> > </span>
            <a href="jewellery.php" class="text-secondary text-decoration-none fw-bold">Vehicle</a>
        </div>
       </div>


       <div class="col-lg-6 col-md-12 px-4">

          <div id="jewellery_carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php
                 $jewellery_img = JEWELLERY_IMG_PATH."thumbnail.jpg";
                 $img_q = mysqli_query($conn,"SELECT * FROM `jewellery_image` WHERE `jewellery_id`='$jewellery_data[id]'");
       
       
                 if(mysqli_num_rows($img_q)>0){
                  $active_class = 'active';
                  while($img_res = mysqli_fetch_assoc($img_q)){

                  echo "<div  class='carousel-item $active_class'>
                   <img style='height: 600px; width: 100%;' src='".JEWELLERY_IMG_PATH.$img_res['image']."' class='d-block' >
                   </div>";

                   $active_class='';
                  }
                   
                 }else{
                  echo "<div class='carousel-item active'>
                  <img src='$jewellery_img' class='d-block w-100' >
                </div>";
                 }
                
       
              ?>

            </div>
            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#jewellery_carousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#jewellery_carousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button> -->
          </div>
                    
       </div>

       <div class="col-lg-6 col-md-12 px-4">
          <div class="card mb-5 border-0 shadow h-100 rounded-3">
            <div class="card-body bg-dark text-light">
              <?php 

                // $cat_q = mysqli_query($conn,"SELECT c.name FROM `category` c INNER JOIN `jewellery_category` jcat ON c.id = jcat.category_id WHERE jcat.jewellery_id = '$jewellery_data[id]'");

                // $category_data = "";
                // while($cat_row = mysqli_fetch_assoc($cat_q)){
                //   $category_data .="<span class='badge rounded-pill bg-light text-dark text-wrap'>$cat_row[name]</span>";
                // }

                // echo<<<category
                // <h6 class="mb-3"><b>Category</b>$category_data</h6>
                // category;

                echo<<<price
                <h5 class="mb-4 mt-2"><b>Rent</b>-₹$jewellery_data[price]/- per day</h5>
                
                price;

                

                echo <<<security
                <h5 class="mb-4 mt-2"><b>Security Charges</b>-₹$jewellery_data[security_charge]/-</h5>
                security;

                $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating` WHERE `jewellery_id`= $jewellery_data[id] ORDER BY `sr_no` DESC LIMIT 20";
                $rating_res = mysqli_query($conn,$rating_q);
                $rating_fetch = mysqli_fetch_assoc($rating_res);

                $rating_data = "";

                if($rating_fetch['avg_rating']!=NULL)
                {
                 

                  for($i=0; $i<$rating_fetch['avg_rating']; $i++){
                    $rating_data .="  <i class='bi bi-star-fill text-warning'></i>";
                  }

               
                }

                echo<<<rating
                <div class="rating mb-4">
                  $rating_data
                </div>
                rating;
               
                echo<<<Description
                <br><br> 
                <h5 class="mb-4"><b>Description</b></h5><p>$jewellery_data[description]</p>
                
                Description;

        
              
                if(!$settings_r['shutdown'])
                {
                  $login = 0;
                  if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                    $login = 1;
                  }
                 
                  echo<<< book
                 
                  <br><br><br><br>
                  <button onclick='checkLogin($login,$jewellery_data[id])' class='bg-success btn w-100 text-light'>Continue</button>
  
                  book;
                }
               

               


              

              ?>
            </div>
          </div>
      </div>
   
   <div>
    <br>
    <h4 class="mt-4 mb-3"><b>Review and Rating</b></h4>
    <?php
        $review_q = "SELECT r.*,uc.name AS uname, j.name AS jname FROM `rating` r 
            INNER JOIN `user_cred` uc ON r.user_id = uc.id
            INNER JOIN `jewellery` j ON r.jewellery_id = j.id WHERE r.jewellery_id ='$jewellery_data[id]' ORDER BY `sr_no` ASC LIMIT 6";

       $review_res = mysqli_query($conn,$review_q);

        if(mysqli_num_rows($review_res)==0){
          echo 'no reviews yet!';
        }else{
          while($row = mysqli_fetch_assoc($review_res))
          {
            $star = "<i class='bi bi-star-fill text-warning'></i> ";
            for($i=1; $i<$row['rating']; $i++){
              $star .= " <i class='bi bi-star-fill text-warning'></i>";
            }
            echo<<<review
            <div>
              <div class=" d-flex align-items-center ">
              <i class='bi bi-person-circle'></i>
                <h6 class="m-0 ms-2"><b>$row[uname]</b></h6>
              </div>
                <p>$row[review]</p>
              <div class="rating mb-3">
                $star
             </div>
            </div> 
            

            review;
          }
        
        }
          
    ?>
    
   <br>
   </div>
  </div>
</div>  
<br>

<br>
<?php
require('inc/footer.php');
?>



</body>
</html>