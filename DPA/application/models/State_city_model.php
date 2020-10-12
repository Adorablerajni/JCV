<?php defined('BASEPATH') OR exit('No direct script access allowed');
class State_city_model  extends CI_Model {

	function __construct() {
		
	}
	
	
public function  state_city()
{
	$sql="SELECT * FROM state_city_list";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['statecity']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}	
public function  state_city_list()
{
	$sql="SELECT state_city_list.id as city_id ,state_list.*, state_city_list.* FROM state_city_list join state_list on state_city_list.state_code = state_list.state_code";
	
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['statecity']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}	

	
public function get_state()
{
    $sql="SELECT * from state_list";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['statelist']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function get_state_byid($id ='')
{
    $sql="SELECT * from state_list where id=".$id."";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['state_byid']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}
public function get_city_as_per_state($state_code ='')
{
  
	$this->db->select();
    $this->db->from('state_city_list');
    $this->db->where("state_code", $state_code); 
      
    $query = $this->db->get();
   
    
    $count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['city_bystatecode']=$query->result_array();
	  
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}
public function state_city_list_by_id($state_city_list_id =''){
	$this->db->select('*');
    $this->db->from('state_city_list');
    $this->db->where("state_city_list.id",$state_city_list_id);      
    $query = $this->db->get();
  	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['city_state_by_id']=$query->result_array();
	  
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   

}

public function head_office_city($head_office_city =''){
	$this->db->select('state_city_list.city');
    $this->db->from('state_city_list');
    $this->db->where("state_city_list.id",$head_office_city);      
    $query = $this->db->get();
  	$city_of_head_office = $query->row();
	return $city_of_head_office;

}
public function get_transporter_cities($transporter_id =''){
	$this->db->select('state_city_list.city,transport_charges.transport_city as t_city, transport_charges.id as tc_id');
    $this->db->from('transport_charges');
    $this->db->join('state_city_list','transport_charges.transport_city=state_city_list.id');
    $this->db->where("transport_charges.transport_id",$transporter_id);      
    $query = $this->db->get();
  	// echo $this->db->last_query();
  	$all_cities = $query->result_array();	
  	// print_r($all_cities);
	return $all_cities;
}



}
?>