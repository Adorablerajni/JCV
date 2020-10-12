<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CheckIn_model  extends CI_Model{

	function __construct() {
        parent::__construct();
       
    }  

function get_checkin($order_id){
	 $sql="SELECT checkin_tbl.*, stock_tbl.stock_name AS st_name, suppliers_tbl.supplier_name AS sup_name FROM `checkin_tbl` LEFT JOIN stock_tbl ON checkin_tbl.stock_name=stock_tbl.id LEFT JOIN suppliers_tbl ON checkin_tbl.supplier_name=suppliers_tbl.id WHERE order_id='".$order_id."' ORDER BY id ASC"; // 
        //echo $sql;
        //die();
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['checkinData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_checkin_list($user_id){
	 $sql="SELECT checkin_tbl.*, stock_tbl.stock_name AS st_name, suppliers_tbl.supplier_name AS sup_name FROM `checkin_tbl` LEFT JOIN stock_tbl ON checkin_tbl.stock_name=stock_tbl.id LEFT JOIN suppliers_tbl ON checkin_tbl.supplier_name=suppliers_tbl.id group by order_id ORDER BY id ASC"; //WHERE user_id='".$user_id."' 
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['checkinData2']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }

	
}