<?php

class Users_model extends CI_Model {

    function read($args=array()){
        if(!empty($args['id']))
            $this->db->where('users.id',$args['id']);
        if(!empty($args['role']))
            $this->db->where('role.id',$args['role']);
        $this->db->select('users.foto, users.id, users.nama, users.username, users.email, users.password, users.created_at, role.nama as role, users.role as id_role');
        $this->db->join('role','users.role = role.id');
        $this->db->where(['users.deleted_at' => NULL, 'role.deleted_at' => NULL]);
        return $this->db->get('users')->result_array();
    }

    function add($args){
        $this->db->insert('users', $args);
        return $this->db->affected_rows();
    }

    function update($args, $id){
        $args['updated_at'] = date('Y-m-d H:i:s');
        $this->db->update('users', $args, ['id' => $id]);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->update('users',['deleted_at'=>date('Y-m-d H:i:s')],['id' => $id]);
        return $this->db->affected_rows();
    }

}