<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Quote_model  extends CI_Model {

	function __construct() {
		
	}
	
	public function quote_post() {
	    $article_fetch_sql = "SELECT  * FROM `admin_posts` WHERE `post_type` = 'Quote'";
	    $query =  $this->db->query($article_fetch_sql);
	    $count = $query->num_rows();
	    if($count >= 1) {
	        $data['flag'] = 1;
	        $data['quotes'] = $query->result_array();
	        return ($data);
	    }
	    else {
	         $data['flag'] = 0;
	         return ($data);
	    }
	}
	
}
	
	
?>