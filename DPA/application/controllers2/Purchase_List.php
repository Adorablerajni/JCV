<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_List extends CI_Controller {
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
	public function purchase_list()
	{
		$this->load->view('purchase_list');
	}
	
	public function add_purchase()
	{
		$this->load->view('add_purchase');
	}
}
