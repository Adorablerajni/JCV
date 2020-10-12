<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poll extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('Poll_model');
	}
	/* Question List*/
	public function index()
	{
		$data['page_title'] = "Poll List";
		$data['get_poll'] = $this->Poll_model->get_polls();
		$this->load->view('poll_list',$data);
		
	}
	/* Add Question */
	public function add_question()
	{	
		$this->form_validation->set_rules('question','Question','required');
	   

	    if ($this->form_validation->run() == true)	
	    {	
	    	$question = $this->input->post('question');
	    	$url_link = $this->input->post('url_link');
	    	$question_data = array(
	    				'question'=>$question,	    				
	    				'user_id' => $_SESSION['userid']

	    	);
			
	    	$response = $this->Poll_model->add_question($question_data);
	    	redirect('/question');

	    }
		$data['page_title'] = "Add Questions";
		$this->theme->load_view_after_login($data,'add_question');
	}
	/* Edit Questions */
	public function edit_question($question_id){
		$this->form_validation->set_rules('question','Question','required');
	    $question_id = $this->uri->segment(2);
	    if ($this->form_validation->run() == true)	
	    {	
	    	$question = $this->input->post('question');
	    	
	    	$question_data = array(
	    				'question'=>$question

	    	);		
	    	$response = $this->Poll_model->edit_question($question_data,$question_id);
	    	redirect('/question');

	    }
		$data['page_title'] = "Edit YouTube Links";
	    $data['get_question'] = $this->Question_model->get_question_by_id($question_id);
       	$this->theme->load_view_after_login($data,'edit_question');


	}
	public function delete_question($link_id){
		$link_id = $this->uri->segment(2);
		$response =  $this->Poll_model->delete_question($link_id);
		if ($response) {
			redirect('/question');
			
		}
		 
	}
	
	/* Poll Response List*/
	public function poll_response()
	{
		$data['page_title'] = "Poll Responses List";
		$data['get_poll_response'] = $this->Poll_model->get_polls_responses();
		$this->load->view('poll_responses',$data);
		
	}
}