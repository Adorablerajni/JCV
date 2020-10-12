<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model  extends CI_Model{

	function __construct() {
        parent::__construct();
       
    }  

function get_user(){
	 $sql="SELECT * FROM `user_tbl` ";
        $query = $this->db->query($sql);
		$count=$query->num_rows();
		if($count>=1)
		{
			$data['flag']=1;
			$data['userData']=$query->result_array();
			return($data);
		}
		else
		{
			$data['flag']=0;
			return($data);
		}   
    }


	
}