<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {

	function __construct() {
		
	}
	
	function login($inputUsername,$inputPassword){
               
		$sql="SELECT * FROM `user_tbl` WHERE user_name ='".$inputUsername."' AND password ='".$inputPassword."' "; 
            
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
	
}