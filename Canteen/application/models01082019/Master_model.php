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


	
}