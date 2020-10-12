<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class PView_Youtube extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
public function index_get()
{
    $u_id = $this->get('u_id');
		
	if(!empty($_GET)) 
		{
		        $query = $this->db->query("SELECT * from youtube_links");
		    
            if ($query->num_rows() > 0)
            {
				//$userData = array();
                //$userData = $query->result_array();
               
               $userData = $query->result_array();
               
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
                    'message' => 'Failed'
                ], REST_Controller::HTTP_OK);
            }
        }
		else
		{
        $this->response([
        'status' => FALSE,
        'message' => 'Required parameters are not available.'
        ], REST_Controller::HTTP_BAD_REQUEST);
       }
           
}
}
