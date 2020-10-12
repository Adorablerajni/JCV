<?php //defined('BASEPATH') OR exit('No direct script access allowed');
class User_model  extends CI_Model {

	function __construct() {
		
	}
	public function register_user($user_data = array()){
		$this->db->insert('users_tbl',$user_data);
		$last_id = $this->db->insert_id();
		if ($last_id) {
			return $last_id;
		}else{
			return false;
		}

	}
	public function check_email($email){
		$this->db->select('*');
		$this->db->where('u_email',$email);		
		$query = $this->db->get('users_tbl');
		//echo $this->db->last_query();
		$row = $query->num_rows();
		if ($row >= 1) {
			return true;
		}else{
			return false;
		}
	    
		

	}
	public function check_email_token($email,$email_token){
		$this->db->select('*');
		$this->db->where('u_email',$email);		
		$this->db->where('email_token',$email_token);		
		$query = $this->db->get('users_tbl');
		//echo $this->db->last_query();
		$row = $query->num_rows();
		if ($row >= 1) {
			return true;
		}else{
			return false;
		}
	    
		

	}
	public function check_email_user($email){
		$this->db->select('*');
		$this->db->where('u_email',$email);		
		$query = $this->db->get('users_tbl');
	//	echo $this->db->last_query();
		$row = $query->num_rows();
		if ($row >= 1) {
		    $data['flag'] =1;
		    $data['user'] = $query->row_array();
			return $data;
		}else{
			 $data['flag'] =0;
			 return $data;
		}
	    
		

	}
	public function check_phone($phone){
		$this->db->select('*');
		$this->db->where('u_mobile',$phone);
		$query = $this->db->get('users_tbl');
		$row = $query->num_rows();
		if ($row >= 1) {
			return true;
		}else{
			return false;
		}
	}
	public function check_login2($email,$password){
		$this->db->select('*');
		$this->db->where('u_email',$email);
		$this->db->where('u_passwrd',$password);
		$query = $this->db->get('users_tbl');
		$user = $query->row();
		// echo "<pre>"; print_r($user);echo "<pre>";
		
		if ($user) {
			$logindata = [
	             'userid' => $user->u_id,
	             'user_role' => $user->u_role,
	             'name'   => $user->u_name,
	             'email'   => $user->u_email,
	             'phone'  => $user->u_mobile
	         ];
	          $this->session->set_userdata($logindata);
			return true;
		}else{
			return false;
		}
	}
	
	public function check_login($email,$password){
		$this->db->select('*');
		$this->db->where("(users_tbl.u_email = '$email' OR users_tbl.u_mobile= '$email')");
		$this->db->where('u_passwrd',$password);
		$query = $this->db->get('users_tbl');
		$user = $query->row();
		// echo "<pre>"; print_r($user);echo "<pre>";
		if ($user) {
			$logindata = [
	             'userid' => $user->u_id,
	             'user_role' => $user->u_role,
	             'name'   => $user->u_name,
	             'email'   => $user->u_email,
	             'phone'  => $user->u_mobile
	         ];
	          $this->session->set_userdata($logindata);
			return true;
		}else{
			return false;
		}
	}
	
