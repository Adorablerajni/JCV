<?php 
if(!isset($_SESSION['user_id'])){
header("location:../");
}
?>
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url() ; ?>Welcome/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CANTEEN<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
<?php if($_SESSION['user_type']=='Admin'){ ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>Welcome/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
<?php } ?>
      
      <!-- Heading 
      <div class="sidebar-heading">
        Interface
      </div>-->

     
      <!-- Nav Item - Charts -->
      <?php //echo $_SESSION['user_type']; ?>
      <?php //if($_SESSION['user_type']=='Stock Manager' || $_SESSION['user_type']=='Admin' || $_SESSION['user_type']=='APM'){ ?>
       <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>PurchaseOrder/purchase_order_list">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Purchase Orders</span></a>
      </li>
		
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item"
	   >
        <a class="nav-link" href="<?php echo base_url();?>Welcome/checkin_list">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Check In</span></a>
      </li>
	  

	  <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Stock</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"></h6>
            <a class="collapse-item" href="<?php echo site_url(); ?>Allotment/add_stock">Add Stock</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Allotment/issue_stock">Issue Stock</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Allotment/available_stock">All Available Stock</a>
            <a class="collapse-item" href="#">Stock Report</a>
          </div>
        </div>
      </li>
      <?php //} ?>
      <?php //if($_SESSION['user_type']=='Lab Incharge' || $_SESSION['user_type']=='Admin'){ ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLab" aria-expanded="true" aria-controls="collapseLab">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Lab</span>
        </a>
        <div id="collapseLab" class="collapse" aria-labelledby="headingLab" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"></h6>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/add_requirement">Add Requirement</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/daily_production_list">Daily Production</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/dispatch_list">Delivery Challans</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/production_report">Production Report</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/dispatch_report">Dispatch Report</a>
            <!--<a class="collapse-item" href="#">Stock Report</a>-->
          </div>
        </div>
      </li>
	  <?php //} ?>
      <?php //if($_SESSION['user_type']=='Dispatch Manager' || $_SESSION['user_type']=='Admin'){ ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDispatch" aria-expanded="true" aria-controls="collapseDispatch">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Dispatch</span>
        </a>
        <div id="collapseDispatch" class="collapse" aria-labelledby="headingDispatch" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"></h6>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/add_requirement">Add Requirement</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/daily_production_list">Daily Production</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/dispatch_list">Delivery Challans</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/production_report">Production Report</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Dispatch/dispatch_report">Dispatch Report</a>
            <!--<a class="collapse-item" href="#">Stock Report</a>-->
          </div>
        </div>
      </li>
	  <?php //} ?>
	  
      <?php //if($_SESSION['user_type']=='Stock Manager' || $_SESSION['user_type']=='Admin'){ ?>
      <!-- Nav Item - Charts -->
      <!--<li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>Allotment/available_stock">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>All Available Stock</span></a>
      </li>-->
		
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasters" aria-expanded="true" aria-controls="collapseMasters">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Masters</span>
        </a>
        <div id="collapseMasters" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"></h6>
            <a class="collapse-item" href="<?php echo site_url(); ?>Master/add_stock_name">Stock</a>
            <?php if($_SESSION['user_type']=='Admin'){ ?>
            <a class="collapse-item" href="<?php echo site_url(); ?>Master/add_product_name">Product</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Master/add_district_name">District</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Master/add_project_name">Project</a>
            <!--<a class="collapse-item" href="<?php echo site_url(); ?>Master/add_suppliers">Suppliers</a>-->
            <a class="collapse-item" href="<?php echo site_url(); ?>Master/add_shift">Shifts</a>
            <?php } ?>
          </div>
        </div>
      </li>
<?php //} ?>
      
<?php //if($_SESSION['user_type']=='Admin'){ ?>

      <!-- Heading 
      <div class="sidebar-heading">
        Addons
      </div>-->

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>User Management</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"></h6>
            <a class="collapse-item" href="<?php echo site_url(); ?>Welcome/add_user">Add Users</a>
            <a class="collapse-item" href="#">Manage Users</a>
            
          </div>
        </div>
      </li>
      <?php //} ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

     