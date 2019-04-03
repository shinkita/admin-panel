<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Header {    
    var $CI;
    public function __construct()
    {
        $this->CI = & get_instance();        
        $this->CI->config->item('base_url');
        $this->CI->load->view('header');        
        $this->CI->load->library('form_validation');        
    }
}
?>