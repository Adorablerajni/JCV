<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Allotment_model extends CI_Model{

	function __construct() {
        parent::__construct();
       
    }  

function get_all_issue_stock($user_id){
	    $sql="SELECT manage_stock.*, stock_tbl.stock_name AS name_of_stock, stock_tbl.stock_type  FROM `manage_stock` LEFT JOIN stock_tbl ON manage_stock.stock_id = stock_tbl.id  WHERE stock_credit is NULL AND user_id='".$user_id."' ORDER BY id ASC";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['allIssueStockData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
	
function get_view_stock_list($stock_id,$user_id,$date1,$date2){
    
        $condition = "manage_stock.user_id = '".$user_id."'";
        
        if($stock_id!='')
        {
            $condition .= "AND manage_stock.stock_id = '".$stock_id."'";
        }
        
        if($date1!='' && $date2!='')
        {
            $condition .= "AND manage_stock.stock_date BETWEEN '".$date1."' AND '".$date2."'";
        }
    
	    //$sql="SELECT manage_stock.*, stock_tbl.stock_name AS name_of_stock, stock_tbl.stock_type, purchase_order.order_no, purchase_order.order_date, suppliers_tbl.supplier_name as s_name FROM `manage_stock` LEFT JOIN stock_tbl ON manage_stock.stock_id = stock_tbl.id LEFT JOIN purchase_order ON manage_stock.order_id = purchase_order.id LEFT JOIN suppliers_tbl ON manage_stock.supplier_name = suppliers_tbl.id WHERE manage_stock.stock_id = '".$stock_id."' AND manage_stock.user_id = '".$user_id."' ORDER BY manage_stock.id ASC";
	    $sql="SELECT manage_stock.*, stock_tbl.stock_name AS name_of_stock, stock_tbl.stock_type, purchase_order.order_no, purchase_order.order_date, suppliers_tbl.supplier_name as s_name, manage_stock.issue_stock_no, manage_stock.issue_usertype FROM `manage_stock` LEFT JOIN stock_tbl ON manage_stock.stock_id = stock_tbl.id LEFT JOIN purchase_order ON manage_stock.order_id = purchase_order.id LEFT JOIN suppliers_tbl ON manage_stock.supplier_name = suppliers_tbl.id WHERE ".$condition." ORDER BY manage_stock.id ASC";
        
        //echo $sql;
        //die();
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['ViewStock']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
	
function get_stock_list_by_date($txtEntryDate)
 {
  
	$sql="SELECT checkin_tbl.*, stock_tbl.stock_name AS st_name FROM `checkin_tbl` LEFT JOIN stock_tbl ON checkin_tbl.stock_name = stock_tbl.id  WHERE checkin_date='".$txtEntryDate."' ORDER BY checkin_tbl.order_id ASC";
	$query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['stockListByDate']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }

 
  function get_quantity_by_stock($Stock_id)
 {
	$sql="SELECT SUM(stock_debit) as quantity_d, SUM(stock_credit) as quantity_c FROM `manage_stock` WHERE stock_id ='".$Stock_id."' ORDER BY id ASC";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
	//$res=$query->row_array();
	//return($res);
		if($count>=1)
		{
			//$res['flag']=1;
			$data=$query->row_array();
			//$res['res']=$query->row_array();
			return($data);
		}
		else
		{
			return('No');
			//$res['flag']=0;
			//return($res);
		}
 }
 
  function get_available_stock($Stock_id)
 {
	$sql="SELECT SUM(stock_debit) As sum_stock_debit, SUM(stock_credit) AS sum_stock_credit FROM `manage_stock` WHERE stock_id ='".$Stock_id."' ORDER BY id ASC";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['availableStockData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }
 
  function show_issue_stock_list($user_id)
 {
	$sql="SELECT manage_stock.*, stock_tbl.stock_name AS name_of_stock, stock_tbl.stock_type  FROM `manage_stock` LEFT JOIN stock_tbl ON manage_stock.stock_id = stock_tbl.id  WHERE stock_debit is NULL AND user_id ='".$user_id."' ORDER BY id ASC";
	$query = $this->db->query($sql);
	$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['issueStockList']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
 }
}