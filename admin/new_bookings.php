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
    <title>ADMIN PANEL - BOOKINGS</title>
    <?php require("inc/links.php");?>
    
</head>


<body class="bg-light">
    <?php
    require('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 mt-0 overflow-hidden">
                <h3 class="mb-4 "><b>New Bookings</b></h3>

                <div class="card border-0 mb-4 shadow">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type here to search">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="text-center sticky-top bg-dark text-light">
                                    <tr>
                                    <th scope="col">Sr no.</th>
                                    <th scope="col">User Details</th>
                                    <th scope="col">Vehicle Details</th>
                                    <th scope="col">Booking Details</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                  
                                </tbody>
                            </table>
                        </div>
                            
                    
    
                    </div>
                </div>          


            </div>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
    
    function get_bookings(search='')
    {
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/new_bookings.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('table-data').innerHTML = this.responseText;
        }

        xhr.send('get_bookings&search='+search);
    }


    function cancel_booking(id)
    {

        if(confirm("ARE YOU SURE"))
        {

        let data = new FormData();
       
        data.append('booking_id',id);
        data.append('cancel_booking','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/new_bookings.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 1){
                alert('Booking Cancelled!');
                get_bookings();
                

            }
            else{
                alert('error');
            
            }

        }

        xhr.send(data);
     }

    }


    function confirm_booking(id)
    {

        if(confirm("ARE YOU SURE"))
        {

        let data = new FormData();
       
        data.append('booking_id',id);
        data.append('confirm_booking','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/new_bookings.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 1){
                alert('Booking Confirmed');
                get_bookings();
                

            }
            else{
                alert('error');
            
            }

        }

        xhr.send(data);
     }

    }




    window.onload = function(){
        get_bookings();
    }


</script>

</body>
</html>