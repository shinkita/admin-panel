<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    var $data;
    public function __construct() {
        parent::__construct();
        $this->load->library('Header');
        if (!($this->session->has_userdata('via-spot_admin'))) {
            redirect(base_url() . 'auth/login');            
        }
        $this->data['gallary_path'] = 'https://www.viaspot.com/vsdeveloper/api/viaspot_users/';
        $this->data['active_list'] = 'Users';
        $this->data['admin_user'] = $this->session->userdata('via-spot_admin');
    }

    public function index() {        
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('users', $this->data);
        $this->load->view('app-footer', $this->data);
    }   
    public function profile($id)
    {
        $data = array(
            'where'=>array('users.id'=>$id),
            'select'=>'*,user_detail.interest',
            'join'=>array(array('table'=>'user_detail','on'=>'users.id=user_detail.user_id','type'=>'LEFT'),array('table'=>'(SELECT * FROM `login_history` ORDER BY `date_time` DESC) as login_history','on'=>'users.id=login_history.user_id','type'=>'LEFT'))
        );
        $this->data['user_id']= $id;
        $this->data['user_profile'] = $this->usersmodel->get_row($data);
        $this->data['profile_pic'] = $this->usersmodel->fetch_query("SELECT * FROM profile_pic WHERE user_id='".$id."'");
        $this->data['horoscope'] = self::horoscope($id);
        //print_r($user);      
        $this->data['friend_list'] = $this->usersmodel->fetch_query("SELECT profile_type,COUNT(*) FROM friends_list WHERE (user_id = '$id' OR friends_id = '$id') AND approved=1 GROUP BY profile_type ORDER BY profile_type");
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-profile', $this->data);
        $this->load->view('app-footer', $this->data);
        //$this->load->model('users');
    }
    public function photos($id,$page=0){
        $query_extend = '';        
        if(isset($_SESSION['profile_type']) && $_SESSION['profile_type'] != 0)
        {
          $query_extend = " AND profile_type='".$_SESSION['profile_type']."' ";
          $this->data['profile_type'] = $_SESSION['profile_type'];
        }       
        else
        {
          $this->data['profile_type'] = 0;
        } 
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM post WHERE user_id='$id' AND post_type = '2' ".$query_extend."");
        $this->data['user_id']= $id;       
        $this->data['user_profile_link']= base_url().'users/profile/'.$id;        
        $this->data['count_photo'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/photos/'.$id.'/';
        $config['total_rows'] = $this->data['count_photo'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';                
        $query = "SELECT id, images, date_time, profile_type, method, deleted FROM post WHERE user_id='$id' AND post_type = '2' ".$query_extend." ORDER BY id DESC LIMIT $page, $config[per_page]";
        // $config['use_page_numbers'] = TRUE;
        $this->data['photos'] = $this->usersmodel->fetch_query($query);
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-images', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function friends($id){
        $this->data['user_profile_link']= base_url().'users/profile/'.$id;      
        $query_extend = '';        
        if(isset($_SESSION['profile_type']) && $_SESSION['profile_type'] != 0)
        {
          $query_extend = " AND profile_type='".$_SESSION['profile_type']."' ";
          $this->data['profile_type'] = $_SESSION['profile_type'];
        }       
        else
        {
          $this->data['profile_type'] = 0;
        } 
        $que = "SELECT DISTINCT user_id,friends_id FROM friends_list WHERE (user_id = '".$id."' OR friends_id = '".$id."') AND approved=1 ";
        $list = array();
        $friend_list = $this->usersmodel->fetch_query($que);
        foreach ($friend_list as $row)
        {
        if(!in_array($row['friends_id'], $list))
          {
            $list[] = $row['friends_id'];
          }
          if(!in_array($row['user_id'], $list))
          {
            $list[] = $row['user_id'];
          }
        }   
        $this->data['user_id']= $id;
        $list = array_diff($list, array($id));
        if(count($list)>0)
        {
        $query = "SELECT user_detail.user_id AS id,name,profile_pic.profile_pic AS user_pic,
        IF (
            (SELECT approved FROM friends_list WHERE (
                user_id = '".$id."' OR friends_id = '".$id."'
            ) AND (
                user_id = user_detail.user_id OR friends_id = user_detail.user_id
            ) AND approved=1 AND profile_type=1 LIMIT 1
        )=1,1,0) AS isFriend, 
        IF ((
            SELECT approved FROM friends_list WHERE (user_id = '".$id."' OR friends_id = '".$id."') AND (user_id = user_detail.user_id OR friends_id = user_detail.user_id) AND approved=1 AND profile_type=2 LIMIT 1)=1,1,0) AS isFamily, IF ((SELECT approved FROM friends_list WHERE (user_id = '".$id."' OR friends_id = '".$id."') AND (user_id = user_detail.user_id OR friends_id = user_detail.user_id) AND approved=1 AND profile_type=3 LIMIT 1)=1,1,0) AS isProfessional  FROM user_detail JOIN profile_pic ON user_detail.user_id = profile_pic.user_id AND profile_pic.profile_type=(CASE WHEN (SELECT approved FROM friends_list WHERE (user_id = '".$id."' OR friends_id = '".$id."') AND (user_id = user_detail.user_id OR friends_id = user_detail.user_id) AND approved=1 AND profile_type=1 LIMIT 1)=1 THEN 1 WHEN (SELECT approved FROM friends_list WHERE (user_id = '".$id."' OR friends_id = '".$id."') AND (user_id = user_detail.user_id OR friends_id = user_detail.user_id) AND approved=1 AND profile_type=2 LIMIT 1)=1 THEN 2 ELSE 3 END) WHERE user_detail.user_id IN (".implode(',',$list).")";
        $this->data['friends'] = $this->usersmodel->fetch_query($query);       
        }
        else
        {
            $this->data['friends'] = [];
        } 
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-friends', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function group($id,$page=0){
      $this->data['user_profile_link']= base_url().'users/profile/'.$id;      
      $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM group_users WHERE user_id='$id'");        
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $this->data['user_id']= $id;
        $config['base_url'] = base_url().'users/group/'.$id.'/';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
      $query = "SELECT * FROM group_users LEFT JOIN chat_groups ON chat_groups.id=group_users.group_id  WHERE group_users.user_id='".$id."' LIMIT $page, $config[per_page]";
        $this->data['groups'] = $this->usersmodel->fetch_query($query); 
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();              
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-groups', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function videos($id,$page=0){
      $this->data['user_profile_link']= base_url().'users/profile/'.$id;      
        $query_extend = '';        
        if(isset($_SESSION['profile_type']) && $_SESSION['profile_type'] != 0)
        {
          $query_extend = " AND profile_type='".$_SESSION['profile_type']."' ";
          $this->data['profile_type'] = $_SESSION['profile_type'];
        }       
        else
        {
          $this->data['profile_type'] = 0;
        }
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM post WHERE user_id='$id' AND post_type = '3' ".$query_extend."");
        $this->data['user_id']= $id;        
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/videos/'.$id.'/';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT * FROM post WHERE post_type=3 AND user_id='$id' ".$query_extend." ORDER BY id DESC LIMIT $page, $config[per_page]";
        $this->data['videos'] = $this->usersmodel->fetch_query($query);   
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();    
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-videos', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function view_event($id){
    	  $query = "SELECT *,event_module.id AS id,(SELECT COUNT(user_id) FROM event_module_attand WHERE event_id=event_module.id) AS attanding_users FROM event_module LEFT JOIN user_detail ON user_detail.user_id=event_module.user_id JOIN profile_pic ON profile_pic.user_id=event_module.user_id AND profile_pic.profile_type='3' AND event_module.id='".$id."'";
        // echo $query;
        $this->data['events'] = $this->usersmodel->fetch_query_row($query); 
        $this->data['horoscope'] = self::horoscope($id);
        //print_r($user);      
        $this->data['attanding_list'] = $this->usersmodel->fetch_query("SELECT user_detail.user_id,profile_pic.profile_pic FROM event_module_attand LEFT JOIN user_detail ON user_detail.user_id=event_module_attand.user_id  JOIN profile_pic ON profile_pic.user_id=event_module_attand.user_id AND profile_pic.profile_type='3' WHERE event_id='".$id."'");
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-profile-view-event', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function events($id,$page=0){

    
      $this->data['user_profile_link']= base_url().'users/profile/'.$id;  
      $query_extend = '';        
        if(isset($_SESSION['profile_type']) && $_SESSION['profile_type'] != 0)
        {
          $query_extend = " AND post.profile_type='".$_SESSION['profile_type']."' ";
          $this->data['profile_type'] = $_SESSION['profile_type'];
        }       
        else
        {
          $this->data['profile_type'] = 0;
        }
      $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM event_module WHERE event_module.user_id='$id' ");      
      $this->data['user_id']= $id;  
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/events/'.$id.'/';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT *,event_module.id AS id,(SELECT COUNT(user_id) FROM event_module_attand WHERE event_id=event_module.id) AS attanding_users FROM event_module LEFT JOIN user_detail ON user_detail.user_id=event_module.user_id WHERE event_module.user_id=$id ORDER BY event_module.id DESC LIMIT $page, $config[per_page]";
        $this->data['events'] = $this->usersmodel->fetch_query($query); 
        if(count($this->data['events']>0))
        {
            foreach ($this->data['events'] as $key => $value) {
                $query = "SELECT event_module_attand.user_id AS user_id, profile_pic.profile_pic AS profile_pic, user_detail.name AS name FROM event_module_attand JOIN user_detail ON user_detail.user_id=event_module_attand.user_id JOIN profile_pic ON profile_pic.user_id=event_module_attand.user_id AND profile_pic.profile_type='3' WHERE event_id='".$value['id']."'";
                $this->data['events'][$key]['user_detail'] = $this->usersmodel->fetch_query($query);
            }
        }
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-events', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function profile_photo($page=0)
    {
      $query_extend = '';        
        if(isset($_SESSION['profile_type']) && $_SESSION['profile_type'] != 0)
        {
          $query_extend = " AND profile_type='".$_SESSION['profile_type']."' ";
          $this->data['profile_type'] = $_SESSION['profile_type'];
        }       
        else
        {
          $this->data['profile_type'] = 0;
        } 
        $this->data['active_list'] = 'Profile_pages';
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM post WHERE post_type = '2' ".$query_extend."");   
        $this->data['count_photo'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/profile_photo/';
        $config['total_rows'] = $this->data['count_photo'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';                
        $query = "SELECT post.id as id, images, post.date_time, profile_type, method, post.deleted, user_detail.name as name1,user_detail.user_id FROM post LEFT JOIN user_detail ON post.user_id=user_detail.user_id WHERE post_type = '2' ".$query_extend." ORDER BY post.id DESC LIMIT $page, $config[per_page]";
        // $config['use_page_numbers'] = TRUE;
        $this->data['photos'] = $this->usersmodel->fetch_query($query);
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-profile-images', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function profile_video($page=0)
    {           
        $query_extend = '';        
        if(isset($_SESSION['profile_type']) && $_SESSION['profile_type'] != 0)
        {
          $query_extend = " AND profile_type='".$_SESSION['profile_type']."' ";
          $this->data['profile_type'] = $_SESSION['profile_type'];
        }       
        else
        {
          $this->data['profile_type'] = 0;
        }
        $this->data['active_list'] = 'Profile_pages';
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM post WHERE post_type = '3' ".$query_extend."");             
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/profile_video';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT *,post.id as id,post.deleted AS deleted,user_detail.user_id FROM post LEFT JOIN user_detail ON post.user_id=user_detail.user_id WHERE post_type=3 ".$query_extend." ORDER BY post.id DESC LIMIT $page, $config[per_page]";
        $this->data['videos'] = $this->usersmodel->fetch_query($query);   
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();    
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-profile-video', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function profile_events($page=0){      
      $this->data['active_list'] = 'Profile_pages';
      $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM event_module");            
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/profile_events';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT *,event_module.id AS id,event_module.user_id AS user_id,(SELECT COUNT(user_id) FROM event_module_attand WHERE event_id=event_module.id) AS attanding_users FROM event_module LEFT JOIN user_detail ON user_detail.user_id=event_module.user_id ORDER BY event_module.id DESC LIMIT $page, $config[per_page]";
        // echo $query;
        $this->data['events'] = $this->usersmodel->fetch_query($query); 
        // print_r($this->data['events']);
        if(count($this->data['events']>0))
        {
            foreach ($this->data['events'] as $key => $value) {
                $query = "SELECT event_module_attand.user_id AS user_id,event_module_attand.id AS event_id,user_detail.name AS name, profile_pic.profile_pic AS profile_pic FROM event_module_attand JOIN user_detail ON user_detail.user_id=event_module_attand.user_id JOIN profile_pic ON profile_pic.user_id=event_module_attand.user_id AND profile_pic.profile_type='3' WHERE event_id='".$value['id']."'";
                $this->data['events'][$key]['user_detail'] = $this->usersmodel->fetch_query($query);
            }
        }
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-profile-events', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function term_condition()
    {
      $this->data['active_list'] = 'term_condition';

        $query = "SELECT * FROM tbl_headerbox1";
        $this->data['term'] = $this->usersmodel->fetch_query($query);         
        $config = array(
            array(
                'field' => 'term',
                'label' => 'Term & condition',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {     
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('term-condition', $this->data);
          $this->load->view('app-footer', $this->data);
        }
      else
      {                 
        $response = $this->usersmodel->update_query("UPDATE  tbl_headerbox1 SET headerdesc1='".$_POST['term']."'");                
            if($response>0)
            {
                   $this->data['response'] = "<div class='alert alert-success'>
                                              <strong>Updated</strong> Term & condition updated succefully!
                                            </div>";        
            }
            $query = "SELECT * FROM tbl_headerbox1";
        $this->data['term'] = $this->usersmodel->fetch_query($query); 
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('term-condition', $this->data);
        $this->load->view('app-footer', $this->data);       
      }
    }
     public function faq($page=0)
    {
        $this->data['active_list'] = 'faq';
        $this->data['sno'] = $page+1;
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM faq_tbl");            
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/faq';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT * FROM faq_tbl ORDER BY position_no ASC LIMIT $page, $config[per_page]";
        $this->data['faq'] = $this->usersmodel->fetch_query($query); 
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-faq', $this->data);
        $this->load->view('app-footer', $this->data);
    }
    public function new_faq()
    {
        $this->data['active_list'] = 'faq';
      $config = array(
            array(
                'field' => 'position',
                'label' => 'Position',
                'rules' => 'required|is_unique[faq_tbl.position_no]'
            ),
            array(
                'field' => 'question',
                'label' => 'Question',
                'rules' => 'required'
            ),
            array(
                'field' => 'answer',
                'label' => 'Answer',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {               
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('faq-new', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
        // echo 'inserted';exit;
        $data = array(
          'data'=>array('position_no'=>$this->input->post('position'),'faq_question'=>$this->input->post('question'),'faq_answer'=>$this->input->post('answer'),'status'=>'1','is_deleted'=>0),
          'table'=>'faq_tbl' 
        );                  
        $response = $this->usersmodel->insert($data);                
            if($response>0)
            {
                $this->data['response']['title'] = 'Suceessfully saved';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> New Faq Added Successfully!
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
    public function edit_faq($id)
    {
        $this->data['active_list'] = 'faq';
        $data = array(
            'where'=>array('id'=>$id),            
            'table'=>'faq_tbl'
        );
        $this->data['faq'] = $this->usersmodel->fetch_row($data);        
      $config = array(
            array(
                'field' => 'position',
                'label' => 'Position',
                'rules' => 'required'
            ),
            array(
                'field' => 'question',
                'label' => 'Question',
                'rules' => 'required'
            ),
            array(
                'field' => 'answer',
                'label' => 'Answer',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {               
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('faq-edit', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
        // echo 'inserted';exit;
        $query = "UPDATE faq_tbl SET position_no='".$this->input->post('position')."', faq_question='".$this->input->post('question')."', faq_answer='".$this->input->post('answer')."', status='".$this->input->post('status')."' WHERE id='".$id."'  ";
        $response = $this->usersmodel->update_query($query);                
            if($response>0)
            {
                $this->data['response']['title'] = 'Successfully Edited';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> New Faq Added Successfully!
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
    public function deactive_event($id)
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $query = "UPDATE `event_module` SET `cancelled` = IF (`cancelled`, 0, 1) WHERE `event_module`.`id` ='".$id."'";
            $response = $this->usersmodel->update_query($query);
            redirect($_SERVER['HTTP_REFERER']); 
        }
        else
        {
            redirect(base_url());
        }
    }
    public function deactive_faq($id)
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $query = "UPDATE `faq_tbl` SET `status` = IF(`status`=1,0,1) WHERE `faq_tbl`.`id` ='".$id."'";
            $response = $this->usersmodel->update_query($query);
            redirect($_SERVER['HTTP_REFERER']); 
        }
        else
        {
            redirect(base_url());
        }
    }
    public function deactive_post($id)
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
        $response = $this->usersmodel->update_query("UPDATE  post SET deleted='1' WHERE id='".$id."'");
        redirect($_SERVER['HTTP_REFERER']); 
        }
        else
        {
            redirect(base_url());
        }
    }
    public function deactive_images($id,$img_key)
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $img_ob = $this->usersmodel->fetch_row(
                array(
                    'where'=>'id="'.$id.'"',
                    'table'=>'post'
                )
            );
            // print_r($img_ob['images']);
            $images = json_decode( $img_ob['images'] );
            $pop_im = $images[$img_key];
            $insert = $this->usersmodel->insert(array(
                    'table'=>'b_images',
                    'data'=>array(
                        'post_id'=>$id,
                        'user_id'=>$img_ob['user_id'],
                        'image'=>$pop_im,
                    )
                )
            );
            unset($images[$img_key]);
            $update = $this->usersmodel->update_query("UPDATE post SET images='".json_encode( $images )."' WHERE id='".$id."'");
            // $response = $this->usersmodel->update_query("UPDATE  post SET deleted='1' WHERE id='".$id."'");
            redirect($_SERVER['HTTP_REFERER']); 
        }
        else
        {
            redirect(base_url());
        }
    }
    public function active_post($id)
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
        $response = $this->usersmodel->update_query("UPDATE  post SET deleted='0' WHERE id='".$id."'");
        redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function active_event($id)
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
        $response = $this->usersmodel->update_query("UPDATE  event SET deleted='0' WHERE id='".$id."'");
        redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function delete_faq($id)
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
        $response = $this->usersmodel->update_query("DELETE FROM faq_tbl WHERE id='".$id."'");
        redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function horoscope($user_id)
    {
      $y=date('Y');
      $query = "SELECT user_detail.dob FROM users JOIN user_detail ON user_detail.user_id=users.id WHERE users.id='".$user_id."'";
      if($user = $this->usersmodel->fetch_query($query))
      {    
          if(!(count($user)>0))
          {
            return $horoscop = 'Unknown';
          }
          $dob = explode(',', $user[0]['dob']);
          $new_dob = new DateTime($dob[0].$y);  
          $Arise_start = new DateTime('21-03-'.$y);
          $Arise_end = new DateTime('20-04-'.$y);
          $Taurus_start = new DateTime('21-04-'.$y);
          $Taurus_end = new DateTime('20-05-'.$y);
          $Gemini_start = new DateTime('21-05-'.$y);
          $Gemini_end = new DateTime('20-06-'.$y);
          $Cancer_start = new DateTime('21-06-'.$y);
          $Cancer_end = new DateTime('20-07-'.$y);
          $Leo_start = new DateTime('21-07-'.$y);
          $Leo_end = new DateTime('20-08-'.$y);
          $Virgo_start = new DateTime('21-08-'.$y);
          $Virgo_end = new DateTime('20-09-'.$y);
          $Libra_start = new DateTime('21-09-'.$y);
          $Libra_end = new DateTime('20-10-'.$y);
          $Scorpio_start = new DateTime('21-10-'.$y);
          $Scorpio_end = new DateTime('20-11-'.$y);
          $Sagittarius_start = new DateTime('21-11-'.$y);
          $Sagittarius_end = new DateTime('20-12-'.$y);
          $Capricorn_start = new DateTime('21-12-'.$y);
          $Capricorn_end = new DateTime('20-01-'.$y);
          $Aquarius_start = new DateTime('21-01-'.$y);
          $Aquarius_end = new DateTime('20-02-'.$y);
          $Pisces_start = new DateTime('21-02-'.$y);
          $Pisces_end = new DateTime('20-03-'.$y);
          if($new_dob > $Arise_start && $new_dob < $Arise_end)
          {
            $horoscop = 'Arise';
          }
          elseif($new_dob > $Taurus_start && $new_dob <  $Taurus_end)
          {
            $horoscop = 'Taurus';
          }
          elseif($new_dob > $Gemini_start && $new_dob <  $Gemini_end)
          {
            $horoscop = 'Gemini';
          }
          elseif($new_dob > $Cancer_start && $new_dob <  $Cancer_end)
          {
            $horoscop = 'Cancer';
          }
          elseif($new_dob > $Leo_start && $new_dob <  $Leo_end)
          {
            $horoscop = 'Leo';
          }
          elseif($new_dob > $Virgo_start && $new_dob <  $Virgo_end)
          {
            $horoscop = 'Virgo';
          }
          elseif($new_dob > $Libra_start && $new_dob <  $Libra_end)
          {
            $horoscop = 'Libra';
          }
          elseif($new_dob > $Scorpio_start && $new_dob <  $Scorpio_end)
          {
            $horoscop = 'Scorpio';
          }
          elseif($new_dob > $Sagittarius_start && $new_dob <  $Sagittarius_end)
          {
            $horoscop = 'Sagittarius';
          }
          elseif($new_dob > $Capricorn_start && $new_dob <  $Capricorn_end)
          {
            $horoscop = 'Capricorn';
          }
          elseif($new_dob > $Aquarius_start && $new_dob <  $Aquarius_end)
          {
            $horoscop = 'Aquarius';
          }
          elseif($new_dob > $Taurus_start && $new_dob <  $Taurus_end)
          {
            $horoscop = 'Pisces';
          }
          elseif($new_dob > $Pisces_start && $new_dob <  $Pisces_end)
          {
            $horoscop = 'Pisces';
          }
          else
          {
            $horoscop = 'Unknown';
          }
    }
    else
    {
      $horoscop = 'Unknown'; 
    }
    return $horoscop;
  }
  public function filture()
  {        
    if(isset($_POST['profile_type']))
        {
          $_SESSION['profile_type'] = $_POST['profile_type'];
        }
        redirect($_SERVER['HTTP_REFERER']);
  }
  public function contact_history($id,$page=0)
  {
     $this->data['user_contact_history']= base_url().'users/contact_history/'.$id;  
      $query_extend = '';        
      $count_photo = $this->usersmodel->fetch_query("SELECT COUNT(*) AS COUNT FROM mail_history WHERE user_id='$id' ");      
      $this->data['user_id']= $id;  
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'users/contact_history/'.$id.'/';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 20;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT * FROM mail_history WHERE user_id='$id' ORDER BY date_time DESC LIMIT $page, $config[per_page]";
        $this->data['emails'] = $this->usersmodel->fetch_query($query); 
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('user-contact-mail', $this->data);
        $this->load->view('app-footer', $this->data);
  }
}
