<?php defined('BASEPATH') OR exit('No direct script access allowed');
class UserPanel_model  extends CI_Model {

	function __construct() {
		
	}
	public function register_user($user_data = array()){
		$this->db->insert('users_tbl',$user_data);
		$last_id = $this->db->insert_id();
		if ($last_id) {
			return true;
		}else{
			return false;
		}

	}
	public function check_email($email){
		$this->db->select('*');
		$this->db->where('user_email',$email);		
		$query = $this->db->get('users');
		//echo $this->db->last_query();
		$row = $query->num_rows();
		if ($row >= 1) {
			return true;
		}else{
			return false;
		}
	    
		

	}
	public function check_phone($phone){
		$this->db->select('*');
		$this->db->where('user_phone',$phone);
		$query = $this->db->get('users');
		$row = $query->num_rows();
		if ($row >= 1) {
			return true;
		}else{
			return false;
		}
	}
	public function check_login($email,$password){
		$this->db->select('*');
		$this->db->where('u_email',$email);
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
	
	public function user_details(){
		$this->db->select('*');
		$this->db->where('u_id',$_SESSION['userid']);
		$query = $this->db->get('users_tbl');
		
		$row = $query->num_rows();
	    //echo	$this->db->last_query();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_user_details'] = $query->result_array();
			return $data;
		}else{
			return false;
		}

	}
	
	public function article_post(){
		//$this->db->select('*');
		//$query = "select * from admin_posts";
		//$this->db->where('id',$_SESSION['userid']);
		$sql="SELECT * FROM admin_posts";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		//$row = $query->num_rows();
		if ($count >= 1) {
			$data['flag'] = 1;
			$data['get_article_data'] = $query->result_array();
			//print_r($data['get_article_data']);
			//die();
			return $data;
		}else{
			return false;
		}

	}


}

?>