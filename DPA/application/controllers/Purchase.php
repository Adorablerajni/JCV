<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('Purchase_model');
       $this->load->model('Party_model');
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
	public function purchase_list()
	{
		$data['purchase_rate']=$this->Purchase_model->get_purchase_rate();
		 //  print_r($data['purchase_rate']);
		 // die();
		$this->load->view('purchase_rate',$data);
	}
	
    public function edit_purchase_rate($p_id='')
	{
	    if(!empty($p_id))
	    {
    		$data['edit_purchase_rate'] = $this->Purchase_model->edit_purchase_rate($p_id);
    		$this->load->view('edit_purchase_rate', $data);
	    }
	    else
	    {
	        redirect ('Purchase/edit_purchase_rate');
	    }
	} /*18-05-2020*/
	public function delete_purchase_rate($p_id='')
	{
	    if(!empty($p_id))
	    {
    		$this->db->delete('data_product', array('data_product_id'=>$p_id));
		   redirect ('Purchase/purchase_list');
    		
	    }
	    
	}
	
	public function update_purchase_order()
	{
	    
	$this->form_validation->set_rules('product_name', 'product_name', 'required');
	$this->form_validation->set_rules('purchase_rate', 'purchase_rate', 'required');
	$this->form_validation->set_rules('hdnid', 'hdnid', 'required');
       //  echo  $hdnid = $this->input->post('hdnid');
       //  echo   $product_name = $this->input->post('product_name');
       //  echo   $purchase_rate = $this->input->post('purchase_rate');
       // die();
        
		if ($this->form_validation->run() == true){	
	    
		$freight_charges = $this->input->post('freight_charges');
        $purchase_rate = $this->input->post('purchase_rate');
        $additional_charges = $this->input->post('additional_charges');
        $additional_cost = $this->input->post('additional_cost');
        $hdnid = $this->input->post('hdnid');
		
            $UpdateOrderData = array(
			      'freight_charges'=>$freight_charges,
			      'purchase_rate'=>$purchase_rate,
			      'additional_charges'=>$additional_charges,
			      'additional_cost'=>$additional_cost,
			 );
             
            $this->db->update('data_product',$UpdateOrderData,array('data_product_id'=>$hdnid));

			$this->session->set_flashdata('message', 'Purchase Rate Updated Successfully.');
			redirect ('Purchase/purchase_list');
			
        }
		else 
		{
		   // die();
				$this->session->set_flashdata('flash_message','Purchase Rate Not Updated. Please Try Again');
				redirect ('Purchase/purchase_list');
		}
	}
	
	
	public function creditslab_list()
	{
		$data['creditslab_list']=$this->Purchase_model->get_credit_slabs();
		  //print_r($data['purchase_rate']);
		 //die();
		$this->load->view('creditslab_list',$data);
	}
	
	
	/*
	public function add_company()
	{
	   // $city = "INDORE";
	   
	  $this->form_validation->set_rules('name','name','required');
	  //$this->form_validation->set_rules('code', 'code', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $company_name =$this->input->post('name');
		    $company_code = substr($company_name, 0, 3);
		    
			$company_list=array(
			                 'com_name'=>$company_name,
							 'com_code'=>$company_code,
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('company_tbl',$company_list);
			redirect('Masters/company_list');
		 }
		 $this->load->view('add_company');
	}
	
	public function product_list()
	{
		$data['productcode']=$this->Masters_model->get_product_code();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('product_list',$data);
	}
	
	public function add_product()
	{
	   
	  $this->form_validation->set_rules('company','company','required');
	  $this->form_validation->set_rules('name', 'name', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $com_id =$this->input->post('company');
		    $product_name =$this->input->post('name');
		    
			
			$company_byid =$this->Masters_model->get_company_byid($com_id);
			//print_r($state_byid);
			  $company_code = $company_byid['company_byid']['0']['com_code'];
			
			$data['comp_code'] = $this->Masters_model->get_comp_code($com_id);
	  $aj_no1 = $data['comp_code']['comp_code']['0']['maximum'];
	 
	  $six_digit = str_pad($aj_no1, 5, '0', STR_PAD_LEFT);
	 
	  $prod_code = $company_code." - ".$six_digit;
	// die();
			$product_list=array(
			                 'com_id'=>$com_id,
							 'prod_code'=>$prod_code,
							 'prod_name'=>$product_name,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('product_tbl',$product_list);
			redirect('Masters/product_list');
		 }
		 $this->load->view('add_product');
	}
	
	public function composition_list()
	{
		$data['composition_list']=$this->Masters_model->get_composition_list();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('composition_list',$data);
	}
	
	
	public function add_composition()
	{
	   
	  $this->form_validation->set_rules('short','short','required');
	  $this->form_validation->set_rules('dosage', 'dosage', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $short =$this->input->post('short');
		    $dosage =$this->input->post('dosage');
		    $indication =$this->input->post('indication');
		    $schedule =$this->input->post('schedule');
		    $narcotics =$this->input->post('narcotics');
		    $details =$this->input->post('details');
		    
			
			//$company_byid =$this->Masters_model->get_company_byid($com_id);
			//print_r($state_byid);
			 // $company_code = $company_byid['company_byid']['0']['com_code'];
			
			$data['composition_code'] = $this->Masters_model->get_composition_code();
	  $aj_no1 = $data['composition_code']['composition_code']['0']['maximum'];
	 
	  $six_digit = str_pad($aj_no1, 5, '0', STR_PAD_LEFT);
	 
	  $prod_code = "COMP"." - ".$six_digit;
	// die();
			$composition_list=array(
			                 'compo_code'=>$prod_code,
							 'compo_short'=>$short,
							 'compo_detail'=>$details,
							 'compo_dosage'=>$dosage,
							 'compo_indications'=>$indication,
							 'compo_schedule'=>$schedule,
							 'compo_narcotics'=>$narcotics,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('composition_tbl',$composition_list);
			redirect('Masters/composition_list');
		 }
		 $this->load->view('add_composition');
	}
	
	public function transport_list()
	{
		$data['transport_list']=$this->Masters_model->get_transport_list();
		 // print_r($data['partylist']);
		 // die();
		$this->load->view('transport_list',$data);
	}
	
	public function add_transport()
	{
	  $this->form_validation->set_rules('party_name','party_name','required');
	  //$this->form_validation->set_rules('code', 'code', 'required');
	  
	  
	  
		if($this->form_validation->run() == true)
	     {
		    $party_id =$this->input->post('party_name');
		    $party_city =$this->input->post('city');
		    $transport_pre =$this->input->post('transport_pre');
		    $door_godown =$this->input->post('door_godown');
		    $remark =$this->input->post('remark');
		    
		    
			$transport_list=array(
			                 'party_id'=>$party_id,
							 'party_city'=>$party_city,
							 'transport_pre'=>$transport_pre,
							 'door_godown'=>$door_godown,
							 'remark'=>$remark,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('transport_tbl',$transport_list);
			redirect('Masters/transport_list');
		 }
		 $this->load->view('add_transport');
	}
	*/
}


?>