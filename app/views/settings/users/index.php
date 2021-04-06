<?php

$list['user'] = array();
$no=1;
foreach($user as $key => $val){
    array_push($list['user'],[
        $no++, 
        image($val['foto'], class: 'rounded'),
        $val['nama'], 
        badge($val['role']), 
        table_text($val['email']), 
        ftime('%d %B %Y %H:%M', $val['created_at']), 
        action_button(base_url('settings/users'),$val['id'])
    ]);
}
$list['role'] = array(['id'=>'','text'=>'-- Semua Role --']);
foreach($role as $key => $val){
    array_push($list['role'],[
        'id' => $val['id'],
        'text' => $val['nama']
    ]);
}
alert_flashdata('message', 'status');
echo panel(
    title: 'Data Seluruh Users',
    actions: [
        is_unlock('Users|ADD', button(theme: 'primary',text: 'Tambah Baru',target:base_url('settings/users/add'),icon:'plus')),
        button(theme: 'warning',text: 'Role',target:base_url('settings/role'),icon:'users'),
        button(theme: 'danger',text: 'Privileges',target:base_url('settings/privileges'),icon:'unlock'),
    ],
    body: panel_body(
        row([
            col('sm-12',align:'right',
                body: select2('role', $list['role'], $this->input->get('role'))
            )
        ])
    )
    .datatable(['#','Foto','Nama Lengkap','Role','Email','Tanggal Didaftarkan','Opsi'],$list['user'],
        style: [
            [1,'style="width:10px"']
        ]
    )
);
?>
<script>

    $("select[name='role']").on('change', function(){
        if($(this).val()!=''){
            location.replace("<?=base_url('settings/users?role=')?>"+$(this).val());
        } else {
            location.replace("<?=base_url('settings/users')?>");
        }
    })

</script>