<?php

require APPPATH.'libraries/Crystal.php';

class Privilege extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('privilege_model','mprivilege');
    }

    function index(){
        $this->load->model('menu_model','mmenu');
        $this->load->model('role_model','mrole');
        template(
            title: 'User Privileges',
            content: 'settings/privilege/index',
            data: [
                'module' => $this->mmenu->read(),
                'permission' => $this->mprivilege->read(['type'=>'permission','role'=>$this->input->get('role')]),
                'role' => $this->mrole->read(except: 1)
            ]
        );
    }

    function set_permission(){
        $module = $this->post('module');
        $role = $this->post('role');
        $permission = $this->post('permission');
        if(empty($module) || empty($role) || empty($permission))
            return;
        echo $this->mprivilege->set_permission($module,$role,$permission);
    }

}