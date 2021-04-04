<?php
alert_flashdata('message', 'status');
echo panel(['color' => 'primary', 'title' => $title, 
    'action' => button(['target' => base_url('settings/notification_label'), 'icon' => 'fa fa-arrow-left', 'text' => 'Kembali', 'color' => 'warning', 'size' => 'xs']),
    'content' => panel_body(
        row(
            col('sm-8',
                form(['method' => 'post', 'enctype'=>'multipart/form-data', 'action' => base_url('settings/notification_label/add'), 'form' => 
                    input_text('Nama Label','nama').
                    input_select('Warna', 'color', [
                        ['id'=>'primary','text'=>'PRIMARY'],
                        ['id'=>'warning','text'=>'WARNING'],
                        ['id'=>'danger','text'=>'DANGER'],
                        ['id'=>'info','text'=>'INFO'],
                        ['id'=>'success','text'=>'SUCCESS'],
                        ['id'=>'default','text'=>'DEFAULT'],
                    ]).
                    input_image('Icon','icon').
                    input_submit('Selesai & Simpan','primary')
                ])
            )
        )
    )
]);