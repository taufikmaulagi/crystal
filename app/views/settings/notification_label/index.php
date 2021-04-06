<?php

$list['label'] = array();
$no=1;
foreach($label as $key => $val){
    array_push($list['label'],[
        $no++,
        image($val['icon']),
        $val['nama'],
        '<span class="text-'.$val['color'].'"><i class="fa fa-circle"></i></i> '.$val['color'],
        action_button(base_url('settings/notification_label'), $val['id'])
    ]);
}

alert_flashdata('message','status');
echo panel(
        title: $title, 
        actions: [
            button(icon:'plus',text:'Tambah Baru',target:base_url('settings/notification_label/add'))        
        ],
        body:datatable(['#','Icon','Nama Label','Color','Opsi'],$list['label'],[
            [0,'style="width:50px"'],
            [1,'style="width:80px"'], //icon
            [4,'style="width:80px"']
        ]
    )
);