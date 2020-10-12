<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class ChangePassword extends REST_Controller {
    
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
        
		$username = $this->post('mobile');
        $password = $this->post('new_password');
		//$u_id = $this->post('u_id');
        
        if(!empty($username) && !empty($password)){
            
            $query = $this->db->query("SELECT `u_id` as user_id from users_tbl where u_mobile = '".$username."'");
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->row_array();
                
				$updateResponse = array(
	            'u_passwrd'=>$password,
                );
				
	
	                $this->db->update('users_tbl',$updateResponse,array('u_mobile'=>$username));

                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Password Changed Successfully.',
					'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            }
            else{
                
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid Userid.'
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
