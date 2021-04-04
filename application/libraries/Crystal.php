<?php

class Crystal extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('logged_in')))
            redirect(base_url('auth/login'));
        $GLOBALS['template'] = 'note';
        if($GLOBALS['template'] == 'note'){
            $this->load->helper('note');
            $this->load->helper('note_template');
        }
    }

}