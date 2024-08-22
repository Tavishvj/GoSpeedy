<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSpeedy-Vehicle</title>
    <?php require('inc/links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>


<body class="bg-light">
<?php
require('inc/header.php');
?>


<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">Our Collection</h2>
  <div class="h-line bg-dark"></div>
</div>
<br>
<div class="container">
  <div class="row">
  
      <?php
          // first block

          $jewellery_res = select("SELECT * FROM `jewellery` WHERE `id` AND `status`=? AND `removed`=?",[1,0],'ii');

          while($jewellery_data = mysqli_fetch_assoc($jewellery_res))
          {
            // get category of jewellery

            $cat_q = mysqli_query($conn,"SELECT c.name FROM `category` c INNER JOIN `jewellery_category` jcat ON c.id = jcat.category_id WHERE jcat.jewellery_id = '$jewellery_data[id]'");

            $category_data = "";
            while($cat_row = mysqli_fetch_assoc($cat_q)){
              $category_data .="<span class='badge rounded-pill bg-light text-dark text-wrap'>$cat_row[name]</span>";
            }

            // get thumbnail of jewellery

            $jewellery_thumb = JEWELLERY_IMG_PATH."thumbnail.jpg";
            $thumb_q = mysqli_query($conn,"SELECT * FROM `jewellery_image` WHERE `jewellery_id`='$jewellery_data[id]' AND `thumb`='1'");


            if(mysqli_num_rows($thumb_q)>0){
              $thumb_res = mysqli_fetch_assoc($thumb_q);
              $jewellery_thumb = JEWELLERY_IMG_PATH.$thumb_res['image'];
            }

            $book_btn = "";
            if(!$settings_r['shutdown'])
            {
              $login = 0;
              if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                $login = 1;
              }
              $book_btn = "<button onclick='checkLogin($login,$jewellery_data[id])' class='bg-dark btn text-light mb-md-2 mb-lg-0'>Book Now</button>";
            }


            // print jewellery card

            echo <<<data
              <div class="col-lg-5 col-md-6 card mb-5 mx-lg-5 p-0 mx-md-0">
                  <div class="row g-0 px-2 align-items-center">
                      <div class="col-md-4 mb-lg-0 mb-md-0 mb-3">
                      <img src="$jewellery_thumb" widht="100%" class="img-fluid rounded">
                      </div>
                      <div class="col-md-8">
                      <div class="card-body">
                          <h5 class="card-title"><b>$jewellery_data[name]</b></h5>
                          <h6><b>Category</b>$category_data</h6>
                          <h6><b>Rent</b>-₹$jewellery_data[price]/- per day</h6>
                          <h6 class="mb-4"><b>Security Charges</b>-₹$jewellery_data[security_charge]/-</h6>
                          $book_btn
                          <a href="jewellery_details.php?id=$jewellery_data[id]" class=" bg-dark btn text-light">View Details</a>
                      </div>
                      </div>
                      </div>
                  </div>

              data;

          }

     
          
        ?>

    </div>
  </div>
</div>


<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item ">
      <a class="page-link bg-success text-white" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link bg-dark text-white" href="#">1</a></li>
    <li class="page-item"><a class="page-link bg-dark text-white" href="#">2</a></li>
    <li class="page-item"><a class="page-link bg-dark text-white" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link bg-success text-white" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

      
  

<!-- <script>

    let jewellery_data = document.getElementById('jewellery-data');

    function fetch_jewellery()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("GET","ajax/jewellery.php?fetch_jewellery",true);
      xhr.onprogress = function(){

      }
      xhr.onload = function(){
        jewellery_data.innerHTML = this.responseText;
      }
      xhr.send();
    }
    fetch_jewellery();

</script> -->



  


<br>
<?php
 require('inc/footer.php');
?>



</body>
</html>