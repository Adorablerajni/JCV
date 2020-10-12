<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('User_model');
			$this->load->model('YouTube_model');
	}
	/*dashboard page view load*/
	public function index()
	{
		$data['page_title'] = "Dashboard";

		$this->load->view('dashboard',$data);
		
	}
	/* YouTube List*/
	public function url_list()
	{
		$data['page_title'] = "YouTube Links";
		$data['get_url'] = $this->YouTube_model->get_urls();
		$this->theme->load_view_after_login($data,'youtube_list');
		//$this->theme->load_view_after_login($data,'dashboard');
	}
	/* Add YouTube URL*/
	public function add_url()
	{	
		$this->form_validation->set_rules('url_title','URL Title','required');
	    $this->form_validation->set_rules('url_link', 'URL Link', 'required');

	    if ($this->form_validation->run() == true)	
	    {	
	    	$url_title = $this->input->post('url_title');
	    	$url_link = $this->input->post('url_link');
	    	$youtube_data = array(
	    				'video_title'=>$url_title,
	    				'youtube_link'=>$url_link ,
	    				'order_level' =>'',
	    				'user_id' => $_SESSION['userid']

	    	);
			
	    	$response = $this->YouTube_model->add_url($youtube_data);
	    	redirect('/url_list');

	    }
		$data['page_title'] = "Add YouTube Links";
		$this->theme->load_view_after_login($data,'add_url');
	}
	public function edit_url($link_id){
		$this->form_validation->set_rules('url_title','URL Title','required');
	    $this->form_validation->set_rules('url_link', 'URL Link', 'required');
	    $link_id = $this->uri->segment(2);
	    if ($this->form_validation->run() == true)	
	    {	
	    	$url_title = $this->input->post('url_title');
	    	$url_link = $this->input->post('url_link');
	    	$youtube_data = array(
	    				'video_title'=>$url_title,
	    				'youtube_link'=>$url_link ,
	       				'user_id' => $_SESSION['userid']

	    	);			
	    	$response = $this->YouTube_model->edit_url($youtube_data,$link_id);
	    	redirect('/url_list');

	    }
		$data['page_title'] = "Edit YouTube Links";
	    $data['get_url'] = $this->YouTube_model->get_url_by_id($link_id);
       	$this->theme->load_view_after_login($data,'edit_url');


	}
	public function delete_url($link_id){
		$link_id = $this->uri->segment(2);
		$response =  $this->YouTube_model->delete_url($link_id);
		if ($response) {
			redirect('/url_list');
			
		}
		 
	}
		

}
