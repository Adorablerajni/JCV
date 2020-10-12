<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

function __construct(){  
   parent::__construct();
		$this->load->library('session');
		$this->load->model('Login_model');
		$this->load->model('Master_model');
		$this->load->model('CheckIn_model');
		$this->load->model('User_model');
		$this->load->model('Purchase_model');
     
       }
	   
	public function index()
	{
		$this->load->view('login');
	}
	
	public function dashboard()
	{
		$this->load->view('dashboard');
	}
	
		public function checkin_list()
	{
	    $user_id = $_SESSION['user_id'];
	    $data['checkinData2'] = $this->CheckIn_model->get_checkin_list($user_id);
		$this->load->view('checkin_list', $data);
	}
	//----------------------------------- Add User ----------------------------------------------
	public function add_user()
	{
		$data['userData'] = $this->User_model->get_user();
		$this->load->view('add-user', $data);
	}
	public function user_add()
	{
		$this->form_validation->set_rules('txtFullName', 'txtFullName', 'required');
		$this->form_validation->set_rules('txtMobileNumber', 'txtMobileNumber', 'required');
		$this->form_validation->set_rules('txtEmailId', 'txtEmailId', 'required');
		$this->form_validation->set_rules('txtUserType', 'txtUserType', 'required');
		$this->form_validation->set_rules('txtUserName', 'txtUserName', 'required');
		$this->form_validation->set_rules('txtPassword', 'txtPassword', 'required');
		
		if($this->form_validation->run() == true){
		   
                $txtFullName = $this->input->post('txtFullName');
                $txtMobileNumber = $this->input->post('txtMobileNumber');
                $txtEmailId = $this->input->post('txtEmailId');
                $txtUserType = $this->input->post('txtUserType');
                $txtUserName = $this->input->post('txtUserName');
                $txtPassword = $this->input->post('txtPassword');
				
            $UserData = array(
			      'full_name'=>$txtFullName,
			      'contact_no'=>$txtMobileNumber,
			      'user_email_id'=>$txtEmailId,
			      'user_type'=>$txtUserType,
			      'user_name'=>$txtUserName,
			      'password'=>$txtPassword,
			      'is_login'=>'Yes',
				  'creation_date'=>date('Y-m-d h:i:s')
			 );
			 
            $this->db->insert('user_tbl',$UserData);
			$this->session->set_flashdata('message', 'User Added Successfully');
			redirect ('Welcome/add_user');
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect ('Welcome/add_user');
        }
	}
	//----------------------------------------- Check In  ---------------------------------------------------- 
/*	public function add_checkin()
	{
	    $user_id = $_SESSION['user_id'];
		$data['checkinData'] = $this->CheckIn_model->get_checkin($user_id);
		$data['distinctOrderData'] = $this->Purchase_model->get_distinct_order($user_id);
		$this->load->view('add_checkin', $data);
	}
	*/
	
	public function add_checkin($order_id="")
	{
	    $user_id = $_SESSION['user_id'];
		//$this->form_validation->set_rules('txtOrderNo', 'txtOrderNo', 'required');
		
		if(isset($order_id)!=''){
			
		//$order_id = $this->input->get('txtOrderNo');
		
		$data['stockNameData'] = $this->Master_model->get_stock_name();
		$data['suppliersData'] = $this->Master_model->get_suppliers();
		$data['checkinData'] = $this->CheckIn_model->get_checkin($order_id);
		$data['distinctOrderData'] = $this->Purchase_model->get_distinct_order($user_id);
		$data['purchaseOrderData'] = $this->Purchase_model->get_purchase_order($order_id, $user_id);
		//echo "Hello";
		$this->load->view('add_checkin', $data);
		}
		else 
		{
	    $user_id = $_SESSION['user_id'];
	    //echo "Bello";
		$data['checkinData'] = $this->CheckIn_model->get_checkin($user_id);
		$data['distinctOrderData'] = $this->Purchase_model->get_distinct_order($user_id);
		$this->load->view('add_checkin', $data);
        }
	}
	
	
	public function checkin_add()
	{

		$this->form_validation->set_rules('txtEntryDate', 'txtEntryDate', 'required');
		$this->form_validation->set_rules('txtVehicleNumber', 'txtVehicleNumber', 'required');
		$this->form_validation->set_rules('txtDriverName', 'txtDriverName', 'required');
		$this->form_validation->set_rules('txtDriverMobile', 'txtDriverMobile', 'required');
		
		if($this->form_validation->run() == true){	
		
		$txtEntryDate = $this->input->post('txtEntryDate');
        $txtVehicleNumber = $this->input->post('txtVehicleNumber');
        $txtDriverName = $this->input->post('txtDriverName');
        $txtDriverMobile = $this->input->post('txtDriverMobile');
        $txtChallanNumber = $this->input->post('txtChallanNumber');
        $txtChallanDate = $this->input->post('txtChallanDate');
        $txtGetInTime = $this->input->post('txtGetInTime');
        $txtOrderId = $this->input->post('txtOrderId');

	    $user_id = $_SESSION['user_id'];
		
        $m =0;
		$module_id = $this->input->post('txtStockName');
		foreach($module_id as $value){
			
            $txtStockName = $this->input->post('txtStockName')[$m];
            $txtSupplierName = $this->input->post('txtSupplierName')[$m];
            $txtQuantity = $this->input->post('txtQuantity')[$m];
            $txtWeight = $this->input->post('txtWeight')[$m];
            $txtRemark = $this->input->post('txtRemark')[$m];
				
				
            $CheckInData = array(
			      'checkin_date'=>$txtEntryDate,
			      'vehicle_number'=>$txtVehicleNumber,
			      'driver_name'=>$txtDriverName,
			      'driver_mobile_no'=>$txtDriverMobile,
			      'chalan_no'=>$txtChallanNumber,
			      'chalan_date'=>$txtChallanDate,
			      'get_in_time'=>$txtGetInTime,
			      'order_id'=>$txtOrderId,
			      'stock_name'=>$txtStockName,
			      'supplier_name'=>$txtSupplierName,
			      'checkin_quantity'=>$txtQuantity,
			      'checkin_weight'=>$txtWeight,
			      'checkin_remark'=>$txtRemark,
			      'user_id'=>$user_id,
				  'creation_date'=>date('Y-m-d h:i:s')
			 );
			 
            if(!empty($txtStockName)) //&&!empty($txtSupplierName)&&!empty($txtQuantity) 
			{
				$this->db->insert('checkin_tbl',$CheckInData);
			}
			
			$m++;
		}
			$this->session->set_flashdata('message', 'CheckIn Successfully');
			redirect ('Welcome/checkin_list');
		}
		else
		{
			$this->session->set_flashdata('message', 'CheckIn Unsuccessful');
			redirect ('Welcome/add_checkin');
		}	
	}
}
