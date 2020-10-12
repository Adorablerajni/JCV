<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_slabs extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('discount_slabs_model');
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
	public function discount_slabs_list()
	{
		 $data['discount_list']=$this->discount_slabs_model->get_discount_slabs();
		 // print_r($data['discount_list']);
		 // die();
		$this->load->view('discount_slabs_list',$data);
	}
	
	public function add_discount_slabs()
	{
		$this->form_validation->set_rules('discount_name','discount_name','required');
	    $this->form_validation->set_rules('start_date', 'start_date', 'required');
		$this->form_validation->set_rules('end_date','end_date','required');
		$this->form_validation->set_rules('state','state','required');
	    $this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('discount_rate', 'discount_rate', 'required');
		if($this->form_validation->run() == true)
	    {
			  $discount_name =$this->input->post('discount_name');
			  $start_date =$this->input->post('start_date');
			  $end_date =$this->input->post('end_date');
			  $state =$this->input->post('state');
			  $city =$this->input->post('city');
			  $discount_rate=$this->input->post('discount_rate');
			  
			  $discount_data=array(
			                      'discount_name'=>$discount_name,
								  'start_date'=>$start_date,
								  'End_date'=>$end_date,
								  'state'=>$state,
								  'city'=>$city,
								  'discount_rate'=>$discount_rate,
			  );
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('discount_slab',$discount_data);
			redirect('Discount_slabs/discount_slabs_list');
		}
		$this->load->view('add_discount_slab');
	}
	
}
