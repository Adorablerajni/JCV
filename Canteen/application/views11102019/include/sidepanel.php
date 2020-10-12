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
        <div class="sidebar-brand-text mx-3">Aahaar<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>Welcome/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      
      <!-- Heading 
      <div class="sidebar-heading">
        Interface
      </div>-->

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>PurchaseOrder/purchase_order">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Purchase Order</span></a>
      </li>
		
      <!-- Nav Item - Pages Collapse Menu -->
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>Welcome/add_checkin">
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
            <a class="collapse-item" href="<?php echo site_url(); ?>Allotment/issue_stock">Manage Stock</a>
            <a class="collapse-item" href="#">Stock Report</a>
          </div>
        </div>
      </li>
	  
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>Allotment/available_stock">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>All Available Stock</span></a>
      </li>
		
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
            <a class="collapse-item" href="<?php echo site_url(); ?>Master/add_suppliers">Suppliers</a>
            <a class="collapse-item" href="<?php echo site_url(); ?>Master/add_shift">Shifts</a>
          </div>
        </div>
      </li>

      


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
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

     