 <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo base_url(); ?>assets/images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform:capitalize"><?php echo $_SESSION['Branch_Name']; ?></div>
                    <div class="email"><?php echo $_SESSION['MM_UserType']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <!--<li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            -->
                            <li><a href="javascript:void(0);"><i class="material-icons">lock</i>Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php
                        $check_type_masters='none';
                        $check_type_dashboard='none';
                        $check_type_dispatch='none';
                        $check_type_pricing='none';
                        $check_type_purchase='none';
                        $check_type_outstanding ='none';
                        if (isset($_SESSION['type'])) {
                            if ($_SESSION['type'] == 'masters' ) {
                                 $check_type_masters='block';
                            }
                            if ($_SESSION['type'] == 'purchase' ) {
                                $check_type_purchase='block';
                            }
                            if ($_SESSION['type'] == 'pricing' ) {
                                $check_type_pricing='block';
                            }
                            if ($_SESSION['type'] == 'dispatch' ) {
                                $check_type_dispatch='block';
                            }
                            if ($_SESSION['type'] == 'outstanding' ) {
                                $check_type_outstanding ='block';
                            }
                            if ($_SESSION['type'] == 'dashboard' ) {
                                $check_type_dashboard='block';
                            }
                        }


                    ?>
                    <?php if($_SESSION['MM_UserType']=="Admin"){?>
                    <li style="display: <?php echo $check_type_dashboard; ?> ">
                        <a href="<?php echo base_url(); ?>Dashboard/dashboard">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <?php } ?>
                    
                    <?php if($_SESSION['MM_UserType']=="Admin" || $_SESSION['MM_UserType']=="Sales" || $_SESSION['MM_UserType'] == "Sub Admin" || $_SESSION['MM_UserType'] == "Finance") {?>
                    <li style="display: <?php echo $check_type_masters; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Masters</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>Masters/company_list">
                                    <span>Company Code</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Masters/product_list">
                                    <span>Product Code</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Masters/composition_list">
                                    <span>Composition</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Party_list/party_list">
                                    <span> Parties</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Party_list/old_party_list">
                                    <span>Old Parties</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Masters/product_specification_list">
                                    <span>Products Specifications</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Masters/product_specification_old_list">
                                    <span>Old Products Specifications</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Discount_slabs/discount_slabs_list">
                                    <span>Discount Slabs</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>State_list/state_city_list">
                                    <span>State/City</span>
                                </a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION['MM_UserType']=="Admin" || $_SESSION['MM_UserType']=="Finance"){?>
                    <li style="display: <?php echo $check_type_purchase; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Purchase</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>Purchase/purchase_list">
                                    <span>Purchase Rate</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Sales/purchase_bill_list">
                                    <span>Purchase Bill List</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Sales/sale_bill_list">
                                    <span>Sale Bill List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION['MM_UserType']=="Admin" || $_SESSION['MM_UserType']=="Sub Admin"){?>
                    <li style="display: <?php echo $check_type_pricing; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Pricing</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>Pricing/brand_margin_slab_list">
                                    <span>Brand Margin and Quantity Slabs</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Pricing/city_state_slab_list">
                                    <span>City/State Slabs</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Purchase/creditslab_list">
                                    <span>Payment Slabs</span>
                                </a>
                            </li>
                             <li>
                                <a href="<?php echo base_url(); ?>Transactions/add_transaction">
                                    <span>New Transaction</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Transactions/transactions_list">
                                    <span>All Transactions</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION['MM_UserType']=="Admin"){?>
                    <li style="display:none">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">list</i>
                            <span>Transactions</span>
                        </a>
                        <ul class="ml-menu">
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Transactions/add_transaction">
                                    <span>New Transaction</span>
                                </a>
                            </li>
                            <li style="display:none">
                                <a href="<?php echo base_url(); ?>Transactions/transactions_list">
                                    <span>All Transactions</span>
                                </a>
                            </li> 
                            <li>
                                <a href="<?php echo base_url(); ?>Sales/sale_list">
                                    <span>All Sale</span>
                                </a>
                            </li> <li>
                                <a href="<?php echo base_url(); ?>Sales/purchase_list">
                                    <span>All Purchase</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                   
                    <?php if($_SESSION['MM_UserType']=="Admin"){?>
                    <li style="display: <?php echo $check_type_dispatch; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Dispatch</span>
                        </a>
                        <ul class="ml-menu">
                             <li>
                                <a href="<?php echo base_url(); ?>Sales/sale_list">
                                    <span>All Sale</span>
                                </a>
                            </li> <li>
                                <a href="<?php echo base_url(); ?>Sales/purchase_list">
                                    <span>All Purchase</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Masters/transport_list">
                                    <span>Transport</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Dispatch/search_transporter">
                                    <span>Search Transporter</span>
                                </a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <a  href="<?php echo base_url(); ?>/Login/custom_logout">
                            <i class="material-icons">dashboard</i>
                            <span>Back</span>
                        </a>
                    </li>
                
            
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 - <?php echo date('Y'); ?> | Developed by <a href="www.visuotech.com" target="_new">Visuotech</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
