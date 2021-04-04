<?php

$GLOBALS['title'] = '';

function template($style='default',$content='templates/empty',$title='Judul belum diset! Perbaiki',$plugin=array(),){
    $el =& get_instance();
    $data['main'] = $el->db->get('content')->result_array()[0];
    $data['heaplug'] = '';
    $data['fooplug'] = '';
    $data['title'] = $title;
    foreach($plugin as $key => $val){
        $data['heaplug'] .= load_plugin($val)['head'];
        $data['fooplug'] .= load_plugin($val)['foot'];
    }
    $el->load->model('notification_model','mnotif');
    $data['notif_lastest'] = $el->mnotif->read(['users'=>$el->session->userdata('logged_in')['id'],'status'=>'unseen']);
    $data['notif_all'] = $el->mnotif->read(['users'=>$el->session->userdata('logged_in')['id']]);
    $el->load->model('menu_model','mmenu');
    $res['menu'] = $el->mmenu->read(['parent'=>0]);
    $data['menu'] = load_menu($res['menu']);
    $data['sidemenu'] = $data['menu']['menu'];
    $data['bread'] = $data['menu']['bread'];
    $el->load->view('templates/'.$style.'/head', $data);
    $el->load->view('templates/'.$style.'/nav');
    $el->load->view('templates/'.$style.'/side');
    $el->load->view('templates/'.$style.'/bread');
    $el->load->view($content);
    $el->load->view('templates/'.$style.'/foot');
}

function assets($path=''){
    return base_url('public/'.$path);
}

function load_img($path=''){
    return base_url('public/images/'.$path);
}

function load_plugin($plugin){
    switch($plugin){
        case 'datatables':
            return [
                'head' => '<link rel="stylesheet" href="'.assets().'js/datatables/datatables.css" type="text/css"/>',
                'foot' => '<script src="'.assets().'js/datatables/jquery.dataTables.min.js"></script>'
            ];
        break;
        case 'nestable':
            return [
                'head' => '<link rel="stylesheet" href="'.assets().'js/nestable/nestable.css" type="text/css" />',
                'foot' => '<script src="'.assets().'js/nestable/jquery.nestable.js"></script><script src="'.assets().'js/nestable/demo.js"></script>'
            ];
        break;
    }
}

function set_rules($name, $label, $rule){
    $el =& get_instance();
    $el->form_validation->set_rules($name, $label, $rule.'|trim|xss_clean');
}

function validation_run(){
    $el =& get_instance();
    return $el->form_validation->run();
}

function post($post){
    $el =& get_instance();
    return $el->input->post($post);
}

function get($get){
    $el =& get_instance();
    return $el->input->get($get);
}

function flash($flash,$state='set'){
    $el =& get_instance();
    if($state=='show')
        return $el->session->flashdata($flash);
    return $el->session->set_flashdata($flash);
}

function load_menu($item,$class=''){
    $el =& get_instance();
    $html = '<ul class="nav '.$class.'">';
    $bread = '';
    foreach($item as $key => $val){
        $el->load->model('menu_model','mmenu');
        $res['menu'] = $el->mmenu->read(['parent'=>$val['id']]);
        $active = '';
        
        // if($val['url']=='/' && empty($el->uri->uri_string())){
        //     $active = 'class="active"';
        // } else if(!empty($el->uri->segment(1)) && strpos('/// '.$val['url'], $el->uri->segment(1))>0){
        //     $bread .= '&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;<i class="'.$val['icon'].'"></i>&nbsp;&nbsp;'.$val['label'];
        //     $active = 'class="active"';
        // } else if(!empty($el->uri->segment(2)) && strpos('/// '.$val['url'], $el->uri->segment(2))>0){
        //     $bread .= '&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;<i class="'.$val['icon'].'"></i>&nbsp;&nbsp;'.$val['label'];
        //     $active = 'class="active"';
        // }
        $html .= '<li '.$active.'>
                    <a href="'.base_url($val['url']).'"  >';
        if($val['parent']!=0){
            $html.= '<i class="fa fa-angle-right"></i>';
        } else {
            $html.= '<i class="'.$val['icon'].' icon">
                        <b class="bg-success"></b>
                    </i>';
        }
                if(count($res['menu'])>0){
                    $html.='<span class="pull-right">
                    <i class="fa fa-angle-down text"></i>
                    <i class="fa fa-angle-up text-active"></i>
                  </span>';
                }
        $html .= '<span>'.$val['label'].'</span>
                    </a>';
            if(count($res['menu'])>0){
                $data['menu'] = load_menu($res['menu'],'lt');
                $html.= $data['menu']['menu'];
                $bread.= $data['menu']['bread'];

            }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return ['menu' => $html, 'bread'=>$bread];
}