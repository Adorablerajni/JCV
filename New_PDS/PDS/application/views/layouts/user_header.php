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
    <div class="row" style="background: #ffbe90;border-top:8px solid #d0110d;">
            <div class="col-lg-1"></div>
                <!-- Line Chart -->
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                    <div class="col-lg-2" style="width:100px;height:140px;padding:5px;">
                          
                    </div>
                    <div class="col-lg-4">
                        <h2 style="color:#FFF;line-height:100px">Jyotish Vidhya</h2>
                        <div></div>
                    </div>
                    
                    <div style="height:50px;" class="col-lg-6">
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav navbar-right" style="color:#000;list-style:none;line-height:50px;">
                    <!-- Call Search -->
                   
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    
                    <li>
                        <i class="material-icons" style="line-height:10px;vertical-align:middle;color:#000;text-decoration:none">person</i> <?php echo $_SESSION['name']; ?>
                    </li>
                </ul>
            </div>
        <style>
            .nav_links {
                padding:15px 0px 15px 20px;
            }
        </style>
                <div style="float:right;color:#FFF">
                <? 
                    // echo "<pre>"; 
                    // print_r($_SESSION);
                    // echo "</pre>";  
                
                
                ?>
                    <!--<a href="" class="nav_links">Home</a>  <a href="<? echo site_url(); ?>User/articles" class="nav_links">Articles</a><a href="<? echo site_url(); ?>User/quotes" class="nav_links">Quotes</a><a href="" class="nav_links">Polls</a> <a href="" class="nav_links">Q/A</a> <a href="" class="nav_links" style="padding-right:7px">My Profile</a></div>-->
                    </div>
                </div>
            </div>
    <!-- #Top Bar -->