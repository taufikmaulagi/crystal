<?php

$GLOBALS['select2_counter'] = 1;

function panel($theme='primary', $body='', $title='', $actions=[], $hidden='', $id=''){
    $html['actions'] = '';
    foreach($actions as $key => $val){
        $html['actions'] .= $val.'&nbsp;&nbsp';
    }
    return '<section '.$id.' class="panel panel-'.$theme.'" '.$hidden.'>
        <header class="panel-heading">
            <div class="row">
                <div class="col-sm-6">
                    <b>'.$title.'</b>
                </div>
                <div class="col-sm-6" style="text-align:right">
                    '.$html['actions'].'
                </div>
            </div>
        </header>
        '.$body.'
    </section>';
}

function panel_body($body){
    return '<div class="panel-body">'.$body.'</div>';
}

function row($cols){
    $html['cols'] = '';
    foreach($cols as $key => $val){
        $html['cols'] .= $val;
    }
    return '<div class="row">'.$html['cols'].'</div>';
}

function col($size, $body){
    return '<div class="col-'.$size.'">'.$body.'</div>';
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

function button($theme='primary',$text='Button',$target='',$icon='',$size='sm',$onclick='',$style=''){
	$icon = !empty($icon) ? '<i class="fa fa-'.$icon.'"></i>' : '';
    $onclick = !empty($onclick) ? 'onclick="'.$onclick.'"' : '';
    $style = !empty($style) ? 'style="'.$style.'"' : '';
	return '<a href="'.$target.'" class="btn btn-'.$theme.' btn-'.$size.'" '.$style.' '.$onclick.'>'.$icon.'&nbsp;&nbsp;'.$text.'</a>';
}

function button_icon($theme='primary',$target='',$icon='',$size='sm',$onclick='',$style=''){
	$icon = !empty($icon) ? '<i class="fa fa-'.$icon.'"></i>' : '';
    $onclick = !empty($onclick) ? 'onclick="'.$onclick.'"' : '';
    $style = !empty($style) ? 'style="'.$style.'"' : '';
	return '<a href="'.$target.'" class="btn btn-'.$size.' btn-icon-only btn-'.$theme.'" '.$style.' '.$onclick.'>
				'.$icon.'
			</a>';
}

function badge($text='Badge',$theme='primary'){
	return '<span class="label bg-'.$theme.'"> '.$text.' </span>';
}

function form($action='#',$method='post',$enctype='',$form=''){
    return '<form action="'.$action.'" method="'.$method.'" enctype="'.$enctype.'" autocomplete="off">'.$form.'</form>';
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

function image($image='default.png', $path='./public/images/', $style=''){
    $style = !empty($args['style']) ? 'style="'.$args['style'].'"' : 'style="width:100%"';
    return '<img src="'.base_url($path.$image).'" '.$style.'>';
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