	public function users_list(){
		$this->db->select('*');
		$query = $this->db->get('users_tbl');
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_users'] = $query->result_array();
			return $data;
		}else{
			return false;
		}

	}
	
	public function quotes() {
	    $article_fetch_sql = "SELECT  * FROM `admin_posts` WHERE `post_type` = 'Quote'";
	    $query =  $this->db->query($article_fetch_sql);
	    $count = $query->num_rows();
	    if($count >= 1) {
	        $data['flag'] = 1;
	        $data['quotes'] = $query->result_array();
	        return ($data);
	    }
	    else {
	         $data['flag'] = 0;
	         return ($data);
	    }
	}
	
	public function articles() {
	    $article_fetch_sql = "SELECT  * FROM `admin_posts` WHERE `post_type` = 'Article'";
	    $query =  $this->db->query($article_fetch_sql);
	    $count = $query->num_rows();
	    if($count >= 1) {
	        $data['flag'] = 1;
	        $data['articles'] = $query->result_array();
	        return ($data);
	    }
	    else {
	         $data['flag'] = 0;
	         return ($data);
	    }
	}
	
	public function pole_questions() {
	    $pole_fetch_sql = "SELECT  * FROM `user_polls` WHERE `poll_status` = 'Active'";
	    $query =  $this->db->query($pole_fetch_sql);
	    $count = $query->num_rows();
	    if($count >= 1) {
	        $data['flag'] = 1;
	        $data['poles'] = $query->result_array();
	        return ($data);
	    }
	    else {
	         $data['flag'] = 0;
	         return ($data);
	    }
	}
	
    public function check_poles($userid) {
        $sql = "SELECT * FROM `users_tbl` WHERE `u_id`=".$userid; 
        $query =  $this->db->query($sql);
	    $count = $query->num_rows();
	    if($count >= 1) { 
	        $data['pole_flag'] = 1;
	        $data['poles'] = $query->row();
	        return ($data);
	    }
	    else {
	         $data['pole_flag'] = 0;
	         return ($data);
	    }
        
    }
    public function get_user_uniqueid($userid) {
        $sql = "SELECT * FROM `users_tbl` WHERE `u_id`=".$userid; 
        $query =  $this->db->query($sql);
	    $count = $query->num_rows();
	    if($count >= 1) { 
	        return $query->row()->u_unique_id;
	       
	    }
	    else {
	         
	         return false;
	    }
        
    }
    public function check_poles_response($u_userid) {
        $sql = "SELECT * FROM `user_polls_responses` WHERE `user_id`='".$u_userid."'"; 
        //echo $sql;
        $query =  $this->db->query($sql);
	    $count = $query->num_rows();
	    //echo $count;
	    if($count == 1) { 
	        return true;
	    }
	    else {
	         return false;
	    }
        
    }  
    
    public function save_poll_response() { 
        $user_data =  $this->check_poles($_POST['user_id']);
        $option_column_name = $_POST['poll_option'];
     
        if($option_column_name == "poll_option1") {
            $another_option ='poll_option2';
        } else { 
            $another_option ='poll_option1';
        }
            $new_user_polls = array (
               "poll_question_id" =>  $_POST['question_id'],
               "$option_column_name" => 1,
               "$another_option" => 0,
               "user_id" => $user_data['poles']->u_unique_id
               );
               $result = $this->db->insert('user_polls_responses',$new_user_polls);
                if($result) {
                    return true;
                } else {
                    return false;
                }
        
    }
	
	public function  our_all_question() {
	     $sql = "SELECT * FROM `questions` "; 
        //echo $sql;
        $query =  $this->db->query($sql);
	    $count = $query->num_rows();
	    //echo $count;
	    if($count >= 1) {
	        $data['q_flag'] = 1;
	        $data['questions'] = $query->result_array();
	        return ($data);
	    }
	    else {
	         $data['q_flag'] = 0;
	         return ($data);
	    }
	}
	
	
	/* check qa details and add the question */
	public function check_our_qa() {
	    $u_id =$_POST['user_id'];
	     $u_uniqueid =  $this->get_user_uniqueid($u_id);
	     $sql = "SELECT * FROM `qa_details` WHERE `user_id`='".$u_uniqueid."'"; 
        
        $query =  $this->db->query($sql);
	    $count = $query->num_rows();
	    $check_records_sql = "SELECT * FROM `user_queries` WHERE `user_id`='".$u_uniqueid."'"; 
	
	    $query_question =  $this->db->query($check_records_sql);
	    $count_question = $query_question->num_rows();

	    if($count >= 4) {
	        $data['status'] = 1;
	        $data['message'] = "Your question Saved!";
	        $data_array = array(
	            'user_ques' => $_POST['user_question'], 
	            'user_id' => $u_uniqueid
	            );
	            if($count_question >= 3 ) {
	                $this->session->set_flashdata('error', "Already 3 Questions Asked!");
	            }
	            else {
	                $result = $this->db->insert('user_queries',$data_array);
	                if($result) {
        	           $this->session->set_flashdata('success', "Your question Saved!");
        	            return ($data);
        	       }
	                
	            }
	   }
	    else {
	        $this->session->set_flashdata('error', "Please Answer हमारे प्रश्न section to ask a question!");
	        $data['status'] = 0;
	        $data['message'] = "Please Answer हमारे प्रश्न section to ask a question!"   ;
	        return ($data);
	    } 
	}
	
	public function get_your_question() {
	    $u_id =$_SESSION['userid'];
	    $u_uniqueid =  $this->get_user_uniqueid($u_id);
	    $check_records_sql = "SELECT * FROM `user_queries` WHERE `user_id`='".$u_uniqueid."'"; 
	
	    $query_question =  $this->db->query($check_records_sql);
	    $count_question = $query_question->num_rows();
	    
	    if($count_question >= 1) {
	        $data['flag'] = 1;
	        $data['ques_with_ans'] = $query_question->result_array();
	        return ($data);
	    }else {
	        $data['flag']=0;
	        return ($data);
	    }
	    
	    
	}
	
	public function save_our_answer() {
	    $u_id =$_POST['user_id'];
	     $u_uniqueid =  $this->get_user_uniqueid($u_id);
	     $sql = "SELECT * FROM `qa_details` WHERE `user_id`='".$u_uniqueid."'"; 
       // echo $sql;
        $query =  $this->db->query($sql);
	    $count = $query->num_rows();
	    //echo $count;
	    if($count >= 1) {
	        $this->session->set_flashdata('error', "Already Answered our question");
	    }else {
	       $data = array();
	       $user_profile =  array();
    	    $data['user_id'] =$u_uniqueid;
    	    $result= 0;
            for ($x = 0; $x < count($_POST['question_id']); $x++) {
                 $data['qa_question_id'] = $_POST['question_id'][$x];
                if( $_POST['question_id'][$x] == 1) {
                    $user_profile['u_dob'] = $_POST['answers'][$x];
                }
                if( $_POST['question_id'][$x] == 2) {
                    $user_profile['u_birth_place'] = $_POST['answers'][$x];
                }
                if( $_POST['question_id'][$x] == 3) {
                    $user_profile['u_birth_time'] = $_POST['answers'][$x];
                }
                 $data['qa_answer'] = $_POST['answers'][$x];
                 $result = $this->db->insert('qa_details',$data);
            }
            $response = $this->db->update('users_tbl',$user_profile,array('u_unique_id'=>$u_uniqueid));
            if($result) {
                $this->session->set_flashdata('success', "Your Answer Saved Successfully!");
                return true;
            } 
	    }
	    
	  
	  
	  
	  }
	  
	  
	public function pole_response_percent() 
	{
	   $all_response_sql ="SELECT SUM(poll_option1) AS pollone_total, SUM(poll_option2) AS polltwo_total FROM user_polls_responses WHERE poll_question_id = 2";
       
        $all_query =  $this->db->query($all_response_sql);
      
        $total_count = $all_query->num_rows();
        $userData = $all_query->result_array();
        $count_yes = $userData[0]['pollone_total']; 
        $count_no = $userData[0]['polltwo_total']; 
        $total = $count_yes + $count_no;
        $data['yes']  = round($count_yes/$total *100);
        $data['no']  = round($count_no/$total *100);
        // print_r(round($count_yes/$total *100));
        // print_r(round($count_no/$total *100));
        return $data;
        
	}
	
	public function get_user_answers($q_id) {
	    $unique_id =$this->get_user_uniqueid($_SESSION['userid']);
	    $sql = "SELECT qa_details.qa_id, qa_details.`qa_question_id`, qa_details.user_id, questions.question, qa_details.qa_answer, qa_details.qa_attachments, qa_details.creation_date  FROM `qa_details` RIGHT JOIN questions ON questions.question_id = qa_details.qa_question_id where qa_details.user_id = '".$unique_id."' and qa_details.`qa_question_id` = '".$q_id."'";
	    $query =  $this->db->query($sql);
	    $count = $query->num_rows();
	    if($count >= 1) {
	        $data['flag'] = 1;
	        $data['user_answer'] = $query->row_array()['qa_answer'] ;
	        return ($data);
	    }
	    else {
	         $data['flag'] = 0;
	         return ($data);
	    }
	}
    
    public function save_new_pass() {
        $current_password = $this->input->post('current_password');
    	$new_password = $this->input->post('new_password');
    
    	
    	$user_id = $this->input->post('user_id');
        $this->db->select('u_passwrd');
		$this->db->where('u_id',$user_id);
		$query = $this->db->get('users_tbl');
		//echo $this->db->last_query();
		$user = $query->row();
// 		echo "<pre>";
// 		print_r($user->u_passwrd);
// 		echo "</pre>";
        $user_profile = array(
                'u_passwrd' =>$new_password
            );
        if( $user->u_passwrd == $current_password ) {
            $reault = $this->db->update('users_tbl',$user_profile,array('u_id'=>$user_id));
            if($reault) {
                $this->session->set_flashdata('success', "Your Password Changed Successfully!");
                return true;
            }
        }else {
             $this->session->set_flashdata('error', "Please Enter Current password Correct!");
             return false;
        }
    }

}

?>