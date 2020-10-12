<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dispatch_model  extends CI_Model{

	function __construct() {
        parent::__construct();
       
    }  

function get_requirement_data($user_id){
    
	 $sql="SELECT requirement_tbl.*, product_tbl.product_name FROM `requirement_tbl` LEFT JOIN product_tbl ON requirement_tbl.product_id = product_tbl.id WHERE requirement_tbl.user_id = '".$user_id."' ORDER BY requirement_tbl.id LIMIT 30";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['RequirementData']=$query->result_array();
			return($data);
		}
		else
		{
		    $data['flag']=0;
			return($data);
		}   
    }

function get_production_data($user_id){
    
	 $sql="SELECT * FROM `production_tbl` ORDER BY id";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['ProductionData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_dispatch_report_data($user_id, $date1, $date2){
    
	 $sql="SELECT dispatch_details.*,project_tbl.project_name FROM `dispatch_details` INNER JOIN project_tbl ON project_tbl.id = dispatch_details.del_project WHERE del_challan_date BETWEEN '".$date1."' AND '".$date2."' ORDER BY del_challan_date ";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['Total_Count']=$count;
			$data['DispatchReportData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			$data['Total_Count']=0;
			return($data);
		}   
    }
    
function get_dispatch_report_packets($product_id, $production_id, $type){
    
	 $sql="SELECT * FROM `production_details_list` WHERE product_id = '".$product_id."' AND production_id = '".$production_id."' AND  type = '".$type."' ORDER BY id ";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['Total_Details_Count']=$count;
			$data['DispatchReportDetailsData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			$data['Total_Details_Count']=0;
			return($data);
		}   
    }
    
function get_dispatch_upto_last_report($productid, $date1, $date2){
    
	 $sql="SELECT SUM(production_details_list.counts)  as p_counts FROM `production_details_list` INNER JOIN production_tbl ON production_details_list.production_id = production_tbl.id WHERE production_details_list.product_id = '".$productid."' AND production_tbl.chalan_date < '".$date1."' ";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['Total_Last_Report_Count']=$count;
			$data['LastReportData']=$query->row_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			$data['Total_Last_Report_Count']=0;
			return($data);
		}   
    }
    
function get_daily_production_data($user_id){
    
	 $sql="SELECT * FROM `daily_production_list` ORDER BY id";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['DailyProductionData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function edit_daily_production_data($pro_id){
    
	 $sql="SELECT daily_production_list.*, daily_production.*, daily_production.id as pr_id FROM `daily_production_list` INNER JOIN daily_production ON daily_production.id = daily_production_list.prod_id where prod_id = '".$pro_id."'";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['EditProductionData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function district_tbl(){
    
	 $sql="SELECT DISTINCT(district_name) FROM `project_tbl` ORDER BY district_name ASC";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['DistrictData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_project_by_city($City_id)
{
    
  $sql = "SELECT `id`, `project_name` FROM project_tbl WHERE district_name = '".$City_id."'  ORDER BY district_name ";
  $query = $this->db->query($sql);
  $output = '<option value="">Select Project Name</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->id.'">'.$row->project_name.'</option>';
  }
  return $output;
 }

function get_dispatch_data(){
    
	 $sql="SELECT dispatch_details.*,project_tbl.project_name FROM `dispatch_details` INNER JOIN project_tbl ON project_tbl.id = dispatch_details.del_project ORDER BY dispatch_details.id";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['DispatchData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
	
function get_dispatch_report($Dis_id){
    
	 $sql="SELECT dispatch_details.*,project_tbl.project_name FROM `dispatch_details` INNER JOIN project_tbl ON project_tbl.id = dispatch_details.del_project where dispatch_details.id= '".$Dis_id."'";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['DispatchReportData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
    
function get_production_report_data($user_id, $date1, $date2){
    
	 $sql="SELECT * FROM `daily_production_list` WHERE prod_date BETWEEN '".$date1."' AND '".$date2."' ORDER BY prod_date ";
	 
	    $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['Total_Count']=$count;
			$data['ProductionReportData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			$data['Total_Count']=0;
			return($data);
		}   
    }
    
}