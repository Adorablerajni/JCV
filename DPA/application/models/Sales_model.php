<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales_model  extends CI_Model {
	function __construct() {
		
	}
	public function get_purchase(){
		$this->db->select('*');
	    $this->db->from('data_dis');
	    $this->db->join('data_product', 'data_product.PID = data_dis.PID');
	    $this->db->where("Type",'P'); 
	    $this->db->order_by('data_dis.created_date','DESC');
	    $query = $this->db->get();
	    // echo $this->db->last_query();
	    $count=$query->num_rows();
		if($count>=1)
		{
		  $data['flag']=1;
		  $data['purchase_list']=$query->result_array();
		  return($data);
		}
		else
		{
		  $data['flag']=0;
		  return($data);
		} 
	}
	public function get_purchase_m(){
		$this->db->select('*');
	    $this->db->from('data_mdis');
	    $this->db->where("Type",'P');  
	     $this->db->order_by('data_mdis.created_at','DESC');
	    $query = $this->db->get();
	    // echo $this->db->last_query();
	    $count=$query->num_rows();
		if($count>=1)
		{
		  $data['flag']=1;
		  $data['purchase_list_m']=$query->result_array();
		  return($data);
		}
		else
		{
		  $data['flag']=0;
		  return($data);
		} 
	}
	public function get_sale(){
		$this->db->select('*');
	     $this->db->from('data_dis');
        $this->db->join('data_product', 'data_product.PID = data_dis.PID');
        $this->db->join('data_party', 'data_party.CID = data_dis.CID');
	    $this->db->where("Type",'G');
	    $this->db->group_by('VCN');
	     $this->db->order_by('data_dis.created_date','DESC');
	    $query = $this->db->get();
	   echo $this->db->last_query();
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
	public function get_sale_m(){
		$this->db->select('*');
        $this->db->from('data_mdis');
        // $this->db->join('data_product', 'data_product.PID = data_mdis.PID');
	    $this->db->where("Type",'G'); 
	     $this->db->order_by('data_mdis.created_at','DESC');
	    $query = $this->db->get();
	    // echo $this->db->last_query();
	    $count=$query->num_rows();
		if($count>=1)
		{
		  $data['flag']=1;
		  $data['sale_list_m']=$query->result_array();
		  return($data);
		}
		else
		{
		  $data['flag']=0;
		  return($data);
		} 
	}
	public function  dis_list_byid($dis_id='')
	{
		$sql="SELECT data_dis.*,data_dis.Rate as ProductRate,data_product.*,data_party.*,data_masters.Name as CompName from data_dis join data_product on data_dis.PID= data_product.PID join data_party on data_dis.CID = data_party.CID  join data_masters on data_dis.CompanyID=data_masters.CompanyID where data_dis.Voucher = '".$dis_id."'";
		$query = $this->db->query($sql);
// 		echo $this->db->last_query();
		$query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
		  $data['flag']=1;
		  $data['dis_list_byid']=$query->result_array();
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