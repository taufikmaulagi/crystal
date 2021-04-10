<?='<?php'?>

$list['<?=$table?>'] = array();
$arrIndex=1;
foreach($<?=$table?> as $key => $val){
    array_push($list['<?=$table?>'],[
        $arrIndex++, 
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i]!='NONE'){
if($element[$i] == 'IMAGE'){?>
        image($val['<?=$val['image']?>']),
<?php } else if($element[$i] == 'created_at') { ?>
        ftime('%d %B %Y %H:%M', $val['created_at']),
<?php } else {?>
        $val['<?=$name[$i]?>'], 
<?php } ?>
<?php } ?>
<?php } ?>
        action_button(base_url('<?=$path?><?=$table?>'),$val['id'],module:'<?=ucwords($table)?>')
    ]);
}
alert_flashdata('message', 'status');
echo panel(
    title: 'Data Seluruh <?=ucwords($table)?>',
    actions: [
        is_unlock('<?=ucwords($table)?>|ADD', button(theme: 'primary',text: 'Tambah Baru',target:base_url('<?=$path?><?=$table?>/add'),icon:'plus')),
    ],
    body: datatable([
        '#',
<?php for ($i=0; $i < count($name); $i++) { ?>
        '<?=$label[$i]?>',
<?php } ?>
        'Opsi'
    ],$list['<?=$table?>'])
);