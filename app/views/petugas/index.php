<?php
$list['petugas'] = array();
$arrIndex=1;
foreach($petugas as $key => $val){
    array_push($list['petugas'],[
        $arrIndex++, 
        $val['nama'], 
        $val['tanggal_lahir'], 
        image($val['foto']),
        action_button(base_url('petugas'),$val['id'],module:'Petugas')
    ]);
}
alert_flashdata('message', 'status');
echo panel(
    title: 'Data Seluruh Petugas',
    actions: [
        is_unlock('Petugas|ADD', button(theme: 'primary',text: 'Tambah Baru',target:base_url('petugas/add'),icon:'plus')),
    ],
    body: datatable([
        '#',
        'Nama',
        'Tanggal_lahir',
        'Foto',
        'Opsi'
    ],$list['petugas'],
        style: [
                [3,'style="width:70px"']
        ]
    )
);