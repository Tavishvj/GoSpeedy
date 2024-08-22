


<head>
<style>
    #dashboard-menu{
        position: fixed;
        height: 100%;
    }
    @media screen and (max-width: 991px){
        #dashboard-menu{
        position: fixed;
        height: auto;
        width: 100%;
    } 
    }
</style>
<?php require("inc/links.php");?>
</head>

<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">ADMIN PANEL</h3>
    <a href="logout.php" class="btn btn-light btn-sm">LOGOUT</a>


</div>

<div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light h-font">GoSpeedy</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#admindropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="admindropdown"></div>
            <ul class="nav nav-pills flex-column">
               
               <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                 </li> 
               <li class="nav-item">
                   <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#apt">
                    <span>My Appointments </span>
                    <span><i class="bi bi-calendar-check-fill"></i></span>
                   </button>
                    <div class="collapse show px-3 small mb-1" id="apt">
                        <ul class="nav nav-pills flex-column rounded border border-secondary">
                            
                            <li class="nav-item">
                                <a class="nav-link" href="12.php" >Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>

                                
                            </li>
                            
                        </ul>
                        
                   </div>
                 </li>
        
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="settings.php">Settings</a>
                </li>
                
            </ul>


        </div>



    </nav>

</div>
