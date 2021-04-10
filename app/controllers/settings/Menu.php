<?php

require APPPATH.'libraries/Crystal.php';

class Menu extends Crystal {

    private $arin = array();

    function __construct(){
        parent::__construct();
        $this->load->model('menu_model','mmenu');
    }

    function index(){
        $this->unlock('Menu Manager|VIEW');
        if($this->_validation()){
            if($this->get('state')=='add' && is_unlock('Menu Manager|ADD')){
                $args['menu'] = $this->_post_data();
                $args['menu']['parent'] = 0;
                $res['menu'] = $this->mmenu->read(parent:0);
                $args['menu']['position'] = intval($res['menu'][count($res['menu'])-1]['positon'])+1;
                if($this->mmenu->create($args['menu'])>0){
                    $this->flash(['message'=>'Simpan Menu Baru Berhasil','status'=>'success']);
                } else {
                    $this->flash(['message'=>'Simpan Menu Baru Gagal','status'=>'failed']);
                }
                redirect(base_url('settings/menu'));
            } else if($this->get('state')=='update' && is_unlock('Menu Manager|EDIT')){
                $args['menu'] = $this->_post_data();
                if($this->mmenu->update($args['menu'],$this->post('id'))>0){
                    $this->flash(['message'=>'Update Menu Berhasil','status'=>'success']);
                } else {
                    $this->flash(['message'=>'Update Menu Gagal','status'=>'failed']);
                }
                redirect(base_url('settings/menu'));
            }
        } else {
            $list['item'] = $this->mmenu->read(parent:0);
            template(
                content: 'settings/menu/index',
                plugin: ['nestable'],
                data: [
                    'menu_list' => $this->_load_menu($list['item']),
                ]
            );
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
                                <b>'.$val['url'].'</b> | &nbsp;&nbsp;'.is_unlock('Menu Manager|EDIT',button_icon(icon:'pencil',size:'xs',onclick:'edit('.$val['id'].')',theme:'warning',target:'#')).' '.action_button(base_url('settings/menu/delete'),$val['id'],['delete'],module: 'Menu').'
                            </div>
                        </div>';
                            $item['menu'] = $this->mmenu->read(parent: $val['id']);
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
        $this->unlock('Menu Manager|ADD');
        if($this->mmenu->delete($this->post('id'))>0){
            $this->flash(['message'=>'Hapus Menu Berhasil', 'status'=>'success']);
        } else {
            $this->flash(['message'=>'Hapus Menu Gagal', 'status'=>'failed']);
        }
        redirect(base_url('settings/menu/'));
    }

    function ajx_organize(){
        if(!is_unlock('Menu Manager|VIEW')) return;
        $data = $this->input->post('data');
        if(empty($data))
            return;
        $this->_organize($data,0);
    }

    function ajx_get_detail($id){
        if(!is_unlock('Menu Manager|VIEW')) return;
        if(empty($id))
            return;
        echo json_encode($this->mmenu->read(id: $id));
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
        $this->set_rules('label','Label','required|max_length[50]');
        $this->set_rules('url','URL','required|max_length[100]');
        $this->set_rules('icon','Icon','required|max_length[20]');
        return $this->validation_run();
    }

    private function _post_data(){
        return [
            'label' => $this->post('label'),
            'url' => $this->post('url'),
            'icon' => $this->post('icon')
        ];
    }

}