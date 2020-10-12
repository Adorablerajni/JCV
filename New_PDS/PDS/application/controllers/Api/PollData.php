<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PollData extends REST_Controller {
    
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
		$q_id = $this->get('q_id');
        
        if(!empty($username) && !empty($q_id)){
            
   
            $query = $this->db->query("SELECT SUM(poll_option1) AS pollone_total, SUM(poll_option2) AS polltwo_total FROM user_polls_responses WHERE poll_question_id = '".$q_id."'");
        
        
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->result_array();
               // echo $count_poll1 = $userData['poll_option1'];
                //echo $count_poll2 = $userData['poll_option2'];
				
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
