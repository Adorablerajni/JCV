<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PViewResponses extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    public function index_get() {
        
		$username = $this->get('u_id');
		$p_id = $this->get('p_id');
        
        if(!empty($username) && !empty($p_id)){
            
           
            $query = $this->db->query("SELECT `id`, `poll_question_id`, `poll_option1`, `poll_option2`, `poll_option3`, `poll_option4`, `user_id` FROM `user_polls_responses` WHERE `id` = '".$p_id."' and user_id = '".$username."'");
            
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
