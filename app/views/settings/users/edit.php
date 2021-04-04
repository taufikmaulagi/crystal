<?php

$list['role'] = array();
foreach($role as $key => $val){
    array_push($list['role'], ['id' => $val['id'], 'text' => $val['nama']]);
}
alert_flashdata('message', 'status');
echo panel(
    title: 'Update Data User',
    actions: [
        button(theme: 'warning',icon: 'arrow-left',text: 'Kembali',target:base_url('settings/users'))
    ],
    body: panel_body(
        row([
            col('sm-8',
                form(
                    enctype: 'multipart/form-data',
                    form: [
                        input('Nama Lengkap','nama',$user['nama']),
                        input_date('Tanggal Lahir','tanggal_lahir',$user['tanggal_lahir']),
                        input_select('Jenis Kelamin','jenis_kelamin',[
                            ['id'=>'L','text'=>'Laki - Laki'],
                            ['id'=>'P','text'=>'Perempuan'],
                        ],$user['jenis_kelamin']),
                        input_select2('Role','role',$list['role'],$user['id_role']),
                        input_image('Foto','foto',$user['foto']),
                        input('Email','email',$user['email'],type:'email'),
                        input('Username','username',$user['username']),
                        input('Password','password',$user['password'],type:'password'),
                        input('Konfirmasi Password','confirm_password',$user['password'],type:'password'),
                        input_submit('Simpan Perubahan','info')
                    ]
                )
            )
        ])
    )
);