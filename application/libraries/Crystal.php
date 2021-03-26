<?php

class Crystal extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('logged_in')))
            redirect(base_url('auth/login'));
        $this->load->helper('crystal');
        $this->load->helper('template');
    }

}