<?php

require APPPATH.'libraries/Crystal.php';

class Users extends Crystal {

    private $module = 'Users';

    function __construct(){
        parent::__construct();
        $this->load->model('users_model','musers');
    }

    function index(){
        $this->load->model('role_model','mrole');
        template(
            title: 'Data Seluruh User',
            content: 'settings/users/index',
            plugin: ['datatables'],
            data: [
                'user' => $this->musers->read(),
                'role' => $this->mrole->read()
            ]
        );
    }

    function add(){
        if($this->_validation()){
            $args['data'] = $this->_post_data();
            $args['data']['foto'] = $this->uploader('foto','user');
            if($this->musers->create($args['data'])>0)
                $this->flash(['message' => 'Simpan User Baru Berhasil','status'=>'success']);
            else 
                $this->flash(['message' => 'Simpan User Baru Gagal','status'=>'failed']);
            redirect(base_url('settings/users/add'),'refresh');
        } else {
            $this->load->model('role_model','musergroup');
            template(
                title: 'Tambah User baru',
                content: 'settings/users/add',
                data: [
                    'role' => $this->musergroup->read()
                ]
            );
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
        $this->set_rules('nama','Nama Lengkap','required|max_length[50]');
        $this->set_rules('role','Role','required|max_length[3]');
        $this->set_rules('username','Username','required|max_length[30]'.$uniq['username']);
        $this->set_rules('email','Email','required|max_length[50]|valid_email');
        $this->set_rules('password','Password','required|max_length[50]|min_length[8]');
        $this->set_rules('confirm_password','Konfirmasi Password','required|max_length[50]|matches[password]|min_length[8]');
        return $this->validation_run();
    }

    private function _post_data(){
        return [
            'nama' => $this->post('nama'),
            'tanggal_lahir' => $this->post('tanggal_lahir') != '01-01-1970' ? strtotime('Y-m-d', strtotime($this->post('tanggal_lahir'))) : NULL,
            'jenis_kelamin' => $this->post('jenis_kelamin'),
            'role' => $this->post('role'),
            'username' => $this->post('username'),
            'email' => $this->post('email'),
            'password' => sha1($this->post('password'))
        ];
    }

}