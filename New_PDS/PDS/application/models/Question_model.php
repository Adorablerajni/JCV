<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Question_model  extends CI_Model {

	function __construct() {
		
	}
	public function add_question($question_data =array()){		
		$response = $this->db->insert('questions',$question_data);
		$last_id = $this->db->insert_id();
		if ($last_id) {
			return true;
		}
		else{
			return false;
		}


	}
	
	public function get_questions(){
		$this->db->select('*');
		$query = $this->db->get('questions');
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['get_question'] = $query->result_array();
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
}