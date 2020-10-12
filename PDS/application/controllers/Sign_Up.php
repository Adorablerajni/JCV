<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_Up extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		// $this->load->library('myoperator');
	}
	 public function index()
   {
       try {
           
           $this->load->library('myoperator');
           $this->load->helper('date');  
           $mobile = '';
           $session_id = '';
           $response = $this->myoperator->run($mobile);          
           $res_array = json_decode($response);
           if($res_array->Status == "Success") {
           		$session_id = $res_array->Details;
           		echo $session_id;
           }

        } catch (Exception $e) {
           var_dump($e->getMessage());
       }
   }
}
?>	