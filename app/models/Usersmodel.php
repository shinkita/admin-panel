<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usersmodel extends CI_Model {
    public $table = 'users';
    public $btable = 'b_users';
     public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
    public function get_row($data) {
        if (isset($data['select'])) {
            $this->db->select($data['select']);
        }
        if (isset($data['where'])) {
            $this->db->where($data['where']);
        }
        if (isset($data['join'])) {
            foreach ($data['join'] as $key => $value) {
                if (isset($value['type'])) {
                    $this->db->join($value['table'], $value['on'], $value['type']);
                } else {
                    $this->db->join($value['table'], $value['on']);
                }
            }
        }
        $query = $this->db->get($this->table, 1);
        //echo $this->db->last_query();
        return $query->row_array();
    }
    public function dget_row($data) {
        if (isset($data['select'])) {
            $this->db->select($data['select']);
        }
        if (isset($data['where'])) {
            $this->db->where($data['where']);
        }
        if (isset($data['join'])) {
            foreach ($data['join'] as $key => $value) {
                if (isset($value['type'])) {
                    $this->db->join($value['table'], $value['on'], $value['type']);
                } else {
                    $this->db->join($value['table'], $value['on']);
                }
            }
        }
        $query = $this->db->get('b_users', 1);
        //echo $this->db->last_query();
        return $query->row_array();
    }
    public function fetch_row($data) {
        if (isset($data['select'])) {
            $this->db->select($data['select']);
        }
        if (isset($data['where'])) {
            $this->db->where($data['where']);
        }
        if (isset($data['join'])) {
            foreach ($data['join'] as $key => $value) {
                if (isset($value['type'])) {
                    $this->db->join($value['table'], $value['on'], $value['type']);
                } else {
                    $this->db->join($value['table'], $value['on']);
                }
            }
        }
        $query = $this->db->get($data['table'], 1);
        //echo $this->db->last_query();
        return $query->row_array();
    }
    public function search_users($data)
    {
        if (isset($data['select'])) {
            $this->db->select($data['select']);
        }
        if (isset($data['where'])) {
            $where = $data['where'];
            $this->db->like('users.email', $where);
            $this->db->or_like('users.date_time', $where);
            $this->db->or_like('user_detail.name', $where);            
        }
        if (isset($data['join'])) {
            foreach ($data['join'] as $key => $value) {
                if (isset($value['type'])) {
                    $this->db->join($value['table'], $value['on'], $value['type']);
                } else {
                    $this->db->join($value['table'], $value['on']);
                }
            }
        }   
        $this->db->order_by('id','DESC');
        if(isset($data['start']) && isset($data['end']))
        {
            $query = $this->db->get($this->table,$data['end'],$data['start']);
        }
        else
        {
            $query = $this->db->get($this->table);
        }
        //return $this->db->last_query();
        return $query->result_array();        
    }
      public function search_dusers($data)
    {
        if (isset($data['select'])) {
            $this->db->select($data['select']);
        }
        if (isset($data['where'])) {
            $where = $data['where'];
            $this->db->like('b_users.email', $where);
            $this->db->or_like('b_users.date_time', $where);
            $this->db->or_like('user_detail.name', $where);            
        }
        if (isset($data['join'])) {
            foreach ($data['join'] as $key => $value) {
                if (isset($value['type'])) {
                    $this->db->join($value['table'], $value['on'], $value['type']);
                } else {
                    $this->db->join($value['table'], $value['on']);
                }
            }
        }   
        $this->db->order_by('id','DESC');
        if(isset($data['start']) && isset($data['end']))
        {
            $query = $this->db->get($this->btable,$data['end'],$data['start']);
        }
        else
        {
            $query = $this->db->get($this->btable);
        }
        //return $this->db->last_query();
        return $query->result_array();        
    }
    public function fetch_query($query)
    {
        $query = $this->db->query($query);
        return $query->result_array();     
    }
    public function fetch_query_row($query)
    {
        $query = $this->db->query($query);
        return $query->row_array();     
    }
    public function insert($data)
    {
        $this->db->insert($data['table'], $data['data']);
        return $this->db->insert_id();
    }
    public function update_query($query)
    {
        $query = $this->db->query($query);
        return $this->db->affected_rows();     
    }
    
     public function count_query($data)
    {
        $query = $this->db->query($data);
	    return $query->num_rows();
          
    }
}
?>
