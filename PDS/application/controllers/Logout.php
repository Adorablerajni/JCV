<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
	}
	/*Home page view load*/
	public function index()
	{	if (isset($_SESSION['userid'])) {
			$this->session->unset_userdata('logindata');
			$this->session->sess_destroy();
			redirect('home');
			
		}else{
			$this->session->sess_destroy();
			redirect('home');
		}
		
		//$this->theme->load_view_after_login($data,'dashboard');
	}
	
		
}
