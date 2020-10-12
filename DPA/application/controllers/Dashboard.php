<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       //$this->load->model('Dashboard_model');
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
	public function dashboard()
	{
		$this->load->view('dashboard');
	}
	public function check_login(){
		$pin = $this->input->post('pin');
		$url = $this->input->post('url');
		$type = $this->input->post('type');
		if ($pin == '123456') {
			$_SESSION['type'] =$type;
			$_SESSION['pin'] = $pin;
			echo json_encode(array('url' => $url , 'flag'=>1 ));
			//redirect('Dashboard/dashboard');
		}
		else{
		    echo json_encode(array('message' =>'Please Enter Correct PIN!' , 'flag'=>0 ));
		    
		}
	}
}
