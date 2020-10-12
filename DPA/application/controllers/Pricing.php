<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {
function __construct(){
  parent::__construct();
       $this->load->library('session');
       //$this->load->library('lib_log');
       $this->load->model('Pricing_model');
       $this->load->model('Party_model');
       $this->load->model('Masters_model');
       $this->load->model('Purchase_model');
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

	public function creditslab_list()
	{
		$data['creditslab_list']=$this->Purchase_model->get_credit_slabs();
		  //print_r($data['purchase_rate']);
		 //die();
		$this->load->view('creditslab_list',$data);
	}
	
	public function add_credit_slab()
	{
	   
	  $this->form_validation->set_rules('payment_type','payment_type','required');
	  $this->form_validation->set_rules('days', 'days', 'required');
	  $this->form_validation->set_rules('operator', 'operator', 'required');
	  $this->form_validation->set_rules('slab', 'slab', 'required');
	  
		if($this->form_validation->run() == true)
	     {
		    $payment_type =$this->input->post('payment_type');
		    $days =$this->input->post('days');
		    $operator =$this->input->post('operator');
		    $slab =$this->input->post('slab');
		    
			$credit_list=array(
			                 'credit_payment_title'=>$payment_type,
							 'no_of_days'=>$days,
							 'plus_minus'=>$operator,
							 'credit_percentage'=>$slab,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('credit_structure_slab',$credit_list);
			redirect('Purchase/creditslab_list');
		 }
		 $this->load->view('add_credit_slab');
	}
	
	public function marginslab_list()
	{
		$data['marginslab_list']=$this->Pricing_model->get_margin_slabs();
		  //print_r($data['purchase_rate']);
		 //die();
		$this->load->view('margin_slabs_list',$data);
	}
	
	public function delete_marginslab($marginslab_id='')
{
	      
           $this->db->delete('brand_margin_slab', array('id'=>$marginslab_id));
		   redirect ('Pricing/brand_margin_slab_list');

}
	
	//===========================================================================================
	

	public function city_state_slab_list()
	{
		$data['get_citystate_slab']=$this->Pricing_model->get_citystate_slab();
		 //  print_r($data['get_citystate_slab']);
		 // die();
		$this->load->view('city_state_slab',$data);
	}
	
    public function add_citystate_slab()
	{
	   
	  $this->form_validation->set_rules('product','product','required');
	  $this->form_validation->set_rules('state', 'state', 'required');
	  $this->form_validation->set_rules('city', 'city', 'required');
	  $this->form_validation->set_rules('discount', 'discount', 'required');
	  
		if($this->form_validation->run() == true)
	     {
		    $product =$this->input->post('product');
		    $state =$this->input->post('state');
		    $city =$this->input->post('city');
		    $discount =$this->input->post('discount');
		    
			$citystate_list=array(
			                 'pro_id'=>$product,
							 'state_slab'=>$state,
							 'city_slab'=>$city,
							 'discount'=>$discount,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			$this->session->set_flashdata('message', 'Data Inserted Successfully');
            $this->db->insert('city_state_slab',$citystate_list);
			redirect('Pricing/city_state_slab_list');
		 }
		 $this->load->view('add_citystate_slab');
	}

	
	public function delete_citystate_slab($citystate_slab_id='')
{
	      
           $this->db->delete('city_state_slab', array('id'=>$citystate_slab_id));
		   redirect ('Pricing/city_state_slab_list');

}
public function edit_creditslab($credit_slab='')
{
	   
	  $this->form_validation->set_rules('payment_type','payment_type','required');
	  $this->form_validation->set_rules('days', 'days', 'required');
	  $this->form_validation->set_rules('operator', 'operator', 'required');
	  $this->form_validation->set_rules('slab', 'slab', 'required');
	  
		if($this->form_validation->run() == true)
	     {
		    $payment_type =$this->input->post('payment_type');
		    $days =$this->input->post('days');
		    $operator =$this->input->post('operator');
		    $slab =$this->input->post('slab');
		    
			$credit_list=array(
			                 'credit_payment_title'=>$payment_type,
							 'no_of_days'=>$days,
							 'plus_minus'=>$operator,
							 'credit_percentage'=>$slab,
							 
			);
			// echo $credit_slab;
			// die;
            $this->db->update('credit_structure_slab',$credit_list,array('id'=>$credit_slab));
			            
            //echo $this->db->last_query();die;
            
            $this->session->set_flashdata('message', 'Data Inserted Successfully');
			redirect('Pricing/creditslab_list');
		 }
		 $data['brand_slab_margin'] = $this->Pricing_model->get_credit_slab_by_id($credit_slab);
		 // print_r($data);
		 $this->load->view('edit_credit_slab',$data);
	}


	


public function delete_creditslab($creditslab_slab_id='')
{
	      
           $this->db->delete('credit_structure_slab', array('id'=>$creditslab_slab_id));
		   redirect ('Purchase/creditslab_list');

}
	
	//===========================================================================================
	
	public function brand_margin_slab_list()
	{
		$data['brandmargin']=$this->Pricing_model->get_brandmargin_slab();
		 //  print_r($data['purchase_rate']);
		 // die();
		$this->load->view('brandmargin_list',$data);
	}
	
	public function add_brand_margin_slab()
	{
	   
	  $this->form_validation->set_rules('product','product','required');
	  $this->form_validation->set_rules('quantity', 'quantity', 'required');
	  $this->form_validation->set_rules('discount', 'discount', 'required');
	  
		if($this->form_validation->run() == true)
	     {
		    $product =$this->input->post('product');
		    $quantity =$this->input->post('quantity');
		    $discount =$this->input->post('discount');
		    $brand_margin =$this->input->post('brand_margin');
		    
			$brandmargin_list=array(
			                 'prod_id'=>$product,
							 'quantity'=>$quantity,
							 'discount'=>$discount,
							 'user_id'=>$_SESSION['MM_User_Id'],
			);
			
            $this->db->insert('brand_margin_slab',$brandmargin_list);
            
            $UpdateBrandData = array(
			      'brand_margin'=>$brand_margin,
			 );
             
            $this->db->update('data_product',$UpdateBrandData,array('data_product_id'=>$product));
            
            $this->session->set_flashdata('message', 'Data Inserted Successfully');
			redirect('Pricing/brand_margin_slab_list');
		 }
		 $this->load->view('add_brandmargin_slab');
	}
	public function edit_brand_margin_slab($brand_slab_margin_id='')
	{
	   
	  $this->form_validation->set_rules('product','product','required');
	  $this->form_validation->set_rules('quantity', 'quantity', 'required');
	  $this->form_validation->set_rules('discount', 'discount', 'required');
	  
		if($this->form_validation->run() == true)
	     {
		    $product =$this->input->post('product');
		    $quantity =$this->input->post('quantity');
		    $discount =$this->input->post('discount');
		    $brand_margin =$this->input->post('brand_margin');
		    
		    $brandmargin_list=array(			                 
							 'quantity'=>$quantity,
							 'discount'=>$discount,
							 
			);
			echo $brand_slab_margin_id;
            $this->db->update('brand_margin_slab',$brandmargin_list,array('prod_id'=>$product));
			            
            $UpdateBrandData = array(
			      'brand_margin'=>$brand_margin,
			 );
             
            $this->db->update('product_specification_tbl',$UpdateBrandData,array('id'=>$product));
            
            $this->session->set_flashdata('message', 'Data Inserted Successfully');
			redirect('Pricing/brand_margin_slab_list');
		 }
		 $data['brand_slab_margin'] = $this->Pricing_model->get_brand_margin_slab_by_id($brand_slab_margin_id);
		 // print_r($data);
		 $this->load->view('edit_brand_margin_slab',$data);
	}	public function edit_citystate_slab($city_state_slab_id)
	{
	
	 $this->form_validation->set_rules('state', 'State', 'required');
        
     if($this->form_validation->run() == true)
	 {
		
     	  $state =$this->input->post('state');
		  $city =$this->input->post('city');
		  $discount =$this->input->post('discount');
		 
		 
			  
			  
			$city_state_slab_data =array(
			                 'state_slab'=>$state,
							 'city_slab'=>$city,
							 'discount'=>$discount,
							 
							
			);
				 /* print_r($city_state_slab_id);
				 die();
	*/
		 $this->db->update('city_state_slab',$city_state_slab_data ,array('pro_id'=>$city_state_slab_id ));
		 //echo $this->db->last_query();die;

	     redirect ('Pricing/city_state_slab_list');
	 }
	 
	
	 $data['citystate_slab'] = $this->Pricing_model->get_citystate_slab_by_id($city_state_slab_id);
      $this->load->view('edit_city_state_slab',$data);
}	

	



// 	public function delete_citystate_slab($citystate_slab_id='')
// {
	      
//            $this->db->delete('city_state_slab', array('id'=>$citystate_slab_id));
// 		   redirect ('Pricing/city_state_slab_list');

// }
	//===========================================================================================
	
	/*
	
	
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