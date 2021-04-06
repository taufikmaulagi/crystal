<?php

class Privilege_model extends CI_Model {

    function read($args=array()){
        if(!empty($args['type'])){
            if($args['type']=='module'){
                $this->db->order_by('nama','asc');
                return $this->db->get_where('module',['deleted_at'=>NULL])->result_array();
            } else if($args['type']=='access'){
                $this->db->order_by('module','asc');
                return $this->db->get_where('access',['deleted_at'=>NULL])->result_array();
            } else if($args['type']=='permission'){
                if(!empty($args['role']))
                    $this->db->where('role',$args['role']);
                if(!empty($args['access']))
                    $this->db->where('access',$args['access']);
                if(!empty($args['module']))
                    $this->db->where('module',$args['module']);
                return $this->db->get('permission')->result_array();
            }
        }
    }

    function set_permission($module,$role,$permission){
        $res['permission'] = $this->read(['type'=>'permission','role'=>$role,'access'=>$permission, 'module'=>$module]);
        if(count($res['permission'])>0){
            $this->db->delete('permission',['role'=>$role,'access'=>$permission,'module'=>$module]);
        } else {
            $this->db->insert('permission',['role'=>$role,'access'=>$permission,'module'=>$module]);
        }
        return $this->db->affected_rows();
    }

    function check_permission($role, $module, $access){
        $this->db->join('access','access.id = permission.access');
        $this->db->join('module','module.id = access.module');
        return $this->db->get_where('permission', ['role' => $role, 'module.nama' => $module, 'access.nama' => $access])->num_rows();
    }

}