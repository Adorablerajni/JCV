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
	// public function test()
	// {	
	// 	echo "<pre>";
	// 	print_r('expression');
	// 	echo "</pre>";
	// 	try {
	// 			$this->load->library('myoperator');		           	 
	// 	        // $user_Otp = $this->input->post('user_Otp');
	// 	        $user_Otp ='236603';
	// 	        //$session_id = $this->input->post('session_id');
	// 	        $session_id = '68ea10fb-aabd-4e1b-8a62-c11f0897c781';
	// 	        // $user_id = $this->input->post('user_id');
	// 	        $user_id = 1;
	// 	        $response = $this->myoperator->run_verify($user_Otp ,$session_id);          
	// 	        $res_array = json_decode($response);
	// 	        echo    $response;die;
	// 	        if($res_array->Status == "Success") {
	// 	      //      	$this->db->where('u_id',$user_id);
	// 			    // $this->db->update('users_tbl',array('is_phone_verified' => 1));
	// 	           	echo json_encode(array('flag'=>1 ,'session_id'=>$session_id ,'message'=>"Please Enter OTP You recieved on Given Mobile Number"));
	// 	        } else {
	// 	           	echo json_encode(array('flag'=> 0 ,'message'=>"OTP not Matched!"));
	// 	        }
	// 		} catch (Exception $e) {
	// 			$message = $e->getMessage();
	//            echo json_encode(array('flag'=> 0 , 'message' =>$message ));
	//        	}
	// 	// $data['page_title'] = "Login";
	// 	// $this->theme->load_view_without_footer($data,'welcome_message');
	// }
	/*Load Registration view*/
	public function sign_up()
	{
		$data['page_title'] = "Register";
		$this->theme->load_view_without_footer($data,'sign_up');
	}
	public function forgot_password()
	{
		$data['page_title'] = "Forgot-Password";
		$this->theme->load_view_without_footer($data,'forgot-password');
	}
	public function forgetpassword()
    {   
        if(!isset($_POST['user_email'])) {
            
            
        }
        $email = $this->input->post('user_email');
        $query_mail = $this->User_model->check_email_user($email);
        // echo "<pre>";
        // print_r($query_mail);
        // echo "</pre>";die;
        if($query_mail['flag'] == 1)
        {
            $data['user'] = $query_mail;
            
            $this->load->library('email');
            $config  =  array  (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    
            $this->email->initialize($config);
            $this->email->from('rajniyadav263@gmail.com', 'Forgot Password Mail');
            $this->email->to($query_mail['user']['u_email']);
            $this->email->subject('Password Recovery Mail');
            $emaildescription = $this->load->view('email/email-template-forget-password',$data,TRUE);
           $emaildescription =  str_replace("{{email}}", $query_mail['user']['u_email'],$emaildescription);
           $emaildescription =  str_replace("{{email-token}}", $query_mail['user']['email_token'],$emaildescription);

            $this->email->message($emaildescription);
            $result=$this->email->send();   
            if($result) {
                $this->session->set_flashdata('message', "Hi, ".$query_mail['user']['u_name']." Check your mailbox.");
               redirect('forgot_password');
            }else {
                $this->session->set_flashdata('error', "No Account Found For This Email!");
               redirect('forgot_password');
            }
        }
        else
        {
            $this->session->set_flashdata('error', "No Account Found For This Email!");
            redirect('forgot_password');
            
        }
    }
    
    public function new_password() {
        $email = $this->uri->segment(2);
        $email_token = $this->uri->segment(3);
        $response = $this->User_model->check_email_token($email,$email_token);
        if($response) {
            $data['title'] = "New Password";
            $this->theme->load_view_without_footer($data,'new_pasword');
        }else {
            echo 'Invalid Request URL!';
        }
        
    }
    public function save_new_password() {
        $email = $this->input->post('email');
        $email_token = $this->input->post('email_token');
        $user_password = $this->input->post('user_password');
        $user_cpassword = $this->input->post('user_cpassword');
        $data = array();
        if($user_password == $user_cpassword) {
            $data = array(
                    'u_passwrd' => $user_password );
            $this->db->where('u_email', $email);
            $this->db->where('email_token', $email_token);
            $response = $this->db->update('users_tbl', $data);
            if( $response) {
                $this->session->set_flashdata('message', "Successfully saved password! Please login now");
                redirect('/');
            }
            
        }else {
            $this->session->set_flashdata('error', "Please check both passwords not same.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        

        
    }
	/*Register User with all validation*/
	public function registered()
	{
		$check_request = $this->input->post('get_request');
		if (isset($check_request) && $check_request != '') {
			if ($check_request == 'signup_user' ) {
				$full_name = $this->input->post('full_name');
				//$l_name = $this->input->post('l_name');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$password = $this->input->post('password');
				$check_email = $this->User_model->check_email($email);
				$check_phone = $this->User_model->check_phone($phone); 
				$timestamp = strtotime("now");
				$u_unique_id = $full_name.'_'.date('dmY').$timestamp;
				
				//echo $check_phone . $check_email;
				if ($check_email && !$check_phone){
					
					echo json_encode(array('flag'=>0 ,'message'=>"Email Already Exist!"));
				}else if ($check_phone && !$check_email) {
				
					echo json_encode(array('flag'=>0 ,'message'=>"Phone Already Exist!"));
				}else if ($check_email && $check_phone) {
					
					echo json_encode(array('flag'=>0 ,'message'=>"Phone and Email Already Exist!"));
				}else{
					$user_data = array(
							'u_unique_id' => $u_unique_id,
							'u_name'=>$full_name,
							'u_email'=>$email,
							'u_role'=>'user',
							'email_token'=>md5($email),
							'u_passwrd'=>$password,
							'u_mobile'=>$phone,
							'u_active_status' =>'active',
							'u_device_type'=>'website',
							);
					$last_id = $this->User_model->register_user($user_data);

					if ($last_id) {
							/* Sent OTP on PHONE*/
							try {
								$this->load->library('myoperator');		           	 
					           	$session_id = '';
					           	$response = $this->myoperator->run($phone);          
					           	$res_array = json_decode($response);
					           	if($res_array->Status == "Success") {
					           		$session_id = $res_array->Details;
									$this->db->where('u_id', $last_id);
					           		$this->db->update('users_tbl',array('phone_key' => $session_id));
					           		$return_response =array(	
					           				'flag'=>1 ,
					           				'session_id'=>$session_id ,
					           				'user_id'=> $last_id ,
					           				'message'=>"Please check you phone , Enter OTP"
					           			);
					           		echo json_encode($return_response);
					           	} else {
					           		
					           		echo json_encode(array('flag'=>0 ,'message'=>"Mobile Number is Not Correct!"));
					           	}
							} catch (Exception $e) {
								
								$message = $e->getMessage();
					           echo json_encode(array('flag'=> 0 , 'message' =>$message ));
					       	}

							// echo json_encode(array('flag'=>1 ,'message'=>"You are registered successfully!"));
					}else {
						
						echo json_encode(array('flag'=>0 ,'message'=>"Could not Register!"));
					}
				}
			}else if ($check_request == 'verify_phone') {
				try {
					$this->load->library('myoperator');		           	 
			        $user_Otp = $this->input->post('user_Otp');
			        //$user_Otp ='236603';
			        $session_id = $this->input->post('session_id');
			        //$session_id = '68ea10fb-aabd-4e1b-8a62-c11f0897c781';
			        $user_id = $this->input->post('user_id');
			       //$user_id = 1;
			        $response = $this->myoperator->run_verify($user_Otp ,$session_id);          
			        $res_array = json_decode($response);
			        // echo    $response;die;
			        if($res_array->Status == "Success") {
			           	$this->db->where('u_id',$user_id);
					    $this->db->update('users_tbl',array('is_phone_verified' => 1));
			           	echo json_encode(array('flag'=>1 ,'session_id'=>$session_id ,'message'=>"You have successfully Verified your phone please login now!"));
			        } else {
			           	echo json_encode(array('flag'=> 0 ,'message'=>"OTP not Matched!"));
			        }
				} catch (Exception $e) {
					$message = $e->getMessage();
		           echo json_encode(array('flag'=> 0 , 'message' =>$message ));
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
	public function verify() {
	    $data['page_title'] = "Register";
	    $this->theme->load_view_without_footer($data,'verification');
	   // $this->load->view('verification');
	}
}
