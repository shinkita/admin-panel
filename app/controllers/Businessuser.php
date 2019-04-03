<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Businessuser extends CI_Controller {

    var $data;
    public function __construct() {
		error_reporting(0);
        parent::__construct();
        $this->load->library('Header');
        if (!($this->session->has_userdata('via-spot_admin'))) {
            redirect(base_url() . 'auth/login');            
        }
        $this->data['gallary_path'] = 'https://www.viaspot.com/vsdeveloper/api/viaspot_users/';
        $this->data['active_list'] = 'Setting';
        $this->data['admin_user'] = $this->session->userdata('via-spot_admin');
    }

    public function index($page=0) {       	    	
    	 $this->data['active_list'] = 'faq';
        $this->data['sno'] = $page+1;
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM admin_user where type='business' ");            
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/faq';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT * FROM admin_user where type='business' ORDER BY id desc  LIMIT $page, $config[per_page]";
        $this->data['faq'] = $this->usersmodel->fetch_query($query); 
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('business-user', $this->data);
        $this->load->view('app-footer', $this->data);
    } 
	
	 public function new_account()
    {
        $this->data['active_list'] = 'faq';
        $config = array(
		 array(
                'field' => 'username',
                'label' => 'User Name',
                'rules' => 'required'
            ) 
            
        ); 
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {        
        	
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('business-user-new', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
      
		########################Image Upload###########################
	  if($_FILES['userimage_upload']['name']!='')
	 {
		$file_name = $_FILES['userimage_upload']['name'];
    $file_size = $_FILES['userimage_upload']['size'];
    $file_type = $_FILES['userimage_upload']['type'];
    $temp_name = $_FILES['userimage_upload']['tmp_name'];
    $ext = pathinfo($_FILES['userimage_upload']['name'])['extension'];
	$user_id=md5(uniqid(rand(), true));
    $location =  '../../viaspot_users/user_images';
    $image = $user_id . '' . rand() . '.' . $ext;
    $uploaded = move_uploaded_file($temp_name, __DIR__.DIRECTORY_SEPARATOR.$location . DIRECTORY_SEPARATOR .  $image);
	
	 }
	 else
	 {
	   $image ='';  
	 }
	########################Image Upload###########################
	
		 $creation_date=date('Y-m-d H:i:s');
        $data = array(
          'data'=>array('username'=>$this->input->post('username'),'email'=>$this->input->post('email'),'password'=>sha1($this->input->post('password')),'temp'=>$this->input->post('password'),'mobile'=>$this->input->post('mobile_no'),'type'=>$this->input->post('source'),'status'=>$this->input->post('userstaus'),'date_time'=>$creation_date ,'profile_image'=>$image),
          'table'=>'admin_user' 
        );                  
		    ##################check data if same name already exist############# 		
      $checked_query ="select * from  admin_user where username='".$this->input->post('username')."' or email='".$this->input->post('email')."'";
		
		 $checked_response = $this->usersmodel->count_query($checked_query );
		 ##################check data if same name already exist#############
		  if($checked_response==0)
        $response = $this->usersmodel->insert($data); 
	else
		$response =0; 
	
            if($response>0)
            {
                $this->data['response']['title'] = 'Suceessfully saved';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> New Business user Added Successfully!
                                            </div>";                 
            }
			else  if($checked_response>0)
            {
			   $this->data['response']['title'] = 'Alert';
             $this->data['response']['body'] = "<div class='alert alert-danger'>
                                              <strong>Alert!</strong> User Name Or email already exist . Please try again
                                            </div>";   	
			}
            else
            {
                $this->data['response']['title'] = 'Alert';
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
     public function edit_account($id)
    {
	 
        $this->data['active_list'] = 'faq';
        $data = array(
            'where'=>array('id'=>$id),            
            'table'=>'admin_user'
        );
        $this->data['account'] = $this->usersmodel->fetch_row($data);        
    $config = array(
		 array(
                'field' => 'username',
                'label' => 'User Name',
                'rules' => 'required'
            ) 
            
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {         
         $query = "SELECT * FROM interest_category_tbl ORDER BY id ASC  ";
          $this->data['category'] = $this->usersmodel->fetch_query($query); 	
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('business-user-edit', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
		  
		 ########################Image Upload###########################
  if($_FILES['userimage_upload']['name']!='')
	 {
		$file_name = $_FILES['userimage_upload']['name'];
    $file_size = $_FILES['userimage_upload']['size'];
    $file_type = $_FILES['userimage_upload']['type'];
    $temp_name = $_FILES['userimage_upload']['tmp_name'];
    $ext = pathinfo($_FILES['userimage_upload']['name'])['extension'];
	$user_id=md5(uniqid(rand(), true));
    $location =  '../../viaspot_users/user_images';
    $image = $user_id . '' . rand() . '.' . $ext;
    $uploaded = move_uploaded_file($temp_name, __DIR__.DIRECTORY_SEPARATOR.$location . DIRECTORY_SEPARATOR .  $image);
	 }
	########################Image Upload###########################
   
         
        $query = "UPDATE admin_user SET   email='".$this->input->post('email')."', 
		status='".$this->input->post('userstaus')."'  ";
		  if($_FILES['userimage_upload']['name']!='')
	 {
		$query .= " , profile_image='".$image. "'"; 
	 }
	  
		 $query .= "  WHERE id='".$id."'";
		 
		   
  
        $response = $this->usersmodel->update_query($query);                
            if($response>0)
            {
                $this->data['response']['title'] = 'Successfully Edited';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> New Business User Updated Successfully!
                                            </div>";                 
            }
            else
            {
                $this->data['response']['title'] = 'Alert';
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
	
	
	   public function feed($id)
    {
		 
		 
        $query = "SELECT * FROM account_tbl where id= '$id'  ";
        $this->data['faq'] = $this->usersmodel->fetch_query($query); 
     
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('business-detail.php', $this->data);
        $this->load->view('app-footer', $this->data);
      
    }
	public function deactive_account($id)
    {
		 
        if(isset($_SERVER['HTTP_REFERER']))
        {
            
            $update_feed_query = "UPDATE `account_tbl` SET `status` = IF(`status`=1,0,1) WHERE  `user_id` ='".$id."'";
            $update_response = $this->usersmodel->update_query($update_feed_query);
            
            $query = "UPDATE `admin_user` SET `status` = IF(`status`=1,0,1) WHERE `admin_user`.`id` ='".$id."'";
            $response = $this->usersmodel->update_query($query);
            redirect($_SERVER['HTTP_REFERER']); 
        }
        else
        {
            redirect(base_url());
        }
    }
	  public function delete_account($id)
    {
	 
        if(isset($_SERVER['HTTP_REFERER']))
        {
             $query = "SELECT * FROM account_tbl where user_id= '$id'  ";
        $data_feed = $this->usersmodel->fetch_query($query);
	 $backup_deleted_feed = "INSERT INTO b_account_tbl(user_id,account_name,category,date,payment_status,account_status,status,description,image,video,is_deleted,updated_date) SELECT user_id,account_name,category,date,payment_status,account_status,status,description,image,video,is_deleted,updated_date FROM account_tbl WHERE user_id = '".$id."'";
	 
		$this->db->query($backup_deleted_feed );
		
		$response = $this->usersmodel->update_query("DELETE FROM account_tbl WHERE user_id='".$id."'");
            
            
            
        $response = $this->usersmodel->update_query("DELETE FROM admin_user WHERE id='".$id."'");
        redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect(base_url());
        }
    }
}
