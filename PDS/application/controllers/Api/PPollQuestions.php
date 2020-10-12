<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PPollQuestions extends REST_Controller {
    
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
        
        if(!empty($username)){
            
            $query = $this->db->query("SELECT id as question_id, `poll_title`, `poll_option1`, `poll_option2` from user_polls where poll_status = 'Active'");
            
            //print_r($query);
            if ($query->num_rows() > 0)
            {
                //$userData = $query->result_array();
                $userData = $query->result_array();
                //print_r($userData);
                //echo $userData[0]['question_id'];
                
                $query2 = $this->db->query("SELECT * from user_polls_responses WHERE poll_question_id = '".$userData[0]['question_id']."' and user_id = '".$username."'");
                
                //$userData = array();
                $userData2 = $query2->result_array();
                if ($query2->num_rows() > 0)
                {
                    $query3 = $this->db->query("SELECT SUM(poll_option1) AS pollone_total, SUM(poll_option2) AS polltwo_total FROM user_polls_responses WHERE poll_question_id = '".$userData[0]['question_id']."'");
                    $userData4 = $query3->result_array();
                    
                    $userData3= array(
        
                        								'id'=>$userData[0]['question_id'],
                        								'poll_title'=>$userData[0]['poll_title'],
                        								'Answered'=>'Yes',
                        								'poll_count1'=>$userData4[0]['pollone_total'],
                        								'poll_count2'=>$userData4[0]['polltwo_total'],
                        								);
                }
                else 
                {
                    $userData3= array(
        
                        								'id'=>$userData[0]['question_id'],
                        								'poll_title'=>$userData[0]['poll_title'],
                        								'Answered'=>'No',
                        								'poll_option1'=>$userData[0]['poll_option1'],
                        								'poll_option2'=>$userData[0]['poll_option2'],
                        								);
                }
				
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successfull.',
					'data' => $userData3
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
