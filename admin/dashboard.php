<?php
require('ess.php');
require('db_config.php');
admlogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL - DASHBOARD</title>
    <?php require("inc/links.php");?>
</head>


<body class="bg-light">
    <?php
    require('header.php');

    $is_shutdown = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `shutdown` FROM `settings`"));

    $current_bookings = mysqli_fetch_assoc(mysqli_query($conn,"SELECT 
        COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`
        FROM `booking_order`"));

    $unread_queries = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(sr_no) AS `count`
     FROM `user_queries` WHERE `seen`=0"));

    $unread_reviews = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(sr_no) AS `count`
     FROM `rating` WHERE `seen`=0"));



    $current_users = mysqli_fetch_assoc(mysqli_query($conn,"SELECT 
     COUNT(id) AS `total`,
     COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
     COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive`,
     COUNT(CASE WHEN `is_verified`=0 THEN 1 END) AS `unverified`
     FROM `user_cred`"));




    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="fw-bold">DASHBOARD</h3>
                    <?php
                        if($is_shutdown['shutdown']){
                            echo<<<data
                            <h6 class="fw-bold badge bg-danger py-2 px-3 rounded">Shutdown Mode Is Active!</h6>
                            data;
                        }
                    
                    ?>
                   
                </div>
                <div class="row mb-4">
                    <div class="col-md-4 mb-4"> 
                        <a href="new_bookings.php" class="text-decoration-none"> 
                            <div class="card text-center border-dark p-3 text-success">
                                <h5 class="mt-2 fw-bold">New Bookings</h5>
                                <h1 class="mt-2 fw-bold"><?php echo $current_bookings['new_bookings'];?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4"> 
                        <a href="rating_review.php" class="text-decoration-none"> 
                            <div class="card text-center border-dark p-3  text-warning">
                                <h5 class="mt-2 fw-bold">Review & Ratings</h5>
                                <h1 class="mt-2 fw-bold"><?php echo $unread_reviews['count'];?></h1>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4"> 
                        <a href="user queries.php" class="text-decoration-none"> 
                            <div class="card text-center border-dark p-3 text-primary">
                                <h5 class="mt-2 fw-bold">User Queries</h5>
                                <h1 class="mt-2 fw-bold"><?php echo $unread_queries['count'];?></h1>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold">Booking Analytics</h5>
                    <select class="form-select shadow-none bg-dark text-light w-auto" onchange="booking_analytics(this.value)">
                        <option value="1">Past 30 Days</option>
                        <option value="2">Past 90 Days</option>
                        <option value="3">Past 1 Year</option>
                        <option value="4">All</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 mb-4"> 
                            <div class="card text-center border-dark p-3 text-success">
                                <h5 class="mt-2 fw-bold">Total Bookings</h5>
                                <h1 class="mt-2 fw-bold" id="total_bookings">5</h1>
                               
                            </div>
                   </div>
                    <div class="col-md-3 mb-4">  
                            <div class="card text-center border-dark p-3  text-info">
                                <h5 class="mt-2 fw-bold">Active Bookings</h5>
                                <h1 class="mt-2 fw-bold" id="active_bookings">5</h1>
                                
                            </div>
                    </div>
                    <div class="col-md-3 mb-4"> 
                          <div class="card text-center border-dark p-3 text-danger">
                              <h5 class="mt-2 fw-bold">Cancelled Bookings</h5>
                                <h1 class="mt-2 fw-bold" id="cancelled_bookings">5</h1>
                                
                            </div>
                    </div>
                </div>


                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold">User, Queries, Reviews Analytics</h5>
                    <select class="form-select shadow-none bg-dark text-light w-auto" onchange = "user_analytics(this.value)">
                        <option value="1">Past 30 Days</option>
                        <option value="2">Past 90 Days</option>
                        <option value="3">Past 1 Year</option>
                        <option value="4">All</option>
                    </select>
                </div>


                <div class="row mb-3">
                    <div class="col-md-3 mb-4"> 
                            <div class="card text-center border-dark p-3 text-success">
                                <h5 class="mt-2 fw-bold">New Registeration</h5>
                                <h1 class="mt-2 fw-bold" id="reg">0</h1>
                            </div>
                   </div>
                    <div class="col-md-3 mb-4">  
                            <div class="card text-center border-dark p-3 text-primary">
                                <h5 class="mt-2 fw-bold">Queries</h5>
                                <h1 class="mt-2 fw-bold" id="total_queries">0</h1>
                            </div>
                    </div>
                    <div class="col-md-3 mb-4"> 
                          <div class="card text-center border-dark p-3 text-warning">
                              <h5 class="mt-2 fw-bold">Reviews</h5>
                                <h1 class="mt-2 fw-bold" id="review">0</h1>
                               
                            </div>
                    </div>
                </div>

                <h5 class="fw-bold">Users</h5>
                
                <div class="row mb-3">
                    <div class="col-md-3 mb-4"> 
                            <div class="card text-center border-dark p-3 text-success">
                                <h5 class="mt-2 fw-bold">Total Users</h5>
                                <h1 class="mt-2 fw-bold"><?php echo $current_users['total']?></h1>
                            </div>
                   </div>
                    <div class="col-md-3 mb-4">  
                            <div class="card text-center border-dark p-3 text-primary">
                                <h5 class="mt-2 fw-bold">Active Users</h5>
                                <h1 class="mt-2 fw-bold"><?php echo $current_users['active']?></h1>
                            </div>
                    </div>
                    <div class="col-md-3 mb-4"> 
                          <div class="card text-center border-dark p-3 text-warning">
                              <h5 class="mt-2 fw-bold">Inactive Users</h5>
                                <h1 class="mt-2 fw-bold"><?php echo $current_users['inactive']?></h1>
                               
                            </div>
                    </div>
                    <div class="col-md-3 mb-4"> 
                          <div class="card text-center border-dark p-3 text-danger">
                              <h5 class="mt-2 fw-bold">Unverifed</h5>
                                <h1 class="mt-2 fw-bold"><?php echo $current_users['unverified']?></h1>
                               
                            </div>
                    </div>
                </div>




            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>

    function booking_analytics(period=1)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/dashboard.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
          let data = JSON.parse(this.responseText);
          console.log(data);
          document.getElementById('total_bookings').textContent = data.total_bookings;
          document.getElementById('active_bookings').textContent = data.active_bookings;
          document.getElementById('cancelled_bookings').textContent = data.cancelled_bookings;
        
        }

        xhr.send('booking_analytics&period='+period);
    }

    function user_analytics(period=1)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/dashboard.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
          let data = JSON.parse(this.responseText);
          console.log(data);
          document.getElementById('reg').textContent = data.total_new_reg;
          document.getElementById('total_queries').textContent = data.total_queries;
          document.getElementById('review').textContent = data.total_reviews;
        
        }

        xhr.send('user_analytics&period='+period);
    }

    window.onload = function(){
        booking_analytics();
    }

</script>
</body>
</html>