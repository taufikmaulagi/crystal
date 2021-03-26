<?php

$temp['id'] = 0;
$list['access'] = array();
$no=1;
foreach($access as $key => $val){
    array_push($list['access'],[
        $no++, 
        $val['nama'],
        button_icon(['icon'=>'fa fa-pencil','size'=>'xs','color'=>'warning','onclick'=>'edit_access('.$val['id'].')']).action_button(base_url('settings/access'),$val['id'],['delete'])
    ]);
}
$list['module'] = array();
foreach ($module as $key => $val) {
    array_push($list['module'], [
        'id' => $val['id'],
        'text' => $val['nama']
    ]);
}
alert_flashdata('message', 'status');
echo row(
    col('sm-3',
        panel(['id'=>'tambahAkses', 'title' => 'Tambah Akses', 'color'=>'success', 'content'=> 
            panel_body(
                row(
                    col('sm-12',
                        form(['method' => 'post', 'action' => base_url('settings/access/add'), 'form' => 
                            input_text('Nama Akses','nama').
                            input_select2('Module','module',$list['module']).
                            input_submit('Selesai & Simpan','primary')
                        ])
                    )
                )
            )
        ]).
        panel(['id'=>'editAkses', 'title' => 'Edit Akses', 'color'=>'warning', 'hidden'=>'hidden',
            'action' => button(['size' => 'xs', 'text'=>'Tambah Baru', 'icon'=>'fa fa-plus', 'color'=>'primary', 'onclick'=>'showTambahPanel()']),
            'content'=> panel_body(
                row(
                    col('sm-12',
                        form(['method' => 'post', 'action' => base_url('settings/access/edit'), 'form' => 
                            input_text('Nama Akses','nama').
                            input_select2('Module','module',$list['module']).
                            input_submit('Simpan Perubahan','primary')
                        ])
                    )
                )
            )
        ])
    ).
    col('sm-9',
        panel(['id' => 'mainPanel', 'color'=>'primary','title' => $title, 
        'action' => button(['color' => 'warning', 'icon' => 'fa fa-folder', 'text' => 'Module','size' => 'xs','target'=>base_url('settings/module')]),
            'content' => panel_body(
                row(
                    col('sm-9','').
                    col('sm-3',
                    select2('module',$list['module']))
                )
            ).datatable(['#','Nama Akses','Opsi'],$list['access'])
        ])
    )
)

?>

<script>

    $("#mainPanel select[name='module']").on('change', function(){
        location.replace("<?=base_url('settings/access?module=')?>"+$("#mainPanel select[name='module']").val());
    });

    function edit_access(id){
        $.ajax({
            url:'<?=base_url('settings/access/ajx_get_detail/')?>'+id,
            success: function(data){
                data = JSON.parse(data);
                $("#editAkses input[name='nama']").val(data[0].nama);
                $("#editAkses input[name='module']").val(data[0].module);
                $("#tambahAkses").hide();
                $("#editAkses").show();
                $("#editAkses form").attr('action','<?=base_url('settings/access/edit/')?>'+id);
            }
        })
    }

    function showTambahPanel(){
        $("#tambahAkses").show();
        $("#editAkses").hide();
    }

</script>