<?php
    require('../ess.php');
    require('../db_config.php');
    admlogin();

    if(isset($_POST['add_jewellery']))
    {
        $categories = filteration(json_decode($_POST['categories']));
        $frm_data = filteration($_POST);

        $flag = 0;


        $q1 = "INSERT INTO `jewellery`(`name`, `price`, `security_charge`, `quantity`, `description`) VALUES (?,?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['price'],$frm_data['security_charge'],$frm_data['quantity'],$frm_data['desc']];

        if(insert($q1,$values,'siiis')){
            $flag = 1;

        }

        $jewellery_id = mysqli_insert_id($conn);

        $q2 = "INSERT INTO `jewellery_category`(`jewellery_id`, `category_id`) VALUES (?,?)";

        if($stmt = mysqli_prepare($conn,$q2)){
            foreach($categories as $f){
                mysqli_stmt_bind_param($stmt,'ii',$jewellery_id,$f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }else{
            $flag = 0;
            die('query cannot be prepared - insert');

        }


        if($flag){
            echo 1;
        }
        else{
            echo 0;
        }


    }

    if(isset($_POST['get_all_jewellery']))
    {
        $res = select("SELECT * FROM `jewellery` WHERE `removed`=?",[0],'i');
        $i=1;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['status']==1){
                $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-success btn-sm shadow-none'>active</button>";
            }else{
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Inactive</button>";
            }


            $data.="
              <tr class='text-center'>
                <td>$i</td>
                <td>$row[name]</td>
                <td>₹ $row[price]</td>
                <td>₹ $row[security_charge]</td>
                <td>$row[quantity]</td>
                <td>$status</td>
                <td><button type='button' onclick='edit_details($row[id])' class='btn btn-info btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#edit-jewellery'>
                <i class='bi bi-pencil-square'></i> 
                </button>
                <button type='button' onclick=\"jewellery_images($row[id],'$row[name]')\" class='btn btn-warning btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#jewellery-images'>
                <i class='bi bi-images'></i> 
                </button>
                <button type='button' onclick='remove_jewellery($row[id])' class='btn btn-danger btn-sm shadow-none'>
                <i class='bi bi-trash'></i> 
                </button>
                </td>
                
              </tr>
            ";
            $i++;

        }
        echo $data;

    }


    if(isset($_POST['get_jewellery']))
    {
        $frm_data = filteration($_POST);
        $res1 = select("SELECT * FROM `jewellery` WHERE `id`=?",[$frm_data['get_jewellery']],'i');
        $res2 = select("SELECT * FROM `jewellery_category` WHERE `jewellery_id`=?",[$frm_data['get_jewellery']],'i');

        $jewellerydata = mysqli_fetch_assoc($res1);
        $categories = [];

        if(mysqli_num_rows($res2)>0){
             while($row = mysqli_fetch_assoc($res2)){
                array_push($categories,$row['category_id']);
             }
        }

        $data = ["jewellerydata" => $jewellerydata, "categories" => $categories];

        $data = json_encode($data);

        echo $data;
    }


    if(isset($_POST['edit_jewellery']))
    {
        $categories = filteration(json_decode($_POST['categories']));
        $frm_data = filteration($_POST);

        $flag = 0;

        $q1 = "UPDATE `jewellery` SET `name`=?,`price`=?,`security_charge`=?,`quantity`=?,`description`=? WHERE `id`=?";
        $values = [$frm_data['name'],$frm_data['price'],$frm_data['security_charge'],$frm_data['quantity'],$frm_data['desc'],$frm_data['jewellery_id']];

        if(update($q1,$values,'siiisi')){
            $flag = 1;
        }

        $del_categories = delete("DELETE FROM `jewellery_category` WHERE `jewellery_id`=?",[$frm_data['jewellery_id']],'i');

        if(!($del_categories)){
            $flag = 0;
        }

        $q2 = "INSERT INTO `jewellery_category`(`jewellery_id`, `category_id`) VALUES (?,?)";

        if($stmt = mysqli_prepare($conn,$q2)){
            foreach($categories as $f){
                mysqli_stmt_bind_param($stmt,'ii',$frm_data['jewellery_id'],$f);
                mysqli_stmt_execute($stmt);
            }
            $flag = 1;
            mysqli_stmt_close($stmt);
        }else{
            $flag = 0;
            die('query cannot be prepared - insert');

        }


        if($flag){
            echo 1;
        }
        else{
            echo 0;
        }





    }


    if(isset($_POST['toggle_status']))
    {
        $frm_data = filteration($_POST);
        $q = "UPDATE `jewellery` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];
         if(update($q,$v,'ii')){
            echo 1;

         }else{
            echo 0;
         }
    }


    if(isset($_POST['add_image']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['image'],JEWELLERY_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `jewellery_image`(`jewellery_id`, `image`) VALUES (?,?)";
            $values = [$frm_data['jewellery_id'],$img_r];
            $res = insert($q,$values,'is');
            echo $res;
        }

    }

    if(isset($_POST['get_jewellery_images']))
    {
        $frm_data = filteration($_POST);

        $res = select("SELECT * FROM `jewellery_image` WHERE `jewellery_id`=?",[$frm_data['get_jewellery_images']],'i');

        $path = JEWELLERY_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['thumb']==1){
            
                $thumb_btn = "<i class='bi bi-check2-square text-light bg-dark px-2 py-1 rounded fs-5'></i>";
            }else{

                 $thumb_btn = "  <button onclick='thumb_image($row[sr_no],$row[jewellery_id])' class='btn btn-secondary btn-sm shadow-none'>
                 <i class='bi bi-check2-square'></i>
               </button>";
            }


            echo<<<data
            <tr class='text-center'>
               <td><img src='$path$row[image]' class='img-fluid'></td>
               <td>$thumb_btn</td>
               <td>
                  <button onclick='rem_image($row[sr_no],$row[jewellery_id])' class='btn btn-danger btn-sm shadow-none'>
                    <i class='bi bi-trash'></i>
                  </button>
               </td>


            </tr>
            data;
        }

    }

    if(isset($_POST['rem_image']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['image_id'],$frm_data['jewellery_id']];

        $pre_q = "SELECT * FROM `jewellery_image` WHERE `sr_no`=? AND `jewellery_id`=?";
        $res = select($pre_q,$values,'ii');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['image'],JEWELLERY_FOLDER)){
            $q = "DELETE FROM `jewellery_image` WHERE `sr_no`=? AND `jewellery_id`=?";
            $res = delete($q,$values,'ii');
            echo $res;

        }else{
            echo 0;
        }

    }

    if(isset($_POST['thumb_image']))
    {
        $frm_data = filteration($_POST);
        $pre_q = "UPDATE `jewellery_image` SET `thumb`=? WHERE `jewellery_id`=?";
        $pre_v = [0,$frm_data['jewellery_id']];
        $pre_res = update($pre_q,$pre_v,'ii');

        $q = "UPDATE `jewellery_image` SET `thumb`=? WHERE `sr_no`=? AND `jewellery_id`=?";
        $v = [1,$frm_data['image_id'],$frm_data['jewellery_id']];
        $res = update($q,$v,'iii');

        echo $res;

    }


    if(isset($_POST['remove_jewellery']))
    {
        $frm_data = filteration($_POST);
        
        $res1 = select("SELECT * FROM `jewellery_image` WHERE `jewellery_id`=?",[$frm_data['jewellery_id']],'i');

        while($row = mysqli_fetch_assoc($res1)){
            deleteImage($row['image'],JEWELLERY_FOLDER);
        }

        $res2 = delete("DELETE FROM `jewellery_image` WHERE `jewellery_id`=?",[$frm_data['jewellery_id']],'i');
        $res3 = delete("DELETE FROM `jewellery_category` WHERE `jewellery_id`=?",[$frm_data['jewellery_id']],'i');
        $res4 = update("UPDATE `jewellery` SET `removed`=? WHERE `id`=?",[1,$frm_data['jewellery_id']],'ii');


        if($res2 || $res3 || $res4){
            echo 1;
        }else{
            echo 0;
        }

    }



    


?>
