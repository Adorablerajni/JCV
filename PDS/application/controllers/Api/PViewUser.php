<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PViewUser extends REST_Controller {
    
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
            
            $query = $this->db->query("SELECT `u_unique_id`, `u_name`, `u_email`, `u_mobile`, `u_city`, `u_state`, `u_gender`, `u_device_id`, `u_active_status`, `u_payment_status`, `u_dob`, `u_birth_place`, `u_birth_time` from users_tbl where u_unique_id = '".$username."'");
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->row_array();
                
				
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successfull.',
					'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            }
            else{
                
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid User ID'
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
