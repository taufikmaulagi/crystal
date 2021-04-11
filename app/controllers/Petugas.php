<?php
require APPPATH.'libraries/Crystal.php';

class Petugas extends Crystal {

   function __construct(){
        parent::__construct();
        $this->load->model('petugas_model','mpetugas');
    }

    function index(){
        $this->unlock('Petugas|VIEW');
        template(
            title: 'Data Seluruh Petugas',
            content: 'petugas/index',
            plugin: ['datatables'],
            data: [
                'petugas' => $this->mpetugas->read(),
            ]
        );
    }

    function add(){
        $this->unlock('Petugas|ADD');
        if($this->_validation(state: 'add')){
            $args['petugas'] = $this->_post_data();
            $args['petugas']['foto'] = $this->uploader('foto','petugas');
            if($this->mpetugas->create($args['petugas'])>0)
                $this->flash(['message' => 'Petugas Baru Telah Tersimpan','status'=>'success']);
            else 
                $this->flash(['message' => 'Oops! Petugas Baru Gagal Tersimpan, Silahkan Coba Lagi','status'=>'failed']);
            redirect(base_url('petugas/add'),'refresh');
        } else {
            
            template(
                title: 'Tambah Petugas baru',
                content: 'petugas/add',
                data: [
                    
                ]
            );
        }
    }

    function edit($id){
        $this->unlock('Petugas|EDIT');
        if(empty($id))
            redirect(base_url('petugas'));
        $res['petugas'] = $this->mpetugas->read(id: $id);
        if(count($res['petugas'])<=0)
            redirect(base_url('petugas'));
        $list['uniq'] = array();
        if($this->_validation($list['uniq'])){
            $args['petugas'] = $this->_post_data();
            $args['petugas']['foto'] = $this->uploader('foto','petugas');
            if($this->mpetugas->update($args['petugas'], $id)>0){
                $this->flash(['message' => 'Perubahan Petugas Telah Tersimpan','status'=>'success']);
            } else {
                $this->flash(['message' => 'Oops! Perubahan Petugas Gagal Tersimpan, Silahkan Coba Lagi','status'=>'failed']);
            }
            redirect(base_url('petugas/edit/'.$id),'refresh');
        } else {
            template(
                title: 'Update Data Petugas',
                content: 'petugas/edit',
                data: [
                    'petugas' => $res['petugas'][0],
                ]
            );
        }
    }
    
    function delete(){
        $this->unlock('Petugas|DELETE');
        if($this->mpetugas->delete($this->post('id'))>0){
            $this->flash(['message'=>'Petugas Telah Terhapus', 'status'=>'success']);
        } else {
            $this->flash(['message'=>'Oops! Petugas Gagal Terhapus, Silahkan Coba Lagi', 'status'=>'failed']);
        }
        redirect(base_url('petugas/'),'refresh');
    }

    private function _validation($uniqlist=array(),$state='default'){
        $this->set_rules('nama','Nama','required|max_length[50]');
        $this->set_rules('tanggal_lahir','Tanggal_lahir','required');
        if($state=='add'){
            $this->set_rules('foto','Foto','callback_foto_required');
        }
    
        return $this->validation_run();
    }

    private function _post_data(){
        return [
            'nama' => $this->post('nama'),
            'tanggal_lahir' => $this->post('tanggal_lahir') != '01-01-1970' ? date('Y-m-d', strtotime($this->post('tanggal_lahir'))) : NULL,
        ];
    } 
    
    function foto_required(){
        $this->form_validation->set_message('foto_required','Belum Memilih File');
        if (empty($_FILES['foto']['name'])) {
            return false;
        } else {
            return true;
        }
    }


}