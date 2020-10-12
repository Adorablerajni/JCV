<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
			$this->load->model('Queries_model');
	}
	
	function sendPushNotificationToMobileDevice($data)
	{
        //require_once("config.php");
        $key="AAAA0Kl669I:APA91bEFr87Xxsuklh_2ENNQcA-J3qBxRiH3QpPCrXF-14SZDqfLCSfwuocg8c6Xv5gvc2xN0lNkRwtM5SxD6zZIB-xtiOt_6r8LpY3_nGKuhn4QQ4RsRkvWG_BvX_9oBCc_0an9S2am";
      
      
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "authorization: key=".$key."",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 85f96364-bf24-d01e-3805-bccf838ef837"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) 
        {
           // print_r($err);
        } 
        else 
        {
            //print_r($response);
        }

    }
    
	/* Question List*/
	public function index()
	{
		$data['page_title'] = "Queries List";
		$data['get_queries'] = $this->Queries_model->get_queries();
		$this->load->view('queries',$data);
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
	public function edit_question($question_id) 
	{
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
	
	
	public function delete_question($link_id) 
	{
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
	
	public function query_response()
    {
	$userque=$this->input->POST('userque');
	$reply=$this->input->POST('reply');
    
	
	// echo "deep";
	//die();
		 
	$updateResponse = array(
	            'answer_desc'=>$reply,
	            'answer_id'=>$_SESSION['userid'],
                'anser_datetime'=>$date = date("Y-m-d h:i:s")
                );
				
	
	 $this->db->update('user_queries',$updateResponse,array('userque_id'=>$userque));
        //redirect('/Query');
        //$data['page_title'] = "Queries List";
		$data['get_token'] = $this->Queries_model->get_token($userque);
		//$this->load->view('queries',$data);
		
		
		$notification['to'] = $data['get_token']['get_token'][0]['usr_token'];
                        $notification['notification']['title'] = "Pt. Shree Ramchandraji Ameta replied to your query:";
                        $notification['notification']['body'] = $reply;
                        // $notification['notification']['text'] = $sender_details['User']['username'].' has sent you a friend request';
                        $notification['notification']['badge'] = "1";
                        $notification['notification']['sound'] = "default";
                        $notification['notification']['icon'] = "";
                        $notification['notification']['image'] = "";
                        $notification['notification']['type'] = "";
                        $notification['notification']['data'] = "";
        
        $data = json_encode($notification);
        
        $key="AAAA0Kl669I:APA91bEFr87Xxsuklh_2ENNQcA-J3qBxRiH3QpPCrXF-14SZDqfLCSfwuocg8c6Xv5gvc2xN0lNkRwtM5SxD6zZIB-xtiOt_6r8LpY3_nGKuhn4QQ4RsRkvWG_BvX_9oBCc_0an9S2am";
      
      
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "authorization: key=".$key."",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 85f96364-bf24-d01e-3805-bccf838ef837"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) 
        {
           // print_r($err);
        } 
        else 
        {
            //print_r($response);
        }
                        //sendPushNotificationToMobileDevice(json_encode($notification));
                        
                        //die();
		echo "Success";
    }
    
    
}