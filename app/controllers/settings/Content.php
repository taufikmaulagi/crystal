<?php
require APPPATH.'libraries/Crystal.php';

class Content extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('content_model','mcontent');
    }

    function index(){
        if($this->_validation()){
            $args['update'] = $this->_post_data();
            if(!empty($_FILES['logo']['name'])){
                $this->load->library('upload');
                $config['upload_path'] = './public/images/';
                $config['allowed_types'] = 'png|jpg|jpeg|svg';
                $config['file_name'] = 'logo-'.uniqid();
                $this->upload->initialize($config);
                if($this->upload->do_upload('logo')){
                    $args['update']['logo'] = $this->upload->file_name;
                } else {
                    var_dump($this->upload->display_errors());
                }
            }
            if(!empty($_FILES['favicon']['name'])){
                $this->load->library('upload');
                $config['upload_path'] = './public/images/';
                $config['allowed_types'] = 'png|jpg|jpeg|svg|ico';
                $config['file_name'] = 'favicon-'.uniqid();
                $this->upload->initialize($config);
                if($this->upload->do_upload('favicon')){
                    $args['update']['favicon'] = $this->upload->file_name;
                } else {
                    var_dump($this->upload->display_errors());
                }
            }
            if($this->mcontent->update($args['update'])){
                flash(['message'=>'Update Content Berhasil','status'=>'success']);
            } else {
                flash(['message'=>'Update Content Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/content'));
        } else {
            $args['content'] = 'settings/content/index';
            $args['main'] = $this->db->get('content')->result_array()[0];
            template($args);
        }
    }

    private function _post_data(){
        return [
            'nama' => post('nama'),
            'deskripsi_pendek' => post('deskripsi_pendek'),
            'deskripsi' => post('deskripsi'),
            'tahun_rilis' => post('tahun_rilis'),
            'email' => post('email'),
            'notelp' => post('notelp'),
            'no_hp' => post('no_hp'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }

    private function _validation(){
        set_rules('nama','Nama','required|max_length[30]');
        set_rules('deskripsi_pendek','Deskripsi Pendek','required|max_length[50]');
        set_rules('deskripsi','Deskripsi','required|max_length[255]');
        set_rules('tahun_rilis','Tahun Rilis','required|max_length[4]');
        set_rules('email','Email','required|max_length[50]');
        return validation_run();
    }

}