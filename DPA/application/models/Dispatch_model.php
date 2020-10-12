<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dispatch_model  extends CI_Model {

	function __construct() {
		
	}
	public function get_transporter_as_per_city($city){
		$this->db->select('transport_charges.*,transports_tbl.*,state_city_list.city as transporter_city');
	    $this->db->from('transport_charges');
	    $this->db->join('transports_tbl','transport_charges.transport_id=transports_tbl.id');
	    $this->db->join('state_city_list','state_city_list.id=transports_tbl.city');
	    $this->db->where("transport_charges.transport_city",$city);      
	    $query = $this->db->get();
	    // echo $this->db->last_query();
	    $count=$query->num_rows();
		if($count>=1)
		{
		  $data['flag']=1;
		  $data['transporter_list']=$query->result_array();
		  return($data);
		}
		else
		{
		  $data['flag']=0;
		  return($data);
		} 
	}
	public function get_dispatch_details($Voucher,$Date){
	    $where = "VCN='".$Voucher."' AND Date='".$Date."'";
	    $this->db->select('*');
	    $this->db->from('data_dis');
	    $this->db->where($where);
	    $this->db->limit(1);
	    $query = $this->db->get();
	    // echo $this->db->last_query();
	    $count=$query->num_rows();
		if($count>=1)
		{
		  $data['flag']=1;
		  $data['dispatch_details']=$query->row_array();
		  return($data);
		}
		else
		{
		  $data['flag']=0;
		  return($data);
		} 
	    
	}
    public function  get_details_by_voucher($voucher='',$date=''){
    	$sql="SELECT distinct data_dis.*,data_product.Name as product_name,data_dis.Rate as ProductRate ,
    	transports_tbl.Name as transport_dis,data_party.*,data_product.* from data_dis 
    	LEFT JOIN data_party on data_party.CID =data_dis.CID 
    	LEFT JOIN data_product on data_dis.PID= data_product.PID 
    	LEFT JOIN transports_tbl on data_dis.transporter=transports_tbl.id where data_dis.VCN = '".$voucher."' AND data_dis.Date ='".$date."'  ORDER BY data_product.Name";
    	
    	$query = $this->db->query($sql);
    // 	echo $this->db->last_query();die;
    	$count=$query->num_rows();
    	if($count>=1)
    	{
    	  $data['flag']=1;
    	  $data['dis_data']=$query->result_array();
    	  return($data);
    	}
    	else
    	{
    	  $data['flag']=0;
    	  return($data);
    	}   
    }
    public function check_voucher_date($Voucher,$Date){
        $sql = "Select * from data_dis where VCN='".$Voucher."' AND Date='".$Date."'";
        $query = $this->db->query($sql);
        $count=$query->num_rows();
    	if($count>=1)
    	{
    	  return true;
    	}
    	else
    	{
    	 return false;
    	}  
    }
    public function check_voucher_date_type($Voucher,$Date, $Type){
        $sql = "Select * from Details_Update where details_voucher='".$Voucher."' AND details_Date='".$Date."' AND details_type='".$Type."'";
        $query = $this->db->query($sql);
       echo $this->db->last_query();die;
        $count=$query->num_rows();
    	if($count>=1)
    	{
        	  $data['flag']=1;
        	  $data['details']=$query->result_array();
        	  return($data);
    	}
    	else
    	{
    	    $data['flag']=0;
    	    return($data);
    	}  
    }
    public function create_detail_type($insert_data=array()){
        $result = $this->db->insert('Details_Update',$insert_data);
        return $result;
    }

    public function get_all_transporter(){
        $sql = "Select * from transports_tbl order by created_at DESC";
        $query = $this->db->query($sql);
       // echo $this->db->last_query();
        $count=$query->num_rows();
    	if($count>=1)
    	{
        	  $data['flag']=1;
        	  $data['all_trans']=$query->result_array();
        	  return($data);
    	}
    	else
    	{
    	    $data['flag']=0;
    	    return($data);
    	}   
        
    }
    
    public function get_freight_paid(){
        $sql = "Select data_dis.Voucher,data_dis.Date,data_dis.CompanyID, 
        data_party.ParNam,state_city_list.city as city_name,state_city_list.state as state_name ,
        data_dis.Qty as Quantity,data_product.Unit,data_dis.lr_number ,transports_tbl.Name 
        as Transporter_name,data_dis.frieght_amt,data_dis.MRP,data_dis.Rate,data_dis.Amount,data_dis.GSTAmount from data_dis
        LEFT JOIN data_product on data_dis.PID= data_product.PID
        LEFT JOIN data_party on data_dis.CID=data_party.CID
        LEFT JOIN transports_tbl on data_dis.transporter =transports_tbl.id 
        LEFT JOIN state_city_list on transports_tbl.city=state_city_list.id where data_dis.freight_paid ='1' GROUP BY data_dis.Voucher ";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        $count=$query->num_rows();
    	if($count>=1)
    	{
        	  $data['flag']=1;
        	  $data['sale_list']=$query->result_array();
        	  return($data);
    	}
    	else
    	{
    	    $data['flag']=0;
    	    return($data);
    	} 
    }
    public function get_taxable_amount($voucher='',$date=''){
        $sql = "Select GSTAmount from data_dis where Voucher='".$voucher."' AND Date='".$date."'";
        $query = $this->db->query($sql);
       // echo $this->db->last_query();
        $count=$query->num_rows();
        $taxable_amount = 0;
        
    	if($count>=1)
    	{
        	  $data['flag']=1;
        	  $all_trans =$query->result_array();
        	  foreach($all_trans as $value){
        	      $taxable_amount= $taxable_amount+ $value['GSTAmount'];
        	  }
        	 return $taxable_amount;
    	}
    	else
    	{
    	  return false;
    	}  
        
    }
}

?>