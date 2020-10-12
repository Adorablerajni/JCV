<?php defined('BASEPATH') OR exit('No direct script access allowed');
class party_model  extends CI_Model {

	function __construct() {
		
	}

public function  get_party_list()
{
	$sql="SELECT * FROM parties_list";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['partylist']=$query->result_array();
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