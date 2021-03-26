<?php

require APPPATH.'libraries/Crystal.php';

class Role extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('role_model','mrole');
    }

    function index(){
        $data['content'] = 'settings/role/index';
        $data['role'] = $this->mrole->read();
        $data['plugin'] = ['datatables'];
        template($data);
    }

    function add(){
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->mrole->add($args['data'])>0){
                flash(['message' => 'Simpan User Group Baru Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Simpan User Group Baru Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/role/add'));
        } else {
            $data['content'] = 'settings/role/add';
            template($data);
        }
    }

    function edit($id){
        if(empty($id))
            redirect(base_url('settings/role'));
        $res['role'] = $this->mrole->read(['id' => $id]);
        if(count($res['role'])<=0)
            redirect(base_url('settings/role'));
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->mrole->update($args['data'], $id)>0){
                flash(['message' => 'Update User Group Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Update User Group Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/role/edit/'.$id));
        } else {
            $data['content'] = 'settings/role/edit';
            $data['role'] = $res['role'][0];
            template($data);
        }
    }
    
    function delete(){
        if($this->mrole->delete(post('id'))>0){
            flash(['message'=>'Hapus User Group Berhasil', 'status'=>'success']);
        } else {
            flash(['message'=>'Hapus User Group Gagal', 'status'=>'failed']);
        }
        redirect(base_url('settings/role/'));
    }

    private function _validation($uniqlist=array()){
        set_rules('nama','Nama Group','required|max_length[20]');
        return validation_run();
    }

    private function _post_data(){
        return [
            'nama' => post('nama')
        ];
    }

}   