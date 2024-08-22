<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSpeedy- Confirm Booking</title>
    <?php require('inc/links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>


<body class="bg-light">
<?php
require('inc/header.php');
?>

<?php
/*
check jewellery id from url is present or not
shutdown mode is active or not 
user is logged in or not
*/
if(!isset($_GET['id']) || $settings_r['shutdown']==true){
  redirect('jewellery.php');
}else if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
  redirect('jewellery.php');
}

// filter and got jewellery and user data

$data = filteration($_GET);

$jewellery_res = select("SELECT * FROM `jewellery` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

if(mysqli_num_rows($jewellery_res)==0){
  redirect('jewellery.php');
}


$jewellery_data = mysqli_fetch_assoc($jewellery_res);


$_SESSION['jewellery'] = [
  "id" => $jewellery_data['id'],
  "name" => $jewellery_data['name'],
  "price" => $jewellery_data['price'],
  "security_charge" => $jewellery_data['security_charge'],
  "payment" => null,
  "payment_security" => null,
  "available" => false,
];


$user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],'i');
$user_data = mysqli_fetch_assoc($user_res);



?>



<br>
<div class="container mb-4">
  <div class="row">

      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold h-font">CONFIRM BOOKING</h2>
        <div style="font-size: 16px;">
            <a href="index.php" class="text-secondary text-decoration-none fw-bold">HOME</a>
            <span class="text-secondary fw-bold"> > </span>
            <a href="jewellery.php" class="text-secondary text-decoration-none fw-bold">Vehicle</a>
            <span class="text-secondary fw-bold"> > </span>
            <a href="jewellery.php" class="text-secondary text-decoration-none fw-bold">Confirm</a>
        </div>
       </div>


       <div class="col-lg-7 col-md-12 px-4 mb-5">
        <?php
        
        $jewellery_thumb = JEWELLERY_IMG_PATH."thumbnail.jpg";
          $thumb_q = mysqli_query($conn,"SELECT * FROM `jewellery_image` WHERE `jewellery_id`='$jewellery_data[id]' AND `thumb`='1'");


          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $jewellery_thumb = JEWELLERY_IMG_PATH.$thumb_res['image'];
          }

          echo<<<data
           
            <div class="card p-3 shadow-sm rounded">
               <img src="$jewellery_thumb" widht="100%" class="img-fluid rounded mb-3">
               <h5>$jewellery_data[name]</h5>
               <h6>₹$jewellery_data[price]/- per day</h6>
               <h6>₹$jewellery_data[security_charge]/- per day</h6>
            </div>

          data;
        
        ?>
                    
       </div>

       <div class="col-lg-5 col-md-12 px-4">
          <div class="card mb-5 border-0 shadow-sm rounded-3">
            <div class="card-body bg-dark text-light">
                <form action="pay_now.php" method="POST" id="booking_form">
                  <h6 class="mb-3">BOOKING DETAILS</h6>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Phone No.</label>
                        <input type="number" name="phone" value="<?php echo $user_data['phone'] ?>" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" value="<?php echo $user_data['address'] ?>" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Pincode</label>
                        <input type="text" name="pincode" value="<?php echo $user_data['pincode'] ?>" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Booking Date</label>
                        <input type="date" onchange="check_availability()" name="booking_date" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Return Date</label>
                        <input type="date" onchange="check_availability()" name="return_date" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-12">
                      <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                      <h6 class="mb-3 text-warning" id="pay_info">Provide booking and return date !</h6>
                        <button class="btn btn-success w-100 shadow-none " disabled name="pay_now">Book Now</button>
                    </div>
                    
                  </div>
                </form>
            </div>
          </div>
      </div>
  
   
    
  </div>
</div>  


<br>
<?php
require('inc/footer.php');
?>

<script>

  let booking_form = document.getElementById('booking_form');
  let info_loader = document.getElementById('info_loader');
  let pay_info = document.getElementById('pay_info');


  function check_availability()
  {
     let book_val = booking_form.elements['booking_date'].value;
     let return_val = booking_form.elements['return_date'].value;

     booking_form.elements['pay_now'].setAttribute('disabled',true);

     if(book_val!='' && return_val!='')
     {
      pay_info.classList.add('d-none');
      pay_info.classList.replace('text-white','text-warning');
      info_loader.classList.remove('d-none');
      let data = new FormData();

      data.append('check_availability','');
      data.append('book_date',book_val);
      data.append('return_date',return_val);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/confirm_booking.php",true);

      xhr.onload = function(){
        let data = JSON.parse(this.responseText);

        if(data.status == 'book_return_date_equal'){
          pay_info.innerText = "you cannot return on same day!";
        }
        else if(data.status == 'return_earlier'){
          pay_info.innerText = "Return date is earlier than booking date! ";
        }
        else if(data.status == 'book_earlier'){
          pay_info.innerText = "Booking cannot be done on day before today!";
        }
        else if(data.status == 'unavailable'){
          pay_info.innerText = "Sorry ! Jewellery is not available on these dates.";
        }
        else{
          pay_info.innerHTML = "No. of days: "+data.days+"<br>Total Amount: ₹"+data.payment+"<br>Total Security to pay (REFUNDABLE): ₹"+data.payment_security;
          pay_info.classList.replace('text-warning','text-white');
          booking_form.elements['pay_now'].removeAttribute('disabled');
        }


        pay_info.classList.remove('d-none');
        info_loader.classList.add('d-none');


      }

      xhr.send(data);
    }
}
</script>



</body>
</html>