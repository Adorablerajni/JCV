<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PSign_up extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    
    public function index_post()
	{
		
		$name = $this->post('name');
        $email_id = $this->post('email_id');
		$mobile = $this->post('mobile');
        $pswd = $this->post('pswd');
        //$proflie_type = $this->post('proflie_type');
		$device_id = $this->post('device_id');
		
	$query2 = $this->db->query("SELECT `u_unique_id`, `u_name`, `u_email`, `u_mobile`, `u_city`, `u_state`, `u_gender`, `u_device_id`, `u_active_status`, `u_payment_status`, `u_dob`, `u_birth_place`, `u_birth_time` from users_tbl where (u_email = '".$email_id."' or (u_mobile = '".$mobile."'))");
	
		if ($query2->num_rows() > 0)
            {
				$this->response([
                    'status' => False,
                    'message' => 'User already Exists!'
                ], REST_Controller::HTTP_OK);
			}
		else 
		{
			
			
if(!empty($mobile) && !empty($pswd))
{
	
				
    $unique_id = $name.'_'.mt_rand(1000,9999);
    $unique_id_date = $unique_id.date("Ymdhis");
	 $add_users = array(
    		'u_unique_id'=>$unique_id_date,
    		'u_name'=> $name,
    		'u_passwrd'=>$pswd,
    		'u_email'=>$email_id,
    		'u_mobile'=>$mobile,
    		'u_role'=>'User',
    		'u_device_type'=>'Mobile',
    		'u_device_id'=>$device_id,
    		
    		);
    		
         $this->db->insert('users_tbl',$add_users);
	     $user_last_id =$this->db->insert_id();
		 
	$query = $this->db->query("SELECT `u_unique_id`, `u_name`, `u_email`, `u_mobile`, `u_city`, `u_state`, `u_gender`, `u_device_id`, `u_active_status`, `u_payment_status`, `u_dob`, `u_birth_place`, `u_birth_time` from users_tbl where u_id = '".$user_last_id."'");
            
            if ($query->num_rows() > 0)
            {
				$userData = $query->row_array();
            }
            
	        $this->response([
                    'status' => TRUE,
                    'message' => 'Success',
					'data' => $userData
                ], REST_Controller::HTTP_OK);
                
}
else
{
    $this->response([
                'status' => FALSE,
                'message' => 'Failed!!!'
                ], REST_Controller::HTTP_OK);
}
}
	}
}
