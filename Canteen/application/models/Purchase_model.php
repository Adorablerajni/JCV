<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model  extends CI_Model{

	function __construct() {
        parent::__construct();
       
    }  

function get_distinct_order($user_id){
	 //$sql="SELECT * FROM `purchase_order` WHERE user_id = '".$user_id."' and id NOT IN (SELECT DISTINCT(order_id) FROM `checkin_tbl` WHERE user_id = '".$user_id."') ORDER BY id ASC";
	 $sql="SELECT * FROM `purchase_order` ORDER BY id ASC";
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

function get_purchase_order($order_id, $user_id){
	 $sql="SELECT purchase_order_list.*, purchase_order_list.id as purchase_item_id, purchase_order.id, purchase_order.order_no, purchase_order.status, purchase_order.order_date, purchase_order.order_address, stock_tbl.stock_name AS name_of_stock, stock_tbl.stock_type  FROM `purchase_order_list` LEFT JOIN purchase_order ON purchase_order_list.order_id = purchase_order.id LEFT JOIN stock_tbl ON purchase_order_list.stock_name = stock_tbl.id WHERE purchase_order_list.order_id='".$order_id."' ORDER BY purchase_order_list.id ASC";  //AND purchase_order_list.user_id='".$user_id."' 
        //print_r($sql);
        //die();
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


function get_upd_purchase_order($po_id){
    
	 $sql="SELECT * FROM `purchase_order` WHERE id = '".$po_id."'";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		//print_r($sql);
		//die();
		if($count>=1)
		{
			$data['flag']=1;
			$data['EditPurchaseOrderData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_upd_purchase_order_list($pol_id){
    
	 $sql="SELECT purchase_order_list.*, stock_tbl.stock_name AS name_of_stock, stock_tbl.stock_type FROM `purchase_order_list` LEFT JOIN stock_tbl ON purchase_order_list.stock_name = stock_tbl.id WHERE purchase_order_list.id = '".$pol_id."'";
	 
	 //print_r($sql);
	 //die();
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['EditPurchaseOrderListData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_id_purchase_order_list($purchase_order_id)
{
    
	 $sql="SELECT `id`, `order_no` FROM `purchase_order`  WHERE id = '".$purchase_order_id."'";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['PurchaseOrderId']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
	
}