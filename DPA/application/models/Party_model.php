<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Party_model  extends CI_Model {

	function __construct() {
		
	}

public function  get_data_party_list()
{
	$sql="SELECT * FROM data_party";
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
	
	
public function get_details_by_party($party_id='')
 {
	$sql="SELECT * FROM `data_party` WHERE data_party_id ='".$party_id."' ";
	//$sql="SELECT * FROM `parties_list` WHERE party_id ='".$party_id."' ";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['party_list_byid'] =$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }

public function get_product_byid($product_id='')
{
    $sql="SELECT data_product.*,company_tbl.com_name from data_product LEFT JOIN company_tbl ON company_tbl.id = data_product.com_id where data_product.data_product_id=".$product_id."";
    /*$sql="SELECT product_specification_tbl.*,company_tbl.com_name from product_specification_tbl INNER JOIN company_tbl ON company_tbl.id = product_specification_tbl.com_id where product_specification_tbl.id=".$product_id."";*/
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['product_byid']=$query->result_array();
	 // print_r($data['product_byid']);
	 // die();
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