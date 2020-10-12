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
			$this->session->set_flashdata('message', 'Purchase Order Successfully');
			redirect ('PurchaseOrder/purchase_order');
		
	}
	
	//----------------------------------------- view Purchase Order  ---------------------------------------------------- 
	public function view_purchase_order($Order_id='')
	{
	    $user_id=$_SESSION['user_id'];
		$data['purchaseOrderData'] = $this->Purchase_model->get_purchase_order($Order_id, $user_id);
		$this->load->view('view_purchase_order', $data);
	}
}
