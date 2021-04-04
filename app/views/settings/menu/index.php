<?php


$hidden['add'] = get('state') == 'edit' ? 'hidden' : '';
$hidden['edit'] = get('state') == 'edit' ? 'show' : 'hidden';

echo alert_flashdata('message','status').
row(
    col('sm-3',
        panel(['id'=>'tambahMenu', 'hidden'=>$hidden['add'],'title'=>'Tambah Baru', 'content'=>
            panel_body(
                form(['method'=>'post','action'=>base_url('settings/menu?state=add'),'form'=>
                    input_text('Label','label').
                    input_text('URL','url').
                    input_text('Icon','icon').
                    input_submit('Selesai & Simpan')
                ])
            )
        , 'color'=>'success'
        ]).
        panel(['id'=>'editMenu', 'title'=>'Edit Menu', 'hidden'=>$hidden['edit'], 
        'action' => button(['size' => 'xs', 'text'=>'Tambah Baru', 'icon'=>'fa fa-plus', 'color'=>'primary', 'onclick'=>'showTambahPanel()']),
        'content'=>
            panel_body(
                form(['method'=>'post','action'=>base_url('settings/menu?state=edit'),'form'=>
                    input_hidden('id').
                    input_text('Label','label').
                    input_text('URL','url').
                    input_text('Icon','icon').
                    input_submit('Simpan Perubahan')
                ])
            )
        , 'color'=>'warning'
        ])
    ). col('sm-9',
        panel(['title'=>$title, 'content'=>
            panel_body(
                '<div class="dd" id="nestable3">'.$menu.'</div>'
            )
        ,'color'=>'primary'
        ,'action'=>'<button id="nestable-menu" class="btn btn-xs btn-default active" data-toggle="class:show">
            <i class="fa fa-plus text"></i>
            <span class="text">Expand All</span>
            <i class="fa fa-minus text-active"></i>
            <span class="text-active">Collapse All</span>
        </button>'])            
    )
);

?>
<script>
    function edit(id){
        $.ajax({
            url : '<?=base_url('settings/menu/ajx_get_detail/')?>'+id,
            success : function(data){
                data = JSON.parse(data);
                $('#editMenu').show();
                $('#tambahMenu').hide();
                $("#editMenu input[name='id']").val(data[0].id);
                $("#editMenu input[name='label']").val(data[0].label);
                $("#editMenu input[name='url']").val(data[0].url);
                $("#editMenu input[name='icon']").val(data[0].icon);
            }
        })
    }

    function showTambahPanel(){
        $("#tambahMenu").show();
        $("#editMenu").hide();
    }
</script>
