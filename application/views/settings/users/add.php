<?php

$list['role'] = array();
foreach($role as $key => $val){
    array_push($list['role'], ['id' => $val['id'], 'text' => $val['nama']]);
}
alert_flashdata('message', 'status');
echo panel(['color' => 'primary', 'title' => $title, 
    'action' => button(['target' => base_url('settings/users'), 'icon' => 'fa fa-arrow-left', 'text' => 'Kembali', 'color' => 'warning', 'size' => 'xs']),
    'content' => panel_body(
        row(
            col('sm-8',
                form(['method' => 'post', 'action' => base_url('settings/users/add'), 'form' => 
                    input_text('Nama Lengkap','nama').
                    input_select('User Group','role',$list['role']).
                    input_text('Username','username').
                    input_email('Email','email').
                    input_password('Password','password').
                    input_password('Konfirmasi Password','confirm_password').
                    input_submit('Selesai & Simpan','primary')
                ])
            )
        )
    )
]);