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
			      'stock_name'=>$txtStockName,
				  'creation_date'=>date('Y-m-d h:i:s')
			 );
			 
            $this->db->insert('stock_tbl',$StockData);
			$this->session->set_flashdata('message', 'Stock Added Successfully');
			redirect ('Master/add_stock_name');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Something went wrong..');
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
			      'supplier_city'=>$txtCity,
				  'creation_date'=>date('Y-m-d h:i:s')
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
			      'shift_end_time'=>$txtEndTime,
				  'creation_date'=>date('Y-m-d h:i:s')
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
	
	
}
