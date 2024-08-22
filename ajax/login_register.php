<?php
    require('../admin/ess.php');
    require('../admin/db_config.php');


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;



    function sendMail($email,$v_code)
    {
       require ('../phpmailer/PHPMailer.php');
       require ('../phpmailer/Exception.php');
       require ('../phpmailer/SMTP.php');

       $mail = new PHPMailer(true);

       try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vertikagarg1709@gmail.com';                     //SMTP username
        $mail->Password   = 'huzw feco qewo fmzi';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('vertikagarg1709@gmail.com', 'Her Treasure');

        $mail->addAddress($email);  
      
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification From Her Treasure';
        $mail->Body    = "Thanks For Registration!
        click the link below to verfiy the Email <a href='".SITE_URL."verify.php? email=$email&v_code=$v_code'>Verify Email</a></b>";
    
    
        $mail->send();
        return true;
      } catch (Exception $e) {
          return false;
      }
    }

    function resetPassword($email,$reset_token)
    {
       require ('../phpmailer/PHPMailer.php');
       require ('../phpmailer/Exception.php');
       require ('../phpmailer/SMTP.php');

       $mail = new PHPMailer(true);

       try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vertikagarg1709@gmail.com';                     //SMTP username
        $mail->Password   = 'huzw feco qewo fmzi';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('vertikagarg1709@gmail.com', 'Her Treasure');

        $mail->addAddress($email);  
      
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link';
        $mail->Body    = "We got a request from you to reset your account password!<br>
        click the link below to reset your account password:<br> <a href='".SITE_URL."index.php? email=$email&reset_token=$reset_token'>Reset Password</a></b>";
    
    
        $mail->send();
        return true;
      } catch (Exception $e) {
          return false;
      }
    }






    if(isset($_POST['register']))
    {
       $data = filteration($_POST);

       // match password and confirm password

       if($data['pass'] != $data['cpass']){
        echo 'pass_mismatch';
        exit;
       }

       // check user exists already or not

       $u_exist = select("SELECT * FROM `user_cred` WHERE `phone` = ? OR `email` = ? LIMIT 1",[$data['phone'],$data['email']],'ss');

       if(mysqli_num_rows($u_exist)!=0){
          $u_exist_fetch = mysqli_fetch_assoc($u_exist);
          echo ($u_exist_fetch['phone'] == $data['phone']) ? 'phone_already' : 'email_already';
          exit;
       }

       $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);
       $v_code = bin2hex(random_bytes(16));

       $query = "INSERT INTO `user_cred`(`name`, `address`, `phone`, `pincode`, `dob`, `pass`, `email`, `verification_code`) VALUES (?,?,?,?,?,?,?,?)";

       $values = [$data['name'],$data['address'],$data['phone'],$data['pincode'],$data['dob'],$enc_pass,$data['email'],$v_code];

       if(insert($query,$values,'ssssssss') && sendMail($_POST['email'],$v_code)){
         echo 1;
       }
       else{
         echo 'ins_failed';
       }
    }

    
    if(isset($_POST['login']))
   {
      $data = filteration($_POST);

      

       $u_exist = select("SELECT * FROM `user_cred` WHERE `phone`=? OR `email`=? LIMIT 1",[$data['email_mob'],$data['email_mob']],'ss');

       if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email_mob';
  
       }else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
          echo 'not_verified';
        }else if($u_fetch['status']==0){
          echo 'inactive';
        }
        else{
          if(!password_verify($data['pass'],$u_fetch['pass'])){
            echo 'invalid_pass';
          }else{
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['uId'] = $u_fetch['id'];
            $_SESSION['uName'] = $u_fetch['name'];
            $_SESSION['uPhone'] = $u_fetch['phone'];
            echo 1;
          }
        }
       }
       
        
      

   }


   if(isset($_POST['forgot_pass']))
   {
      $data = filteration($_POST);

      $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",[$data['email']],'s');

       if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email';
  
       }else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['is_verified']==0){
          echo 'not_verified';
        }else if($u_fetch['status']==0){
          echo 'inactive';
        }
        else{
          // send reset link 
          $reset_token = bin2hex(random_bytes(16));
          date_default_timezone_set('Asia/Kolkata');
          $date = date("Y-m-d");

          $query = "UPDATE `user_cred` SET `reset_token`=?, `token_expire`=? WHERE `email`=?";
          $values = [$reset_token,$date,$data['email']];
          if(update($query,$values,'sss') && resetPassword($_POST['email'],$reset_token)){
            echo 1;
          }else{
            echo 'inv_link';
          }

        }
       }
   }


   if(isset($_POST['reset_pass']))
   {
      $data = filteration($_POST);

      $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

      $query = "UPDATE `user_cred` SET `pass`=?, `reset_token`=?, `token_expire`=? WHERE `email`=? AND `reset_token`=?";
      $values = [$enc_pass,null,null,$data['email'],$data['reset_token']];

      if(update($query,$values,'sssss'))
      {
        echo 1;
      }else{
        echo 'failed';
      }

   }
    
?>