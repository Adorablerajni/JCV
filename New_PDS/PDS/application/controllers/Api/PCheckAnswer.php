<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PCheckAnswer extends REST_Controller {
    
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
        
		$u_id = $this->get('u_id');
		$q_id = $this->get('q_id');
        
        if(!empty($u_id) && !empty($q_id)){
            
            $query = $this->db->query("SELECT qa_question_id as q_id, qa_answer as answer, qa_attachments as attachments, user_id as u_id, creation_date as entry_date from qa_details where user_id = '".$u_id."' and qa_question_id= '".$q_id."'");
            
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
                    'message' => 'No record Found!'
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
