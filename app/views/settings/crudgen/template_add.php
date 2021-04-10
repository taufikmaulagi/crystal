<?='<?php'?>

alert_flashdata('message', 'status');
echo panel(
    title: $title,
    actions: [
        button(theme: 'warning',icon: 'arrow-left',text: 'Kembali',target:base_url('<?=$path?><?=$table?>'))
    ],
    body: panel_body(
        row([
            col('sm-8',
                form(
<?php if(in_array('IMAGE',$element)){ ?>
                    enctype: 'multipart/form-data',
<?php } ?>
                    form: [
<?php for ($i=0; $i < count($name); $i++) { 
if($element[$i] == 'IMAGE'){ ?>
                        input_image('<?=$label[$i]?>','<?=$name[$i]?>'),
<?php } else if($element[$i] == 'EMAIL'){ ?>
                        input('<?=$label[$i]?>','<?=$name[$i]?>',type:'email'),
<?php } else if($element[$i] == 'DATE'){ ?>
                        input_date('<?=$label[$i]?>','<?=$name[$i]?>'),
<?php } else if($element[$i] == 'NUMBER'){ ?>
                        input('<?=$label[$i]?>','<?=$name[$i]?>',type:'number'),
<?php } else if($element[$i] == 'PASSWORD'){ ?>
                        input('<?=$label[$i]?>','<?=$name[$i]?>',type:'password'),
<?php } else { ?>
                        input('<?=$label[$i]?>','<?=$name[$i]?>'),
<?php } ?>
<?php } ?>
                        input_submit('Selesai & Simpan','primary')
                    ]
                )
            )
        ])
    )
);