<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('User_model');
	}
	/*Home page view load*/
	public function index()
	{
		$data['page_title'] = "Login";
		$this->theme->load_view_without_footer($data,'welcome_message');
	}
	/*Load Registration view*/
	public function sign_up()
	{
		$data['page_title'] = "Register";
		$this->theme->load_view_without_footer($data,'sign_up');
	}
	/*Register User with all validation*/
	public function registered()
	{
		$check_request = $this->input->post('get_request');

		if (isset($check_request) && $check_request != '') {
			if($check_request == 'verify'){
				try {
					$this->load->library('myoperator');		           	 
			        $user_Otp = $this->input->post('user_Otp');
			           $session_id = $this->input->post('session_id');
			           	$response = $this->myoperator->run_verify($user_Otp ,$session_id);          
			           	$res_array = json_decode($response);
			           	if($res_array->Status == "Success") {
			           		$session_id = $res_array->Details;
			           		echo json_encode(array('flag'=>1 ,'session_id'=>$session_id ,'message'=>"Please Enter OTP You recieved on Given Mobile Number"));
			           	} else {
			           		
			           		echo json_encode(array('flag'=>0 ,'message'=>"OTP not Matched!"));
			           	}
				} catch (Exception $e) {
					$message = $e->getMessage();
		           echo json_encode(array('flag'=> 0 , 'message' =>$message ));
		       	}
			}else {
				$full_name = $this->input->post('full_name');
				//$l_name = $this->input->post('l_name');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$password = $this->input->post('password');
				$check_email = $this->User_model->check_email($email);
				$check_phone = $this->User_model->check_phone($phone); 
				$timestamp = strtotime("now");
				$u_unique_id = $full_name.'_'.date('dmY').$timestamp;
				
				echo $check_phone . $check_email;
				if ($check_email && !$check_phone) {
					echo json_encode(array('flag'=>0 ,'message'=>"Email Already Exist!"));
				}
				else if ($check_phone && !$check_email) {
					echo json_encode(array('flag'=>0 ,'message'=>"Phone Already Exist!"));
				}else if ($check_email && $check_phone) {
					echo json_encode(array('flag'=>0 ,'message'=>"Phone and Email Already Exist!"));
				}
				else{
					$user_data = array(
							'u_unique_id' => $u_unique_id,
							'u_name'=>$full_name,
							'u_email'=>$email,
							'u_role'=>'user',
							// 'email_key'=>md5($email),
							'u_passwrd'=>$password,
							'u_mobile'=>$phone,
							'u_active_status' =>'inactive',
							'u_device_type'=>'website',
							);
					try {
						$this->load->library('myoperator');		           	 
			           	$session_id = '';
			           	// $response = $this->myoperator->run($phone);          
			           	// $res_array = json_decode($response);
			           	// if($res_array->Status == "Success") {
			           	// 	$session_id = $res_array->Details;
			           	// 	echo json_encode(array('flag'=>1 ,'session_id'=>$session_id ,'message'=>"You are registered successfully!!!!!!!!!"));
			           	// } else {
			           	// 	echo json_encode(array('flag'=>0 ,'message'=>"Mobile Number is Correct!"));
			           	// }
					} catch (Exception $e) {
						
						$message = $e->getMessage();
			           echo json_encode(array('flag'=> 0 , 'message' =>$message ));
			       	}
					$result = $this->User_model->register_user($user_data);
					if ($result) {
						echo json_encode(array('flag'=>1 ,'message'=>"You are registered successfully! sfsdf "));
					} else{
					echo json_encode(array('flag'=> 0 ,'message'=>"Could not Register!"));
				}

				}
			}
			
			
			
		}
	}
	/*Users login function */
	public function login_user(){
		$check_request = $this->input->post('get_request');
		$email = $this->input->post('email');	
		$password = $this->input->post('password');
		$response = $this->User_model->check_login($email,$password);
		if (!$response) {
			echo json_encode(array('flag'=>0 ,'message'=>"Email OR Password Wrong!"));
		}else{
		    
		    if($_SESSION['user_role'] === 'admin' ){
		        echo json_encode(array('flag'=>1 ,'message'=>"loggin please...!" ,'url'=>site_url().'dashboard'));
		    }
		    else{
		        echo json_encode(array('flag'=>1 ,'message'=>"loggin please...!" ,'url'=>site_url().'User'));
		    }
			
			//redirect('dashboard');
		}


	}
	
	public function users_list()
	{
		$data['page_title'] = "Users List";
		$data['get_users'] = $this->User_model->users_list();
		$this->load->view('users',$data);
		
	}
}
