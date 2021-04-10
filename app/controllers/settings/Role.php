<?php

require APPPATH.'libraries/Crystal.php';

class Role extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('role_model','mrole');
    }

    function index(){
        $this->unlock('Role|VIEW');
        template(
            title: 'Data Seluruh Role',
            plugin: ['datatables'],
            content: 'settings/role/index',
            data: [
                'role' => $this->mrole->read()
            ]
        );
    }

    function add(){
        $this->unlock('Role|ADD');
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->mrole->create($args['data'])>0){
                $this->flash(['message' => 'Simpan User Group Baru Berhasil','status'=>'success']);
            } else {
                $this->flash(['message' => 'Simpan User Group Baru Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/role/add'),'refresh');
        } else {
            template(
                title: 'Tambah Role Baru',
                content: 'settings/role/add'
            );
        }
    }

    function edit($id){
        $this->unlock('Role|EDIT');
        if(empty($id))
            redirect(base_url('settings/role'));
        $res['role'] = $this->mrole->read(id: $id);
        if(count($res['role'])<=0)
            redirect(base_url('settings/role'));
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->mrole->update($args['data'], $id)>0){
                $this->flash(['message' => 'Update User Group Berhasil','status'=>'success']);
            } else {
                $this->flash(['message' => 'Update User Group Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/role/edit/'.$id),'refresh');
        } else {
            template(
                title: 'Update Role',
                content: 'settings/role/edit',
                data: [
                    'role' => $res['role'][0]
                ]
            );
        }
    }
    
    function delete(){
        $this->unlock('Role|DELETE');
        if($this->mrole->delete($this->post('id'))>0){
            $this->flash(['message'=>'Hapus User Group Berhasil', 'status'=>'success']);
        } else {
            $this->flash(['message'=>'Hapus User Group Gagal', 'status'=>'failed']);
        }
        redirect(base_url('settings/role'));
    }

    private function _validation($uniqlist=array()){
        $this->set_rules('nama','Nama Group','required|max_length[20]');
        return $this->validation_run();
    }

    private function _post_data(){
        return [
            'nama' => $this->post('nama')
        ];
    }

}   