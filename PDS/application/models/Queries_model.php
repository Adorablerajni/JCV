<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Queries_model  extends CI_Model {

	function __construct() {
		
	}
	
	public function get_queries(){
		///$this->db->select('*');
		//$query = $this->db->get('user_queries');
		$sql = "select user_queries.*,users_tbl.u_name,users_tbl.u_dob,users_tbl.u_birth_place,users_tbl.u_birth_time from user_queries INNER JOIN users_tbl ON users_tbl.u_unique_id = user_queries.user_id order by userque_id desc";
		$query = $this->db->query($sql);
		
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_queries'] = $query->result_array();
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
	public function delete_question($question_id){
		
		$response = $this->db->delete('questions', array('question_id'=>$question_id));
		
		if ($response) {
			return true;
		}
		else{
			return false;
		}
	}
	
		public function get_question_responses(){
		//$this->db->select('*');
		$sql = "select qa_details.*,users_tbl.u_name,questions.question from qa_details INNER JOIN users_tbl ON users_tbl.u_unique_id = qa_details.user_id INNER JOIN questions ON questions.question_id=qa_details.qa_question_id order by qa_id desc";
		$query = $this->db->query($sql);
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_question_responses'] = $query->result_array();
			return $data;
		}else{
			return false;
		}

	}
	
	public function get_token($query_id){
		//$this->db->select('*');
		$sql = "select user_queries.*,users_tbl.u_name,users_tbl.usr_token from user_queries INNER JOIN users_tbl ON users_tbl.u_unique_id = user_queries.user_id where userque_id = '".$query_id."'";
		$query = $this->db->query($sql);
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_token'] = $query->result_array();
			return $data;
		}else{
			return false;
		}
	}
}