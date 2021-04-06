<?php

$list['role'] = array();
$no=1;
foreach($role as $key => $val){
    array_push($list['role'],[
        $no++, 
        $val['nama'], 
        action_button(base_url('settings/role'),$val['id'],module: 'Role')
    ]);
}
alert_flashdata('message', 'status');
echo panel(
    title: $title,
    actions: [
        is_unlock('Role|ADD', button(theme: 'primary',text: 'Tambah Baru',target:base_url('settings/role/add'),icon:'plus')),
        is_unlock('Users|VIEW', button(theme: 'info',text: 'Users',target:base_url('settings/users'),icon:'users')),
        is_unlock('User Privilege|VIEW', button(theme: 'danger',text: 'Privileges',target:base_url('settings/privilege'),icon:'unlock')),
    ],
    body: datatable(['#','Nama Role','Opsi'],$list['role'])
);