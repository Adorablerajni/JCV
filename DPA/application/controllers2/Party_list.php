<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party_list extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('party_model');
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
	public function party_list()
	{
		$data['partylist']=$this->party_model->get_party_list();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('party_list',$data);
	}
	
	public function add_party()
	{
		$this->form_validation->set_rules('party_name','party_name','required');
	    $this->form_validation->set_rules('party_category', 'party_category', 'required');
		$this->form_validation->set_rules('party_code','party_code','required');
		$this->form_validation->set_rules('mobile_number','mobile_number','required');
	    $this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('state','state','required');
	    $this->form_validation->set_rules('city', 'city', 'required');
	    $this->form_validation->set_rules('Gst_number','Gst_number','required');
		if($this->form_validation->run() == true)
	     {
			  $party_name =$this->input->post('party_name');
			  $party_category =$this->input->post('party_category');
			  $party_code =$this->input->post('party_code');
			  $email_id =$this->input->post('email_id');
			  $mobile_number =$this->input->post('mobile_number');
			  $address =$this->input->post('address');
			  $state =$this->input->post('state');
			  $city =$this->input->post('city');
			  $Gst_number =$this->input->post('Gst_number');
			  
			  $party_data=array(
			                 'name'=>$party_name,
							 'category'=>$party_category,
							 'code'=>$party_code,
							 'email'=>$email_id,
							 'mobile'=>$mobile_number,
							 'address'=>$address,
							 'state'=>$state,
							 'city'=>$city,
							 'gstno'=>$Gst_number,
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('parties_list',$party_data);
			redirect('Party_list/party_list');
		 }
		$this->load->view('add_party');
	}
	
}


?>