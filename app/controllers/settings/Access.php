<?php

require APPPATH.'libraries/Crystal.php';

class Access extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('access_model','maccess');
    }

    function index(){
        $args = [
            'module' => get('module')
        ];
        $data['content'] = 'settings/access/index';
        $this->load->model('module_model','mmodule');
        $data['module'] = $this->mmodule->read();
        if(empty($args['module']))
            $args['module'] = $data['module'][0]['id'];
        $data['access'] = $this->maccess->read($args);
        $data['plugin'] = ['datatables'];
        template($data);
    }

    function add(){
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->maccess->add($args['data'])>0){
                flash(['message' => 'Simpan Access Baru Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Simpan Access Baru Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/access/add'));
        } else {
            redirect(base_url('settings/access/'));
        }
    }

    function edit($id){
        if(empty($id))
            redirect(base_url('settings/access'));
        $res['access'] = $this->maccess->read(['id' => $id]);
        if(count($res['access'])<=0)
            redirect(base_url('settings/access'));
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->maccess->update($args['data'], $id)>0){
                flash(['message' => 'Update Access Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Update Access Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/access/'));
        } else {
            redirect(base_url('settings/access/'));
        }
    }
    
    function delete(){
        if($this->maccess->delete(post('id'))>0){
            flash(['message'=>'Hapus Access Berhasil', 'status'=>'success']);
        } else {
            flash(['message'=>'Hapus Access Gagal', 'status'=>'failed']);
        }
        redirect(base_url('settings/access/'));
    }
    
    function ajx_get_detail($id){
        if(empty($id))
            return 0;
        echo json_encode($this->maccess->read(['id' => $id]));
    }

    private function _validation($uniqlist=array()){
        set_rules('nama','Nama Akses','required|max_length[20]');
        set_rules('module','Module','required');
        return validation_run();
    }

    private function _post_data(){
        return [
            'nama' => post('nama'),
            'module' => post('module'),
        ];
    }

}   