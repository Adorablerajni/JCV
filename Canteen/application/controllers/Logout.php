<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {

function __construct(){
     parent::__construct();
	  $this->load->library('session') ;
	  $this->load->model('Login_model');
	}
	
public function index(){
	  $user_id =  $_SESSION['user_id'];
      if($this->session->$user_id){
			$this->session->sess_destroy();
			$path=site_url().'/';
			redirect('Welcome');
		}else{
			$this->session->sess_destroy();
			redirect('Welcome');
		}
			
	}
	
}
	
