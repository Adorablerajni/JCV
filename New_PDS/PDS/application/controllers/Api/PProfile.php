<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PProfile extends REST_Controller {
    
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
        $u_dob = $this->post('dob');
		$u_birth_place = $this->post('b_place');
		$b_time = $this->post('b_time');
		$city = $this->post('city');
		$state = $this->post('state');
		$gender = $this->post('gender');
        
        if(!empty($u_id)){
            
            $query = $this->db->query("SELECT `u_unique_id`, `u_name`, `u_email`, `u_mobile`, `u_city`, `u_state`, `u_gender` from users_tbl where u_unique_id = '".$u_id."'");
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->row_array();
                
				$updatelogindata = array(

                'u_dob'=>$u_dob,
                'u_birth_place'=>$u_birth_place,
                'u_birth_time'=>$b_time,
                'u_city'=>$city,
                'u_state'=>$state,
                'u_gender'=>$gender,
                 );
  
                 $this->db->update('users_tbl',$updatelogindata, array('u_unique_id'=>$u_id));

                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Record Updated',
				//	'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            }
            else{
                
                $this->response([
                    'status' => FALSE,
                    'message' => 'User not found!'
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
