<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Model {
    public $table = 'admin_user';
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
                    $this->db->join($this->table, $value['on'], $value['type']);
                } else {
                    $this->db->join($this->table, $value['on']);
                }
            }
        }
        $query = $this->db->get($this->table, 1);
        //echo $this->db->last_query();
        return $query->row_array();
    } 
    public function update_admin($data)
    {
        $this->db->update($this->table,$data['data'],$data['where']);        
        if($this->db->affected_rows()>0)
        {
            return TRUE;
        }
        else
        {
            return False;
        }
    }
}
?>
