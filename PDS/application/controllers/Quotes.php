<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends CI_Controller {
    public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('Quote_model');
	}
	
	/* Quotes Type Posts List  */
	 public function index()
	{
		$data['page_title'] = "User Panel | Jyotish Vidhya";
		$data['get_quote'] = $this->Quote_model->quote_post();
// 		print_r($data);
// 		die();
		$this->load->view('quotes_show',$data);
		
	}
    
    
    
}
?>