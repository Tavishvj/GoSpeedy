<?php
    require('admin/ess.php');
    require('admin/db_config.php');

    date_default_timezone_set("Asia/Kolkata");

    session_start();

    if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
        redirect('index.php');
      }

      if(isset($_POST['pay_now']))
      {
        $frm_data = filteration($_POST);
        $order_id = bin2hex(random_bytes(4));

        $query1 = "INSERT INTO `booking_order`(`user_id`, `jewellery_id`, `booking_date`, `return_date`, `order_id`) VALUES (?,?,?,?,?)";

        insert($query1,[$_SESSION['uId'],$_SESSION['jewellery']['id'],$frm_data['booking_date'],$frm_data['return_date'],$order_id],'issss');
         
       $booking_id = mysqli_insert_id($conn);

       $query2 = "INSERT INTO `booking_details`(`booking_id`, `jewellery_name`, `price`, `security_charge`, `total_price`, `total_security`, `user_name`, `phone`, `address`, `pincode`) VALUES (?,?,?,?,?,?,?,?,?,?)";
       insert($query2,[$booking_id,$_SESSION['jewellery']['name'],$_SESSION['jewellery']['price'],$_SESSION['jewellery']['security_charge'],$_SESSION['jewellery']['payment'],$_SESSION['jewellery']['payment_security'],$frm_data['name'],$frm_data['phone'],$frm_data['address'],$frm_data['pincode']],'isssssssss');

       


      }
redirect('success.php');
?>

