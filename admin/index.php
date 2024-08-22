<?php
require('db_config.php');
require('ess.php');

session_start();
    if(isset($_SESSION['admlogin']) && $_SESSION['admlogin']==true){
        redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN PANNEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        {font-family: 'Merienda', cursive;}        
        div.login{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 400px;
        }
        .btn-login{
            background-color: darkblue;
            color: azure;
           
        }

               

    </style>
</head>
<body class="bg-light">
    
  <div class="login text-center rounded bg-white shadow overflow-hidden">
    <form method="POST">
        <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANNEL</h4>
    <div class="p-4">
        <div class="mb-3">
            <input name="adm" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
        </div>
        <div  class="mb-4">
            <input name="adm_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
        </div>
        <button type="submit" class="btn-login bg-dark text-light rounded shadow-none" name="login">LOGIN</button>
    </div>
   </form>
</div>  

<?php
if(isset($_POST['login'])){
    $frm_data=filteration($_POST);
    $query = "SELECT * FROM `admin_login` WHERE `adm`=? AND `adm_pass`=?";
    $values = [$frm_data['adm'],$frm_data['adm_pass']];
    $res = select($query,$values,"ss");
    if($res->num_rows==1){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['admlogin'] = true;
        $_SESSION['admId'] = $row['sr_no'];
        redirect('dashboard.php');

    }
    else{
       alert('error','Login Failed!!!');

    }
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
</body>
</html>