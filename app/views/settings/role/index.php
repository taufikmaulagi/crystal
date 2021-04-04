<?php

$list['role'] = array();
$no=1;
foreach($role as $key => $val){
    array_push($list['role'],[
        $no++, 
        $val['nama'],
        action_button(base_url('settings/role'),$val['id'])
    ]);
}
alert_flashdata('message', 'status');
echo panel(['color'=>'primary','title' => $title, 
'action' => button(['color' => 'primary', 'icon' => 'fa fa-plus', 'text' => 'Tambah Baru','size' => 'xs','target'=>base_url('settings/role/add')]).' '.
            button(['color' => 'danger', 'icon' => 'fa fa-users', 'text' => 'Semua User','size' => 'xs','target'=>base_url('settings/users')]),
    'content' => datatable(['#','Nama Group','Opsi'],$list['role'])
]);