<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PQuestions extends REST_Controller {
    
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
            
            
            
            $query = $this->db->query("select * from questions");
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->result_array();
                 $i=0;
                 //print_r($userData);
               foreach($userData as $val)
                {
                   
                    //echo $val['question_id'];
                    $query2[$i] = $this->db->query("select qa_details.*, questions.question from qa_details INNER JOIN questions ON questions.question_id = qa_details.qa_question_id where questions.question_id = '".$val['question_id']."' and (qa_details.user_id = '".$username."' or qa_details.qa_answer is null) group by qa_question_id");
                    //print_r($query2);
                    
                    
                    if ($query2[$i]->num_rows() > 0)
                        {
                            $userData2['queans']= $query2[$i]->result_array();
                            //print_r($userData2);
                            //die();
                            
                            $userData3[$i]= array(
        
                        								'question_id'=>$userData2['queans'][0]['qa_question_id'], 
                        								'question'=>$userData2['queans'][0]['question'],
                        								'answer'=>$userData2['queans'][0]['qa_answer'],
                        								'user_id'=>$userData2['queans'][0]['user_id'],
                        								);
                        					
                        }
                        else {
                            
                            $userData3[$i]= array(
        
                        								'question_id'=>$val['question_id'], 
                        								'question'=>$val['question'],
                        								'answer'=>'',
                        								'user_id'=>$username,
                        								);
                        					
                        }
                        
                        $i++;
                    
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
                    'message' => 'Invalid u_id!'
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
