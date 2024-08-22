<?php
    require('admin/ess.php');
    require('admin/db_config.php');

    if(isset($_GET['email']) && isset($_GET['v_code']))
    {
        $data = filteration($_GET);
        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `verification_code`=? LIMIT 1",[$data['email'],$data['v_code']],'ss');

        if(mysqli_num_rows($query)==1)
            {
                $fetch = mysqli_fetch_assoc($query);
    
                if($fetch['is_verified']==1){
                    echo"<script>alert('Email Already Verified')</script>";
                    redirect('index.php');
                }else{
                    $update = update("UPDATE `user_cred` SET `is_verified`=? WHERE `id`=?",[1,$fetch['id']],'ii');
                    if($update){
                        echo"<script>alert('Email Verification Successful!')</script>";
                    }else{
                        echo"<script>alert('Email Verification Failed!')</script>";
                    }
                    redirect('index.php');
                }
            }
            else{
                echo"<script>alert('Invalid Link')</script>";
                redirect('index.php');
            }
    }

    // if(isset($_GET['email_confirmation']))
    // {
    //     $data = filteration($_GET);

    //     $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `verification_code`=? LIMIT 1",[$data['email'],$data['verification_code']],'ss');

    //     if(mysqli_num_rows($query)==1)
    //     {
    //         $fetch = mysqli_fetch_assoc($query);

    //         if($fetch['is_verified']==1){
    //             echo"<script>alert('Email Already Verified')</script>";
    //             redirect('index.php');
    //         }else{
    //             $update = update("UPDATE `user_cred` SET `is_verified`=? WHERE `id`=?",[1,$fetch['id']],'ii');
    //             if($update){
    //                 echo"<script>alert('Email Verification Successful!')</script>";
    //             }else{
    //                 echo"<script>alert('Email Verification Failed!')</script>";
    //             }
    //             redirect('index.php');
    //         }
    //     }
    //     else{
    //         echo"<script>alert('Invalid Link')</script>";
    //         redirect('index.php');
    //     }
    // }
?>