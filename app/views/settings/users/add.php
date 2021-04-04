<?php

$list['role'] = array();
foreach($role as $key => $val){
    array_push($list['role'], ['id' => $val['id'], 'text' => $val['nama']]);
}
alert_flashdata('message', 'status');
echo panel(
    title: 'Tambah User Baru',
    actions: [
        button(theme: 'warning',icon: 'arrow-left',text: 'Kembali',target:base_url('settings/users'))
    ],
    body: panel_body(
        row([
            col('sm-8',
                form(
                    enctype: 'multipart/form-data',
                    form: [
                        input('Nama Lengkap','nama'),
                        input_date('Tanggal Lahir','tanggal_lahir'),
                        input_select('Jenis Kelamin','jenis_kelamin',[
                            ['id'=>'L','text'=>'Laki - Laki'],
                            ['id'=>'P','text'=>'Perempuan'],
                        ]),
                        input_select2('Role','role',$list['role']),
                        input_image('Foto','foto'),
                        input('Email','email',type:'email'),
                        input('Username','username'),
                        input('Password','password',type:'password'),
                        input('Konfirmasi Password','confirm_password',type:'password'),
                        input_submit('Selesai & Simpan','primary')
                    ]
                )
            )
        ])
    )
);