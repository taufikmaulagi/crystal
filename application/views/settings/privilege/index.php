<?php

$list['privilege'] = '';
$no=1;
foreach($module as $key => $val){
    $list['access'] = '';
    foreach($access as $akey => $aval){
        if($aval['module'] == $val['id']){
            $checked = '';
            foreach($permission as $pkey => $pval){
                if($pval['access'] == $aval['id']){
                    $checked = 'checked';
                }
            }
            $list['access'] .= '<label class="checkbox-inline m-r">
                <input type="checkbox" id="inlineCheckbox1" value="option1" '.$checked.' onclick="set_permission('.$aval['id'].')"> '.$aval['nama'].'
            </label>';
        }
    }
    $list['privilege'] .= '<tr>
        <td style="width:1px; white-space:nowrap">'.$no++.'</td>
        <td style="width:20%">'.$val['nama'].'</td>
        <td>'.$list['access'].'</td>
    </tr>';
}

$list['role'] = '';
foreach($role as $key => $val){
    $selected = get('role') == $val['id'] ? 'selected="selected"' : '';
    $list['role'] .= '<option value="'.$val['id'].'" '.$selected.'>'.$val['nama'].'</option>';
}



echo panel(['title'=>$title,'color'=>'primary',
    'action' => button(['target'=>base_url('settings/users'),'size'=>'xs','color'=>'danger','icon'=>'fa fa-users','text'=>'Seluruh User']).' '.
                button(['target'=>base_url('settings/module'),'size'=>'xs','color'=>'warning','icon'=>'fa fa-folder-open','text'=>'Module']).' ',
    'content'=> panel_body(
        row(
            col('sm-9',''

            ).
            col('sm-3',
                '<select class="form-control input-sm" id="srole" onchange="change_role()">'.$list['role'].'</select>'
            )
        )
    ).
    '<table class="table table-striped">
        <tr>
            <th> # </th>
            <th> Module </th>
            <th> Permission </th>
        </tr>
        '.$list['privilege'].'
    </table>'
]);

?>
<script>
    function change_role(){
        location.replace("<?=base_url('settings/privilege?role=')?>"+$('#srole').val());
    }

    function set_permission(access_id){
        $.ajax({
            type:'POST',
            url:'<?=base_url('settings/privilege/set_permission')?>',
            data: {access_id: access_id, role: $('#srole').val()}
        });
    }
</script>