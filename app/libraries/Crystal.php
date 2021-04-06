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

    function uploader($name,$uniq='image',$path='./public/images/',$types='png|jpg|jpeg'){
        if(!empty($_FILES[$name]['name'])){
            $this->load->library('upload');
            $config['upload_path'] = $path;
            $config['allowed_types'] = $types;
            $config['file_name'] = $uniq.'-'.uniqid();
            $this->upload->initialize($config);
            if($this->upload->do_upload($name)){
                return $this->upload->file_name;
            } 
            // else {
            //     return $this->upload->display_errors();
            // }
        }
        return;
    }

    function set_rules($name, $label, $rule){
        $el =& get_instance();
        $el->form_validation->set_rules($name, $label, $rule.'|trim|xss_clean');
    }
    
    function validation_run(){
        $el =& get_instance();
        return $el->form_validation->run();
    }
    
    function post($post){
        $el =& get_instance();
        return $el->input->post($post);
    }
    
    function get($get){
        $el =& get_instance();
        return $el->input->get($get);
    }
    
    function flash($flash,$state='set'){
        $el =& get_instance();
        if($state=='show')
            return $el->session->flashdata($flash);
        return $el->session->set_flashdata($flash);
    }

    function unlock($access){
        if(!is_unlock($access)){
            redirect(base_url());
        }
    }

}