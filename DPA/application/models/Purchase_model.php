<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_model  extends CI_Model {

	function __construct() {
		
	}

public function  get_purchase_rate()
{
	$sql="SELECT * from data_product";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['purchase_rate']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function edit_purchase_rate($p_id)
{
	$sql="SELECT * from data_product where data_product_id='".$p_id."'";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['edit_purchase_rate']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function  get_credit_slabs()
{
	$sql="SELECT * FROM credit_structure_slab";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['creditslab_list']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}	



/*
public function  get_product_code()
{
	$sql="SELECT product_tbl.id as p_id,product_tbl.*, company_tbl.* FROM product_tbl INNER JOIN company_tbl ON company_tbl.id = product_tbl.com_id";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['productcode']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}


public function get_product_byid($id)
{
    $sql="SELECT * from product_tbl where id=".$id."";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['product_byid']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function get_composition_byid($comp_id)
{
    $sql="SELECT * from composition_tbl where id=".$comp_id."";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['composition_byid']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function get_company_byid($com_id)
{
    $sql="SELECT * from company_tbl where id=".$com_id."";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['company_byid']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

function get_comp_code($com_id){
	 $sql="SELECT COUNT(*)+1 as maximum from product_tbl where com_id='".$com_id."'";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['comp_code']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
    function get_composition_code(){
	 $sql="SELECT COUNT(*)+1 as maximum from composition_tbl";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['composition_code']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
    public function  get_transport_list()
{
	$sql="SELECT transport_tbl.id, transport_tbl.*,parties_list.name FROM transport_tbl INNER JOIN parties_list ON transport_tbl.party_id = parties_list.party_id";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['transport_list']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}
	*/
}
?>