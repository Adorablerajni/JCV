<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Post_model  extends CI_Model {

	function __construct() {
		
	}
	public function add_post($post_data =array()){		
		$response = $this->db->insert('admin_posts',$post_data);
		$last_id = $this->db->insert_id();
		if ($last_id) {
			return true;
		}
		else{
			return false;
		}


	}
	
	public function get_posts(){
		$this->db->select('*');
		$query = $this->db->get('admin_posts');
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_post'] = $query->result_array();
			return $data;
		}else{
			return false;
		}

	}
	public function get_question_by_id($question_id){
		$this->db->select('*');
		$this->db->where('question_id',$question_id);
		$query = $this->db->get('questions');
		//echo $this->db->last_query();
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['question'] = $query->result_array();
			//print_r($data['youtube_link']);
			return $data;
		}else{
			return false;
		}



	}
	public function edit_question($question_data,$question_id){
	
		$response = $this->db->update('questions',$question_data,array('question_id'=>$question_id));

		if ($response) {
			return true;
		}
		else{
			return false;
		}


	}
	public function delete_post($post_id){
		
		$response = $this->db->delete('admin_posts', array('id'=>$post_id));
		
		if ($response) {
			return true;
		}
		else{
			return false;
		}


	}
	
	public function edit_post($post_data,$post_id){
	
		$response = $this->db->update('admin_posts',$post_data,array('id'=>$post_id));

		if ($response) {
			return true;
		}
		else{
			return false;
		}


	}
	
	public function get_post_by_id($post_id){
		$this->db->select('*');
		$this->db->where('id',$post_id);
		$query = $this->db->get('admin_posts');
		//echo $this->db->last_query();
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['post'] = $query->result_array();
			//print_r($data['youtube_link']);
			return $data;
		}else{
			return false;
		}
    }
	
	
	
	public function get_polls_responses(){
		//$this->db->select('*');
		$sql = "select user_polls_responses.*,users_tbl.u_name  from user_polls_responses INNER JOIN users_tbl ON users_tbl.u_unique_id = user_polls_responses.user_id";
		$query = $this->db->query($sql);
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_poll_response'] = $query->result_array();
			return $data;
		}else{
			return false;
		}

	}
}