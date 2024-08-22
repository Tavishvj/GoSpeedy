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
    <title>ADMIN PANEL - USERS</title>
    <?php require("inc/links.php");?>
    
</head>


<body class="bg-light">
    <?php
    require('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 mt-0 overflow-hidden">
                <h3 class="mb-4 "><b>Users</b></h3>

                <div class="card border-0 mb-4 shadow">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type here to search">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width: 1300px;">
                                <thead class="text-center sticky-top bg-dark text-light">
                                    <tr>
                                    <th scope="col">Sr no.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone No.</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Verified</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="users-data">
                                  
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
    
    function get_users()
    {
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/users.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('users-data').innerHTML = this.responseText;
        }

        xhr.send('get_users');
    }

    function remove_user(user_id)
    {
        if(confirm("ARE YOU SURE"))
        {

        let data = new FormData();
       
        data.append('user_id',user_id);
        data.append('remove_user','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/users.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 1){
                alert('User removed');
                get_users();
                

            }
            else{
                alert('error');
            
            }

        }

        xhr.send(data);
     }
    }



    function toggle_status(id,val)
    {
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/users.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            if(this.responseText==1){
                alert('success');
                get_users();
            }else{
                alert('error');
            }
        }

        xhr.send('toggle_status='+id+'&value='+val);


    }


    function search_user(username)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/users.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('users-data').innerHTML = this.responseText;
        }

        xhr.send('search_user&name='+username);
    }



    window.onload = function(){
        get_users();
    }


</script>

</body>
</html>