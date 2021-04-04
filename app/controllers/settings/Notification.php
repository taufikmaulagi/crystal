<?php

require APPPATH.'libraries/Crystal.php';

class Notification extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('notification_model','mnotif');
    }

    function ajx_get_new(){
        $data['req'] = json_encode($this->mnotif->read([
            'status'=>'unseen',
            'users'=>$this->session->userdata('logged_in')['id'],
            'requested_at'=>'empty'
        ]));
        $this->mnotif->update_requested(['requested_at'=>date('Y-m-d H:i:s')]);
        echo $data['req'];
    }

    function ajx_read_all(){
        $this->mnotif->update(['status'=>'seen']);
    }

}