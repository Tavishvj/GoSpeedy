<?php
    require('../ess.php');
    require('../db_config.php');
    admlogin();

    if(isset($_POST['add_category'])){
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `category`(`name`) VALUES (?)";
        $values = [$frm_data['name']];
        $res = insert($q,$values,'s');
        echo $res;
    }

    if(isset($_POST['get_categories']))
    {
        $res = selectAll('category');
        $i=1;

        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
            <tr>
              <td>$i</td>
              <td>$row[name]</td>
              <td>
              <button type="button" onclick="rem_category($row[id])" class="btn btn-danger btn-sm shadow-none">
              <i class="bi bi-trash3"></i>  Delete
              </button>
              </td>
            
            </tr>
            data;
            $i++;
        }
    }


    if(isset($_POST['rem_category'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_category']];

        $check_q = select('SELECT * FROM `jewellery_category` WHERE `category_id`=?',[$frm_data['rem_category']],'i');

       if(mysqli_num_rows($check_q)==0){
        $q = "DELETE FROM `category` WHERE `id`=?";
        $res = delete($q,$values,'i');
        echo $res;  
      }else{
        echo 'jewellery_added';
      }
    }




    


?>
