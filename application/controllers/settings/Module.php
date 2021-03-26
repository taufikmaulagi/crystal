<?php

require APPPATH.'libraries/Crystal.php';

class Module extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('module_model','mmodule');
    }

    function index(){
        $data['content'] = 'settings/module/index';
        $data['module'] = $this->mmodule->read();
        $data['plugin'] = ['datatables'];
        template($data);
    }

    function add(){
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->mmodule->add($args['data'])>0){
                flash(['message' => 'Simpan Module Baru Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Simpan Module Baru Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/module/add'));
        } else {
            $data['content'] = 'settings/module/add';
            template($data);
        }
    }

    function edit($id){
        if(empty($id))
            redirect(base_url('settings/module'));
        $res['module'] = $this->mmodule->read(['id' => $id]);
        if(count($res['module'])<=0)
            redirect(base_url('settings/module'));
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->mmodule->update($args['data'], $id)>0){
                flash(['message' => 'Update Module Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Update Module Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/module/edit/'.$id));
        } else {
            $data['content'] = 'settings/module/edit';
            $data['module'] = $res['module'][0];
            template($data);
        }
    }
    
    function delete(){
        if($this->mmodule->delete(post('id'))>0){
            flash(['message'=>'Hapus Module Berhasil', 'status'=>'success']);
        } else {
            flash(['message'=>'Hapus Module Gagal', 'status'=>'failed']);
        }
        redirect(base_url('settings/module/'));
    }

    private function _validation($uniqlist=array()){
        set_rules('nama','Nama Group','required|max_length[30]');
        return validation_run();
    }

    private function _post_data(){
        return [
            'nama' => post('nama')
        ];
    }

}   