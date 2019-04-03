<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('Header');
        if (!($this->session->has_userdata('via-spot_admin'))) {
            redirect(base_url() . 'auth/login');
        }
        $this->data['gallary_path'] = 'http://52.66.105.102/viaspot/viaspot_users/';
        $this->data['active_list'] = 'Faq';
        $this->data['admin_user'] = $this->session->userdata('via-spot_admin');
    }
    public function index() {
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('faq', $this->data);
        $this->load->view('app-footer', $this->data);
    }
}
