<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->load->library('Header');
        if (!($this->session->has_userdata('via-spot_admin'))) {
            redirect(base_url() . 'auth/login');
        }
        $this->data['active_list'] = 'Home';
    }

    public function index() {
        $this->data['admin_user'] = $this->session->userdata('via-spot_admin');
        $this->data['count_dashboard'] = $this->usersmodel->fetch_query("SELECT COUNT(*),(SELECT COUNT(*) FROM users WHERE activated=0) AS inactive_users,(SELECT COUNT(*) FROM b_users) AS deleted_users,(SELECT COUNT(*) FROM post WHERE post_type='2' AND deleted=0) AS t_images,(SELECT COUNT(*) FROM post WHERE post_type='3' AND deleted=0) AS t_video, (SELECT COUNT(*) FROM event WHERE deleted=0) AS t_events,(SELECT COUNT(*) FROM post WHERE deleted=0) AS t_post,(SELECT COUNT(*) FROM chat_groups WHERE deleted=0) AS t_groups,(SELECT login_time FROM admin_user WHERE id='".$this->data['admin_user']['id']."') AS lgin_time FROM users");
      
	   $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('home', $this->data);
        $this->load->view('app-footer', $this->data);
    }

}
