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
    <title>ADMIN PANEL - Category</title>
    <?php require("inc/links.php");?>
    
</head>


<body class="bg-light">
    <?php
    require('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 mt-0 overflow-hidden">
                <h3 class="mb-4 "><b>Categories</b></h3>

                <div class="card border-0 mb-4 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 "><b>Jewellery Categories</b></h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#category-s">
                            <i class="bi bi-plus-circle-fill"></i>  Add
                            </button>
                        </div>

                        <div class="table-responsive-md" style="height: 450px;">
                            <table class="table table-hover border">
                                <thead class="sticky-top bg-dark text-light">
                                    <tr>
                                    <th scope="col">Sr no.</th>
                                    <th scope="col">Name</th>
                
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="category-data">
                                  
                                </tbody>
                            </table>
                        </div>
                            
                        
    
                    </div>
                </div>


               
           




            </div>
        </div>
    </div>


    <div class="modal fade" id="category-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="category_s_form">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Add Category</b></h5>
            
                    </div>
                    <div class="modal-body bg-dark text-light">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="category_name"  class="form-control shadow-none" required>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>

    let category_s_form = document.getElementById('category_s_form');

    
    category_s_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_category();
    });

    function add_category()
    {
        let data = new FormData();
        data.append('name',category_s_form.elements['category_name'].value);
        data.append('add_category','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/category_crud.php",true);

        xhr.onload = function(){
            
            var myModal = document.getElementById('category-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1){
                // alert('success', 'new category added!');
                category_s_form.elements['category_name'].value='';
                get_categories();
                


            }else{
                // alert('error','server Down!');
            }
        }

        xhr.send(data);





    }

    function get_categories(){

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/category_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            document.getElementById('category-data').innerHTML = this.responseText;
        }
        xhr.send('get_categories');
    }

    function rem_category(val){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/category_crud.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            if(this.responseText == 1)
            {
                // alert("Category Removed!");
                get_categories();
            }else if(this.responseText == 'jewellery_added'){
                alert("Category is added to Jewellery");

            }
            else{
                // alert("error");
            }
          

        }

        xhr.send('rem_category='+val);

    }

    window.onload = function(){
        get_categories();
    }

</script>

</body>
</html>