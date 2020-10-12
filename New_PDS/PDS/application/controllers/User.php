<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('UserPanel_model');
			$this->load->model('User_model');
	}
	/* Question List*/
	public function index()
	{   
	    if(!isset($_SESSION['userid'])) {
	        redirect('home');
	    } else {
	        $data['page_title'] = "User Panel | Jyotish Vidhya";
    		$data['get_user_details'] = $this->UserPanel_model->user_details();
    		$data['get_qa'] = $this->User_model->get_your_question();
    		$data['get_article'] = $this->User_model->articles();
    		$data['get_quote'] = $this->User_model->quotes();
    		$data['get_poles'] = $this->User_model->pole_questions();
    		$data['get_ques'] = $this->User_model->our_all_question();
    		$data['pole_percent'] = $this->User_model->pole_response_percent();
    		//$data['users_answer'] = $this->User_model->get_user_answers();
    		$pole_response = $this->User_model->check_poles($_SESSION['userid']);
    		if($pole_response['pole_flag'] == 1){
    		    $data['poles_response'] = $this->User_model->check_poles_response($pole_response['poles']->u_unique_id);
    		}
	    }
		
		
	
// 		print_r( $data['poles_response']);
// 		die();
		$this->load->view('user_home',$data);
		
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
	
	 public function quotes()
	{
		$data['page_title'] = "User Panel | Jyotish Vidhya";
		$data['get_quote'] = $this->User_model->quotes();
// 		print_r($data);
// 		die();
		$this->load->view('quotes_show',$data);
		
	}
	
	/* Articles type post */
    public function articles()
	{
		$data['page_title'] = "User Panel | Jyotish Vidhya";
		$data['get_article'] = $this->User_model->articles();
// 		print_r($data);
// 		die();
		$this->load->view('articles_show',$data);
		
	}
	
    public function save_response() {
       $result =  $this->User_model->save_poll_response($_POST);
       if($result) {
         redirect('User');
       }
    }
	
	public function save_our_ans() {
	    $result=  $this->User_model->save_our_answer($_POST);
        redirect('User');
      
	
	}
	public function check_our_ans() {
	     $response=  $this->User_model->check_our_qa($_POST);
	   redirect('User');
	   // echo json_encode($response);
	
	}	
	public function change_password() {
	    $data['page_title'] = "User Panel | Jyotish Vidhya";
	    $this->theme->load_view_without_footer($data,'change_password');
	    
	 }	
	 public function save_new_password() {
	    $new_password = $this->input->post('new_password');
    	$cf_new_password = $this->input->post('cf_new_password');
    	if($new_password != $cf_new_password) {
    	    $this->session->set_flashdata('error', "Please Enter Confirm Password as Password!");
    	    redirect('User/change_password');
    	}
	    $response =  $this->User_model->save_new_pass();
	    if($response) {
	        redirect('User');
	    }else {
	        redirect('User/change_password');
	    }
	   // $this->form_validation->set_rules('current_password','Current Password','required');
	   // $this->form_validation->set_rules('new_password','New Password','required');
	   // $this->form_validation->set_rules('cf_new_password','Confirm New Password','requiredmatches[new_password]');
	   

	   // if ($this->form_validation->run() == true)	
	   // {	
	    	
	   // 	
	   // }
	 }
	 
	
}