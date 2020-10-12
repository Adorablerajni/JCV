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
		$data['allStockData'] = $this->Allotment_model->get_all_stock($user_id);
		//print_r($data);die();
		$this->load->view('add_stock', $data);
	}
	
	public function show_stock_list()
	{
		$txtEntryDate = $this->input->post('txtEntryDate');
		$data['stockListByDate'] = $this->Allotment_model->get_stock_list_by_date($txtEntryDate);
		$this->load->view('add_stock', $data);
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
				
            $AllStockData = array(
			      'stock_date'=>$txtCheckinDate,
			      'stock_id'=>$txtStockName,
			      'stock_debit'=>$txtQuantity,
			      'stock_rate'=>$txtRate,
			      'stock_amount'=>$txtAmount,
			      'user_id'=>$user_id,
				  'creation_date'=>date('Y-m-d h:i:s')
			 );
			 if($txtRate!=''){
				$this->db->insert('manage_stock', $AllStockData);
				$this->session->set_flashdata('message', 'Stock Added Successfully');
			 }
			 else{
				$this->session->set_flashdata('message', 'Stock Not Added');
			 }
			$m++;
		}
			redirect ('Allotment/add_stock');
	}
	
	//------------------------------- Available Stock  ---------------------------
	public function available_stock()
	{
	    $user_id=$_SESSION['user_id'];
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$data['allStockData'] = $this->Allotment_model->get_all_stock($user_id);
		$this->load->view('available_stock', $data);
	}
	
	//------------------------------- Issue Stock  ---------------------------
	public function issue_stock()
	{
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$this->load->view('issue_stock', $data);
	}
	
	public function add_issue_stock()
	{
	    $user_id=$_SESSION['user_id'];
		$txtEntryDate = $this->input->post('txtEntryDate');
        $txtIssueTo = $this->input->post('txtIssueTo');
				
        $m =0;
		$module_id = $this->input->post('txtStockName');
		foreach($module_id as $value) 
		{
			
                $txtStockName = $this->input->post('txtStockName')[$m];
                $txtCurrentStock = $this->input->post('txtCurrentStock')[$m];
                $txtIssueQuantity = $this->input->post('txtIssueQuantity')[$m];
                $txtAvailableStock = $this->input->post('txtAvailableStock')[$m];
				
				
            $IssueData = array(
			      'stock_date'=>$txtEntryDate,
			      'stock_id'=>$txtStockName,
			      'stock_credit'=>$txtIssueQuantity,
			      'issued_to'=>$txtIssueTo,
			      'user_id'=>$user_id,
				  'creation_date'=>date('Y-m-d h:i:s')
			 );
             
            $this->db->insert('manage_stock',$IssueData);
			$m++;
	}
			$this->session->set_flashdata('message', 'Issued Successfully');
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
}
