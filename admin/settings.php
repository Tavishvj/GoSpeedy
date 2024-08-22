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
    <title>ADMIN PANEL - SETTINGS</title>
    <?php require("inc/links.php");?>
    
</head>


<body class="bg-light">
    <?php
    require('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 mt-0 overflow-hidden">
                <h3 class="mb-4"><b>Settings</b></h3>
                <!--general setting action-->
                <div class="card mb-4 shadow">
                    <div class="card-body ">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0 "><b>General Settings</b></h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#general-s">
                            <i class="bi bi-pencil-square"></i> EDIT
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                        <p class="card-text" id="site_about"></p>

                    </div>
                 </div>

                 <!-- Modal -->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="general_s_form">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>General Settings</b></h5>
            
                    </div>
                    <div class="modal-body bg-dark text-light">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Site Title</label>
                            <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required>
                        </div>
                        <div class=" mb-3">
                            <label class="form-label fw-bold">About Us</label>
                            <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" row="6" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="" class="btn btn-success text-light">Save</button>
                    </div>
                    </div>

                    </form>
                    
                </div>
                </div>

            <!-- shutdown -->
                <div class="card mb-4 shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0"><b>Shutdown Website</b></h5>
                                <div class="form-check form-switch">
                                    <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                    </form>
                                </div>
                            </div>
                        
                            <p class="card-text">
                                No customers will be allowed to book jewellery when shutdown mode is on.
                            </p>

                        </div>
                </div>


            <!-- contact us section -->
            <div class="card mb-4 shadow ">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0"><b>Contact Settings</b></h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#contact-s">
                            <i class="bi bi-pencil-square"></i> EDIT
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold mb-2">Phone No.</h6>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-outbound-fill"></i>
                                        <span id="pn1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-outbound-fill"></i>
                                        <span id="pn2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                                    <p class="card-text" id="mail"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="mb-4">
                                
                                    <h6 class="card-subtitle mb-1 fw-bold mb-2">Social Link</h6>
                                   
                                    <p class="card-text">
                                    <i class="bi bi-facebook mb-1"></i></i>
                                        <span id="fb"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-instagram mb-1"></i>
                                        <span id="insta"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold mb-2">Iframe</h6>
                                   <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>


             <!-- contact Modal -->
             <div class="modal fade " id="contact-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form id="contact_form" >
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Contact Settings</b></h5>
            
                    </div>
                    <div class="modal-body bg-dark text-light">
                        <div class="container-fluid p-0 ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Address</label>
                                        <input type="text" name="address" id="address_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Google Map Link</label>
                                        <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Phone No.</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="bi bi-telephone-outbound-fill"></i></span>
                                            <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="bi bi-telephone-outbound-fill"></i></span>
                                            <input type="number" name="pn2" id="pn2_inp" class="form-control shadow-none" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">E-mail</label>
                                        <input type="email" name="mail" id="mail_inp" class="form-control shadow-none" required>
                                    </div>
                                
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Social Links</label>
                                        
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="bi bi-facebook mb-1"></i></i></span>
                                            <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="bi bi-instagram mb-1"></i></span>
                                            <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" required>
                                        </div>  
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Iframe</label>
                                        <input type="text" name="iframe" id="iframe_inp" class="form-control shadow-none" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="contacts_inp(contacts_data)" class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="" class="btn btn-success text-light">Save</button>
                    </div>
                    </div>

                    </form>
                    
                </div>
                </div>





            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
    let general_data, contacts_data;
    let general_s_form = document.getElementById('general_s_form');

    let site_title_inp = document.getElementById('site_title_inp');
    let site_about_inp = document.getElementById('site_about_inp');

    let contact_form = document.getElementById('contact_form');

    general_s_form.addEventListener('submit',function(e){
        e.preventDefault();
        edit(site_title_inp.value,site_about_inp.value);
    })
    
    
    function get_general(){
        let site_title = document.getElementById('site_title');
        let site_about = document.getElementById('site_about');

        

        let shutdown_toggle = document.getElementById('shutdown-toggle');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_cred.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            general_data = JSON.parse(this.responseText);
            console.log(general_data);

            site_title.innerText = general_data.site_title;
            site_about.innerText = general_data.site_about;

            site_title_inp.value = general_data.site_title;
            site_about_inp.value = general_data.site_about;

            if(general_data.shutdown == 0)
            {
                shutdown_toggle.checked = false;
                shutdown_toggle.value = 0;
            } 
            else
            {
                shutdown_toggle.checked = true;
                shutdown_toggle.value = 1;
            }
        }

        xhr.send('get_general');
    }

    function edit(site_title_val,site_about_val)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_cred.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            
            var myModal = document.getElementById('general-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1)
            {
                window.alert("saved");
                get_general();
            }
            else{
                alert("No Changes Made ");
            }
        }

        xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&edit');
    }

    function upd_shutdown(val)
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_cred.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){

            if(this.responseText == 1 && general_data.shutdown == 0)
            {
                window.alert("Site has been shutdown");
                get_general();
            }
            else{
                window.alert("Shutdown Mode Off");
            }
          
        }

        xhr.send('upd_shutdown='+val);

    }

    function get_contacts()
    {
        let contacts_p_id = ['address','gmap','pn1','pn2','mail','fb','insta'];
        let iframe = document.getElementById('iframe');


        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_cred.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            contacts_data = JSON.parse(this.responseText);
            contacts_data = Object.values(contacts_data);

            for(i=0;i<contacts_p_id.length;i++){
                document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
            }

            iframe.src = contacts_data[8];

            contacts_inp(contacts_data);
            
        }

        xhr.send('get_contacts');
    }


    function contacts_inp(data)
    {
        let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','pn2_inp','mail_inp','fb_inp','insta_inp','iframe_inp'];

        for(i=0;i<contacts_inp_id.length;i++){
            document.getElementById(contacts_inp_id[i]).value = data[i+1];
        }

    }

    contact_form.addEventListener('submit',function(e){
        e.preventDefault();
        upd_contacts();
    })

    function upd_contacts()
    {
        let index = ['address','gmap','pn1','pn2','mail','fb','insta','iframe'];
        let contacts_inp_id = ['address_inp','gmap_inp','pn1_inp','pn2_inp','mail_inp','fb_inp','insta_inp','iframe_inp'];

        let data_str = "";

        for(i=0;i<index.length;i++){
            data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';
        }
        data_str += "upd_contacts";

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/settings_cred.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            var myModal = document.getElementById('contact-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1)
            {
                window.alert("Changes saved successfully!");
                get_contacts();
             
            }
            else{
                window.alert("No Changes made!");
            }
        }

        xhr.send(data_str);
    }

    window.onload = function(){
        get_general();
        get_contacts();
    }
</script>

</body>
</html>