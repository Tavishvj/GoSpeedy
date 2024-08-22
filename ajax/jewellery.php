<?php
    require('../admin/ess.php');
    require('../admin/db_config.php');

    session_start();
    if(isset($GET['fetch_jewellery']))
    {
        $count_jewellery = 0;
        $output = "";

        // shutdown checking
        $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
        $settings_r = mysqli_fetch_assoc(mysqli_query($conn,$settings_q));


    // first block

        $jewellery_res = select("SELECT * FROM `jewellery` WHERE `id` BETWEEN 3 AND 5 AND `status`=? AND `removed`=?",[1,0],'ii');

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

         $output.="
            <div class='card mb-5'>
                <div class='row g-0 px-2 align-items-center'>
                    <div class='col-md-4 mb-lg-0 mb-md-0 mb-3'>
                    <img src='$jewellery_thumb' widht='100%' class='img-fluid rounded'>
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'><b>$jewellery_data[name]</b></h5>
                            <h6><b>Category</b>$category_data</h6>
                            <h6><b>Rent</b>-₹$jewellery_data[price]/- per day</h6>
                            <h6 class='mb-4'><b>Security Charges</b>-₹$jewellery_data[security_charge]/-</h6>
                            $book_btn
                            <a href='jewellery_details.php?id=$jewellery_data[id]' class='bg-dark btn text-light'>View Details</a>
                        </div>
                    </div>
                </div>
            </div>";
            
            $count_jewellery++;
        }
        if($count_jewellery>0){
            echo $output;
        }else{
            echo"<h3>No jewellery Found</h3>";
        }

    // first block

    //second block

        $jewellery_res = select("SELECT * FROM `jewellery`  WHERE `id` BETWEEN 6 AND 8 AND `status`=? AND `removed`=?  ",[1,0],'ii');

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

            

            <div class="card mb-5">
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
                    <a href="jewellery_details.php?id=$jewellery_data[id]" class="bg-dark btn text-light">View Details</a>
                </div>
                </div>
                </div>
                </div>

            data;

        }
    //second block

    //third block  

        $jewellery_res = select("SELECT * FROM `jewellery` WHERE `id` BETWEEN 9 AND 19 AND `status`=? AND `removed`=?",[1,0],'ii');

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

            

            <div class="card mb-5">
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
                            <a href="jewellery_details.php?id=$jewellery_data[id]" class="bg-dark btn text-light">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

            data;

        }
    

    //third block

    //fourth block
    
        $jewellery_res = select("SELECT * FROM `jewellery` WHERE `id` BETWEEN 20 AND 30 AND `status`=? AND `removed`=?",[1,0],'ii');

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

                

            <div class="card mb-5">
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
                            <a href="jewellery_details.php?id=$jewellery_data[id]" class="bg-dark btn text-light">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

         data;

        }

    //fourth block

    //fifth block
    
            $jewellery_res = select("SELECT * FROM `jewellery`  WHERE `id` BETWEEN 31 AND 41 AND `status`=? AND `removed`=?  ",[1,0],'ii');

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

            

        <div class="card mb-5">
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
                        <a href="jewellery_details.php?id=$jewellery_data[id]" class="bg-dark btn text-light">View Details</a>
                    </div>
                </div>
            </div>
        </div>

     data;

            }

    //fifth block
      
    }
?>
