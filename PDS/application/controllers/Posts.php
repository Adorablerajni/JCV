<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('Post_model');
			$this->load->model('Question_model');
	}
	/* Question List*/
	public function posts()
	{
		$data['page_title'] = "Posts List";
		$data['get_post'] = $this->Post_model->get_posts();
		$this->load->view('posts_list',$data);
		
	}
	/* Add Question */
	public function add_post()
	{	
	    $this->form_validation->set_rules('post_type','post_type','required');
		$this->form_validation->set_rules('post_content','post_content','required');
	   

	    if ($this->form_validation->run() == true)	
	    {	
	        
	    if (!empty($_FILES['file']['name'])){    
        
        $imagename=date("d-m-Y")."-".time();
        //$fileinfo = pathinfo($_FILES['file']['name']);
        //$extension = $fileinfo['extension'];

        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if($ext ==='gif' || $ext ==='jpg' || $ext ==='png' || $ext ==='jpeg')
        {
            $config = array(
            'upload_path'   => './uploads/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size' => "2048", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'file_name'     =>$imagename //"post_images!".$imagename
             );        

            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('file'))
            {
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors() ;
            die("file");
            }
            else
            {
            $imageDetailArray = $this->upload->data();
            $fileName = "uploads/".$imagename. '.' .$ext; // $imageDetailArray['file_name'];
            }
        }
        }
        else 
        {
        $file='';
        }
        
        //echo $fileName;
         //die();
	    	$post_type = $this->input->post('post_type');
	    	$post_content = $this->input->post('post_content');
	    	$post_data = array(
	    	            'post_type'=>$post_type,
	    				'post_content'=>$post_content,	    				
	    				'user_id' => $_SESSION['userid'],
	    				'post_image'=>$fileName,

	    	);
			
	    	$response = $this->Post_model->add_post($post_data);
	    	redirect('/posts');

	    }
		$data['page_title'] = "Add Post";
		$this->theme->load_view_after_login($data,'add_post');
	}
	
	/* Edit Questions */
	public function edit_question($question_id){
		$this->form_validation->set_rules('question','Question','required');
	    $question_id = $this->uri->segment(3);
	    if ($this->form_validation->run() == true)	
	    {	
	    	$question = $this->input->post('question');
	    	
	    	$question_data = array(
	    				'question'=>$question

	    	);		
	    	$response = $this->Poll_model->edit_question($question_data,$question_id);
	    	redirect('/question');

	    }
	    //echo $question_id;
		$data['page_title'] = "Edit YouTube Links";
	    $data['get_question'] = $this->Question_model->get_question_by_id($question_id);
       	$this->theme->load_view_after_login($data,'edit_question');


	}
	
	/* Edit  Post */
	public function edit_post($post_id){
		
	    $post_id = $this->uri->segment(3);
	    $this->form_validation->set_rules('post_type','post_type','required');
		$this->form_validation->set_rules('post_content','post_content','required');
	    if ($this->form_validation->run() == true)	
	    {	
	        $fileName = "";
	        if (!empty($_FILES['file']['name'])) {    
            
                $imagename=date("d-m-Y")."-".time();
                //$fileinfo = pathinfo($_FILES['file']['name']);
                //$extension = $fileinfo['extension'];
                
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        
                if($ext ==='gif' || $ext ==='jpg' || $ext ==='png' || $ext ==='jpeg')
                {
                    $config = array(
                    'upload_path'   => './uploads/',
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size' => "2048", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'file_name'     =>$imagename //"post_images!".$imagename
                     );        
        
                    $this->load->library('upload');
                    $this->upload->initialize($config);
        
                    if(!$this->upload->do_upload('file'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                        echo $this->upload->display_errors() ;
                        die("file");
                    }
                    else
                    {
                        $imageDetailArray = $this->upload->data();
                        $fileName = "uploads/".$imagename. '.' .$ext; // $imageDetailArray['file_name'];
                    }
                }
            }
            else 
            {
                $file='';
            }
            $post_type = $this->input->post('post_type');
	    	$post_content = $this->input->post('post_content');
	    	if( $fileName != "") { 
	    	    $post_data = array(
        	    	            'post_type'=>$post_type,
        	    				'post_content'=>$post_content,	    				
        	    				'user_id' => $_SESSION['userid'],
        	    				'post_image'=>$fileName,
                    );
	    	}
	    	else {
	    	    $post_data = array(
        	    	            'post_type'=>$post_type,
        	    				'post_content'=>$post_content,	    				
        	    				'user_id' => $_SESSION['userid']
        	    				
                    );
	    	}
	    	
            // print_r($post_data);die;
        	$response = $this->Post_model->edit_post($post_data,$post_id);
        	redirect('/posts');

	    }
		$data['page_title'] = "Edit Posts";
	    $data['get_post'] = $this->Post_model->get_post_by_id($post_id);
       	$this->theme->load_view_after_login($data,'edit_post');


	}
	
	
	public function delete_post($link_id){
		$link_id = $this->uri->segment(3);
		$response =  $this->Post_model->delete_post($link_id);
		if ($response) {
			redirect('/posts');
			
		}
		 
	}
	
	
}