<?php
    require('../admin/ess.php');
    require('../admin/db_config.php');

    date_default_timezone_set('Asia/Kolkata');

    if(isset($_POST['check_availability']))
    {
        $frm_data = filteration($_POST);

        $status = "";
        $result = "";

        // book and return date validation

        $today_date = new DateTime(date("Y-m-d"));
        $booking_date = new DateTime($frm_data['book_date']);
        $return_date = new DateTime($frm_data['return_date']);


        if($booking_date == $return_date){
            $status = 'book_return_date_equal';
            $result = json_encode(["status"=>$status]);
        }
        else if($return_date < $booking_date){
            $status = 'return_earlier';
            $result = json_encode(["status"=>$status]);
        }
        else if($booking_date < $today_date){
            $status = 'book_earlier';
            $result = json_encode(["status"=>$status]);
        }

        // check booking availability if status is blank else return the error

        if($status!=''){
            echo $result;
        }else{
            session_start();
            $_SESSION['jewellery'];

            // run query to check availability
            $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order` 
            WHERE booking_status=? AND jewellery_id=? AND return_date > ? AND booking_date < ?";

            $values = ['booked',$_SESSION['jewellery']['id'],$frm_data['book_date'],$frm_data['return_date']];

            $tb_fetch = mysqli_fetch_assoc(select($tb_query,$values,'siss'));

            $jq_result = select("SELECT `quantity` FROM `jewellery` WHERE `id`=?",[$_SESSION['jewellery']['id']],'i');
            $jq_fetch = mysqli_fetch_assoc($jq_result);

            if(($jq_fetch['quantity']-$tb_fetch['total_bookings'])==0){
                $status = 'unavailable';
                $result = json_encode(['status'=>$status]);
                echo $result;
                exit;
            }




            $count_days = date_diff($booking_date,$return_date)->days;

            $payment = $_SESSION['jewellery']['price']* $count_days;
            $payment_security = $_SESSION['jewellery']['security_charge']* $count_days;
            
            
            $_SESSION['jewellery']['payment'] = $payment;
            $_SESSION['jewellery']['payment_security'] = $payment_security;
            $_SESSION['jewellery']['available'] = true;

            $result = json_encode(["status"=>'available', "days"=>$count_days, "payment"=> $payment, "payment_security"=> $payment_security]);
            echo $result;
        }

    }
    
 ?>   
