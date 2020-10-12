<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction_model  extends CI_Model {

	function __construct() {
		
	}

public function  get_transactions_list()
{
	$sql="SELECT * from transactions_list";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['transaction_list']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function  transactions_list_byid($t_id='')
{
	$sql="SELECT * from transactions_list where id = '".$t_id."'";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['transactions_list_byid']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function  transactions_products_byid($t_id='')
{
	$sql="SELECT * from transactions_products where transaction_id = '".$t_id."'";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['transactions_products_byid']=$query->result_array();
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