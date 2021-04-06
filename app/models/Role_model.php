<?php

class Role_model extends CI_Model {

    function read($id='',$except=''){
        if(!empty($id)) $this->db->where('id',$id);
        if(!empty($except)) $this->db->where('id != '.$except);
        $this->db->where('deleted_at',NULL);
        return $this->db->get('role')->result_array();
    }

    function create($args){
        $this->db->insert('role', $args);
        return $this->db->affected_rows();
    }

    function update($args, $id){
        $this->db->update('role', $args, ['id' => $id]);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->update('role',['deleted_at'=>date('Y-m-d H:i:s')],['id' => $id]);
        return $this->db->affected_rows();
    }
    
}