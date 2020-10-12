<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme {
    protected $CI;

    public function __construct()
    {
         // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }
   
    public function load_view_without_footer($data,  $view)
    {
        $this->CI->load->view('layouts/header',$data);
        $this->CI->load->view('layouts/headerlinks');
        $this->CI->load->view($view);
        $this->CI->load->view('layouts/footerjs');
        
    }
    public function load_view_after_login($data,  $view)
    {
      
        $this->CI->load->view('after_login_header',$data);      
        $this->CI->load->view($view);       
        $this->CI->load->view('after_login_footer');
        
    }

}