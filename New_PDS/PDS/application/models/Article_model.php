<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Article_model  extends CI_Model {

	function __construct() {
		
	}
	
	public function article_post() {
	    $article_fetch_sql = "SELECT  * FROM `admin_posts` WHERE `post_type` = 'Article'";
	    $query =  $this->db->query($article_fetch_sql);
	    $count = $query->num_rows();
	    if($count >= 1) {
	        $data['flag'] = 1;
	        $data['articles'] = $query->result_array();
	        return ($data);
	    }
	    else {
	         $data['flag'] = 0;
	         return ($data);
	    }
	}
	
}
	
	
?>