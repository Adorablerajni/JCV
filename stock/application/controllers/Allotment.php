<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allotment extends CI_Controller {

function __construct(){  
   parent::__construct();
		$this->load->library('session');
		$this->load->model('Master_model');
		$this->load->model('Allotment_model');
     
       }
	public function index()
	{
		$this->load->view('login');
	}
	//------------------------------- Add Stock  ---------------------------
	public function add_stock()
	{
	    $user_id=$_SESSION['user_id'];
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		//print_r($data);die();
		$this->load->view('add_stock_new', $data);
	}
	
	public function show_stock_list()
	{
		$txtEntryDate = $this->input->post('txtEntryDate');
		$data['stockListByDate'] = $this->Allotment_model->get_stock_list_by_date($txtEntryDate);
		$this->load->view('add_stock_new', $data);
	}
	
	public function stock_add()
	{
	    $user_id=$_SESSION['user_id'];
		$m =0;
		$module_id = $this->input->post('txtStockName');
		foreach($module_id as $value) 
		{
                $txtCheckinDate = $this->input->post('txtCheckinDate');
                $txtStockName = $this->input->post('txtStockName')[$m];
                $txtQuantity = $this->input->post('txtQuantity')[$m];
                $txtRate = $this->input->post('txtRate')[$m];
                $txtAmount = $this->input->post('txtAmount')[$m];
				$txtOrderId = $this->input->post('txtOrderId')[$m];
				$txtCheckinId = $this->input->post('txtCheckinId')[$m];
				$txtSupplierId = $this->input->post('txtSupplierId')[$m];
				
            $AllStockData = array(
			      'stock_date'=>$txtCheckinDate,
			      'stock_id'=>$txtStockName,
			      'stock_debit'=>$txtQuantity,
			      'stock_rate'=>$txtRate,
			      'stock_amount'=>$txtAmount,
				  'supplier_name'=>$txtSupplierId,
				  'order_id'=>$txtOrderId,
				  'checkin_id'=>$txtCheckinId,
				  'user_id'=>$user_id
				  //'creation_date'=>date('Y-m-d h:i:s')
			 );
			 
            if(!empty($txtStockName) && !empty($txtQuantity) && !empty($txtRate)) 
			{
				$this->db->insert('manage_stock', $AllStockData);
				$this->session->set_flashdata('message', 'Stock Added Successfully');
			}
			else
			{
				$this->session->set_flashdata('message', 'Stock Not Added');
			}
			$m++;
		} 
			redirect ('Allotment/add_stock_new');
	}
	
	//------------------------------- Available Stock  ---------------------------
	public function available_stock()
	{
		$this->load->view('available_stock');
	}
	
	//------------------------------- show available Stock  ---------------------------
	public function show_available_stock()
	{
		    $this->form_validation->set_rules('txtStockType', 'txtStockType', 'required');
			if($this->form_validation->run() == true)
	        {
				$txtStockType = $this->input->post('txtStockType');
				$data['stockAccordingType'] = $this->Master_model->stock_according_type($txtStockType);
				$this->load->view('available_stock', $data);
		    }
			else 
		    {
		     $this->session->set_flashdata('message', 'Please Select Stock Type');
			 $this->load->view('available_stock');
		    }
	}
	
	//------------------------------- Issue Stock  ---------------------------
	public function issue_stock()
	{
	    $user_id=$_SESSION['user_id'];
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$data['issueStockList'] = $this->Allotment_model->show_issue_stock_list($user_id);
		$this->load->view('issue_stock', $data);
	}
	
	public function add_issue_stock()
	{
	    $user_id=$_SESSION['user_id'];
		$this->form_validation->set_rules('txtEntryDate', 'txtEntryDate', 'required');
		$this->form_validation->set_rules('txtIssueTo', 'txtIssueTo', 'required');
		$this->form_validation->set_rules('txtIssueUserType', 'txtIssueUserType', 'required');
		$this->form_validation->set_rules('issue_stock_no', 'issue_stock_no', 'required');
		
		if($this->form_validation->run() == true)
	    {
		$txtEntryDate = $this->input->post('txtEntryDate');
        $txtIssueTo = $this->input->post('txtIssueTo');
        $issue_stock_no = $this->input->post('issue_stock_no');
        $txtIssueUserType = $this->input->post('txtIssueUserType');
        
				
        $m =0;
		$module_id = $this->input->post('txtStockName');
		foreach($module_id as $value) 
		{
			
                $txtStockName = $this->input->post('txtStockName')[$m];
                $txtCurrentStock = $this->input->post('txtCurrentStock')[$m];
                $txtIssueQuantity = $this->input->post('txtIssueQuantity')[$m];
                $txtAvailableStock = $this->input->post('txtAvailableStock')[$m];
				
				
            $IssueData = array(
			      'issue_stock_no'=>$issue_stock_no,
			      'stock_date'=>$txtEntryDate,
			      'stock_id'=>$txtStockName,
			      'stock_credit'=>$txtIssueQuantity,
			      'issued_to'=>$txtIssueTo,
			      'issue_usertype'=>$txtIssueUserType,
			      'user_id'=>$user_id
				  //'creation_date'=>date('Y-m-d h:i:s')
			 );
            if(!empty($txtStockName)&&!empty($txtIssueQuantity)){ 
            $this->db->insert('manage_stock',$IssueData);
			$this->session->set_flashdata('message', 'Issued Successfully');
			}
			$m++;
		}
			}
			else 
		    {
		     $this->session->set_flashdata('message', 'Please Select Date and Name');
		    }
			 redirect ('Allotment/issue_stock');
		
	}
	
	
//------------------- get quantity by stock ----------------------------------	
public function get_quantity_by_stock()
 {
  if($this->input->post('Stock_id'))
  {
    $data = $this->Allotment_model->get_quantity_by_stock($this->input->post('Stock_id'));
	echo json_encode($data);
	//print_r($res);
  }
 }	
 
/*--------------------------------------START VIEW STOCK-------------------------------*/

public function view_stock($stock_id='',$date1='',$date2='')
 {
	$user_id = $_SESSION['user_id']; 
	$data['ViewStock'] = $this->Allotment_model->get_view_stock_list($stock_id,$user_id,$date1,$date2);
		
	$this->load->view('view_stock', $data);
 }
 
public function get_view_stock()
 {
	$this->form_validation->set_rules('stock_id', 'stock_id', 'required');
	$this->form_validation->set_rules('date1', 'date1', 'required');
	$this->form_validation->set_rules('date2', 'date2', 'required');
		
	$stock_id = $this->input->post('stock_id');	
		
	if($this->form_validation->run() == true)
	{
		
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        
	    redirect ("Allotment/view_stock/".$stock_id."/".$date1."/".$date2);
	    
	}
	else 
	{
		redirect ("Allotment/view_stock/".$stock_id);
	}
 }
 
/*--------------------------------------END VIEW STOCK-------------------------------*/
 
}
