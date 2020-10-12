<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model  extends CI_Model {

	function __construct() {
		
	}

public function get_product_list()
{
    $sql="SELECT * FROM product_tbl";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['productlist']=$query->result_array();
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