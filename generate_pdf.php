<?php

require('admin/ess.php');
require('admin/db_config.php');
require('admin/inc/mpdf/vendor/autoload.php');
session_start();

if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
    redirect('index.php');
  }




if(isset($_GET['gen_pdf']) && isset($_GET['id']))
{
    $frm_data = filteration($_GET);

    $query = "SELECT bo.*, bd.*, uc.email FROM `booking_order` bo 
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
    INNER JOIN `user_cred` uc ON bo.user_id = uc.id
    WHERE ((bo.booking_status='booked') OR (bo.booking_status='cancelled'))
    AND bo.booking_id = '$frm_data[id]'";

    $res = mysqli_query($conn,$query);
    $total_rows = mysqli_num_rows($res);

    if($total_rows==0)
    {
        header('location: index.php');
        exit;
    }
    $data = mysqli_fetch_assoc($res);

    $date = date("h:ia | d-m-Y",strtotime($data['datentime']));
    $book_date = date("d-m-Y",strtotime($data['booking_date']));
    $return_date = date("d-m-Y",strtotime($data['return_date']));

    $table_data = "
    <h1 style='text-align: center;'>GoSpeedy</h1>
    <h2>Booking Receipt</h2>
    <h5 style='background-color: yellow;'>NOTE:Bring this receipt with you to collect and return your order!</h5>
    <table border='1' cellpadding='9' align='center' style='font-size: 22px;'>
        <tr>
            <td><b>Order ID</b>: $data[order_id]</td>
            <td><b>Booking Date</b>: $date</td>
        </tr>
        <tr>
            <td colspan='2'><b>Status</b>: $data[booking_status]</td>
        </tr>
        <tr>
            <td><b>Name</b> : $data[user_name]</td>
            <td><b>E-mail</b>: $data[email]</td>
        </tr>
        <tr>
            <td><b>Phone no.</b> : $data[phone]</td>
            <td><b>Address</b>: $data[address]</td>
        </tr>
        <tr>
            <td colspan='2'><b>Vehicle Name</b> : $data[jewellery_name]</td>
        
        </tr>
        <tr>
            <td><b>Rent</b>: ₹ $data[total_price] </td>
            <td><b>Security(Refundable)</b>: ₹ $data[total_security] </td>
        </tr>
        <tr>
            <td><b>Booking Date</b> : $book_date</td>
            <td><b>Return Date</b>: $return_date</td>
        </tr>

        <h6 class='text-center fw-bold mb-4'>Bring this receipt with you to collect and return your order!</h6>
        
    ";

    $table_data.="</table>";


    $mpdf = new \Mpdf\Mpdf();

    $mpdf->WriteHTML($table_data);
    $mpdf->Output($data['order_id'].'.pdf','D');

    
    
    
   





}else{
    header('location: index.php');
}

?>