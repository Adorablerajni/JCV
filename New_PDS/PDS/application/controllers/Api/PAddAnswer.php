<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PAddAnswer extends REST_Controller {
    
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
        $q_id = $this->post('q_id');
        $answer = $this->post('answer');
        $attachment = $this->post('attachment');
        
        if(!empty($q_id) && !empty($answer) && !empty($u_id)){
            
            $query = $this->db->query("SELECT qa_details.qa_id, qa_details.`qa_question_id`, qa_details.user_id, questions.question, qa_details.qa_answer, qa_details.qa_attachments, qa_details.creation_date  FROM `qa_details` RIGHT JOIN questions ON questions.question_id = qa_details.qa_question_id where qa_details.user_id = '".$u_id."' and qa_details.`qa_question_id` = '".$q_id."'");
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->row_array();
                
				

                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Already Answered!',
					'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            }
            else{
                
                $logindata = array(

                'user_id'=> $u_id,
                'qa_question_id'=> $q_id,
				'qa_answer'=>$answer,
				'qa_attachments'=>$attachment,
                 );
  
                 $this->db->insert('qa_details',$logindata);
                
                $this->response([
                    'status' => TRUE,
                    'message' => 'Entry added Successfully!'
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
