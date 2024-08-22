<?php
require('ess.php');
require('db_config.php');
admlogin();

if(isset($_GET['seen'])){
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if(update($q,$values,'i'))
        {
            echo '<script>alert("Marked all as read")</script>';
        }else{
            echo '<script>alert("Error ")</script>';
        }

    }else{
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1,$frm_data['seen']];
        if(update($q,$values,'ii'))
        {
            echo '<script>alert("Marked as read")</script>';
        }else{
            echo '<script>alert("Error ")</script>';
        }

    }
}

if(isset($_GET['del'])){
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){
//         $q = "DELETE FROM `user_queries`";
//         if(mysqli_query($conn,$q))
//         {
//             echo '<script>alert("All Query Deleted!")</script>';
//         }

        
}else{
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if(delete($q,$values,'i'))
        {
            echo '<script>alert("Query Deleted!")</script>';
        }

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL - User Queries</title>
    <?php require("inc/links.php");?>
    
</head>


<body class="bg-light">
    <?php
    require('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 mt-0 overflow-hidden">
                <h3 class="mb-4 "><b>User Queries</b></h3>

                <div class="card border-0 mb-4 shadow">
                    <div class="card-body">
                        <div class="text-end mb-4">
                           <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm"><i class="bi bi-check-circle-fill"></i>&nbsp;&nbsp;Mark all as read</a>
                           <!-- <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm"><i class="bi bi-x-circle-fill"></i>&nbsp;&nbsp;Delete all</a> -->
                        </div>


                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top bg-dark text-light">
                                    <tr>
                                    <th scope="col">Sr no.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" width="20%">Address</th>
                                    <th scope="col" width="30%">Message</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                   
                                   $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                   $data = mysqli_query($conn,$q);
                                   $i=1;
                                   while($row = mysqli_fetch_assoc($data))
                                   {

                                    $date = date('d-m-Y',strtotime($row['datentime']));

                                    $seen='';
                                    if($row['seen']!=1){
                                        $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-success'>Mark as Read</a>";
                                    }

                                    $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mx-2'>Delete</a>";


                                    echo<<<query
                                    <tr>
                                      <td>$i</td>
                                      <td>$row[name]</td>
                                      <td>$row[email]</td>
                                      <td>$row[address]</td>
                                      <td>$row[message]</td>
                                      <td>$date</td>
                                      <td>$seen</td>
                                    </tr> 
                                    query; 
                                    $i++;
                                   }
                                   
                                   ?>
                                </tbody>
                            </table>
                        </div>
                            
                        
    
                    </div>
                </div>


               
           




            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>




</body>
</html>