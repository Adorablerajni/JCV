<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pricing_model  extends CI_Model {

	function __construct() {
		
	}

public function  get_purchase_rate()
{
	$sql="SELECT purchase_rate.*,product_specification_tbl.prod_name FROM purchase_rate RIGHT JOIN product_specification_tbl ON product_specification_tbl.id = purchase_rate.product_id";
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

public function  get_credit_slabs()
{
	$sql="SELECT * FROM get_margin_slabs";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['marginslab_list']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}
public function get_citystate_slab_by_id($citystate_slab = "")
{
    $sql="SELECT city_state_slab.*, product_specification_tbl.id as prod_id ,product_specification_tbl.name,product_specification_tbl.brand_margin,product_specification_tbl.purchase_rate from city_state_slab INNER JOIN product_specification_tbl  ON product_specification_tbl.id= city_state_slab.pro_id where city_state_slab.id=".$citystate_slab;
	$query = $this->db->query($sql);
	//echo $this->db->last_query();
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['get_citystate_slab']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}	public function get_brand_margin_slab_by_id($citystate_slab = "")
{
    $sql="SELECT brand_margin_slab.*, product_specification_tbl.id as prod_id ,product_specification_tbl.name,product_specification_tbl.shipper ,product_specification_tbl.brand_margin,product_specification_tbl.purchase_rate from brand_margin_slab INNER JOIN product_specification_tbl  ON product_specification_tbl.id= brand_margin_slab.prod_id where brand_margin_slab.id=".$citystate_slab;
	$query = $this->db->query($sql);
	//echo $this->db->last_query();
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['get_brandmargin_slab']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}
public function get_credit_slab_by_id($credit_slab_id = "")
{
    $sql="SELECT * from credit_structure_slab where  id=".$credit_slab_id;
	$query = $this->db->query($sql);
	//echo $this->db->last_query();
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['get_brandmargin_slab']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}	

public function get_citystate_slab()
{
    $sql="SELECT city_state_slab.*,data_product.Code as code,data_product.Name as name,data_product.brand_margin,data_product.purchase_rate from city_state_slab INNER JOIN data_product ON data_product.data_product_id = city_state_slab.pro_id";
   /* $sql="SELECT city_state_slab.*,product_specification_tbl.code,product_specification_tbl.name,product_specification_tbl.brand_margin,product_specification_tbl.purchase_rate from city_state_slab INNER JOIN product_specification_tbl ON product_specification_tbl.id = city_state_slab.pro_id";*/
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['get_citystate_slab']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function get_brandmargin_slab()
{
    $sql="SELECT brand_margin_slab.*,data_product.code,data_product.Name   as name  ,data_product.brand_margin,data_product.shipper,data_product.purchase_rate from brand_margin_slab INNER JOIN data_product ON data_product.data_product_id = brand_margin_slab.prod_id";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['brandmargin']=$query->result_array();
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