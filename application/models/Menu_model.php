<?php

class Menu_model extends CI_Model {

    function read($args=array()){
        if(!empty($args['id']))
            $this->db->where('id',$args['id']);
        if(isset($args['parent']))
            $this->db->where('parent',$args['parent']);
        $this->db->order_by('position','asc');
        $this->db->where('deleted_at',NULL);
        return $this->db->get('menu')->result_array();
        
    }

    function add($args){
        $this->db->insert('menu', $args);
        return $this->db->affected_rows();
    }

    function update($args,$id){
        $this->db->update('menu', $args, ['id' => $id]);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->update('menu', ['deleted_at'=>date('Y-m-d H:i:s')], ['id' => $id]);
        return $this->db->affected_rows();
    }

}