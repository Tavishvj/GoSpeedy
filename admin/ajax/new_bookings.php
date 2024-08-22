<?php
    require('../ess.php');
    require('../db_config.php');
    admlogin();

    

    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);
      
        

        $query = "SELECT bo.*, bd.* FROM `booking_order` bo 
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
        WHERE (bd.phone LIKE ? OR bd.user_name LIKE ?) AND
        bo.booking_status = ? AND bo.arrival = ?  ORDER BY bo.booking_id DESC";

        $res = select($query,["%$frm_data[search]%","%$frm_data[search]%","booked",0],'sssi');
        $i = 1;
        $table_data = "";

        if(mysqli_num_rows($res)==0)
        {
            echo"<b>No Data Found!</b>";
            exit;
        }

        while($data = mysqli_fetch_assoc($res))
        {
            $date = date("d-m-Y",strtotime($data['datentime']));
            $book_date = date("d-m-Y",strtotime($data['booking_date']));
            $return_date = date("d-m-Y",strtotime($data['return_date']));

            $table_data .="
              <tr>
                <td>$i</td>
                <td>
                  <span class='badge bg-primary'>
                    Order ID: $data[order_id]
                  </span>
                  <br>
                  <b>Name :</b> $data[user_name]
                  <br>
                  <b>Phone No. :</b> $data[phone]
                </td>
                <td>
                  <b>Jewellery: </b> $data[jewellery_name]
                  <br>
                  <b>Price :</b> ₹$data[price]
                  <br>
                  <b>Security :</b> ₹$data[security_charge]
                </td>
                <td>
                  <b>Booking Date: </b>$book_date
                  <br>
                  <b>Return Date: </b>$return_date
                  <br>
                  <b>Total Amount: </b> ₹$data[total_price]
                  <br>
                  <b>Total Security(Refundable): </b> ₹$data[total_security]
                  <br>
                  <b>Date</b> $date
                </td>
                <td>
                <button type='button' onclick='confirm_booking($data[booking_id])' class='mt-2 mb-4 btn text-white btn-sm fw-bold bg-success shadow-none'>
                <i class='bi bi-check2-all'></i>  CONFIRM BOOKING 
                </button> <br>
                    <button type='button' onclick='cancel_booking($data[booking_id])' class='btn text-white btn-sm fw-bold bg-danger shadow-none'>
                    <i class='bi bi-x-lg'></i>  CANCEL BOOKING
                    </button>

                </td>
              </tr>
            
            
            ";
            $i++;
        }

        echo $table_data;
    }


    
    if(isset($_POST['confirm_booking']))
    {
        $frm_data = filteration($_POST);
        
        $query = "UPDATE `booking_order` SET `arrival`=?, `rate_review`=? WHERE `booking_id`=?";
        $values = [1,0,$frm_data['booking_id']];
        $res = update($query,$values,'iii');

        echo $res;
    }

   

    if(isset($_POST['cancel_booking']))
    {
        $frm_data = filteration($_POST);
        
        $query = "UPDATE `booking_order` SET `booking_status`=? WHERE `booking_id`=?";
        $values = ['cancelled',$frm_data['booking_id']];
        $res = update($query,$values,'si');

        echo $res;
    }


?>
