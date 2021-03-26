<?php require APPPATH.'libraries/Crystal.php';

class  Notification_label extends Crystal {

    function __construct(){
        parent::__construct();
        $this->load->model('notification_label_model','mnotiflabel');
    }

    function index(){
        $data['label'] = $this->mnotiflabel->read();
        $data['content'] = 'settings/notification_label/index';
        $data['plugin'] = ['datatables'];
        template($data);
    }

    function add(){
        if($this->_validation()){
            $args['label'] = $this->_postdata();
            if(!empty($_FILES['icon']['name'])){
                $config['upload_path'] = './public/images/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = 'nlabel-'.uniqid();
                $this->load->library('upload',$config);
                if($this->upload->do_upload('icon')){
                    $args['label']['icon'] = $this->upload->file_name;
                }
            }
            if($this->mnotiflabel->add($args['label'])){
                flash(['message'=>'Label baru telah tersimpan','status'=>'success']);
            } else {
                flash(['message'=>'Label gagal tersimpan! Silahkan coba lagi','status'=>'failed']);
            }
            redirect(base_url('settings/notification_label/add'));
        } else {
            $data['content'] = 'settings/notification_label/add';
            template($data);
        }
    }

    function edit($id){
        if(empty($id)){ redirect(base_url('settings/notification_label')); }
        $res['label'] = $this->mnotiflabel->read(['id'=>$id]);
        if(count($res['label'])<=0){ redirect(base_url('settings/notification_label')); }
        if($this->_validation()){
            $args['label'] = $this->_postdata();
            if(!empty($_FILES['icon']['name'])){
                $config['upload_path'] = './public/images/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = 'nlabel-'.uniqid();
                $this->load->library('upload',$config);
                if($this->upload->do_upload('icon')){
                    $args['label']['icon'] = $this->upload->file_name;
                }
            }
            if($this->mnotiflabel->update($args['label'],$id)){
                flash(['message'=>'Perubahan Label telah tersimpan','status'=>'success']);
            } else {
                flash(['message'=>'Label gagal tersimpan! Silahkan coba lagi','status'=>'failed']);
            }
            redirect(base_url('settings/notification_label/edit/'.$id));
        } else {
            $data['label'] = $res['label'][0];
            $data['content'] = 'settings/notification_label/edit';
            template($data);
        }
    }

    function delete(){
        if($this->mnotiflabel->delete(post('id'))>0){
            flash(['message'=>'Label telah dihapus', 'status'=>'success']);
        } else {
            flash(['message'=>'Label gagal dihapus! Silahkan coba lagi', 'status'=>'failed']);
        }
        redirect(base_url('settings/notification_label/'));
    }

    private function _validation(){
        set_rules('nama','Nama','required|max_length[20]');
        set_rules('color','Color','required|max_length[15]');
        return validation_run();
    }

    private function _postdata(){
        return [
            'nama' => post('nama'),
            'color' => post('color')
        ];
    }

}