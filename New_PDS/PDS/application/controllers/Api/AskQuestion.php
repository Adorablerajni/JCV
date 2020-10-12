<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class AskQuestion extends REST_Controller {
    
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
        
		$u_id = $this->post('u_id');
		$question = $this->post('question');
        
        if(!empty($u_id) && !empty($question)){
            
            
            $query = $this->db->query("SELECT `userque_id`, `user_ques`, `user_id`, `answer_desc`, `creation_date`  FROM `user_queries` WHERE `user_id` = '".$u_id."'");
            
            if ($query->num_rows() <= 2)
            {
                
                $queriesdata = array(

                'user_id'=> $u_id,
                'user_ques'=> $question
                 );
  
                 $this->db->insert('user_queries',$queriesdata);
                 
                //$user_last_id =$this->db->insert_id();
                
                //$userData = array();
                $userData = $query->result_array();
                
				
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Question Submitted',
					//'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            }
            else{
                
                $this->response([
                    'status' => TRUE, 
                    'message' => 'Already 3 Questions Asked'
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
