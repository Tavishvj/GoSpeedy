<?php
    require('../admin/ess.php');
    require('../admin/db_config.php');

    date_default_timezone_set('Asia/Kolkata');

    if(isset($_POST['info_form']))
    {
        $frm_data = filteration($_POST);
        session_start();

        $u_exist = select("SELECT * FROM `user_cred` WHERE `phone` = ? AND `id`!=? LIMIT 1",[$data['phone'],$_SESSION['uId']],'ss');

       if(mysqli_num_rows($u_exist)!=0){
          echo 'phone_already';
          exit;
       }

       $query = "UPDATE `user_cred` SET `name`=?,`address`=?,`phone`=?,`pincode`=?,`dob`=? WHERE `id`=?";
       $values = [$frm_data['name'],$frm_data['address'],$frm_data['phone'],$frm_data['pincode'],$frm_data['dob'],$_SESSION['uId']];

       if(update($query,$values,'ssssss')){
        $_SESSION['uName'] = $frm_data['name'];
        echo 1;
       }else{
        echo 0;
       }

    }

    if(isset($_POST['pass_form']))
    {
        $frm_data = filteration($_POST);
        session_start();

        if($frm_data['new_pass']!=$frm_data['confirm_pass']){
            echo 'mismatch';
            exit;
        }

        $enc_pass = password_hash($frm_data['new_pass'],PASSWORD_BCRYPT);

        $query = "UPDATE `user_cred` SET `pass`=? WHERE `id`=? LIMIT 1";
        $values = [$enc_pass,$_SESSION['uId']];
        if(update($query,$values,'ss')){
            echo 1;
        }else{
            echo 0;
        }
    }
?>