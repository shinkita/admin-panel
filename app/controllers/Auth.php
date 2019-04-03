<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Header');
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function login() {
        $data['where'] = array(
            'username' => trim($this->input->post('username')),
        );
        $user = $this->admin->get_row($data);         
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|callback_valideUser[' . count($user) . ']'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|callback_validePass[' . $user['password'] . ']'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_form');
        } else {
            //print_r($user);
            $this->usersmodel->update_query("UPDATE admin_user SET login_time='".date('Y-m-d H:i:s')."' WHERE id='".$user['id']."'");
            $this->session->set_userdata('via-spot_admin', $user);
            redirect(base_url());
        }
    }

    public function logout() {
        $this->session->unset_userdata('via-spot_admin');
        redirect(base_url() . 'auth/login');
    }

    public function valideUser($username, $count) {
        if ($count != 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valideUser', 'Invalid %s');
            return FALSE;
        }
    }

    public function validePass($pass, $mysql_pass) {
        if ($mysql_pass == do_hash($pass)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validePass', 'Invalid %s');
            return FALSE;
        }
    }
    public function valideEmail($email) {
        $data['where'] = array(
            'email' => $email,
        );
        $user = $this->admin->get_row($data);     
        if (count($user)>0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valideEmail', 'Invalid %s');
            return FALSE;
        }
    }
    public function forget_password()
    {       
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|callback_valideEmail'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('forget-password');
        } else {
            //print_r($user);
            $number = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $number = str_shuffle($number);
            $number = substr($number, 1, 6);            
            $this->usersmodel->update_query("UPDATE admin_user SET temp='".$number."' WHERE email='".$_POST['email']."'");
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'viaspot.com',
                'smtp_user' => 'welcome@viaspot.com',
                'smtp_pass' => 'writeus@viaspot',
                'smtp_port' => '465',
                'smtp_timeout' => '5',
                'smtp_crypto' => 'ssl',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'validate' => TRUE,
                'priority' => 1,
                'crlf' => "\r\n",
                'newline' => "\r\n",
            );            
            $message = "<h3>Hi,</h3>";
            $message .= "<h2>Viaspot Admin</h2>";
            $message .= "<p>Here is password reset link  <a href='".base_url()."auth/reset/".$number."'>Click Here</a> to reset your password Or directly use this link : ".base_url()."auth/reset/".$number."
                <br>
                Ignore this if you not initiate password reset.</p>
                <p>
                Regards:<br>
                Viaspot Team
             </p>";
            $this->load->library('email', $config);
            $this->load->initialize($config);
            $this->email->from('welcome@viaspot.com', 'Viaspot Admin');
            $this->email->to($_POST['email']);
            $this->email->subject('Password Reset');
            $this->email->message($message);
            $this->email->send();
            $this->data['response'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> Mail Sent
                                            </div>";  
            $this->load->view('forget-password',$this->data);
        }
    }    
    public function reset($code)
    {
        $data['where'] = array(
            'temp' => $code,
        );
        $user = $this->admin->get_row($data);    
        if(!$user['id'])
        {
            echo "The link is expired";
            die();

            // $this->usersmodel->update_query("UPDATE admin_user SET temp='".$number."' WHERE email='".$_POST['email']."'");
        }
            
        $config = array(
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
            $this->load->view('recover-password');
        }
        else
        {
            $this->usersmodel->update_query("UPDATE admin_user SET temp='',password='".sha1($_POST['newpassword'])."' WHERE temp='".$code."'");
            $this->data['response'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> Password Reset Successfully!
                                            </div>";
            $this->load->view('recover-password',$this->data);

        }
    }
}
