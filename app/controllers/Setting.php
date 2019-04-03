<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    var $data;
    public function __construct() {
        parent::__construct();
        $this->load->library('Header');
        if (!($this->session->has_userdata('via-spot_admin'))) {
            redirect(base_url() . 'auth/login');            
        }
        $this->data['gallary_path'] = 'https://www.viaspot.com/vsdeveloper/api/viaspot_users/';
        $this->data['active_list'] = 'Setting';
        $this->data['admin_user'] = $this->session->userdata('via-spot_admin');
    }

    public function index() {       	    	
    	$config = array(
            array(
                'field' => 'currentpassword',
                'label' => 'Current password',
                'rules' => 'required|callback_validepassword'
            ),
            array(
                'field' => 'newpassword',
                'label' => 'New password',
                'rules' => 'required'
            ),
            array(
                'field' => 'verifypassword',
                'label' => 'Verify password',
                'rules' => 'required|matches[newpassword]'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {             	
	        $this->load->view('app-header', $this->data);
	        $this->load->view('app-sidebar', $this->data);
	        $this->load->view('setting', $this->data);
	        $this->load->view('app-footer', $this->data);
	    }
	    else
	    {
	    	$data = array(
	    		'data'=>array('password'=>sha1($this->input->post('newpassword'))),
	    		'where'=>array('id'=>$this->data['admin_user']['id']) 
	    	);                  
	    	$response = $this->admin->update_admin($data);	    		    	
            if($response == true)
            {
                $this->data['response']['title'] = 'Password change';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> Password Updated successfully. You must Logout to take effect
                                            </div>";                 
            }
            else
            {
                $this->data['response']['title'] = 'Password change';
             $this->data['response']['body'] = "<div class='alert alert-danger'>
                                              <strong>Alert!</strong> Something went wrong. Please try again
                                            </div>";     
            }
    		$this->load->view('app-header', $this->data);
	        $this->load->view('app-sidebar', $this->data);
	        $this->load->view('success', $this->data);
	        $this->load->view('app-footer', $this->data);	    	 	
	    }
    } 
    public function  validepassword($pass){
    	if($this->data['admin_user']['password'] == sha1($pass))
    	{
    		return TRUE;
    	}
    	else
    	{
    		$this->form_validation->set_message('validepassword', 'Invalid %s');
            return FALSE;
    	}
    } 
}
