<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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

    public function index($page=0) {       	    	
    	 $this->data['active_list'] = 'faq';
        $this->data['sno'] = $page+1;
        $count_photo = $this->usersmodel->fetch_query("SELECT count(id) AS COUNT FROM interest_category_tbl");            
        $this->data['count_rows'] = $count_photo[0]['COUNT'];
        $config['base_url'] = base_url().'category/index';
        $config['total_rows'] = $this->data['count_rows'];
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div class="my-pagination">';
        $config['full_tag_close'] = '</div>';
        $query = "SELECT * FROM interest_category_tbl ORDER BY id ASC LIMIT $page, $config[per_page]";
        $this->data['faq'] = $this->usersmodel->fetch_query($query); 
        $this->pagination->initialize($config);
        $this->data['paging'] = $this->pagination->create_links();
        $this->load->view('app-header', $this->data);
        $this->load->view('app-sidebar', $this->data);
        $this->load->view('category', $this->data);
        $this->load->view('app-footer', $this->data);
    } 
	
	 public function new_category()
    {
        $this->data['active_list'] = 'faq';
 
		      $config = array(
            array(
                'field' => 'category',
                //'label' => 'Category',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {               
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('category-new', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
        // echo 'inserted';exit;
     
$data = array(
          'data'=>array('category_name'=>$this->input->post('category'),'status'=>'1'),
          'table'=>'interest_category_tbl' 
        );
          ##################check data if same name already exist############# 		
      $checked_query ="select * from  interest_category_tbl where category_name='".$this->input->post('category')."'";
		
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
                                              <strong>Success!</strong> New category Added Successfully!
                                            </div>";                 
            }
			else  if($checked_response>0)
            {
			   $this->data['response']['title'] = 'Alert';
             $this->data['response']['body'] = "<div class='alert alert-danger'>
                                              <strong>Alert!</strong> Category Name already exist . Please try again
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
     public function edit_category($id)
    {
		 
        $this->data['active_list'] = 'faq';
        $data = array(
            'where'=>array('id'=>$id),            
            'table'=>'interest_category_tbl'
        );
        $this->data['faq'] = $this->usersmodel->fetch_row($data);        
    
		$config = array(
            array(
                'field' => 'category', 
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {               
          $this->load->view('app-header', $this->data);
          $this->load->view('app-sidebar', $this->data);
          $this->load->view('category-edit', $this->data);
          $this->load->view('app-footer', $this->data); 
      }
      else
      {
        // echo 'inserted';exit;
		
		  ##################check data if same name already exist############# 		
      $checked_query ="select * from  interest_category_tbl where  BINARY category_name like '%".$this->input->post('category')."%'";
		
		 $checked_response = $this->usersmodel->count_query($checked_query );
		 ##################check data if same name already exist############# 
		 
		 
       $query = "UPDATE interest_category_tbl SET category_name='".$this->input->post('category')."' WHERE id='".$id."'  ";
	   
	   if($checked_response==0)
		$response = $this->usersmodel->update_query($query); 
         else
		$response =0; 		
            if($response>0)
            {
                $this->data['response']['title'] = 'Successfully Edited';
                $this->data['response']['body'] = "<div class='alert alert-success'>
                                              <strong>Success!</strong> category Modified Successfully!
                                            </div>";                 
            }
			else  if($checked_response>0)
            {
			   $this->data['response']['title'] = 'Alert';
             $this->data['response']['body'] = "<div class='alert alert-danger'>
                                              <strong>Alert!</strong> Category Name already exist . Please try again
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
	public function deactive_category($id)
    { 
        if(isset($_SERVER['HTTP_REFERER']))
        {
           $query = "UPDATE `interest_category_tbl` SET `status` = IF(`status`=1,0,1) WHERE `interest_category_tbl`.`id` ='".$id."'";
       $response = $this->usersmodel->update_query($query);
            redirect($_SERVER['HTTP_REFERER']); 
        }
        else
        {
            redirect(base_url());
        }
    }
	  public function delete_category($id)
    {
	 
        if(isset($_SERVER['HTTP_REFERER']))
        {
        $response = $this->usersmodel->update_query("DELETE FROM interest_category_tbl WHERE id='".$id."'");
        redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
            redirect(base_url());
        }
    }
}
