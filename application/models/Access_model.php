<?php

class Access_model extends CI_Model {

    function read($args=array()){
        if(!empty($args['id']))
            $this->db->where('id',$args['id']);
        if(!empty($args['module']))
            $this->db->where('module',$args['module']);
        $this->db->where('deleted_at',NULL);
        return $this->db->get('access')->result_array();
    }

    function add($args){
        $this->db->insert('access', $args);
        return $this->db->affected_rows();
    }

    function update($args, $id){
        $this->db->update('access', $args, ['id' => $id]);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->update('access',['deleted_at'=>date('Y-m-d H:i:s')],['id' => $id]);
        return $this->db->affected_rows();
    }
    
}