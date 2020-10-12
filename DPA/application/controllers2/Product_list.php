<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_list extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('product_model');
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
	public function product_list()
	{
		$data['productlist']=$this->product_model->get_product_list();
		 // print_r($data['productlist']);
		// die();
		$this->load->view('product_list',$data);
	}
	
	public function add_product()
	{
		$this->form_validation->set_rules('product_name','product_name','required');
	    $this->form_validation->set_rules('product_code', 'product_code', 'required');
		$this->form_validation->set_rules('packing','packing','required');
		$this->form_validation->set_rules('division','division','required');
	    $this->form_validation->set_rules('composition', 'composition', 'required');
		$this->form_validation->set_rules('MRP', 'MRP', 'required');
		$this->form_validation->set_rules('GST','GST','required');
		$this->form_validation->set_rules('case','case','required');
	    $this->form_validation->set_rules('final_pricing', 'final_pricing', 'required');
		if($this->form_validation->run() == true)
	    {
			  $product_name =$this->input->post('product_name');
			  $product_code =$this->input->post('product_code');
			  $packing =$this->input->post('packing');
			  $division =$this->input->post('division');
			  $composition =$this->input->post('composition');
			  $MRP =$this->input->post('MRP');
			  $GST =$this->input->post('GST');
			  $case =$this->input->post('case');
			  $final_pricing =$this->input->post('final_pricing');
			   $product_data=array(
			                 'name'=>$product_name,
							 'code'=>$product_code,
							 'packing'=>$packing,
							 'division'=>$division,
							 'composition'=>$composition,
							 'MRP'=>$MRP,
							 'gst'=>$GST,
							 'case'=>$case,
							 'final_pricing'=>$final_pricing,
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('product',$product_data);
			redirect('Product_list/product_list');
		}
		$this->load->view('add_product');
	}
	
}
