<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party_list extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('Party_model');
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
	public function party_list()
	{
		$data['partylist']=$this->Party_model->get_data_party_list();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('party_list',$data);
	}
	public function old_party_list()
	{
		$data['partylist']=$this->Party_model->get_party_list();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('old_party_list',$data);
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
			  $whatsapp_number =$this->input->post('whatsapp_number');
			  $alternate_number =$this->input->post('other_number');
			  $mobile_number =$this->input->post('mobile_number');
			  $landline_number =$this->input->post('landline_number');
			  $email_id =$this->input->post('email_id');
			  $address =$this->input->post('address');
			  $state =$this->input->post('state');
			  $city =$this->input->post('city');
			  $Gst_number =$this->input->post('Gst_number');
			  $transport =$this->input->post('transport');
			  $dl_no =$this->input->post('dl_no');
			  
			  $party_data=array(
			                 'name'=>$party_name,
							 'category'=>$party_category,
							 'code'=>$party_code,
							 'whatsapp_no'=>$whatsapp_number,
							 'other_no'=>$alternate_number,
							 'mobile'=>$mobile_number,
							 'landline_no'=>$landline_number,
							 'email'=>$email_id,
							 'address'=>$address,
							 'state'=>$state,
							 'city'=>$city,
							 'gstno'=>$Gst_number,
							 'transport'=>$transport,
							 'dl_no'=>$dl_no,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('parties_list',$party_data);
			redirect('Party_list/party_list');
		 }
		 
		$this->load->view('add_party');
	}
	
	
}


?>