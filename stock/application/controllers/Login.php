<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

function __construct()
{  
  	parent::__construct();
	$this->load->library('session');
	$this->load->library('theme');	
	$this->load->model('Login_model');
}
	 
public function custom_login(){

	$this->form_validation->set_rules('exampleInputUsername', 'exampleInputUsername', 'required');
	$this->form_validation->set_rules('exampleInputPassword', 'exampleInputPassword', 'required');
        
		if ($this->form_validation->run() == true){	
	        $inputUsername = $this->input->post('exampleInputUsername');
            $inputPassword = $this->input->post('exampleInputPassword');
                
			$return=$this->Login_model->login($inputUsername,$inputPassword);
			
            if($return['flag']==1){
				$logindata = array(

				'login_ip'=>$_SERVER['REMOTE_ADDR'], 
				'login_agent'=>$_SERVER['HTTP_USER_AGENT'],
                'user_id'=> $return['resultData']['id'],
                'login_user_type'=> $return['resultData']['user_type'],
                'login_name'=> $return['resultData']['user_name'],
                'login_status'=> 'Active',
				'login_time'=>date('Y-m-d H:i:s')
			 );
				$this->db->insert('log_tbl',$logindata);
		
	                   $data = array(
						'user_id'=>$return['resultData']['id'],
						'user_type'=>$return['resultData']['user_type'],
						'full_name'=>$return['resultData']['full_name'],
						'user_name'=>$return['resultData']['user_name'],
						'user_email_id'=>$return['resultData']['user_email_id'],
						'is_login'=>$return['resultData']['is_login']
                 );
				// echo $_SESSION['user_name'];
				// print_r($data);
		//die();
				 $this->session->set_userdata($data);
				 $this->session->set_flashdata('flash_message','Loggedin successfully');
				redirect('Welcome/dashboard');
				 
				} else {
				$this->session->set_flashdata('flash_message','Wrong Username Or Password ');
		        log_message('error','username or password is wrong !');
				redirect('Welcome');
			 }
        }
		else 
		{
				$this->session->set_flashdata('flash_message','Wrong Username Or Password ');
		        log_message('error','username or password is wrong !');
				redirect('Welcome');
		}
       }

	
 

}
