<?php 

$list['tables'] = [['id'=>'','text'=>'-- Pilih Table --']];
foreach($tables as $key => $val){
    array_push($list['tables'], [
        'id' => $val['TABLE_NAME'],
        'text' => $val['TABLE_TYPE'].' : '.$val['TABLE_NAME'].' ( '.$val['TABLE_ROWS'].' Rows )'
    ]);
}
$list['fields'] = [];
$arrIndex = 1;
foreach($fields as $key=>$val){
    array_push($list['fields'],[
            $arrIndex++,
            '<span name="name|'.$val['COLUMN_NAME'].'">'.$val['COLUMN_NAME'].'</span>',
            strtoupper($val['COLUMN_TYPE']),
            '<input name="label|'.$val['COLUMN_NAME'].'" class="form-control" value="'.ucwords($val['COLUMN_NAME']).'">',
            '<textarea name="validation|'.$val['COLUMN_NAME'].'" class="form-control"></textarea>',
            '<select name="element|'.$val['COLUMN_NAME'].'" class="form-control">
                <option value="TEXT">TEXT</option>
                <option value="EMAIL">EMAIL</option>
                <option value="PASSWORD">PASSWORD
                <option value="TEXTAREA">TEXTAREA</option>
                <option value="DATE">DATE</option>
                <option value="IMAGE">IMAGE</option>
                <option value="NONE">NONE</option>
            </select>',
            $val['COLUMN_KEY'],
            $val['IS_NULLABLE']
        ]
    );
}

alert_flashdata('message','status');
echo panel(
        title: $title,
        actions: [
            button(icon: 'fa fa-terminal', text: 'Generate MVC Files', theme: 'danger',onclick: 'generate()')
        ],
        body: panel_body(
            row([
                col('sm-7',''),
                col('sm-5',
                    select2('table', $list['tables'], $this->input->get('tables'), width:'300px'),
                align: 'right')
            ])
        ).
        
        datatable(
            ['#','Field','Type','Label','Validation','Element','Key','Null'],
            $list['fields']
        )
    )
?>
<script>
    $("select[name='table']").on('change', function(){
        location.replace("<?=base_url('settings/crudgen?table=')?>"+$(this).val());
    });
    function generate(){
        var formData = {};
        $("input[name^='label|'], textarea[name^='validation|'], select[name^='element|'], span[name^='name|']").each(function(){
            if($(this).val() == ''){
                formData[$(this).attr('name')] = $(this).html();
            } else {
                formData[$(this).attr('name')] = $(this).val();
            }
        });
        formData['table'] = "<?=$this->input->get('table')?>";
        $.ajax({
            url: "<?=base_url('settings/crudgen/ajx_generate')?>",
            type: 'post',
            data: formData,
            success: function(data){
                alert(data);
            }
        })
    }
</script>