<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller { 

    public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('Article_model');
	}
	
	/* Articles type post */
    public function index()
	{
		$data['page_title'] = "User Panel | Jyotish Vidhya";
		$data['get_article'] = $this->Article_model->article_post();
// 		print_r($data);
// 		die();
		$this->load->view('articles_show',$data);
		
	}
}