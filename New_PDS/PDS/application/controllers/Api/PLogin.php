<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PLogin extends REST_Controller {
    
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
        
		$username = $this->post('user_name');
        $password = $this->post('pswd');
		$device_id = $this->post('device_id');
        
        if(!empty($username) && !empty($password)){
            
            $query = $this->db->query("SELECT `u_id` as user_id, `u_unique_id`, `u_name`, `u_email`, `u_mobile`, `u_city`, `u_state`, `u_gender`, `u_device_id`, `u_active_status`, `u_payment_status` from users_tbl where (u_email = '".$username."' OR u_mobile = '".$username."') AND u_passwrd = '".$password."'");
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->row_array();
                
				$logindata = array(

                'branch_name'=> $userData['u_name'],
                'device_id'=> $userData['u_device_id'],
				'user_id'=>$userData['user_id'],
                'login_time'=>date('Y-m-d H:i:s')
                 );
  
                 $this->db->insert('user_logs',$logindata);

                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Login Successfull.',
					'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            }
            else{
                
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid login credential.'
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
