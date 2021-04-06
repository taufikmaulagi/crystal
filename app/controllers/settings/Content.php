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
            $args['update']['logo'] = $this->uploader('logo','logo',types: 'png|jpg|jpeg|svg');
            $args['update']['favicon'] = $this->uploader('favicon','favicon',types: 'png|jpg|jpeg|svg|ico');
            if($this->mcontent->update($args['update'])){
                $this->flash(['message'=>'Update Content Berhasil','status'=>'success']);
            } else {
                $this->flash(['message'=>'Update Content Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/content'));
        } else {
            template(
                title: 'Content Management',
                content: 'settings/content/index',
                data: [
                    'main' => $this->db->get('content')->result_array()[0]
                ]
            );
        }
    }

    private function _post_data(){
        return [
            'nama' =>$this->post('nama'),
            'deskripsi_pendek' =>$this->post('deskripsi_pendek'),
            'deskripsi' =>$this->post('deskripsi'),
            'tahun_rilis' =>$this->post('tahun_rilis'),
            'email' =>$this->post('email'),
            'notelp' =>$this->post('notelp'),
            'no_hp' =>$this->post('no_hp'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }

    private function _validation(){
        $this->set_rules('nama','Nama','required|max_length[30]');
        $this->set_rules('deskripsi_pendek','Deskripsi Pendek','required|max_length[50]');
        $this->set_rules('deskripsi','Deskripsi','required|max_length[255]');
        $this->set_rules('tahun_rilis','Tahun Rilis','required|max_length[4]');
        $this->set_rules('email','Email','required|max_length[50]');
        return $this->validation_run();
    }

}