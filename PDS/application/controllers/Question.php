<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('Question_model');
	}
	/* Question List*/
	public function index()
	{
		$data['page_title'] = "Questions List";
		$data['get_question'] = $this->Question_model->get_questions();
		$this->load->view('question_list',$data);
		
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
			
	    	$response = $this->Question_model->add_question($question_data);
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
	    	$response = $this->Question_model->edit_question($question_data,$question_id);
	    	redirect('/question');

	    }
		$data['page_title'] = "Edit YouTube Links";
	    $data['get_question'] = $this->Question_model->get_question_by_id($question_id);
       	$this->theme->load_view_after_login($data,'edit_question');


	}
	public function delete_question($link_id){
		$link_id = $this->uri->segment(2);
		$response =  $this->Question_model->delete_question($link_id);
		if ($response) {
			redirect('/question');
			
		}
		 
	}
	
	/* Question Responses List*/
	public function question_responses()
	{
		$data['page_title'] = "Questions Responses List";
		$data['get_question_responses'] = $this->Question_model->get_question_responses();
		$this->load->view('questions_responses',$data);
		
	}
}