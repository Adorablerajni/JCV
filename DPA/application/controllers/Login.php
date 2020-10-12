<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('Login_model');
}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('index');
	}
	
	public function recaptcha()
    {
		//echo "H";
        $this->load->view('Common_function/captchaClass');
    }
        

   public function custom_login()
    {
	$this->form_validation->set_rules('txtUsername', 'txtUsername', 'required');
	$this->form_validation->set_rules('txtPassword', 'txtPassword', 'required');
    //$this->form_validation->set_rules('txtUsertype', 'txtUsertype', 'required');

        
	if ($this->form_validation->run() == true){	
             
	    $username=$this->input->post('txtUsername');
            $password = $this->input->post('txtPassword');
			
            //$captcha = $this->input->post('txtCaptcha');
			//$usertype = $this->input->post('txtUsertype');
		
        if($username!='')
       {

            $return=$this->Login_model->login($username,$password);
            $return['flag'];

            if($return['flag']==1){          
                $data = array(
                                'MM_Username'=>$username,
                                'MM_User_Id'=>$return['resultData']['id'],
								'Branch_Name'=>$return['resultData']['branch_name'],
                                'MM_UserType'=>$return['resultData']['user_type'],
                    );
						
				$this->session->set_userdata($data);
		                                 
				$this->session->set_flashdata('flash_message','loggedin successfully');
				// redirect('Dashboard/dashboard');  
				$this->load->view('before_login');
            } 
            else 
            {		  	   
                $this->session->set_flashdata('flash_message','Invalid Username Or Password');
                log_message('error','Invalid Username Or Password');
                redirect('Login');
            }
                         
		}	
		else{
			$this->session->set_flashdata('flash_message','Please Enter The Correct Numbers!!');
			redirect('Login');
	        die();
		}             
    }
	else{
			$this->session->set_flashdata('flash_message','Invalid Username or Password');
             //log_message('error','Invalid Username Or Password');
             redirect('Login');
		}
    }
    public function before_login(){
    	$this->load->view('before_login');
    }
    public function custom_logout(){
    	if (isset($_SESSION['type']) && isset($_SESSION['pin']) ) {
			unset($_SESSION['type']);
			unset($_SESSION['pin']);
			redirect('Login/before_login');
		}
    }
        
    public function logout()
    {

	  $usertype =  $_SESSION['MM_Username'];
	   
        if($this->session->$usertype)
        {
	   $this->session->sess_destroy();
	   $path=site_url().'/';
	   redirect('Login');
	}
        else
        {
	   $this->session->sess_destroy();
	   redirect('Login');
	}
    }
	
	
}
