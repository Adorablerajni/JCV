<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class ViewQueries extends REST_Controller {
    
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
        
        if(!empty($username)){
            
           if(!empty($username) && !empty($q_id)){
            $query = $this->db->query("SELECT `userque_id`, `user_ques`, `user_id`, `answer_desc`, `creation_date`  FROM `user_queries` WHERE `userque_id` = '".$q_id."' and user_id = '".$username."'");
           }
           else {
               $query = $this->db->query("SELECT `userque_id`, `user_ques`, `user_id`, `answer_desc`, `creation_date`  FROM `user_queries` WHERE user_id = '".$username."'");
           }
            
            
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
