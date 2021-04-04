<?php

require APPPATH.'libraries/Crystal.php';

class Home extends Crystal {

    function index(){
        $data['content'] = 'settings/user/index';
        template($data);
    }

}