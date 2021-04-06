<?php require APPPATH.'libraries/Crystal.php';

class  Notification_label extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('notification_label_model','mnotiflabel');
    }

    function index(){
        template(
            title: 'Notification Label',
            content: 'settings/notification_label/index',
            plugin: ['datatables'],
            data: [
                'label' => $this->mnotiflabel->read()
            ]
        );
    }

    function add(){
        if($this->_validation()){
            $args['label'] = $this->_postdata();
            $args['label']['icon'] = $this->uploader('icon','nlabel');
            if($this->mnotiflabel->add($args['label'])){
                $this->flash(['message'=>'Label baru telah tersimpan','status'=>'success']);
            } else {
                $this->flash(['message'=>'Label gagal tersimpan! Silahkan coba lagi','status'=>'failed']);
            }
            redirect(base_url('settings/notification_label/add'));
        } else {
            template(
                title: 'Tambah Notifikasi Label Baru',
                content: 'settings/notification_label/add'
            );
        }
    }

    function edit($id){
        if(empty($id)){ redirect(base_url('settings/notification_label')); }
        $res['label'] = $this->mnotiflabel->read(['id'=>$id]);
        if(count($res['label'])<=0){ redirect(base_url('settings/notification_label')); }
        if($this->_validation()){
            $args['label'] = $this->_postdata();
            $args['label']['icon'] = $this->uploader('icon','nlabel');
            if($this->mnotiflabel->update($args['label'],$id)){
                $this->flash(['message'=>'Perubahan Label telah tersimpan','status'=>'success']);
            } else {
                $this->flash(['message'=>'Label gagal tersimpan! Silahkan coba lagi','status'=>'failed']);
            }
            redirect(base_url('settings/notification_label/edit/'.$id));
        } else {
            template(
                title: 'Update Notification Label',
                content: 'settings/notification_label/edit',
                data: [
                    'label' => $res['label'][0]
                ]
            );
        }
    }

    function delete(){
        if($this->mnotiflabel->delete($this->post('id'))>0){
            $this->flash(['message'=>'Label telah dihapus', 'status'=>'success']);
        } else {
            $this->flash(['message'=>'Label gagal dihapus! Silahkan coba lagi', 'status'=>'failed']);
        }
        redirect(base_url('settings/notification_label/'));
    }

    private function _validation(){
        $this->set_rules('nama','Nama','required|max_length[20]');
        $this->set_rules('color','Color','required|max_length[15]');
        return $this->validation_run();
    }

    private function _postdata(){
        return [
            'nama' => $this->post('nama'),
            'color' => $this->post('color')
        ];
    }

}