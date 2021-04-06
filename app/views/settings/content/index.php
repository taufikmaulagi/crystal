<?php

echo alert_flashdata('message','status').
panel(
    title: $title, 
    body: panel_body(
        form(
            enctype: 'multipart/form-data',
            form: [
                input('Nama Aplikasi','nama',$main['nama']),
                input('Deskripsi Pendek','deskripsi_pendek',$main['deskripsi_pendek']),
                input('Email','email',$main['email'],type:'email'),
                input_textarea('Deskripsi','deskripsi',$main['deskripsi']),
                input_image('Logo','logo',$main['logo']),
                input('Tahun Rilis','tahun_rilis',$main['tahun_rilis']),
                input_image('Favicon','favicon',$main['favicon']),
                input_submit('Simpan Perubahan'),
            ]
        )
    )
);