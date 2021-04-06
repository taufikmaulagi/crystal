<?php
alert_flashdata('message', 'status');
echo panel(
    title: $title,
    actions: [
        button(theme:'warning',text:'Kembali',icon:'arrow-left',target:base_url('settings/role'))
    ],
    body: panel_body(
        row([
            col('sm-8',
                form(
                    form: [
                        input('Nama Role','nama',$role['nama']),
                        input_submit('Simpan Perubahan','info')
                    ]
                )
            )
        ])
    )
);