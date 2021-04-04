<?php
alert_flashdata('message', 'status');
echo panel(['color' => 'primary', 'title' => $title, 
    'action' => button(['target' => base_url('settings/notification_label'), 'icon' => 'fa fa-arrow-left', 'text' => 'Kembali', 'color' => 'warning', 'size' => 'xs']),
    'content' => panel_body(
        row(
            col('sm-8',
                form(['method' => 'post', 'enctype'=>'multipart/form-data', 'action' => base_url('settings/notification_label/edit/'.$label['id']), 'form' => 
                    input_text('Nama Label','nama', $label['nama']).
                    input_select('Warna', 'color', [
                        ['id'=>'primary','text'=>'PRIMARY'],
                        ['id'=>'warning','text'=>'WARNING'],
                        ['id'=>'danger','text'=>'DANGER'],
                        ['id'=>'info','text'=>'INFO'],
                        ['id'=>'success','text'=>'SUCCESS'],
                        ['id'=>'default','text'=>'DEFAULT'],
                    ], $label['color']).
                    input_image('Icon','icon',$label['icon']).
                    input_submit('Selesai & Simpan','primary')
                ])
            )
        )
    )
]);