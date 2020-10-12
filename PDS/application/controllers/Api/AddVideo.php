<?php
   
require APPPATH . '/libraries/REST_Controller.php';
     
class AddVideo extends REST_Controller {
    
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
        
		//$u_id = $this->post('u_id');
		$file = $this->post('file');
        
        if(!empty($_FILES['file']['name'])){
            
            
            //$query = $this->db->query("SELECT `userque_id`, `user_ques`, `user_id`, `answer_desc`, `creation_date`  FROM `user_queries` WHERE `user_id` = '".$u_id."'");
            
            //if ($query->num_rows()>0)
            //{
            
            /*-------------------------IMAGES TBL--------------------------------*/
	
	if (!empty($_FILES['file']['name'])){    
        
        $imagename=date("d-m-Y")."-".time();
        //$fileinfo = pathinfo($_FILES['file']['name']);
        //$extension = $fileinfo['extension'];

        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        //if($ext ==='gif' || $ext ==='jpg' || $ext ==='png' || $ext ==='jpeg')
        //{
            $config = array(
            'upload_path'   => './uploads/Videos/',
            'allowed_types' => 'mp4|jpeg|jpg',
            'max_size' => "2048", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'file_name'     =>$imagename //"post_images!".$imagename
             );        

            $this->load->library('upload');
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('file'))
            {
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors() ;
            die("file");
            }
            else
            {
            $imageDetailArray = $this->upload->data();
            $fileName = "uploads/Videos/".$imagename. '.' .$ext; // $imageDetailArray['file_name'];
            }
        }
        //}
       // else 
       // {
       // $file='';
        //}

	$image=array(
	
	//'insert_by_id'=>$_SESSION['user_id'],
	'video_url'=>$fileName,
        //'images_id'=>$last_id_assign,
	//'new_entry_id'=>$last_id
			
	);
	
	$this->db->insert('video_tbl',$image);
                
                //$queriesdata = array(

                //'user_id'=> $u_id,
                //'user_ques'=> $video
               //  );
  
                 //$this->db->insert('video_tbl',$queriesdata);
                 
                //$user_last_id =$this->db->insert_id();
                
                //$userData = array();
                //$userData = $query->result_array();
                
				
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Video Uploaded',
					//'data' => $userData
                ], REST_Controller::HTTP_OK);
                
            //}
           // else{
                
               // $this->response([
               //     'status' => TRUE, 
              //      'message' => 'Already 3 Questions Asked'
                    //'data' => $userData2
             //   ], REST_Controller::HTTP_OK);
           // }
        }else{
            
                $this->response([
                    'status' => FALSE,
                    'message' => 'Required parameters are not available.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            //$this->response("Required parameters are not available.", REST_Controller::HTTP_BAD_REQUEST);
        }
           
    }
}
