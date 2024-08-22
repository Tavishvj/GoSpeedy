<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSpeedy- My Booking</title>
    <?php require('inc/links.php')?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>


<body class="bg-light">
<?php
  require('inc/header.php');

  if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
    redirect('index.php');
  }

?>




<div class="container mb-4">
  <div class="row">

      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold text-center h-font">MY BOOKINGS</h2>
        <div class="h-line bg-dark"></div>
        <div style="font-size: 16px;">
            <a href="index.php" class="text-secondary text-decoration-none  fw-bold">Home</a>
            <span class="text-secondary fw-bold "> > </span>
            <a href="jewellery.php" class="text-secondary text-decoration-none  fw-bold">My Bookings</a>
        </div>
      </div>

        <?php 
        
          $query = "SELECT bo.*, bd.* FROM `booking_order` bo 
          INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
          WHERE ((bo.booking_status='booked') OR (bo.booking_status='cancelled')) AND
          (bo.user_id=?)
          ORDER BY bo.booking_id DESC";

          $res = select($query,[$_SESSION['uId']],'i');

          while($data = mysqli_fetch_assoc($res))
          {
            
            $date = date("d-m-Y",strtotime($data['datentime']));
            $book_date = date("d-m-Y",strtotime($data['booking_date']));
            $return_date = date("d-m-Y",strtotime($data['return_date']));

            $status_bg = "";
            $btn = "";

            if($data['booking_status']=='booked')
            {
                $status_bg = "bg-success";

                if($data['arrival']==1)
                {
                  $btn ="<a href ='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-sm text-white fw-bold bg-dark shadow-none'>
                          Download PDF
                        </a>";
                    if($data['rate_review']==0){
                      $btn .= "<button type='button' onclick='rate_jewellery($data[booking_id],$data[jewellery_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-sm text-dark fw-bold ms-2 bg-warning shadow-none'>
                                Rate & Review
                              </button>";
                    }
                }else
                {
                  $btn ="<button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-sm text-white bg-danger shadow-none'>
                          Cancel Booking 
                        </button>";
                }

              }else{
              $status_bg ="bg-danger";

              $btn ="<a href ='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-sm text-white fw-bold bg-dark shadow-none'>
              Download PDF
              </a>";
            }


            echo<<<bookings
              <div class='col-md-4 px-4 mb-4'>
                <div class='bg-white p-3 rounded shadow-sm'>
                  <h5 class='fw-bold'>$data[jewellery_name]</h5>
                  <p>
                    <b>Price:</b>₹ $data[price] Per Day<br>
                    <b>Security:</b>₹ $data[security_charge]  Per Day
                  </p>
                  <p>
                    <b>Booking Date:</b>$book_date<br>
                    <b>Return Date:</b>$return_date<br>
                    <b>Amount:</b> ₹ $data[total_price]<br>
                    <b>Total Security:</b> ₹ $data[total_security] (REFUNDABLE)<br>
                    <b>Date:</b> $date
                  </p>
                  <p>
                    <span class='badge $status_bg'>$data[booking_status]</span>
                  </p>
                  $btn
                </div>
              </div>

            bookings;

          }
        
        ?>
  
    
  </div>
</div>  



<div class="modal fade shadow-none" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="bg-warning" id="review-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center "><i class="bi bi-star-fill"></i>&nbsp;<b>Rate & Review</b></h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-light text-dark">
          <div class="mb-3">
              <label class="form-label">Rating</label>
              <select class="form-select" name="rating">
                <option value="5">Excellent</option>
                <option value="4">Good</option>
                <option value="3">Average</option>
                <option value="2">Poor</option>
                <option value="1">Bad</option>
              </select>
          </div>
          <div class="mb-3">
              <label class="form-label">Review</label>
              <textarea name="review" required rows="3" required class="form-control shadow-none"></textarea>
          </div>
          <input type="hidden" name="booking_id">
          <input type="hidden" name="jewellery_id">
          <div> 
            <button type="submit" class="w-100 btn btn-dark shadow-none bg-dark text-white">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<br>





<?php
require('inc/footer.php');
?>

<script>

  function cancel_booking(id)
  {
    if(confirm('Are you sure to cancel booking'))
    {
      let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/my_bookings.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
           if(this.responseText==1){
            window.location.href="my_bookings.php";
           }else{
            alert('cancellation failed');
           }
        }

        xhr.send('cancel_booking&id='+id);
    }
    
  }

  let review_form = document.getElementById('review-form');

  function rate_jewellery(bid,jid)
  {
    review_form.elements['booking_id'].value = bid;
    review_form.elements['jewellery_id'].value = jid;
  }

  review_form.addEventListener('submit',function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('review_form','');
    data.append('rating',review_form.elements['rating'].value);
    data.append('review',review_form.elements['review'].value);
    data.append('booking_id',review_form.elements['booking_id'].value);
    data.append('jewellery_id',review_form.elements['jewellery_id'].value);

    let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/my_bookings.php",true);


        xhr.onload = function()
        {
           if(this.responseText == 1)
           {
            alert('Thankyou for review and rating');
             window.location.href = 'my_bookings.php';
          
           }else{
            var myModal = document.getElementById('reviewModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            alert('Rating & Review Failed!');
           }
        }

        xhr.send(data);

       

  })

</script>


</body>
</html>