<?php

alert_flashdata('message', 'status');
echo panel(['color' => 'primary', 'title' => $title, 
    'action' => button(['target' => base_url('settings/module'), 'icon' => 'fa fa-arrow-left', 'text' => 'Kembali', 'color' => 'warning', 'size' => 'xs']),
    'content' => panel_body(
        row(
            col('sm-8',
                form(['method' => 'post', 'action' => base_url('settings/module/edit/'.$module['id']), 'form' => 
                    input_text('Nama Module','nama',$module['nama']).
                    input_submit('Simpan Perubahan','primary')
                ])
            )
        )
    )
]);