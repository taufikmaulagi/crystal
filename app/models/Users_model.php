<?php

class Users_model extends CI_Model {

    function read($id='',$role=''){
        if(!empty($id)) $this->db->where('users.id',$id);
        if(!empty($role)) $this->db->where('role.id',$role);
        $this->db->select('users.foto, users.id, users.nama, users.username, users.email, users.password, users.created_at, role.nama as role, users.role as id_role');
        $this->db->join('role','users.role = role.id');
        $this->db->where(['users.deleted_at' => NULL, 'role.deleted_at' => NULL]);
        return $this->db->get('users')->result_array();
    }

    function create($args){
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