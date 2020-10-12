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
	
public function get_state()
{
    $sql="SELECT DISTINCT state from state_city_list";
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

}
?>