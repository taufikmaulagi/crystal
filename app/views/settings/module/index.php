<?php

$list['module'] = array();
$no=1;
foreach($module as $key => $val){
    array_push($list['module'],[
        $no++, 
        $val['nama'],
        button(['color'=>'info','text'=>'Access','icon'=>'fa fa-lock','target'=>base_url('settings/access?module='.$val['id']),'size'=>'xs']).'&nbsp;'.action_button(base_url('settings/module'),$val['id'])
    ]);
}
alert_flashdata('message', 'status');
echo panel(['color'=>'primary','title' => $title, 
'action' => button(['color' => 'primary', 'icon' => 'fa fa-plus', 'text' => 'Tambah Baru','size' => 'xs','target'=>base_url('settings/module/add')]).' '.
            button(['color' => 'danger', 'icon' => 'fa fa-unlock', 'text' => 'User Privilege','size' => 'xs','target'=>base_url('settings/privilege')]),
    'content' => datatable(['#','Nama Modul','Opsi'],$list['module'])
]);

?>