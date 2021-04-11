<?php
alert_flashdata('message', 'status');
echo panel(
    title: $title,
    actions: [
        button(theme: 'warning',icon: 'arrow-left',text: 'Kembali',target:base_url('petugas'))
    ],
    body: panel_body(
        row([
            col('sm-8',
                form(
                    enctype: 'multipart/form-data',
                    form: [
                        input('Nama','nama'),
                        input_date('Tanggal_lahir','tanggal_lahir'),
                        input_image('Foto','foto'),
                        input_submit('Selesai & Simpan','primary')
                    ]
                )
            )
        ])
    )
);
