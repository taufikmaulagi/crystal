<?php
$hidden['add'] = $this->input->get('state') == 'edit' ? 'hidden' : '';
$hidden['edit'] = $this->input->get('state') == 'edit' ? 'show' : 'hidden';

alert_flashdata('message','status');
echo row([
    col('sm-3',
        panel(
            id: 'tambahMenu',
            hidden: $hidden['add'],
            title: 'Tambah',
            theme: 'success',
            body: panel_body(
                form(
                    action: base_url('settings/menu?state=add'),
                    form : [
                        input('Label','label'),
                        input('URL','url'),
                        input('Icon','icon'),
                        input_submit('Selesai & Simpan')
                    ]
                )
            )
        ).
        panel(
            id: 'editMenu',
            hidden: $hidden['edit'],
            title: 'Update',
            theme: 'warning',
            body: panel_body(
                form(
                    action: base_url('settings/menu?state=update'),
                    form : [
                        input_hidden('id'),
                        input('Label','label',type:'text'),
                        input('URL','url',type:'text'),
                        input('Icon','icon',type:'text'),
                        input_submit('Selesai & Simpan')
                    ]
                )
            )
        )
    ),
    col('sm-9',
        panel(
            title: $title,
            actions: [
                button(text:'Tambah Baru',icon:'plus',onclick:'showTambahPanel()',target:'#'),
                '<button id="nestable-menu" class="btn btn-sm btn-default active" data-toggle="class:show">
                    <i class="fa fa-plus text"></i>
                    <span class="text">Expand All</span>
                    <i class="fa fa-minus text-active"></i>
                    <span class="text-active">Collapse All</span>
                </button>'
            ],
            body: panel_body('<div class="dd" id="nestable3">'.$menu_list.'</div>')
        )
    )
])
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
