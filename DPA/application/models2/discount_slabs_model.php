<?php defined('BASEPATH') OR exit('No direct script access allowed');
class discount_slabs_model  extends CI_Model {

	function __construct() {
		
	}
	
public function get_discount_slabs()
{
	$sql="SELECT * FROM discount_slab";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['discount_list']=$query->result_array();
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