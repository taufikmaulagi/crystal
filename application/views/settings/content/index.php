<?php

echo alert_flashdata('message','status').
panel(['title'=>$title, 'color'=>'primary',
    'content'=>panel_body(
        form(['action'=>base_url('settings/content/'),'method'=>'post','enctype'=>'multipart/form-data','form'=>
            input_text('Nama Aplikasi','nama',$main['nama']).
            input_text('Deskripsi Pendek','deskripsi_pendek',$main['deskripsi_pendek']).
            input_textarea('Deskripsi','deskripsi',$main['deskripsi']).
            input_image('Logo','logo',$main['logo']).
            input_text('Tahun Rilis','tahun_rilis',$main['tahun_rilis']).
            input_image('Favicon','favicon',$main['favicon']).'<p>&nbsp;</p>'.
            input_submit('Simpan Perubahan')
        ])
    )
]);