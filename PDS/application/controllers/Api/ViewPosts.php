<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class ViewPosts extends REST_Controller {
    
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
		$post_type = $this->get('p_type');
		$token = $this->get('token');
        
        if(!empty($username) && !empty($post_type)){
            
            $updateToken = array(
	            'usr_token'=>$token
                );
				
	
	            $this->db->update('users_tbl',$updateToken,array('u_unique_id'=>$username));
	            //print_r($updateToken);
	//die();
            if($post_type=='ALL'){
                $query = $this->db->query("select * from admin_posts order by id desc");
            }
            else if($post_type=='Quote'){
                $query = $this->db->query("select * from admin_posts where post_type= 'Quote' order by id desc");
            }
            else if($post_type=='Article'){
                $query = $this->db->query("select * from admin_posts where post_type= 'Article' order by id desc");
            }
            
            if ($query->num_rows() > 0)
            {
                
                //$userData = array();
                $userData = $query->result_array();
                print_r($userData);
                
				
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
