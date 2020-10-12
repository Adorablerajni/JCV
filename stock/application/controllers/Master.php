<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

function __construct(){  
   parent::__construct();
		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Master_model');
     
       }
	public function index()
	{
		$this->load->view('login');
	}
	//------------------------------- Stock  ---------------------------
	public function add_stock_name()
	{
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$this->load->view('add_stock_name', $data);
	}
	
	public function stock_name_add()
	{
		$this->form_validation->set_rules('txtStockType', 'txtStockType', 'required');
		$this->form_validation->set_rules('txtStockName', 'txtStockName', 'required');
		
		if($this->form_validation->run() == true){
		   
                $txtStockType = $this->input->post('txtStockType');
                $txtStockName = $this->input->post('txtStockName');
				
            $StockData = array(
			      'stock_type'=>$txtStockType,
			      'stock_name'=>$txtStockName
				  //'creation_date'=>date('Y-m-d h:i:s')
			 );
			 
            $this->db->insert('stock_tbl',$StockData);
			$this->session->set_flashdata('message', 'Stock Added Successfully.');
			redirect ('Master/add_stock_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect ('Master/add_stock_name');
        }
	}
	
	public function edit_stock_name($s_id='')
	{
	    if(!empty($s_id))
	    {
    		$data['EditstockNameData'] = $this->Master_model->get_update_stock_name($s_id);
    		$this->load->view('edit_stock_name', $data);
	    }
	    else
	    {
	        $this->session->set_flashdata('message', 'Please Try Again.');
	       	redirect ('Master/add_stock_name'); 
	    }

	}
	
	public function stock_name_update()
	{
		$this->form_validation->set_rules('txtStockType', 'txtStockType', 'required');
		$this->form_validation->set_rules('txtStockName', 'txtStockName', 'required');
		$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
		
		if($this->form_validation->run() == true){
		   
                $txtStockType = $this->input->post('txtStockType');
                $txtStockName = $this->input->post('txtStockName');
                $hdnid = $this->input->post('hdnid');
				
            $UpdateStockData = array(
			      'stock_type'=>$txtStockType,
			      'stock_name'=>$txtStockName
			 );
			 
            $this->db->update('stock_tbl',$UpdateStockData,array('id'=>$hdnid));
			$this->session->set_flashdata('message', 'Stock Updated Successfully.');
			redirect ('Master/add_stock_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Stock Not Updated. Please Try Again.');
			redirect ('Master/add_stock_name');
        }
	}
	
	//------------------------------- Supplier ---------------------------
	public function add_suppliers()
	{
		$data['suppliersData'] = $this->Master_model->get_suppliers();
		$this->load->view('add_suppliers', $data);
	}
	
	public function suppliers_add()
	{
		$this->form_validation->set_rules('txtSupplierName', 'txtSupplierName', 'required');
		$this->form_validation->set_rules('txtMobileNo', 'txtMobileNo', 'required');
		$this->form_validation->set_rules('txtCity', 'txtCity', 'required');
		$this->form_validation->set_rules('txtAddress', 'txtAddress', 'required');
		
		if($this->form_validation->run() == true){
		   
                $txtSupplierName = $this->input->post('txtSupplierName');
                $txtMobileNo = $this->input->post('txtMobileNo');
                $txtCity = $this->input->post('txtCity');
                $txtAddress = $this->input->post('txtAddress');
				
            $SupplierData = array(
			      'supplier_name'=>$txtSupplierName,
			      'supplier_mobile_no'=>$txtMobileNo,
			      'supplier_address'=>$txtAddress,
			      'supplier_city'=>$txtCity
				  //'creation_date'=>date('Y-m-d h:i:s')
			 );
			 
            $this->db->insert('suppliers_tbl',$SupplierData);
			$this->session->set_flashdata('message', 'Supplier Added Successfully');
			redirect ('Master/add_suppliers');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Something went wrong..');
			$this->load->view('add_suppliers');
        }
	}
	
	//------------------------------- Shift ---------------------------
	public function add_shift()
	{
		$data['shiftData'] = $this->Master_model->get_shift();
		$this->load->view('add_shift', $data);
	}
	
	public function shift_add()
	{
		$this->form_validation->set_rules('txtShiftName', 'txtShiftName', 'required');
		$this->form_validation->set_rules('txtStartTime', 'txtStartTime', 'required');
		$this->form_validation->set_rules('txtEndTime', 'txtEndTime', 'required');
		
		if($this->form_validation->run() == true){
		   
                $txtShiftName = $this->input->post('txtShiftName');
                $txtStartTime = $this->input->post('txtStartTime');
                $txtEndTime = $this->input->post('txtEndTime');
				
            $ShiftData = array(
			      'shift_type'=>$txtShiftName,
			      'shift_start_time'=>$txtStartTime,
			      'shift_end_time'=>$txtEndTime
				  //'creation_date'=>date('Y-m-d h:i:s')
			 );
			 
            $this->db->insert('shift_tbl',$ShiftData);
			$this->session->set_flashdata('message', 'Shift Added Successfully');
			redirect ('Master/add_shift');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Something went wrong..');
			$this->load->view('add_shift');
        }
	}
	
/*------------------------------------------------------------------------PRODUCT NAME------------------------------------------------------------------------------*/
	
	public function add_product_name()
	{
		$data['ProductNameData'] = $this->Master_model->get_product_name();
		$this->load->view('add_product_name', $data);
	}
	
	public function product_name_add()
	{
		$this->form_validation->set_rules('txtProductName', 'txtProductName', 'required');
		
		if($this->form_validation->run() == true){
		   
                $txtProductName = $this->input->post('txtProductName');
				
            $ProductData = array(
                
			      'product_name'=>$txtProductName

			 );
			 
            $this->db->insert('product_tbl',$ProductData);
            
			$this->session->set_flashdata('message', 'Product Added Successfully.');
			redirect ('Master/add_product_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Please Try Again...');
			redirect ('Master/add_product_name');
        }
	}
	
	public function edit_product_name($p_id='')
	{
	    if(!empty($p_id))
	    {
    		$data['EditProductNameData'] = $this->Master_model->get_update_product_name($p_id);
    		$this->load->view('edit_product_name', $data);
	    }
	    else
	    {
	        $this->session->set_flashdata('message', 'Please Try Again.');
	       	redirect ('Master/add_product_name'); 
	    }

	}
	
	public function product_name_update()
	{
		$this->form_validation->set_rules('txtProductName', 'txtProductName', 'required');
		$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
		
		if($this->form_validation->run() == true){
		   
                $txtProductName = $this->input->post('txtProductName');
                $hdnid = $this->input->post('hdnid');
				
            $UpdateProductData = array(
                
			      'product_name'=>$txtProductName

			 );
			 
            $this->db->update('product_tbl',$UpdateProductData,array('id'=>$hdnid));
			$this->session->set_flashdata('message', 'Product Updated Successfully.');
			redirect ('Master/add_product_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Product Not Updated. Please Try Again.');
			redirect ('Master/add_product_name');
        }
	}
	
	
/*------------------------------------------------------------------------DISTRICT NAME------------------------------------------------------------------------------*/
	
	public function add_district_name()
	{
		$data['DistrictNameData'] = $this->Master_model->get_district_name();
		$this->load->view('add_district_name', $data);
	}
	
	public function district_name_add()
	{
		$this->form_validation->set_rules('district_name', 'district_name', 'required');
		
		if($this->form_validation->run() == true){
		   
                $district_name = $this->input->post('district_name');
				
            $DistrictData = array(
                
			      'district_name'=>$district_name

			 );
			 
            $this->db->insert('district_tbl',$DistrictData);
            
			$this->session->set_flashdata('message', 'District Added Successfully.');
			redirect ('Master/add_district_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Please Try Again...');
			redirect ('Master/add_district_name');
        }
	}
	
	public function edit_district_name($d_id='')
	{
	    if(!empty($d_id))
	    {
    		$data['EditDistrictNameData'] = $this->Master_model->get_update_district_name($d_id);
    		$this->load->view('edit_district_name', $data);
	    }
	    else
	    {
	        $this->session->set_flashdata('message', 'Please Try Again.');
	       	redirect ('Master/add_district_name'); 
	    }

	}
	
	public function district_name_update()
	{
		$this->form_validation->set_rules('district_name', 'district_name', 'required');
		$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
		
		if($this->form_validation->run() == true){
		   
                $district_name = $this->input->post('district_name');
                $hdnid = $this->input->post('hdnid');
				
            $UpdateDistrictData = array(
                
			      'district_name'=>$district_name

			 );
			 
            $this->db->update('district_tbl',$UpdateDistrictData,array('id'=>$hdnid));
			$this->session->set_flashdata('message', 'District Updated Successfully.');
			redirect ('Master/add_district_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'District Not Updated. Please Try Again.');
			redirect ('Master/add_district_name');
        }
	}	
	
	
/*------------------------------------------------------------------------PROJECT NAME------------------------------------------------------------------------------*/
	
	public function add_project_name()
	{
		$data['DistrictNameData'] = $this->Master_model->get_district_name();
		$data['ProjectNameData'] = $this->Master_model->get_project_name();
		$this->load->view('add_project_name', $data);
	}
	
	public function project_name_add()
	{
		$this->form_validation->set_rules('district_id', 'district_id', 'required');
		$this->form_validation->set_rules('district_type', 'district_type', 'required');
		$this->form_validation->set_rules('project_name', 'project_name', 'required');
		
		if($this->form_validation->run() == true){
		   
                $district_id = $this->input->post('district_id');
                $district_type = $this->input->post('district_type');
                $project_name = $this->input->post('project_name');
				
            $ProjectData = array(
                
			      'district_id'=>$district_id,
			      'district_type'=>$district_type,
			      'project_name'=>$project_name

			 );
			 
            $this->db->insert('project_tbl',$ProjectData);
            
			$this->session->set_flashdata('message', 'Project Added Successfully.');
			redirect ('Master/add_project_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Please Try Again...');
			redirect ('Master/add_project_name');
        }
	}
	
	public function edit_project_name($pro_id='')
	{
	    if(!empty($pro_id))
	    {
	        $data['DistrictNameData'] = $this->Master_model->get_district_name();
    		$data['EditProjectNameData'] = $this->Master_model->get_update_project_name($pro_id);
    		$this->load->view('edit_project_name', $data);
	    }
	    else
	    {
	        $this->session->set_flashdata('message', 'Please Try Again.');
	       	redirect ('Master/add_project_name'); 
	    }

	}
	
	public function project_name_update()
	{
		$this->form_validation->set_rules('district_id', 'district_id', 'required');
		$this->form_validation->set_rules('district_type', 'district_type', 'required');
		$this->form_validation->set_rules('project_name', 'project_name', 'required');
		$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
		
		if($this->form_validation->run() == true){
		   
                $district_id = $this->input->post('district_id');
                $district_type = $this->input->post('district_type');
                $project_name = $this->input->post('project_name');
                $hdnid = $this->input->post('hdnid');
				
            $UpdateProjectData = array(
                
			      'district_id'=>$district_id,
			      'district_type'=>$district_type,
			      'project_name'=>$project_name

			 );
			 
            $this->db->update('project_tbl',$UpdateProjectData,array('id'=>$hdnid));
            
			$this->session->set_flashdata('message', 'Project Updated Successfully.');
			redirect ('Master/add_project_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Project Not Updated. Please Try Again.');
			redirect ('Master/add_project_name');
        }
	}
	
}
