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
    <title>ADMIN PANEL - BOOKING RECORDS</title>
    <?php require("inc/links.php");?>
    
</head>


<body class="bg-light">
    <?php
    require('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 mt-0 overflow-hidden">
                <h3 class="mb-4 "><b>Booking Records</b></h3>

                <div class="card border-0 mb-4 shadow overflow-hidden">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" id="search_input" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type here to search">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="sticky-top bg-dark text-light">
                                    <tr>
                                    <th scope="col">Sr no.</th>
                                    <th scope="col">User Details</th>
                                    <th scope="col">Vehicle Details</th>
                                    <th scope="col">Booking Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                  
                                </tbody>
                            </table>
                        </div>

                        <nav>
                            <ul class="pagination mt-3" id="table-pagination">
                            
                            </ul>
                        </nav>
                            
                    
    
                    </div>
                </div>          


            </div>
        </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
    
    function get_bookings(search='',page=1)
    {
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/bookings.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            let data = JSON.parse(this.responseText);
            document.getElementById('table-data').innerHTML = data.table_data;
            document.getElementById('table-pagination').innerHTML = data.pagination;
        }

        xhr.send('get_bookings&search='+search+'&page='+page);
    }


    function change_page(page)
    {
       get_bookings(document.getElementById('search_input').value,page);
    }


    function download(id){
        window.location.href = 'generate_pdf.php?gen_pdf&id='+id;
    }





    window.onload = function(){
        get_bookings();
    }


</script>

</body>
</html>