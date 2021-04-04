<?php

require APPPATH.'libraries/Crystal.php';

class Menu extends Crystal {

    private $arin = array();

    function __construct(){
        parent::__construct();
        $this->load->model('menu_model','mmenu');
    }

    function index(){
        if($this->_validation()){
            if(get('state')=='add'){
                $args['menu'] = $this->_post_data();
                $args['menu']['parent'] = 0;
                $res['menu'] = $this->mmenu->read(['parent'=>0]);
                $args['menu']['position'] = intval($res['menu'][count($res['menu'])-1]['positon'])+1;
                if($this->mmenu->add($args['menu'])>0){
                    flash(['message'=>'Simpan Menu Baru Berhasil','status'=>'success']);
                } else {
                    flash(['message'=>'Simpan Menu Baru Gagal','status'=>'failed']);
                }
                redirect(base_url('settings/menu'));
            } else if(get('state')=='edit'){
                $args['menu'] = $this->_post_data();
                if($this->mmenu->update($args['menu'],post('id'))>0){
                    flash(['message'=>'Update Menu Berhasil','status'=>'success']);
                } else {
                    flash(['message'=>'Update Menu Gagal','status'=>'failed']);
                }
                redirect(base_url('settings/menu'));
            }
        } else {
            $list['item'] = $this->mmenu->read(['parent'=>0]);
            $data['menu'] = $this->_load_menu($list['item']);
            $data['content'] = 'settings/menu/index';
            $data['plugin'] = ['nestable'];
            template($data);
        }
    }

    private function _load_menu($items){
        $html = '<ol class="dd-list">';
        foreach($items as $key => $val){
            if(!in_array($val['id'],$this->arin)){
                $html .='<li class="dd-item dd3-item" data-id="'.$val['id'].'">
                        <div class="dd-handle dd3-handle" style="background-color:black; text-color:white">&nbsp;&nbsp;&nbsp;</div><div class="dd3-content">
                            <i class="'.$val['icon'].'"></i>&nbsp;&nbsp;'.$val['label'].'
                            <div style="float:right">
                                <b>'.$val['url'].'</b> | &nbsp;&nbsp;'.button_icon(['icon'=>'fa fa-pencil','size'=>'xs','onclick'=>'edit('.$val['id'].')','color'=>'warning']).' '.action_button(base_url('settings/menu/delete'),$val['id'],['delete']).'
                            </div>
                        </div>';
                            $item['menu'] = $this->db->get_where('menu',['parent' => $val['id']])->result_array();
                            if(count($item['menu'])>0){
                                $html.=$this->_load_menu($item['menu']);
                            }
                $html .= '</li>';
                array_push($this->arin, $val['id']);
            }
        }
        $html .= '</ol>';
        return $html;
    }

    function delete(){
        if($this->mmenu->delete(post('id'))>0){
            flash(['message'=>'Hapus Menu Berhasil', 'status'=>'success']);
        } else {
            flash(['message'=>'Hapus Menu Gagal', 'status'=>'failed']);
        }
        redirect(base_url('settings/menu/'));
    }

    function ajx_organize(){
        $data = $this->input->post('data');
        if(empty($data))
            return;
        $this->_organize($data,0);
    }

    function ajx_get_detail($id){
        if(empty($id))
            return;
        echo json_encode($this->mmenu->read(['id' => $id]));
    }

    private function _organize($item,$parent){
        $position = 1;
        foreach($item as $key => $val){
            $this->db->update('menu',['position'=>$position++,'parent'=>$parent],['id'=>$val['id']]);
            if(!empty($val['children'])){
                $this->_organize($val['children'],$val['id']);
            }
        }
    }

    private function _validation($uniqlist=array()){
        set_rules('label','Label','required|max_length[50]');
        set_rules('url','URL','required|max_length[100]');
        set_rules('icon','Icon','required|max_length[20]');
        return validation_run();
    }

    private function _post_data(){
        return [
            'label' => post('label'),
            'url' => post('url'),
            'icon' => post('icon')
        ];
    }

}