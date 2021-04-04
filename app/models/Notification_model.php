<?php

class Notification_model extends CI_Model {

    function read($args=array()){
        if(!empty($args['users']))
            $this->db->where('users',$args['users']);
        if(!empty($args['limit']))
            $this->db->limit($args['limit']);
        if(!empty($args['status']))
            $this->db->where('status',$args['status']);
        if(!empty($args['requested_at']))
            $this->db->where('requested_at',NULL);
        $this->db->order_by('created_at','desc');
        $this->db->select('notification.*,notification_label.nama as nama_label,color,icon');
        $this->db->join('notification_label','notification.label = notification_label.id');
        return $this->db->get('notification')->result_array();
    }

    function add($args){
        $this->db->insert('notification',$args);
        return $this->db->affected_rows();
    }

    function update_requested(){
        $this->db->update('notification',['requested_at'=>date('Y-m-d H:i:s')],['users'=>$this->session->userdata('logged_in')['id'],'requested_at'=>NULL]);
        return $this->db->affected_rows();
    }

    function update($args){
        $this->db->update('notification',$args,['users'=>$this->session->userdata('logged_in')['id']]);
        return $this->db->affected_rows();
    }

}