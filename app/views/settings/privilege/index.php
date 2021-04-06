<?php

$list['privilege'] = '';
$no=1;
$role_id = empty($this->input->get('role')) ? 2 : $this->input->get('role');
foreach($module as $key => $val){
    $list['privilege'] .= '<tr>
        <td style="width:1px; white-space:nowrap">'.$no++.'</td>
        <td style="width:20%">'.$val['label'].'</td>';
        $checked='';
        foreach($permission as $pkey => $pval){
            if($pval['module'] == $val['id'] && $pval['access'] == 'VIEW' && $pval['role'] == $role_id){
                $checked='checked';
            }
        }
        $list['privilege'] .= '<td>
            <label class="checkbox-inline m-r">
                <input type="checkbox" id="inlineCheckbox1" value="VIEW" onchange="set_permission('.$val['id'].')" '.$checked.'> <b>VIEW</b>
            </label>
        </td>';
        $checked='';
        foreach($permission as $pkey => $pval){
            if($pval['module'] == $val['id'] && $pval['access'] == 'ADD' && $pval['role'] == $role_id){
                $checked='checked';
            }
        }
        $list['privilege'] .= '<td>
            <label class="checkbox-inline m-r">
                <input type="checkbox" id="inlineCheckbox1" value="ADD" onchange="set_permission('.$val['id'].')" '.$checked.'> <b>ADD</b>
            </label>
        </td>';
        $checked='';
        foreach($permission as $pkey => $pval){
            if($pval['module'] == $val['id'] && $pval['access'] == 'EDIT' && $pval['role'] == $role_id){
                $checked='checked';
            }
        }
        $list['privilege'] .= '<td>
            <label class="checkbox-inline m-r">
                <input type="checkbox" id="inlineCheckbox1" value="EDIT" onchange="set_permission('.$val['id'].')" '.$checked.'> <b>EDIT</b>
            </label>
        </td>';
        $checked='';
        foreach($permission as $pkey => $pval){
            if($pval['module'] == $val['id'] && $pval['access'] == 'DELETE' && $pval['role'] == $role_id){
                $checked='checked';
            }
        }
        $list['privilege'] .= '<td>
            <label class="checkbox-inline m-r">
                <input type="checkbox" id="inlineCheckbox1" value="DELETE" onchange="set_permission('.$val['id'].')" '.$checked.'> <b>DELETE</b>
            </label>
        </td>';
        $checked='';
        foreach($permission as $pkey => $pval){
            if($pval['module'] == $val['id'] && $pval['access'] == 'EXPORT' && $pval['role'] == $role_id){
                $checked='checked';
            }
        }
        $list['privilege'] .= '<td>
            <label class="checkbox-inline m-r">
                <input type="checkbox" id="inlineCheckbox1" value="EXPORT" onchange="set_permission('.$val['id'].')" '.$checked.'> <b>EXPORT</b>
            </label>
        </td>';
        $checked='';
        foreach($permission as $pkey => $pval){
            if($pval['module'] == $val['id'] && $pval['access'] == 'IMPORT' && $pval['role'] == $role_id){
                $checked='checked';
            }
        }
        $list['privilege'] .= '<td>
            <label class="checkbox-inline m-r">
                <input type="checkbox" id="inlineCheckbox1" value="IMPORT" onchange="set_permission('.$val['id'].')" '.$checked.'> <b>IMPORT</b>
            </label>
        </td>
    </tr>';
}

$list['role'] = '';
foreach($role as $key => $val){
    $selected = $this->input->get('role') == $val['id'] ? 'selected="selected"' : '';
    $list['role'] .= '<option value="'.$val['id'].'" '.$selected.'>'.$val['nama'].'</option>';
}

echo panel(
    title: $title,
    actions: [
        is_unlock('Users|VIEW', button(theme: 'info',text: 'Users',target:base_url('settings/users'),icon:'users')),
        is_unlock('Role|VIEW', button(theme: 'warning',text: 'Role',target:base_url('settings/role'),icon:'users')),
    ],
    body: panel_body(
        row([
            col('sm-9',''

            ),
            col('sm-3',
                '<select class="form-control input-sm" id="srole" onchange="change_role()">'.$list['role'].'</select>'
            )
        ])
    ).
    '<div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th> # </th>
                <th> Module </th>
                <th colspan="6">Permission</th>
            </tr>
            '.$list['privilege'].'
        </table>
    </div>'
);

?>
<script>
    function change_role(){
        location.replace("<?=base_url('settings/privilege?role=')?>"+$('#srole').val());
    }

    function set_permission(module){
        $.ajax({
            type:'POST',
            url:'<?=base_url('settings/privilege/set_permission')?>',
            data: {
                module: module, 
                role: $('#srole').val(), 
                permission: $(event.target).val()
            }
        });
    }

    function set_permission(module){
        $.ajax({
            type:'POST',
            url:'<?=base_url('settings/privilege/set_permission')?>',
            data: {
                module: module, 
                role: $('#srole').val(), 
                permission: $(event.target).val()
            }
        });
    }

    function set_permission_all(module){
        
    }
</script>