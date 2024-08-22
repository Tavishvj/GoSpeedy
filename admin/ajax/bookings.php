<?php
    require('../ess.php');
    require('../db_config.php');
    admlogin();

    

    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);

        $limit = 5;
        $page = $frm_data['page'];
        $start = ($page-1) * $limit;

        $query = "SELECT bo.*, bd.* FROM `booking_order` bo 
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
        WHERE ((bo.booking_status='booked') OR (bo.booking_status='cancelled')) AND
        (bd.phone LIKE ? OR bd.user_name LIKE ?) 
        ORDER BY bo.booking_id DESC";

        $res = select($query,["%$frm_data[search]%","%$frm_data[search]%"],'ss');

        $limit_query = $query ." LIMIT $start,$limit";
        $limit_res = select($limit_query,["%$frm_data[search]%","%$frm_data[search]%"],'ss');
          

        

        $total_rows = mysqli_num_rows($res);

        if($total_rows==0)
        {

          $output = json_encode(['table_data'=>"<b>No Data Found!</b>", "pagination"=>'']);
            echo $output;
          exit;
        }

        $i = $start+1;
        $table_data = "";

        while($data = mysqli_fetch_assoc($limit_res))
        {
            $date = date("d-m-Y",strtotime($data['datentime']));
            $book_date = date("d-m-Y",strtotime($data['booking_date']));
            $return_date = date("d-m-Y",strtotime($data['return_date']));

            if($data['booking_status']=='booked'){
              $status_bg = 'bg-success';
            }
            else{
              $status_bg = 'bg-danger';
            }

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
              <b>Total Amount: </b> ₹$data[total_price]
              <br>
              <b>Total Security(Refundable): </b> ₹$data[total_security]
              <br>
              <b>Date</b> $date
            </td>
            <td>
              <span class='badge $status_bg'> $data[booking_status]</span>
            </td>
            <td>
                
                <button type='button' onclick='download($data[booking_id])' class='btn text-dark fw-bold bg-warning shadow-none'>
                <i class='bi bi-file-earmark-pdf-fill'></i>
                </button>

            </td>
          </tr>
        
            
            
            ";
            $i++;
        }

        $pagination = "";
        if($total_rows>$limit)
        {
          if($page!=1){
            $pagination .="<li class='page-item'><button onclick='change_page(1)' class='page-link shadow-none'>First </button></li>";
 
           }


           $total_pages = ceil($total_rows/$limit);
           $disabled = ($page==1) ? "disabled" : "";
           $prev = $page-1;
           $pagination .="<li class='page-item $disabled'><button onclick='change_page($prev)' class='page-link shadow-none'>Previous</button></li>";

           $disabled = ($page==$total_pages) ? "disabled" : "";
           $next = $page+1;
           $pagination .="<li class='page-item $disabled'><button onclick='change_page($next)' class='page-link shadow-none'>Next</button></li>";

           if($page!=$total_pages){
            $pagination .="<li class='page-item'><button onclick='change_page($total_pages)' class='page-link shadow-none'>Last </button></li>";
 
           }
        }
          
        $output = json_encode(["table_data"=>$table_data,"pagination"=>$pagination]);

        echo $output;
        
    }
   





?>
