<?php

require APPPATH.'libraries/Crystal.php';

class Privilege extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('privilege_model','mprivilege');
    }

    function index(){
        $data['content'] = 'settings/privilege/index';
        $data['module'] = $this->mprivilege->read(['type'=>'module']);
        $data['access'] = $this->mprivilege->read(['type'=>'access']);
        $this->load->model('role_model','mrole');
        $data['role'] = $this->mrole->read(['!id' => 1]);
        $id['role'] = empty(get('role')) ? $data['role'][0]['id'] : get('role');
        $data['permission'] = $this->mprivilege->read(['type'=>'permission','role'=>$id['role']]);
        template($data);
    }

    function set_permission(){
        $access_id = post('access_id');
        $role = post('role');
        if(empty($access_id) || empty($role))
            redirect(base_url('settings/privilege'));
        $this->mprivilege->set_permission($access_id,$role);
    }

}