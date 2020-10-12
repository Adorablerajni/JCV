<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_list extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('State_city_model');
}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function state_city_list()
	{
		$data['statecity']=$this->State_city_model->state_city();
		// print_r($data['statecity']);
		 // die();
		$this->load->view('state_city_list',$data);
	}
	
	public function add_state_city()
	{
	  $this->form_validation->set_rules('city','city','required');
	  $this->form_validation->set_rules('state', 'state', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $city =$this->input->post('city');
			$id =$this->input->post('state');
			$tier_cat =$this->input->post('tier_cat');
			
			$state_byid =$this->State_city_model->get_state_byid($id);
			//print_r($state_byid);
			  $state = $state_byid['state_byid']['0']['state'];
			  $state_code = $state_byid['state_byid'][0]['state_code'];
			 //die();
			$state_city=array(
			                 'city'=>$city,
							 'state'=>$state,
							 'tier_cat'=>$tier_cat,
							 'state_code'=>$state_code,
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('state_city_list',$state_city);
			redirect('State_list/state_city_list');
		 }
		 $this->load->view('add_state_city');
	}
	public function edit_state_city($state_city_id ='')
	{
	  $this->form_validation->set_rules('city','city','required');
	  $this->form_validation->set_rules('state', 'state', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $city =$this->input->post('city');
			$id =$this->input->post('state');
			$tier_cat =$this->input->post('tier_cat');
			
			$state_byid =$this->State_city_model->get_state_byid($id);
			//print_r($state_byid);
			  $state = $state_byid['state_byid']['0']['state'];
			  $state_code = $state_byid['state_byid'][0]['state_code'];
			 //die();
			$state_city=array(
			                 'city'=>$city,
							 'state'=>$state,
							 'tier_cat'=>$tier_cat,
							 'state_code'=>$state_code,
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->update('state_city_list', $state_city ,array('id'=>$state_city_id));
			redirect('State_list/state_city_list');
		 }
		 $data['city_state_by_id'] = $this->State_city_model->state_city_list_by_id($state_city_id);
		 $this->load->view('edit_state_city' ,$data);
	}
	public function delete_state_city($state_city_id ='')
	{
	 	if(!empty($state_city_id))
	    {
    		$this->db->delete('state_city_list', array('id'=>$state_city_id));
		   redirect ('State_list/state_city_list');
    		
	    }
            
	}
		 
	
	
}
