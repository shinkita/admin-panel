<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function load_data() {
        //$this->load->model('users');
        $lm_end = 10;
        $where = $this->input->post('where');
        $lm_start = $this->input->post('start_page');
        $data = array(
            'start' => $lm_start,
            'end' => $lm_end,
            'join' => array(
                array(
                    'table' => 'user_detail',
                    'on' => 'user_detail.user_id=users.id'
                )
            ),
            'select' => 'users.id,email,country_code,mobile,activated,users.date_time,users.source,user_detail.name'
        );
        if ($where != null && $where != '') {
            $data['where'] = $where;
        }
        $data_users = $this->usersmodel->search_users($data);
        unset($data['start']);
        unset($data['end']);
        $count_users = count($this->usersmodel->search_users($data));
        $page = ($lm_start / $lm_end) + 1;
        $page = ($page >= 1) ? $page : 1;
        $config = array(
            'lm_start' => $lm_start,
            'lm_end' => $lm_end,
            'adjanst' => 2,
            'total_page' => ceil($count_users / $lm_end),
            'page' => $page
        );
        $sno = $lm_start + 1;
        $Out_put = '<table class="table table-striped table-hover">      
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Code</th>
                                    <th>Mobile</th>
                                    <th>Register Date</th>
									<th>Source</th>
                                    <th>Status</th>                                    
                                </tr>
                            </thead>
                            <tbody>';
        if (!(count($data_users) > 0)) {
            $Out_put .= '<tr><td colspan="6">No data found</td></tr>';
        }
        foreach ($data_users as $key => $array) {
            $status = ($array['activated'] == 1) ? '<i class="icon-bulb" style="color:green;"></i>' : '<i class="icon-bulb" style="color:red;"></i>';
            $profile_link = base_url() . 'users/profile/' . $array['id'];
            $Out_put .= '<tr>
                <td><a href="' . $profile_link . '">' . $sno . '</a></td>
                <td><a href="' . $profile_link . '">' . $array['name'] . '</a></td>
                <td><a href="' . $profile_link . '">' . $array['email'] . '</a></td>
                <td><a href="' . $profile_link . '">+' . $array['country_code'] . '</a></td>
                <td><a href="' . $profile_link . '">' . $array['mobile'] . '</a></td>
                <!--td><a href="' . $profile_link . '">' . date('d-m-Y H:i:s', strtotime($array['date_time'])) . '</a></td-->
				<td><a href="' . $profile_link . '">' . date('m/Y/d H:i:s', strtotime($array['date_time'])) . '</a></td>
			 
				<td><a href="' . $profile_link . '">' . $array['source'] . '</a></td>
                <td><button onclick="active('.$array['id'].',this)">' . $status . '</button></td>                
            </tr>';
            $sno++;
        }
        $Out_put .= '</tbody>                
                </table>';
        $Out_put .= '<div class="pull-right">Showing ' . --$sno . ' of ' . $count_users . ' Items </div>';
        $Out_put .= '<nav aria-label="Page navigation example">
                <ul class="pagination">';
        if ($config['total_page'] > 1) {
            $Out_put .= '<li class="page-item"><a href="#" class="page-link" onclick="load_user()">First</a></li>';

            if ($config['total_page'] <= (($config['adjanst'] * 2) + 1)) {
                for ($i = 0; $i < $config['total_page']; $i++) {
                    $active = '';
                    if ($config['page'] == ($i + 1)) {
                        //print_r($config);
                        $active = 'active';
                    }
                    $Out_put .= '<li class="page-item ' . $active . '"><a href="#" class="page-link" onclick="load_user(' . ($i * 10) . ')">' . ($i + 1) . '</a></li>';
                } 
            } else {
                if ($config['page'] <= $config['adjanst']) {
                    $start = 1;
                    $end = ($config['adjanst'] * 2) + 1;
                } elseif ($config['page'] <= $config['total_page'] && ($config['total_page'] - $config['page']) < $config['adjanst']) {
                    $start = $config['total_page'] - ($config['adjanst'] * 2);
                    $end = $config['total_page'];
                } else {
                    $start = $config['page'] - $config['adjanst'];
                    $end = $config['page'] + $config['adjanst'];
                }
                for ($i = $start; $i <= $end; $i++) {
                    $active = '';
                    if ($config['page'] == $i) {
                        $active = 'active';
                    }
                    $page_val = $i;
                    $out = ($page_val-1)*10;
                    $Out_put .= '<li class="page-item ' . $active . '"><a href="#" class="page-link" onclick="load_user(' . $out . ')">' . $page_val . '</a></li>';
                }
            }
            if ($config['total_page'] > 1) {
                $last_page = ($config['total_page'] - 1) * $config['lm_end'];
                $Out_put .= '<li class="page-item"><a href="#" class="page-link" onclick="load_user(' . $last_page . ')">Last</a></li>';
            }
            $Out_put .= '</ul>
                    </nav>';
        }
        echo $Out_put;
        //echo $data_users;
    }
    public function deleted_load_data() {
        //$this->load->model('users');
        $lm_end = 10;
        $where = $this->input->post('where');

        $lm_start = $this->input->post('start_page');
        $data = array(
            'start' => $lm_start,
            'end' => $lm_end,
            'join' => array(
                array(
                    'table' => 'user_detail',
                    'on' => 'user_detail.user_id=b_users.user_id'
                )
            ),
            'select' => 'b_users.user_id as id,email,country_code,mobile,activated,b_users.date_time,user_detail.name'
        );
        if ($where != null && $where != '') {
            $data['where'] = $where;
        }
        // print_r($data['where']);die();
		
        $data_users = $this->usersmodel->search_dusers($data);
        unset($data['start']);
        unset($data['end']);
        $count_users = count($this->usersmodel->search_dusers($data));
        $page = ($lm_start / $lm_end) + 1;
        $page = ($page >= 1) ? $page : 1;
        $config = array(
            'lm_start' => $lm_start,
            'lm_end' => $lm_end,
            'adjanst' => 2,
            'total_page' => ceil($count_users / $lm_end),
            'page' => $page
        );
        $sno = $lm_start + 1;
        $Out_put = '<table class="table table-striped table-hover">      
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Code</th>
                                    <th>Mobile</th>
                                    <th>Register Date</th>
                                    <th>Status</th>                                    
                                </tr>
                            </thead>
                            <tbody>';
        if (!(count($data_users) > 0)) {
            $Out_put .= '<tr><td colspan="6">No data found</td></tr>';
        }
        foreach ($data_users as $key => $array) {
            $status = ($array['activated'] == 1) ? '<i class="icon-bulb" style="color:green;"></i>' : '<i class="icon-bulb" style="color:red;"></i>';
            $profile_link = base_url() . 'deleted_users/profile/' . $array['id'];
            $Out_put .= '<tr>
                <td><a href="' . $profile_link . '">' . $sno . '</a></td>
                <td><a href="' . $profile_link . '">' . $array['name'] . '</a></td>
                <td><a href="' . $profile_link . '">' . $array['email'] . '</a></td>
                <td><a href="' . $profile_link . '">+' . $array['country_code'] . '</a></td>
                <td><a href="' . $profile_link . '">' . $array['mobile'] . '</a></td>
                <td><a href="' . $profile_link . '">' . date('m/Y/d H:i:s', strtotime($array['date_time'])) . '</a></td>
                <td><button onclick="active('.$array['id'].',this)">' . $status . '</button></td>                
            </tr>';
            $sno++;
        }
        $Out_put .= '</tbody>                
                </table>';
        $Out_put .= '<div class="pull-right">Showing ' . --$sno . ' of ' . $count_users . ' Items </div>';
        $Out_put .= '<nav aria-label="Page navigation example">
                <ul class="pagination">';
        if ($config['total_page'] > 1) {
            $Out_put .= '<li class="page-item"><a href="#" class="page-link" onclick="load_user()">First</a></li>';

            if ($config['total_page'] <= (($config['adjanst'] * 2) + 1)) {
                for ($i = 0; $i < $config['total_page']; $i++) {
                    $active = '';
                    if ($config['page'] == ($i + 1)) {
                        //print_r($config);
                        $active = 'active';
                    }
                    $Out_put .= '<li class="page-item ' . $active . '"><a href="#" class="page-link" onclick="load_user(' . ($i * 10) . ')">' . ($i + 1) . '</a></li>';
                } 
            } else {
                if ($config['page'] <= $config['adjanst']) {
                    $start = 1;
                    $end = ($config['adjanst'] * 2) + 1;
                } elseif ($config['page'] <= $config['total_page'] && ($config['total_page'] - $config['page']) < $config['adjanst']) {
                    $start = $config['total_page'] - ($config['adjanst'] * 2);
                    $end = $config['total_page'];
                } else {
                    $start = $config['page'] - $config['adjanst'];
                    $end = $config['page'] + $config['adjanst'];
                }
                for ($i = $start; $i <= $end; $i++) {
                    $active = '';
                    if ($config['page'] == $i) {
                        $active = 'active';
                    }
                    $page_val = $i;
                    $out = ($page_val-1)*10;
                    $Out_put .= '<li class="page-item ' . $active . '"><a href="#" class="page-link" onclick="load_user(' . $out . ')">' . $page_val . '</a></li>';
                }
            }
            if ($config['total_page'] > 1) {
                $last_page = ($config['total_page'] - 1) * $config['lm_end'];
                $Out_put .= '<li class="page-item"><a href="#" class="page-link" onclick="load_user(' . $last_page . ')">Last</a></li>';
            }
            $Out_put .= '</ul>
                    </nav>';
        }
        echo $Out_put;
        //echo $data_users;
    }

    public function send_mail() {
        try {
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'viaspot.com',
                'smtp_user' => 'welcome@viaspot.com',
                'smtp_pass' => 'writeus@viaspot',
                'smtp_port' => '465',
                'smtp_timeout' => '5',
                'smtp_crypto' => 'ssl',
                'mailtype' => 'text',
                'charset' => 'iso-8859-1',
                'validate' => TRUE,
                'priority' => 1,
                'crlf' => "\r\n",
                'newline' => "\r\n",
            );            
            $this->load->library('email', $config);
            $this->load->initialize($config);
            $this->email->from('welcome@viaspot.com', 'Viaspot Admin');
            $this->email->to($_POST['email']);
            $this->email->subject('Viaspot info');
            $this->email->message($_POST['message']);
            $data = array(
              'data'=>array('user_id'=>$_POST['viasp-vc'],'email_id'=>$_POST['email'],'msg'=>addslashes($_POST['message']),'status'=>'unknown'),
              'table'=>'mail_history' 
            );                  
            $response = $this->usersmodel->insert($data);
            $insert_id = $this->db->insert_id(); 
            if ($this->email->send()) {
                $query = "UPDATE mail_history SET status='Successful' WHERE id='".$insert_id."'";

            $update = $this->usersmodel->update_query($query); 
                $result = array(
                    'status' => true,
                    'msg' => 'Email sent successfully'
                );

                echo json_encode($result);
            }
        } catch (Exception $ex) {
            $result = array(
                'status' => false,
                'msg' => 'Something wrong' . $ex->msg()
            );
            echo json_encode($result);
        }
    }

    public function paging($config) {
//        $config['start'];
//        $config['record_per_page'];
//        $config['adjanst'];
//        $config['total_record'];
        $total_page = $config['total_record'] / $config['record_per_page'];
    }
    public function active(){
        $id = $this->input->post('id');
        $data = array(
            'where'=>" id='".$id."' " 
        );
        $user = $this->usersmodel->get_row($data);
        $active = ($user['activated']==0)?1:0;
        $icon = ($user['activated']==0)?'<i class="icon-bulb" style="color:green;"></i>':'<i class="icon-bulb" style="color:red;"></i>';        
        $query = $this->usersmodel->update_query("UPDATE users SET activated='".$active."' WHERE id='".$id."'");
        if($query>0)
        {
            echo json_encode(array('status'=>TRUE,'icon'=>$icon));
        }
        else
        {
            echo json_encode(array('status'=>False,'icon'=>$icon));
        }
    }
}
