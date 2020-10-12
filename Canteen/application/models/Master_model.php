<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model{

	function __construct() {
        parent::__construct();
       
    }  

function get_stock_name(){
	 $sql="SELECT * FROM `stock_tbl` ";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['stockNameData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_update_stock_name($s_id){
	 $sql="SELECT * FROM `stock_tbl` WHERE id = '".$s_id."'";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['EditstockNameData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    } 
    
function get_product_name(){
	 $sql="SELECT * FROM `product_tbl` ORDER BY product_name";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['total_product_count']=$count;
			$data['ProductNameData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_update_product_name($p_id){
	 $sql="SELECT * FROM `product_tbl` WHERE id = '".$p_id."'";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['EditProductNameData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    } 
    
    
function stock_according_type($txtStockType){
	 $sql="SELECT * FROM `stock_tbl` WHERE stock_type='".$txtStockType."'";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['stockAccordingType']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }

function get_suppliers(){
	 $sql="SELECT * FROM `suppliers_tbl` ";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['suppliersData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }

function get_shift(){
	 $sql="SELECT * FROM `shift_tbl` ";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['shiftData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }

function get_district_name(){
	 $sql="SELECT * FROM `district_tbl` ";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['DistrictNameData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_update_district_name($d_id){
	 $sql="SELECT * FROM `district_tbl` WHERE id = '".$d_id."'";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['EditDistrictNameData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    } 
    
function get_project_name(){
	 $sql="SELECT project_tbl.*, district_tbl.district_name FROM `project_tbl` LEFT JOIN district_tbl ON project_tbl.district_id = district_tbl.id ";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['ProjectNameData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_update_project_name($pro_id){
	 $sql="SELECT project_tbl.* , district_tbl.district_name FROM `project_tbl` LEFT JOIN district_tbl ON project_tbl.district_id = district_tbl.id WHERE project_tbl.id = '".$pro_id."'";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['EditProjectNameData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    } 
	
}