<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model  extends CI_Model{

	function __construct() {
        parent::__construct();
       
    }  

function get_distinct_order($user_id){
	 $sql="SELECT * FROM `purchase_order` WHERE user_id='".$user_id."' ORDER BY id ASC";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['distinctOrderData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
	
function get_purchase_order($Order_id, $user_id){
	 $sql="SELECT purchase_order_list.*, purchase_order.order_no, purchase_order.order_date, purchase_order.order_address, stock_tbl.stock_name AS name_of_stock, stock_tbl.stock_type  FROM `purchase_order_list` LEFT JOIN purchase_order ON purchase_order_list.order_id=purchase_order.id LEFT JOIN stock_tbl ON purchase_order_list.stock_name=stock_tbl.id WHERE purchase_order_list.order_id='".$Order_id."' AND purchase_order_list.user_id='".$user_id."' ORDER BY id ASC";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['purchaseOrderData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }

	
}