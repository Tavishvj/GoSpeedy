<?php
    require('../ess.php');
    require('../db_config.php');
    admlogin();

    

    if(isset($_POST['booking_analytics']))
    {
        $frm_data = filteration($_POST);
        $condition="";

        if($frm_data['period']==1){
          $condition="WHERE datentime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
        }
        else if($frm_data['period']==2){
          $condition="WHERE datentime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
        }
        else if($frm_data['period']==3){
          $condition="WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
        }

        $current_bookings = mysqli_fetch_assoc(mysqli_query($conn,"SELECT 
          COUNT(booking_id) AS `total_bookings`,
          COUNT(CASE WHEN booking_status='booked' AND arrival=1 THEN 1 END) AS `active_bookings`,
          COUNT(CASE WHEN booking_status='cancelled' THEN 1 END) AS `cancelled_bookings`
          FROM `booking_order` $condition"));

        // $current_amount = mysqli_fetch_assoc(mysqli_query($conn,"SELECT 
        //   SUM(total_price) AS `total_amt`,
        //   SUM(CASE WHEN booking_status='booked' AND arrival=1 THEN `total_price` END) AS `active_amt`,
        //   SUM(CASE WHEN booking_status='cancelled' THEN `total_price` END) AS `cancelled_amt`
        //   FROM `booking_order`"));

        $output = json_encode($current_bookings);
        echo $output;
        
    }
   

    if(isset($_POST['user_analytics']))
    {
        $frm_data = filteration($_POST);
        $condition="";

        if($frm_data['period']==1){
          $condition="WHERE datentime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
        }
        else if($frm_data['period']==2){
          $condition="WHERE datentime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
        }
        else if($frm_data['period']==3){
          $condition="WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
        }

        $total_queries = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(sr_no) AS `count`
          FROM `user_queries` $condition"));

        $total_reviews = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(sr_no) AS `count`
          FROM `rating` $condition"));

        $total_new_reg = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) AS `count`
        FROM `user_cred` $condition"));

        $output = ['total_queries'=>$total_queries['count'],'total_reviews'=>$total_reviews['count'],'total_new_reg'=>$total_new_reg['count']];

        $output = json_encode($output);
        echo $output;


  }





?>
