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
    <title>ADMIN PANEL - GoSpeedy</title>
    <?php require("inc/links.php");?>
    
</head>


<body class="bg-light">
    <?php
    require('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 mt-0 overflow-hidden">
                <h3 class="mb-4 "><b>Vehicle</b></h3>

                <div class="card border-0 mb-4 shadow">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#add-jewellery">
                            <i class="bi bi-plus-circle-fill"></i>  Add
                            </button>
                        </div>

                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="text-center sticky-top bg-dark text-light">
                                    <tr>
                                    <th scope="col">Sr no.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Security Charge</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="jewellery-data">
                                  
                                </tbody>
                            </table>
                        </div>
                            
                    
    
                    </div>
                </div>          


            </div>
        </div>
    </div>

<!-- add jewellery modal -->
    <div class="modal fade" id="add-jewellery" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form id="add_jewellery_form" autocomplete="off">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Add Jewellery</b></h5>
            
                    </div>
                    <div class="modal-body bg-dark text-light">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name"  class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" min="1" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Security Charge</label>
                                <input type="number" min="1" name="security_charge"  class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" min="1" name="quantity"  class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <div class="row">
                                    <?php
                                      $res = selectAll('category');
                                      while($opt = mysqli_fetch_assoc($res)){
                                        echo"<div>
                                          <label>
                                             <input type='checkbox' name='categories' value='$opt[id]' class='form-check-input shadow-none'>
                                             $opt[name]
                                          </label>
                                        </div>";
                                      }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                               <label class="form-label fw-bold">Description</label>
                               <textarea name="desc" required rows="4" class="form-control shadow-none"></textarea>

                            </div>
                        </div>
                    </div>
                       
                    <div class="modal-footer">
                        <button type="reset"  class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="" class="btn btn-success text-light">Save</button>
                    </div>
                    </div>

                    </form>
                    
                </div>
    </div>


<!-- add jewellery modal -->

<!-- edit jewellery modal -->
            <div class="modal fade" id="edit-jewellery" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form id="edit_jewellery_form" autocomplete="off">
                       <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><b>Add Vehicle</b></h5>
                    
                            </div>
                            <div class="modal-body bg-dark text-light">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="name"  class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Price</label>
                                        <input type="number" min="1" name="price" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Security Charge</label>
                                        <input type="number" min="1" name="security_charge"  class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Quantity</label>
                                        <input type="number" min="1" name="quantity"  class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Category</label>
                                        <div class="row">
                                            <?php
                                            $res = selectAll('category');
                                            while($opt = mysqli_fetch_assoc($res)){
                                                echo"<div>
                                                <label>
                                                    <input type='checkbox' name='categories' value='$opt[id]' class='form-check-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                                </div>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="desc" required rows="4" class="form-control shadow-none"></textarea>

                                    </div>
                                    <input type="hidden" name="jewellery_id">
                                </div>
                            </div>
                       
                            <div class="modal-footer">
                                <button type="reset"  class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" onclick="" class="btn btn-success text-light">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>


<!-- edit jewellery modal -->


<!-- jewellery image modal -->
    <div class="modal fade" id="jewellery-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vehicle Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                            <button type="submit" onclick="" class="btn btn-success text-light">ADD</button>
                            <input type="hidden" name="jewellery_id">

                        </form>
                    </div>

                        <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="sticky-top bg-dark text-light">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="jewellery-image-data">
                                  
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
<!-- jewellery image modal -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
    let add_jewellery_form = document.getElementById('add_jewellery_form');

    add_jewellery_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_jewellery();
    });

    function add_jewellery()
    {
        let data = new FormData();
        data.append('add_jewellery','');
        data.append('name',add_jewellery_form.elements['name'].value);
        data.append('price',add_jewellery_form.elements['price'].value);
        data.append('security_charge',add_jewellery_form.elements['security_charge'].value);
        data.append('quantity',add_jewellery_form.elements['quantity'].value);
        data.append('desc',add_jewellery_form.elements['desc'].value);
        

        let categories = [];

        add_jewellery_form.elements['categories'].forEach(el =>{
            if(el.checked){
                categories.push(el.value);
            }
        });

        data.append('categories',JSON.stringify(categories));



        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);

        xhr.onload = function(){
            
            var myModal = document.getElementById('add-jewellery');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1){
                alert('success', 'new category added!');
                add_jewellery_form.reset();
                get_all_jewellery();
                
            }else{
                alert('error','server Down!');
            }
        }

        xhr.send(data);

    }

    function get_all_jewellery()
    {
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('jewellery-data').innerHTML = this.responseText;
        }

        xhr.send('get_all_jewellery');


    }

    
    let edit_jewellery_form = document.getElementById('edit_jewellery_form');


    function edit_details(id)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            let data = JSON.parse(this.responseText);
            edit_jewellery_form.elements['name'].value = data.jewellerydata.name;
            edit_jewellery_form.elements['price'].value = data.jewellerydata.price;
            edit_jewellery_form.elements['security_charge'].value = data.jewellerydata.security_charge;
            edit_jewellery_form.elements['quantity'].value = data.jewellerydata.quantity;
            edit_jewellery_form.elements['desc'].value = data.jewellerydata.description;
            edit_jewellery_form.elements['jewellery_id'].value = data.jewellerydata.id;

        

            edit_jewellery_form.elements['categories'].forEach(el =>{
                if(data.categories.includes(Number(el.value))){
                    el.checked = true;
                }
            });
            
        }

        xhr.send('get_jewellery='+id);

    }

    edit_jewellery_form.addEventListener('submit',function(e){
        e.preventDefault();
        submit_edit_jewellery();
    });


    function submit_edit_jewellery()
    {
        let data = new FormData();
        data.append('edit_jewellery','');
        data.append('jewellery_id',edit_jewellery_form.elements['jewellery_id'].value);
        data.append('name',edit_jewellery_form.elements['name'].value);
        data.append('price',edit_jewellery_form.elements['price'].value);
        data.append('security_charge',edit_jewellery_form.elements['security_charge'].value);
        data.append('quantity',edit_jewellery_form.elements['quantity'].value);
        data.append('desc',edit_jewellery_form.elements['desc'].value);
        

        let categories = [];

        edit_jewellery_form.elements['categories'].forEach(el =>{
            if(el.checked){
                categories.push(el.value);
            }
        });

        data.append('categories',JSON.stringify(categories));



        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);

        xhr.onload = function(){
            
            var myModal = document.getElementById('edit-jewellery');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1){
                alert('success', 'new category added!');
                edit_jewellery_form.reset();
                get_all_jewellery();
                
            }else{
                alert('error','server Down!');
            }
        }

        xhr.send(data);

    }


    let add_image_form = document.getElementById('add_image_form');

    add_image_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_image();
    });

    function add_image()
    {
        let data = new FormData();
        data.append('image',add_image_form.elements['image'].files[0]);
        data.append('jewellery_id',add_image_form.elements['jewellery_id'].value);
        data.append('add_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 'inv_img'){
                alert('only Jpg and PNG images are allowed');
            }
            else if(this.responseText == 'inv_size'){
                alert('image should be less than 2MB');
            }
            else if(this.responseText == 'upd_failed'){
                alert('image upload failed');
            }else{
                alert('image uploaded');
                
                jewellery_images(add_image_form.elements['jewellery_id'].value,document.querySelector("#jewellery-images .modal-title").innerText);
                add_image_form.reset();
            }

        }

        xhr.send(data);

    }

    function jewellery_images(id,rname)
    {
        document.querySelector("#jewellery-images .modal-title").innerText = rname;
        add_image_form.elements['jewellery_id'].value = id;
        add_image_form.elements['image'].value = '';

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
           document.getElementById('jewellery-image-data').innerHTML = this.responseText;
        }

        xhr.send('get_jewellery_images='+id);


    }

    function rem_image(img_id,jewellery_id)
    {
        let data = new FormData();
        data.append('image_id',img_id);
        data.append('jewellery_id',jewellery_id);
        data.append('rem_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 1){
                alert('image removed');
                jewellery_images(jewellery_id,document.querySelector("#jewellery-images .modal-title").innerText);

            }
            else{
                alert('error');
            
            }

        }

        xhr.send(data);
    }

    function thumb_image(img_id,jewellery_id)
    {
        let data = new FormData();
        data.append('image_id',img_id);
        data.append('jewellery_id',jewellery_id);
        data.append('thumb_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 1){
                alert('image thumbnail changed');
                jewellery_images(jewellery_id,document.querySelector("#jewellery-images .modal-title").innerText);

            }
            else{
                alert('error');
            
            }

        }

        xhr.send(data);
    }

    function remove_jewellery(jewellery_id)
    {
        if(confirm("ARE YOU SURE"))
        {

        let data = new FormData();
       
        data.append('jewellery_id',jewellery_id);
        data.append('remove_jewellery','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/jewellery.php",true);

        xhr.onload = function()
        {
            if(this.responseText == 1){
                alert('jewellery removed');
                get_all_jewellery();
                

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
        xhr.open("POST","ajax/jewellery.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            if(this.responseText==1){
                alert('success');
                get_all_jewellery();
            }else{
                alert('error');
            }
        }

        xhr.send('toggle_status='+id+'&value='+val);


    }



    window.onload = function(){
        get_all_jewellery();
    }


</script>

</body>
</html>