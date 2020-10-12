<?php defined('BASEPATH') OR exit('No direct script access allowed');
class YouTube_model  extends CI_Model {

	function __construct() {
		
	}
	public function add_url($url_data =array()){
		$order_level = $this->get_number_of_urls();
		$url_data['order_level'] = $order_level+1;
		$response = $this->db->insert('youtube_links',$url_data);
		$last_id = $this->db->insert_id();
		if ($last_id) {
			return true;
		}
		else{
			return false;
		}


	}
	public function get_number_of_urls(){
		$this->db->select('*');
		$query = $this->db->get('youtube_links');
		$row = $query->num_rows();
		if ($row >= 1) {
			return $row;
		}else{
			return false;
		}

	}
	public function get_urls(){
		$this->db->select('*');
		$query = $this->db->get('youtube_links');
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['youtube_links'] = $query->result_array();
			return $data;
		}else{
			return false;
		}

	}
	public function get_url_by_id($link_id){
		$this->db->select('*');
		$this->db->where('youtube_id',$link_id);
		$query = $this->db->get('youtube_links');
		//echo $this->db->last_query();
		$row = $query->num_rows();
		if ($row >= 1) {
			$data['flag'] = 1;
			$data['youtube_link'] = $query->result_array();
			//print_r($data['youtube_link']);
			return $data;
		}else{
			return false;
		}



	}
	public function edit_url($youtube_data,$link_id){
	
		$response = $this->db->update('youtube_links',$youtube_data,array('youtube_id'=>$link_id));

		if ($response) {
			return true;
		}
		else{
			return false;
		}


	}
	public function delete_url($link_id){
		
		$response = $this->db->delete('youtube_links', array('youtube_id'=>$link_id));
		
		if ($response) {
			return true;
		}
		else{
			return false;
		}


	}
}