<!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <div style="height:5px;"></div>
    <div class="row" style="background:#FFF;border-top:8px solid #d0110d;">
            <div class="col-lg-1"></div>
                <!-- Line Chart -->
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                    <div class="card col-lg-2" style="width:100px;height:140px;margin-top:-50px;border-radius:50%;padding:5px;" >
                          
                               <img src="<?php echo base_url(); ?>assets/images/user.png" style="width:90px;height:130px;margin-left:-0px;border-radius:50%" />
                           
                    </div>
                    <div class="col-lg-4"><br />
                        <div><h2 style="color:#6d6665"><?php echo $_SESSION['name']; ?></h2></div>
                    </div>
                    
                    <div style="height:50px;" class="col-lg-6">
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav navbar-right" style="color:#000;list-style:none;line-height:50px;">
                    <!-- Call Search -->
                   
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li>
                        <a href="" style="color:#000"><i class="material-icons" style="line-height:10px;vertical-align:middle;">vpn_key</i> Change Password</a>
                    </li>
                    <li>
                        <a href="http://localhost/PDS/logout" style="color:#000"><i class="material-icons" style="line-height:10px;vertical-align:middle;color:#000">lock</i> Logout</a>
                    </li>
                </ul>
            </div>
        <style>
            .nav_links {
                padding:15px 0px 15px 20px;
            }
        </style>
                <div style="float:right">
                <?php 
                    // echo "<pre>"; 
                    // print_r($_SESSION);
                    // echo "</pre>";  
                
                
                ?>
                    <ul class="nav nav-tabs custom-menu">
                        
                        <li class="active"><a data-toggle="tab" href="#articles"> Articles </a></li>
                        <li><a data-toggle="tab" href="#quotes">Quotes</a></li>
                        <li><a data-toggle="tab" href="#polls"> Polls</a></li>
                        <li><a data-toggle="tab" href="#qa"> Q/A </a></li>
                        <li><a data-toggle="tab" href="#my_profile"> My Profile </a></li>
                      </ul>
                    <!--<a href="" class="nav_links">Home</a>  <a href="<? echo site_url(); ?>User/articles" class="nav_links">Articles</a><a href="<? echo site_url(); ?>User/quotes" class="nav_links">Quotes</a><a href="" class="nav_links">Polls</a> <a href="" class="nav_links">Q/A</a> <a href="" class="nav_links" style="padding-right:7px">My Profile</a></div>-->
                    </div>
                </div>
            </div>
    <!-- #Top Bar -->