<?php

$list['user'] = array();
$no=1;
foreach($user as $key => $val){
    array_push($list['user'],[
        $no++, 
        $val['nama'], 
        $val['role'], 
        $val['email'], 
        ftime('%d %B %Y %H:%M', 
        $val['created_at']), 
        action_button(base_url('settings/users'),$val['id'])
    ]);
}
alert_flashdata('message', 'status');
echo panel(['color'=>'primary','title' => $title, 
'action' => button(['color' => 'primary', 'icon' => 'fa fa-plus', 'text' => 'Tambah Baru','size' => 'xs','target'=>base_url('settings/users/add')]).' '.
            button(['color' => 'danger', 'icon' => 'fa fa-users', 'text' => 'Role','size' => 'xs','target'=>base_url('settings/role')]).' '.
            button(['color' => 'warning', 'icon' => 'fa fa-unlock', 'text' => 'User Privelegs','size' => 'xs','target'=>base_url('settings/privilege')]),
    'content' => datatable(['#','Nama Lengkap','Group','Email','Tanggal Didaftarkan','Opsi'],$list['user'])
]);