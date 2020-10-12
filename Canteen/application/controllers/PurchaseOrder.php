<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrder extends CI_Controller {

function __construct(){  
   parent::__construct();
		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Master_model');
		$this->load->model('Purchase_model');
     
       }
	   
	public function index()
	{
		$this->load->view('login');
	}
	
	//----------------------------------------- Purchase Order  ---------------------------------------------------- 
	public function purchase_order()
	{
	    $user_id=$_SESSION['user_id'];
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$data['distinctOrderData'] = $this->Purchase_model->get_distinct_order($user_id);
		$this->load->view('purchase_order', $data);
	}
	

	
	public function add_purchase_order()
	{
	    $user_id=$_SESSION['user_id'];
		$txtAddress = $this->input->post('txtAddress');
        $txtOrderNumber = $this->input->post('txtOrderNumber');
        $txtOrderDate = $this->input->post('txtOrderDate');
		
            $orderData = array(
			      'order_no'=>$txtOrderNumber,
			      'order_date'=>$txtOrderDate,
			      'order_address'=>$txtAddress,
			      'user_id'=>$user_id,
				  'creation_date'=>date('Y-m-d h:i:s'),
				 
			 );
             
            $this->db->insert('purchase_order',$orderData);
			$order_id =$this->db->insert_id();		
        $m =0;
		$module_id = $this->input->post('txtStockName');
		foreach($module_id as $value) 
		{
			
                $txtStockName = $this->input->post('txtStockName')[$m];
                $txtQuantity = $this->input->post('txtQuantity')[$m];
                $txtRequiredFor = $this->input->post('txtRequiredFor')[$m];
                $txtStoreStock = $this->input->post('txtStoreStock')[$m];
                $txtRemark = $this->input->post('txtRemark')[$m];
				
				
            $PurchaseData = array(
			      'order_id'=>$order_id,
			      'stock_name'=>$txtStockName,
			      'quantity_required'=>$txtQuantity,
			      'required_for'=>$txtRequiredFor,
			      'store_stock'=>$txtStoreStock,
			      'remark'=>$txtRemark,
			      'user_id'=>$user_id,
				  'creation_date'=>date('Y-m-d h:i:s')
			 );
            if(!empty($txtStockName)&&!empty($txtQuantity)) 
            $this->db->insert('purchase_order_list',$PurchaseData);
			$m++;
		}
			$this->session->set_flashdata('message', 'Purchase Order Successfully.');
			redirect ('PurchaseOrder/purchase_order');
		
	}
	
	public function edit_purchase_order($po_id='')
	{
	    if(!empty($po_id))
	    {
    		$data['EditPurchaseOrderData'] = $this->Purchase_model->get_upd_purchase_order($po_id);
    		$this->load->view('edit_purchase_order', $data);
	    }
	    else
	    {
	        redirect ('PurchaseOrder/purchase_order');
	    }
	}
	
	public function update_purchase_order()
	{
	    
	$this->form_validation->set_rules('txtAddress', 'txtAddress', 'required');
	$this->form_validation->set_rules('txtOrderNumber', 'txtOrderNumber', 'required');
	$this->form_validation->set_rules('txtOrderDate', 'txtOrderDate', 'required');
	$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
        
		if ($this->form_validation->run() == true){	
	    
		$txtAddress = $this->input->post('txtAddress');
        $txtOrderNumber = $this->input->post('txtOrderNumber');
        $txtOrderDate = $this->input->post('txtOrderDate');
        $hdnid = $this->input->post('hdnid');
		
            $UpdateOrderData = array(
			      'order_no'=>$txtOrderNumber,
			      'order_date'=>$txtOrderDate,
			      'order_address'=>$txtAddress,
			 );
             
            $this->db->update('purchase_order',$UpdateOrderData,array('id'=>$hdnid));

			$this->session->set_flashdata('message', 'Purchase Order Updated Successfully.');
			redirect ('PurchaseOrder/purchase_order');
			
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Purchase Order Not Updated. Please Try Again');
				redirect ('PurchaseOrder/purchase_order');
		}
	}
	
	public function edit_purchase_order_list($pol_id='')
	{
	    if(!empty($pol_id))
	    {
	        $data['stockNameData'] = $this->Master_model->get_stock_name();
    		$data['EditPurchaseOrderListData'] = $this->Purchase_model->get_upd_purchase_order_list($pol_id);
    		$this->load->view('edit_purchase_order_list', $data);
	    }
	    else
	    {
	        redirect ('PurchaseOrder/purchase_order');
	    }
	}
	
	public function update_purchase_order_list()
	{
	    
	$this->form_validation->set_rules('txtStockName', 'txtStockName', 'required');
	$this->form_validation->set_rules('txtQuantity', 'txtQuantity', 'required');
	$this->form_validation->set_rules('txtRequiredFor', 'txtRequiredFor', 'required');
	$this->form_validation->set_rules('txtStoreStock', 'txtStoreStock', 'required');
	$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
        
		if ($this->form_validation->run() == true){	
	    
                $txtStockName = $this->input->post('txtStockName');
                $txtQuantity = $this->input->post('txtQuantity');
                $txtRequiredFor = $this->input->post('txtRequiredFor');
                $txtStoreStock = $this->input->post('txtStoreStock');
                $txtRemark = $this->input->post('txtRemark');
                $hdnid = $this->input->post('hdnid');
		
            $UpdatePurchaseData = array(

			      'stock_name'=>$txtStockName,
			      'quantity_required'=>$txtQuantity,
			      'required_for'=>$txtRequiredFor,
			      'store_stock'=>$txtStoreStock,
			      'remark'=>$txtRemark
			 );;
             
            $this->db->update('purchase_order_list',$UpdatePurchaseData,array('id'=>$hdnid));

			$this->session->set_flashdata('message', 'Purchase Order List Updated Successfully.');
			redirect ('PurchaseOrder/purchase_order');
			
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Purchase Order List Not Updated. Please Try Again');
				redirect ('PurchaseOrder/purchase_order');
		}
	}
	
	
	//----------------------------------------- view Purchase Order  ---------------------------------------------------- 
	public function view_purchase_order($Order_id='')
	{
	    $user_id=$_SESSION['user_id'];
		$data['purchaseOrderData'] = $this->Purchase_model->get_purchase_order($Order_id, $user_id);
		$this->load->view('view_purchase_order', $data);
	}
	
	//----------------------------------------- Purchase Order List ---------------------------------------------------- 
	public function purchase_order_list()
	{
	    $user_id=$_SESSION['user_id'];
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$data['distinctOrderData'] = $this->Purchase_model->get_distinct_order($user_id);
		$this->load->view('purchase_order_list', $data);
	}
	
	//----------------------------------------- Approve Purchase Order ---------------------------------------------------- 
	public function approve_purchase_order()
	{
	$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
        
		if ($this->form_validation->run() == true){	
        $hdnid = $this->input->post('hdnid');
		//$approved_time = $this-> date("Y-m-d h:i:s");
		$user_id = $this->input->post('user_id');
		$approved_name = $this->input->post('user_name');
		
            $UpdateOrderData = array(
			      'status'=>"Approved",
			      'approved_by'=>$user_id,
			      'approved_time'=>date('Y-m-d h:i:s'),
			      'approvedby_name'=>$approved_name,
			 );
             //print_r($UpdateOrderData);
             //die();
             
            $this->db->update('purchase_order',$UpdateOrderData,array('id'=>$hdnid));

			$this->session->set_flashdata('message', 'Purchase Order Updated Successfully.');
			redirect ('PurchaseOrder/purchase_order_list');
			
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Purchase Order Not Updated. Please Try Again');
				redirect ('PurchaseOrder/purchase_order_list');
		}
	}
	
	//----------------------------------------- Add Purchase Item ---------------------------------------------------- 
	public function add_purchase_items($purchase_order_id='')
	{
	  	$this->form_validation->set_rules('txtStockName', 'txtStockName', 'required');
        
		if ($this->form_validation->run() == true)
		{	
 
	    //$purchase_id = $purchase_order_id;
	    $user_id=$_SESSION['user_id'];
		
                $txtStockName = $this->input->post('txtStockName');
                $txtQuantity = $this->input->post('txtQuantity');
                $txtRequiredFor = $this->input->post('txtRequiredFor');
                $txtStoreStock = $this->input->post('txtStoreStock');
                $txtRemark = $this->input->post('txtRemark');
                $hdnid = $this->input->post('hdnid');
                
				
            $AddData = array(
			      'order_id'=>$hdnid,
			      'stock_name'=>$txtStockName,
			      'quantity_required'=>$txtQuantity,
			      'required_for'=>$txtRequiredFor,
			      'store_stock'=>$txtStoreStock,
			      'remark'=>$txtRemark,
			      'user_id'=>$user_id,
				  'creation_date'=>date('Y-m-d h:i:s')
			 );
			 //print_r($AddData);
			 //die();
            if(!empty($txtStockName)&&!empty($txtQuantity)) 
            $this->db->insert('purchase_order_list',$AddData);
			
			$this->session->set_flashdata('message', 'Purchase Order Successfully.');
			redirect ('PurchaseOrder/purchase_order_list');
	    }
	    else 
	    {
	        $purchase_id = $purchase_order_id;
	    $user_id=$_SESSION['user_id'];
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$data['distinctOrderData'] = $this->Purchase_model->get_distinct_order($user_id);
		$data['PurchaseOrderId'] = $this->Purchase_model->get_id_purchase_order_list($purchase_order_id);
		//print_r($data['PurchaseOrderId']);
		//$data['p_id'] = $purchase_order_id;
		//print_r($data);
		//die();
		$this->load->view('add_purchase_item', $data);
	        
	    }
		
	}
}
