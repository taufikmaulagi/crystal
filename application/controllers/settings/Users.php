<?php

require APPPATH.'libraries/Crystal.php';

class Users extends Crystal {

    private $module = 'Users';

    function __construct(){
        parent::__construct();
        $this->load->model('users_model','musers');
    }

    function index(){
        // $this->load->model('privilege_model','mprivilege');
        // echo $res['permission'] = $this->mprivilege->check_permission(2, $this->module, 'View');
        $data['content'] = 'settings/users/index';
        $data['user'] = $this->musers->read();
        $data['plugin'] = ['datatables'];
        template($data);
    }

    function add(){
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            if($this->musers->add($args['data'])>0){
                flash(['message' => 'Simpan User Baru Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Simpan User Baru Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/users/add'));
        } else {
            $data['content'] = 'settings/users/add';
            $this->load->model('role_model','musergroup');
            $data['role'] = $this->musergroup->read();
            template($data);
        }
    }

    function edit($id){
        if(empty($id))
            redirect(base_url('settings/users'));
        $res['user'] = $this->musers->read(['id' => $id]);
        if(count($res['user'])<=0)
            redirect(base_url('settings/users'));
        $list['uniq'] = array();
        if($this->_post_data()['username'] == $res['user'][0]['username'])
            $list['uniq']['username'] = 'remove';

        if($this->_validation($list['uniq'])){
            $args['data'] = $this->_post_data();
            if(post('password') == $res['user'][0]['password'])
                unset($args['data']['password']);
            if($this->musers->update($args['data'], $id)>0){
                flash(['message' => 'Update User Berhasil','status'=>'success']);
            } else {
                flash(['message' => 'Update User Gagal','status'=>'failed']);
            }
            redirect(base_url('settings/users/edit/'.$id));
        } else {
            $data['content'] = 'settings/users/edit';
            $data['user'] = $res['user'][0];
            $this->load->model('role_model','musergroup');
            $data['role'] = $this->musergroup->read();
            template($data);
        }
    }
    
    function delete(){
        if($this->musers->delete(post('id'))>0){
            flash(['message'=>'Hapus User Berhasil', 'status'=>'success']);
        } else {
            flash(['message'=>'Hapus User Gagal', 'status'=>'failed']);
        }
        redirect(base_url('settings/users/'));
    }

    private function _validation($uniqlist=array()){
        $uniq['username'] = '|is_unique[users.username]';
        if(!empty($uniqlist['username']))
            $uniq['username'] = '';
        set_rules('nama','Nama Lengkap','required|max_length[50]');
        set_rules('role','User Group','required|max_length[3]');
        set_rules('username','Username','required|max_length[30]'.$uniq['username']);
        set_rules('email','Email','required|max_length[50]|valid_email');
        set_rules('password','Password','required|max_length[50]|min_length[8]');
        set_rules('confirm_password','Konfirmasi Password','required|max_length[50]|matches[password]|min_length[8]');
        return validation_run();
    }

    private function _post_data(){
        return [
            'nama' => post('nama'),
            'role' => post('role'),
            'username' => post('username'),
            'email' => post('email'),
            'password' => sha1(post('password'))
        ];
    }

}