<?php

$GLOBALS['select2_counter'] = 1;

function panel($args){
    $args['color'] = !empty($args['color']) ? $args['color'] : 'default';
    $args['content'] = !empty($args['content']) ? $args['content'] : '';
    $args['title'] = !empty($args['title']) ? $args['title'] : '';
    $args['action'] = !empty($args['action']) ? $args['action'] : '';
    $args['hidden'] = !empty($args['hidden']) ? $args['hidden'] : '';
    $args['id'] = !empty($args['id']) ? 'id="'.$args['id'].'"' : '';
    return '<section '.$args['id'].' class="panel panel-'.$args['color'].'" '.$args['hidden'].'>
        <header class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                    <b>'.$args['title'].'</b>
                </div>
                <div class="col-sm-6" style="text-align:right">
                    '.$args['action'].'
                </div>
            </div>
        </header>
        '.$args['content'].'
    </section>';
}

function panel_body($content){
    return '<div class="panel-body">'.$content.'</div>';
}

function row($content){
    return '<div class="row">'.$content.'</div>';
}

function col($col, $content){
    return '<div class="col-'.$col.'">'.$content.'</div>';
}

function datatable($head, $body, $style=array()){
	$thead = '';
	$tbody = '';
    $no=0;

	foreach($head as $key => $val){
        $append = '';
        for($i=0;$i<count($style);$i++){
            if($no == $style[$i][0])
                $append = $style[$i][1];
        }
        $thead .= '<th '.$append.'>'.$val.'</th>';
        $no++;
    }
	foreach($body as $bkey => $bval){
        $no=0;
		$tbody .= '<tr>';
		foreach($bval as $key => $val){ 
            $append = '';
            for($i=0;$i<count($style);$i++){
                if($no == $style[$i][0])
                    $append = $style[$i][1];
            }         
            $tbody .= '<td '.$append.'>'.$val.'</td>';
            $no++;
        }
		$tbody .= '</tr>';
	}
	return '<div class="table-responsive"><table class="table table-striped table-hover" data-ride="datatables">
				<thead>'.$thead.'</thead>
				<tbody>'.$tbody.'</tbody>
			</table></div>';
}

function button($args=array()){
	$args['color'] = empty($args['color']) ? 'primary' : $args['color'];
	$args['text'] = empty($args['text']) ? 'Button' : $args['text'];
	$args['target'] = empty($args['target']) ? 'javascript:void(0)' : $args['target'];
	$args['icon'] = empty($args['icon']) ? '' : '<i class="'.$args['icon'].'"></i>';
	$args['size'] = empty($args['size']) ? 'sm' : $args['size'];
    $args['style'] = empty($args['style']) ? '' : 'style="'.$args['style'].'"';
    $args['onclick'] = empty($args['onclick']) ? '' : 'onclick="'.$args['onclick'].'"';
	return '<a href="'.$args['target'].'" class="btn btn-'.$args['size'].' btn-'.$args['color'].'" '.$args['style'].' '.$args['onclick'].'>
				'.$args['icon'].'&nbsp;&nbsp;'.$args['text'].'
			</a>';
}

function button_icon($args=array()){
	$args['color'] = empty($args['color']) ? 'primary' : $args['color'];
	$args['target'] = empty($args['target']) ? 'javascript:void(0)' : $args['target'];
	$args['icon'] = empty($args['icon']) ? '' : '<i class="'.$args['icon'].'"></i>';
	$args['size'] = empty($args['size']) ? 'sm' : $args['size'];
    $args['style'] = empty($args['style']) ? '' : 'style="'.$args['style'].'"';
    $args['onclick'] = empty($args['onclick']) ? '' : 'onclick="'.$args['onclick'].'"';
	return '<a href="'.$args['target'].'" class="btn btn-'.$args['size'].' btn-icon-only btn-'.$args['color'].'" '.$args['style'].' '.$args['onclick'].'>
				'.$args['icon'].'
			</a>';
}

function badge($args=array()){
	$args['color'] = empty($args['color']) ? 'primary' : $args['color'];
	$args['text'] = empty($args['text']) ? 'Add Text' : $args['text'];
	return '<span class="badge badge-'.$args['color'].' badge-roundless"> '.$args['text'].' </span>';
}

