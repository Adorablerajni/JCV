<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PPollResponses extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    public function index_post() {
        
		$username = $this->post('u_id');
		$q_id = $this->post('q_id');
		$p_one = $this->post('p_one');
		$p_two = $this->post('p_two');
        
        if(!empty($username) && !empty($q_id)){
            
            $logindata = array(

                'user_id'=> $username,
                'poll_question_id'=> $q_id,
				'poll_option1'=>$p_one,
				'poll_option2'=>$p_two,
                 );
  
                 $this->db->insert('user_polls_responses',$logindata);
                 
            $user_last_id =$this->db->insert_id();
            $query = $this->db->query("SELECT `id`, `poll_question_id`, `poll_option1`, `poll_option2`, `user_id` FROM `user_polls_responses` WHERE `id` = '".$user_last_id."'");
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->result_array();
                
				
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successfull.',
					'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            }
            else{
                
                $this->response([
                    'status' => TRUE, 
                    'message' => 'No Records Found!'
                    //'data' => $userData2
                ], REST_Controller::HTTP_OK);
            }
        }else{
            
                $this->response([
                    'status' => FALSE,
                    'message' => 'Required parameters are not available.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            //$this->response("Required parameters are not available.", REST_Controller::HTTP_BAD_REQUEST);
        }
           
    }
}
