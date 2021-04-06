<?php
alert_flashdata('message', 'status');
echo panel(
    title: $title, 
    actions:[
        button(theme:'warning',text:'Kembali',icon:'arrow-left',target:base_url('settings/notification_label'))
    ],
    body: panel_body(
        row([
            col('sm-8',
                form(
                    enctype: 'multipart/form-data', 
                    form:[
                        input('Nama Label','nama'),
                        input_select('Warna', 'color', [
                            ['id'=>'primary','text'=>'PRIMARY'],
                            ['id'=>'warning','text'=>'WARNING'],
                            ['id'=>'danger','text'=>'DANGER'],
                            ['id'=>'info','text'=>'INFO'],
                            ['id'=>'success','text'=>'SUCCESS'],
                            ['id'=>'default','text'=>'DEFAULT'],
                        ]),
                        input_image('Icon','icon'),
                        input_submit('Selesai & Simpan','primary')
                    ]
                )
            )
        ])
    )
);