function form($args=array()){
	$args['enctype'] = empty($args['enctype']) ? '' : $args['enctype'];
	$args['method'] = empty($args['method']) ? '' : $args['method'];
	$args['action'] = empty($args['action']) ? '' : $args['action'];
    $args['form'] = empty($args['form']) ? '' : $args['form'];
    return '<form action="'.$args['action'].'" method="'.$args['method'].'" enctype="'.$args['enctype'].'" autocomplete="off">'.$args['form'].'</form>';
}

function input_text($label, $name, $value=''){
    $ci =& get_instance(); 
    $value = !empty($ci->input->post($name)) ? $ci->input->post($name) : $value;
    return '<div class="form-group">
            <label> '.$label.' </label>
            <input type="text" name="'.$name.'" class="form-control" placeholder="Masukan '.$label.' disini . ." value="'.$value.'">
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_email($label, $name, $value=''){
    $ci =& get_instance(); 
    $value = !empty($ci->input->post($name)) ? $ci->input->post($name) : $value;
    return '<div class="form-group">
            <label> '.$label.' </label>
            <input type="email" name="'.$name.'" class="form-control" placeholder="Masukan '.$label.' disini . ." value="'.$value.'">
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_text_disable($label, $name, $value=''){
    $ci =& get_instance(); 
    $value = !empty($ci->input->post($name)) ? $ci->input->post($name) : $value;
    return '<div class="form-group">
            <label> '.$label.' </label>
            <input type="text" name="'.$name.'" class="form-control" placeholder="Masukan '.$label.' disini . ." value="'.$value.'" disabled>
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_hidden($name, $value=''){
    return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
}

function input_number($label, $name, $value=''){
    $ci =& get_instance(); 
    $value = !empty($ci->input->post($name)) ? $ci->input->post($name) : $value;
    return '<div class="form-group">
            <label> '.$label.' </label>
            <input type="number" name="'.$name.'" class="form-control" placeholder="Masukan '.$label.' disini . ." value="'.$value.'">
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_password($label, $name, $value=''){
    $ci =& get_instance(); 
    $value = !empty($ci->input->post($name)) ? $ci->input->post($name) : $value;
    return '<div class="form-group">
            <label> '.$label.' </label>
            <input type="password" name="'.$name.'" class="form-control" placeholder="Masukan '.$label.' disini . ." value="'.$value.'">
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_textarea($label, $name, $value=''){
    $ci =& get_instance(); 
    $value = !empty($ci->input->post($name)) ? $ci->input->post($name) : $value;
    return '<div class="form-group">
            <label> '.$label.' </label>
            <textarea name="'.$name.'" class="form-control" placeholder="Masukan '.$label.' disini . .">'.$value.'</textarea>
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_radio($label, $name, $data, $value=''){
    $option = '';
    $ci =& get_instance(); 
    foreach($data as $key => $val){
        if(empty($ci->input->post($name))){
            $checked = !empty($value) && $value == $val['id'] ? 'checked' : '';
        } else {
            $checked = $ci->input->post($name) == $val['id'] ? 'checked' : '';
        }
        $option.= '<label>';
        $option.= '<input type="radio" name="'.$name.'" value="'.$val['id'].'" '.$checked.'> '.$val['nama'].'</br/>';
        $option.= '</label>';
    }
    return '<div class="form-group">
            <label> '.$label.' </label><br/>
            <div class="radio-list">'
                .$option.
            '</div>
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_date($label, $name, $value='', $start='2000-03-01'){
    $ci =& get_instance(); 
    $value = !empty($ci->input->post($name)) ? $ci->input->post($name) : $value;
    return '<div class="form-group">
            <label> '.$label.' </label><br/>
            <div class="input-group input-medium date date-picker" data-date="'.$start.'" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
				<input type="text" class="form-control" name="'.$name.'" value="'.$value.'" readonly>
				<span class="input-group-btn">
					<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
				</span>
			</div>
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_select($label, $name, $data, $value=''){
    $ci =& get_instance();
    $option = '';
    foreach($data as $key => $val){
        if(empty($ci->input->post($name))){
            $selected = !empty($value) && $value == $val['id'] ? 'selected="selected"' : '';
        } else {
            $selected = $ci->input->post($name) == $val['id'] ? 'selected="selected"' : '';
        }
        $option.= '<option value="'.$val['id'].'" '.$selected.'> '.$val['text'].'</option>';
    }
    return '<div class="form-group">
            <label> '.$label.' </label><br/>
            <select name="'.$name.'" class="form-control">
                <option value="">-- Pilih '.$label.' --</option>'
                .$option.
            '</select>
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_select2($label, $name, $data, $value=''){;
    $ci =& get_instance();
    $option = '';
    foreach($data as $key => $val){
        if(empty($ci->input->post($name))){
            $selected = !empty($value) && $value == $val['id'] ? 'selected="selected"' : '';
        } else {
            $selected = $ci->input->post($name) == $val['id'] ? 'selected="selected"' : '';
        }
        $option.= '<option value="'.$val['id'].'" '.$selected.'> '.$val['text'].'</option>';
    }

    return '<div class="form-group">
            <label> '.$label.' </label><br/>
            <select name="'.$name.'" style="width:200px" id="select2-option'.$GLOBALS['select2_counter']++.'">
                <option value="">-- Pilih '.$label.' --</option>'
                .$option.
            '</select>
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_image($label, $name, $value=''){
    $value = empty($value) ? 'default.png' : $value;
    return '<div class="form-group">
            <label> '.$label.' </label><br/>
            <img width="250px" class="img-thumbnail" src="'.base_url('public/images/'.$value).'">
            <input type="file" name="'.$name.'" onchange="change_img_file(this)">
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_file($label, $name){
    return '<div class="form-group">
            <label> '.$label.' </label>
            <input type="file" name="'.$name.'" id="img_inp">
            <span class="help-block m-b-none text-danger">'.form_error($name).'</span>
        </div>';
}

function input_submit($value, $color="primary"){
    return '<p>&nbsp;</p><button type="submit" class="btn btn-'.$color.'"><i class="fa fa-check"></i>&nbsp;&nbsp;'.$value.'</button>';
}

function action_button($url,$id,$avail=['edit','delete']){
    $action = '';
    if(in_array('edit',$avail)){
        $action.=button_icon(['color'=>'warning','icon'=>'fa fa-pencil','target'=>$url.'/edit/'.$id,'size'=>'xs']);
    }
    if(in_array('delete',$avail)){
        $action.='&nbsp;&nbsp;<button class="btn btn-xs btn-danger" data-toggle="popover" data-html="true" data-placement="left" 
            data-content=\'<form method="post" action="'.$url.'/delete/">
                <input type="hidden" name="id" value="'.$id.'">
                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Iya, Hapus !</button>
            </form>\' title="" data-original-title=\'<button type="button" class="close pull-right" data-dismiss="popover">&times;</button>Anda Yakin ?\'>
        <i class="fa fa-trash-o"></i></button>';
    }
    return $action;
}

function image($img='', $args=array()){
    $args['style'] = !empty($args['style']) ? $args['style'] : 'width:100%';
    $args['location'] = !empty($args['location']) ? $args['location'] : 'public/images/';
    $args['default'] = !empty($args['default']) ? $args['default'] : 'default.png';
    if(empty($img)){
        $img = $args['default'];
    }
    return '<img src="'.base_url($args['location'].$img).'" style="'.$args['style'].'">';
}

function alert_flashdata($flashdata, $status='success'){
    $ci =& get_instance();
    $color='success';
    if($ci->session->flashdata($status)!='success'){
        $color='danger';
    }
    if(!empty($ci->session->flashdata($flashdata))){
        echo '<div class="alert alert-'.$color.' alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="fa fa-comment-o"></i>&nbsp;&nbsp;
                '.$ci->session->flashdata($flashdata).'
            </div>';
    }
}

function ftime($format, $date){
    return strftime($format, strtotime($date));
}

function modal($id, $title, $content, $theme="primary"){
    return  '<div id="'.$id.'" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header modal-header-'.$theme.'">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">'.$title.'</h4>
        </div>
        <div class="modal-body">
          <p>'.$content.'</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>';
}

function select2($name, $data, $value=''){
    $ci =& get_instance();
    $option = '';
    foreach($data as $key => $val){
        if(empty($ci->input->get($name))){
            $selected = !empty($value) && $value == $val['id'] ? 'selected="selected"' : '';
        } else {
            $selected = $ci->input->get($name) == $val['id'] ? 'selected="selected"' : '';
        }
        $option.= '<option value="'.$val['id'].'" '.$selected.'> '.$val['text'].'</option>';
    }
    return '<select name="'.$name.'" id="select2-option'.$GLOBALS['select2_counter']++.'" style="width:100%">'
                .$option.
            '</select>';
}