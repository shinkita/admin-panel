<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {

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
		
		if($_SESSION['via-spot_admin']['id']==1)
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM account_tbl"); 

else 
$count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM account_tbl where user_id='".$_SESSION['via-spot_admin']['id']."'"); 
	
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'business/index';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
		if($_SESSION['via-spot_admin']['id']==1)
        $query = "SELECT * FROM account_tbl ORDER BY id desc  LIMIT $page, $config[per_page]";
	else 
		$query = "SELECT * FROM account_tbl where user_id='".$_SESSION['via-spot_admin']['id']."' ORDER BY id desc  LIMIT $page, $config[per_page]";
		
        $this->data['faq'] = $this->usersmodel->fetch_query($query); 
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('business', $this->data);
        $this->load->view('app-footer', $this->data);
    } 
	
	 public function new_account()
    {
        $this->data['active_list'] = 'faq';
        if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($_FILES['video_upload']['name']!=''    )
		{
		 $ext = pathinfo($_FILES['video_upload']['name'])['extension'];
		  $config = array(
		 array(
                'field' => 'accountname',
                'label' => 'Account Name',
                'rules' => 'required'
            ),
			 array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required'
            ) ,
			 array(
                'field' => 'paid_status',
                'label' => 'Payment',
                'rules' => 'required'
            ) , 
             array(
                'field' => 'video_upload',
                'label' => 'video_upload',
                'rules' => 'callback_validExt[' .  $ext . ']'
            )
            
        ); 
		} 
		  else if($_FILES['image_upload']['name']!=''    )
		{
		 
		 $imgext = pathinfo($_FILES['image_upload']['name'])['extension'];
		 
		  $config = array(
		 array(
                'field' => 'accountname',
                'label' => 'Account Name',
                'rules' => 'required'
            ),
			 array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required'
            ) ,
			 array(
                'field' => 'paid_status',
                'label' => 'Payment',
                'rules' => 'required'
            ) ,
			
			 
			 array(
                'field' => 'image_upload',
                'label' => 'image_upload',
                'rules' => 'callback_validimgExt[' .  $imgext  . ']'
            )
            
        ); 
		 
		} 
		else
		{
		    $config = array(
		 array(
                'field' => 'accountname',
                'label' => 'Account Name',
                'rules' => 'required'
            ) ,
			 array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required'
            ) ,
			 array(
                'field' => 'paid_status',
                'label' => 'Payment',
                'rules' => 'required'
            ) 
            
        );
		}
		}
            if($this->input->post('youtube')!=''    )
		{
		$url = parse_url($this->input->post('youtube'));
       if($url['scheme'] != 'https') 
	   $url='https://'.$this->input->post('youtube');
   else 
	  $url=$this->input->post('youtube'); 
		}
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {        
         $query = "SELECT * FROM interest_category_tbl ORDER BY id ASC  ";
          $this->data['category'] = $this->usersmodel->fetch_query($query); 	
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('account-new', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
      $account_status=implode(',',$this->input->post('account_status'));
	   
		
		########################Image Upload###########################
	  if($_FILES['image_upload']['name']!='')
	 {
		$file_name = $_FILES['image_upload']['name'];
    $file_size = $_FILES['image_upload']['size'];
    $file_type = $_FILES['image_upload']['type'];
    $temp_name = $_FILES['image_upload']['tmp_name'];
    $ext = pathinfo($_FILES['image_upload']['name'])['extension'];
	$user_id=md5(uniqid(rand(), true));
    $location =  '../../viaspot_users/images';
    $image = $user_id . '' . rand() . '.' . $ext;
    $uploaded = move_uploaded_file($temp_name, __DIR__.DIRECTORY_SEPARATOR.$location . DIRECTORY_SEPARATOR .  $image);
	
	 }
	 else 
	 {
		$image =''; 
	 }
	########################Image Upload###########################
	########################Video Upload###########################
	  if($_FILES['video_upload']['name']!='')
	 {
   $file_name = $_FILES['video_upload']['name'];
    $file_size = $_FILES['video_upload']['size'];
    $file_type = $_FILES['video_upload']['type'];
    $temp_name = $_FILES['video_upload']['tmp_name'];
    $ext = pathinfo($_FILES['video_upload']['name'])['extension'];
	$user_id=md5(uniqid(rand(), true));
    $location =  '../../viaspot_users';
    $video = $user_id . '' . rand() . '.' . $ext;
	 
    $uploaded = move_uploaded_file($temp_name, __DIR__.DIRECTORY_SEPARATOR.$location . DIRECTORY_SEPARATOR . $video);
	 }
	 
	 else
	 {
		 $video ='';
	 }
	########################Video Upload###########################
         date_default_timezone_set("UTC");
		 $date=date('Y-m-d H:i:s');
		 $description=$this->input->post('description');
		 $description=str_ireplace('<p>','',$description);
		 $description=str_ireplace('</p>','',$description);
        $data = array(
          'data'=>array('user_id'=>$this->input->post('user_id'),'account_name'=>$this->input->post('accountname'),'payment_status'=>$this->input->post('paid_status'),'category'=>$this->input->post('category'),'account_status'=>$this->input->post('account_status'),'account_status'=>$account_status,'description'=>$description,'image'=>$image,'video'=>$video,'url'=>$url,'date'=>$date),
          'table'=>'account_tbl' 
        );                  
		
		 
        $response = $this->usersmodel->insert($data);                
            if($response>0)
            {
                $this->data['response']['title'] = 'Suceessfully saved';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> New Feed Added Successfully!
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
            'table'=>'account_tbl'
        );
        $this->data['account'] = $this->usersmodel->fetch_row($data);        
    $config = array(
		 array(
                'field' => 'account_name',
                'label' => 'Account Name',
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
          $this->load->view('business-edit', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
		  
		 ########################Image Upload###########################
  if($_FILES['image_upload_updates']['name']!='')
	 {
		$file_name = $_FILES['image_upload_updates']['name'];
    $file_size = $_FILES['image_upload_updates']['size'];
    $file_type = $_FILES['image_upload_updates']['type'];
    $temp_name = $_FILES['image_upload_updates']['tmp_name'];
    $ext = pathinfo($_FILES['image_upload_updates']['name'])['extension'];
	$user_id=md5(uniqid(rand(), true));
    $location =  '../../viaspot_users/images';
    $image = $user_id . '' . rand() . '.' . $ext;
    $uploaded = move_uploaded_file($temp_name, __DIR__.DIRECTORY_SEPARATOR.$location . DIRECTORY_SEPARATOR .  $image);
	 }
	########################Image Upload###########################
	########################Video Upload###########################
	 if($_FILES['video_upload_updates']['name']!='')
	 {
   $file_name = $_FILES['video_upload_updates']['name'];
    $file_size = $_FILES['video_upload_updates']['size'];
    $file_type = $_FILES['video_upload_updates']['type'];
    $temp_name = $_FILES['video_upload_updates']['tmp_name'];
    $ext = pathinfo($_FILES['video_upload_updates']['name'])['extension'];
	$user_id=md5(uniqid(rand(), true));
    $location =  '../../viaspot_users';
    $video =  $user_id . '' . rand() . '.' . $ext;
    $uploaded = move_uploaded_file($temp_name, __DIR__.DIRECTORY_SEPARATOR.$location . DIRECTORY_SEPARATOR . $video);
	 }
	  if($this->input->post('youtube')!=''    )
		{
		$url = parse_url($this->input->post('youtube'));
       if($url['scheme'] != 'https') 
	   $url='https://'.$this->input->post('youtube');
   else 
	  $url=$this->input->post('youtube'); 
		}
	########################Video Upload###########################
      $account_status=implode(',',$this->input->post('account_status'));
      date_default_timezone_set("UTC");
     $date=date('Y-m-d H:i:s');
      
        $description=$this->input->post('description');
		 $description=str_ireplace('<p>','',$description);
		 $description=str_ireplace('</p>','',$description);
        $query = "UPDATE account_tbl SET user_id='".$this->input->post('user_id')."',  account_name='".$this->input->post('account_name')."', 
		payment_status='".$this->input->post('paid_status')."', category='".$this->input->post('category')."', account_status='".$account_status."'
		 ,description='".$description. "' ,updated_date='$date',url='$url'   ";
		  if($_FILES['image_upload_updates']['name']!='')
	 {
		$query .= " , image='".$image. "'"; 
	 }
	 	  if($_FILES['video_upload_updates']['name']!='')
	 {
		 $query .= " ,  video='".$video. "'"; 
	 }
	 
		 $query .= "  WHERE id='".$id."'";
		 
		   
  
        $response = $this->usersmodel->update_query($query);                
            if($response>0)
            {
                $this->data['response']['title'] = 'Successfully Edited';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> feed Updated Successfully!
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
            $query = "UPDATE `account_tbl` SET `status` = IF(`status`=1,0,1) WHERE `account_tbl`.`id` ='".$id."'";
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
        $response = $this->usersmodel->update_query("DELETE FROM account_tbl WHERE id='".$id."'");
        redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect(base_url());
        }
    }
    
      public function validExt($ext ,$vext) {
 
        if (in_array($vext,array('mp4','mp3'))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validExt', 'Video must be in mp4 or mp3 format');
            return FALSE;
        }
    }
    public function validimgExt($ext ,$vext) {
 
        if (in_array($vext,array('jpg','png','jpeg'))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validimgExt', 'Image must be in JPG or PNG format');
            return FALSE;
        }
    }
	
}
