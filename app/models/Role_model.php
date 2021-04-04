<?php

class Role_model extends CI_Model {

    function read($args=array()){
        if(!empty($args['id']))
            $this->db->where('id',$args['id']);
        if(!empty($args['!id']))
            $this->db->where('id != '.$args['!id']);
        $this->db->where('deleted_at',NULL);
        return $this->db->get('role')->result_array();
    }

    function add($args){
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