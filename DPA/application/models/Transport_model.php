<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Transport_model  extends CI_Model {

	function __construct() {
		
	}

	function set_transport(){

	}

	function set_transport_charges(){
		//print_r($this->input->post());die;
		$transport_code = rand(0,10000);
		$name = $this->input->post('Name');
		$city = $this->input->post('city_name');
		$address =$this->input->post('address');
	    $contact_person =$this->input->post('contact_person');
	    $contact_number =$this->input->post('contact_number');
	    $whats_app =$this->input->post('Whats_app');
	    $landline_one =$this->input->post('landline_one');
	    $landline_two = $this->input->post('landline_two');
	    $landline_three = $this->input->post('landline_three');
	    $head_city_name = $this->input->post('head_city_name');
	    
		$transport_list =array(
		                 
						 'code'=>$transport_code,
						 'Name'=>$name,
						 'city'=>$city,
						 'address'=>$address ,
						 'contact_person'=>$contact_person,
						 'contact_number'=>$contact_number,
						 'whatsapp_number'=>$whats_app,
						 'landline_one'=>$landline_one,
						 'landline_two'=>$landline_two,
						 'landline_three'=>$landline_three,
						 'city_of_head_office'=>$head_city_name,
						 'user_id'=>$_SESSION['MM_User_Id'],
		);
		
		$this->db->insert('transports_tbl',$transport_list);
		$last_transport_id =$this->db->insert_id();
		$data = $this->input->post();
		$count = count($data['state']);
		if ($count >= 1 ) {
		 	for($i = 0; $i<$count; $i++){
            if (!isset($data['state'])) {
                $data['state'] = NULL;
            }if (!isset($data['transport_city'])) {
                $data['transport_city'] = NULL;
            }if (!isset($data['term'])) {
                $data['term'] = NULL;
            }if (!isset($data['rs_per_case'])) {
                $data['rs_per_case'] = NULL;
            }if (!isset($data['upto_15'])) {
                $data['upto_15'] = NULL;
            }if (!isset($data['upto_30'])) {
                $data['upto_30'] = NULL;
            }if (!isset($data['lr_charges'])) {
                $data['lr_charges'] = NULL;
            }if (!isset($data['add_charges'])) {
                $data['add_charges'] = NULL;
            }
            $entries[] = array(
                'transport_state'=>$data['state'][$i],
                'transport_city'=>$data['transport_city'][$i],
                'transport_term'=>$data['term'][$i],
                'rs_per_case'=>$data['rs_per_case'][$i],
                'rs_upto_15'=>$data['upto_15'][$i],
                'rs_upto_30'=>$data['upto_30'][$i],
                'lr_charges'=>$data['lr_charges'][$i],
                'add_charges'=>$data['add_charges'][$i],
                'user_id'=>$_SESSION['MM_User_Id'],
                'transport_id'=>$last_transport_id
                );
        }
        $this->db->insert_batch('transport_charges', $entries); 
        if($this->db->affected_rows() > 0)
            return true;

        else
            return false;
		}
	} 
		
	public function get_transport_by_id($transport_id='')
 {
	$sql="SELECT * FROM `transports_tbl` WHERE id ='".$transport_id."' ";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['transport_list'] =$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }public function get_transport_charges_by_id($transport_charges_id='')
 {
	$sql="SELECT * FROM `transport_charges` join  state_city_list on transport_charges.transport_city=state_city_list.id WHERE transport_charges.id ='".$transport_charges_id."' ";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['transport_charge'] =$query->result_array();
			// echo "<pre>";
			// print_r($data['transport_charges'] );die;
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }



}