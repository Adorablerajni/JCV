<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme {
    protected $CI;

    public function __construct()
    {
         // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }
   
    public function theme_view($data,  $view)
    {
        $this->CI->load->view('includes/header',$data);        
        $this->CI->load->view($view);
        $this->CI->load->view('includes/footer');
        
    }
    public function load_view_after_login($data,  $view)
    {
      
        $this->CI->load->view('after_login_header',$data);      
        $this->CI->load->view($view);       
        $this->CI->load->view('after_login_footer');
        
    }

}