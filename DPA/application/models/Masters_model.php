<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Masters_model  extends CI_Model {

	function __construct() {
		
	}

public function  get_company_code()
{
	$sql="SELECT * FROM company_tbl";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['companycode']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}	

public function  get_product_code()
{
	$sql="SELECT * from data_product";
	/*$sql="SELECT data_product.id as p_id,data_product.*, company_tbl.* FROM data_product INNER JOIN company_tbl ON company_tbl.id = data_product.com_id";*/
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['productcode']=$query->result_array();
	  //print_r($data['productcode']);
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function  get_composition_list()
{
	$sql="SELECT * FROM composition_tbl";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['composition_list']=$query->result_array();
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
    $sql="SELECT * from product_specification_tbl where id=".$id."";
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
	 $sql="SELECT COUNT(*)+1 as maximum from product_specification_tbl where com_id='".$com_id."'";
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
 public function  get_transporter_list()
{
	$sql="SELECT transports_tbl.id as t_id,state_city_list.city as city_name, transports_tbl.*,state_city_list.* FROM transports_tbl INNER JOIN state_city_list ON transports_tbl.city = state_city_list.id";
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

	public function  get_party_list()
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

public function get_data_product_list()
{
    $sql="SELECT * FROM data_product";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['product_specification']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}
public function get_product_specification_list()
{
    $sql="SELECT * FROM product_specification_tbl";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['product_specification']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function get_statecity_byid($stateid,$cityid)
{
    if($cityid!=="ALL"){
    $sql="SELECT * from state_city_list where id=".$cityid."";
    }
    else{
        $sql="SELECT * from state_city_list where state_code=".$stateid."";
    }
    
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['citystate_byid']=$query->result_array();
	  return($data);
	}
	else
	{
	  $data['flag']=0;
	  return($data);
	}   
}

public function get_quantity_by_id($product='', $quantity='')
 {
	$sql="SELECT * FROM `brand_margin_slab` WHERE prod_id = '".$product."' and quantity ='".$quantity."' ";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['quantity_byid'] =$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			$data['quantity_byid']="0";
			return($data);
		}   
 }
 
public function get_credit_by_id($payment='')
 {


	$sql="SELECT * FROM `credit_structure_slab` WHERE credit_payment_title ='".$payment."' ";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['credit_byid'] =$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }
 
 public function get_cityslab_by_id($product="", $city='')
 {


	$sql="SELECT * FROM `city_state_slab` WHERE pro_id='".$product."' and  city_slab ='".$city."'";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['cityslab_byid'] =$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }
 
 public function get_productspecification_by_id($product='')
 {


	$sql="SELECT * FROM `product_specification_tbl` WHERE product_id ='".$product."'";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['marginslab_byid'] =$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }

public function get_state_bystatecode($id='')
{
    $sql="SELECT * from state_list where state_code=".$id."";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	if($count>=1)
	{
	  $data['flag']=1;
	  $data['state_bycode']=$query->result_array();
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