<?php

class Notification_label_model extends CI_Model {

    function read($args=array()){
        if(!empty($args['id']))
            $this->db->where('id',$args['id']);
        $this->db->where('deleted_at',NULL);
        return $this->db->get('notification_label')->result_array();
    }

    function add($args){
        $this->db->insert('notification_label',$args);
        return $this->db->affected_rows();
    }

    function update($args,$id){
        $res['label'] = $this->read(['id'=>$id]);
        $this->db->update('notification_label',$args,['id' => $id]);
        if(!empty($res['label'][0]['icon']))
            unlink('./public/images/'.$res['label'][0]['icon']);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->update('notification_label',['deleted_at'=>date('Y-m-d H:i:s')], ['id' => $id]);
        return $this->db->affected_rows();
    }

}