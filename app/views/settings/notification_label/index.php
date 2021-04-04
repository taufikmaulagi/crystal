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

echo alert_flashdata('message','status').
panel(['title'=>$title, 'color'=>'primary', 'action'=>
    button(['color'=>'primary','text'=>'Tambah Baru','icon'=>'fa fa-plus','size'=>'xs','target'=>base_url('settings/notification_label/add/')]),
    'content' => datatable(
        ['#','Icon','Nama Label','Color','Opsi'],
        $list['label'],[
            [0,'style="width:50px"'],
            [1,'style="width:80px"'], //icon
            [4,'style="width:80px"']
        ]
    )
]);