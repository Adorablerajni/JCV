<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {

	function __construct() {
		
	}

	function login($username,$password){
          
		  $sql="SELECT * FROM branch_tbl WHERE username = '".$username."' AND password = '".$password."'";  //OR email = '".$username."'
            
		$query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1){
			$data['flag']=1;
			$data['resultData']=$query->row_array();
		    return($data);
		} else {   

		 	$data['flag']=0;
		    return($data);
			  
		}
	}

	function Registation($data,$mobile){
          
		$this->db->where('mobile_no',$mobile);
        $data= $this->db->update('registration', $data);
	    return $data;
	}

	function userlogin($check){
      

        $data= $this->db->get_where('registration',$check)->row();
	    return $data;	
	}
	function Adminlogin($check){
      

        $data= $this->db->get_where('admin',$check)->row();
	    return $data;	
	}
	function UpdatePass($data,$mobile){
          
		
		        $this->db->where('mobile_no', $mobile);
            $data= $this->db->update('registration', $data);
		    return $data;
			  
		
	}

	function MobileRegistation($data){
          
		$data = $this->db->insert('registration',$data);
		    return $data;
			  
		
	}
	
   function get_select_header(){
	$sql="SELECT * FROM branch_tbl WHERE id = '".$_SESSION['MM_User_Id']."'";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['headerdata']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }
	
	
	
	
	
	
	
	/* shubham add  1/4/19 */
	
	
	
	
	
	//function get_assign_group_office($ass_id = ""){
		 
           //if($ass_id === '2')
            //{
            // $sql="SELECT * FROM assigned_office_list";
          // }
         //  elseif($ass_id === '1')
          // {
            // $sql="SELECT * FROM branch_tbl where dept_name = '-'";
			//}
       //$query = $this->db->query($sql);
		//$count=$query->num_rows();
		//if($count>=1)
		//{
		//	$data['flag']=1;
		//	$data['branchassigndata']=$query->result_array();
		//	return($data);
		//}
		//else
		//{
			//$data['flag']=0;
			//return($data);
		//}   
   // }
	
	

	 
/*.............................VIEW SECOND TAB .................................*/	 
	 
	
	
/*.............................VIEW FOURTH TAB .................................*/	 
	 
	
	 
/*.............................VIEW FIFTH TAB .................................*/	 










	 

	

}