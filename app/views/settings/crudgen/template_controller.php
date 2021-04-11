<?='<?php'?>

require APPPATH.'libraries/Crystal.php';

class <?=ucwords($table)?> extends Crystal {

   function __construct(){
        parent::__construct();
        $this->load->model('<?=$table?>_model','m<?=$table?>');
    }

    function index(){
        $this->unlock('<?=ucwords($table)?>|VIEW');
        template(
            title: 'Data Seluruh <?=ucwords($table)?>',
            content: '<?=$path?><?=$table?>/index',
            plugin: ['datatables'],
            data: [
                '<?=$table?>' => $this->m<?=$table?>->read(),
            ]
        );
    }

    function add(){
        $this->unlock('<?=ucwords($table)?>|ADD');
        if($this->_validation(state: 'add')){
            $args['<?=$table?>'] = $this->_post_data();
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i] == 'IMAGE'){?>
            $args['<?=$table?>']['<?=$name[$i]?>'] = $this->uploader('<?=$name[$i]?>','<?=$table?>');
<?php } 
}?>
            if($this->m<?=$table?>->create($args['<?=$table?>'])>0)
                $this->flash(['message' => '<?=ucwords($table)?> Baru Telah Tersimpan','status'=>'success']);
            else 
                $this->flash(['message' => 'Oops! <?=ucwords($table)?> Baru Gagal Tersimpan, Silahkan Coba Lagi','status'=>'failed']);
            redirect(base_url('<?=$path?><?=$table?>/add'),'refresh');
        } else {
            
            template(
                title: 'Tambah <?=ucwords($table)?> baru',
                content: '<?=$path?><?=$table?>/add',
                data: [
                    
                ]
            );
        }
    }

    function edit($id){
        $this->unlock('<?=ucwords($table)?>|EDIT');
        if(empty($id))
            redirect(base_url('<?=$path?><?=$table?>'));
        $res['<?=$table?>'] = $this->m<?=$table?>->read(id: $id);
        if(count($res['<?=$table?>'])<=0)
            redirect(base_url('<?=$path?><?=$table?>'));
        $list['uniq'] = array();
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i]!='NONE'){
if(str_contains($validation[$i], 'is_unique')){?>
        if($this->_post_data()['<?=$name[$i]?>'] == $res['<?=$table?>'][0]['<?=$name[$i]?>'])
            $list['uniq']['<?=$name[$i]?>'] = 'remove';
<?php } } 
}?>
        if($this->_validation($list['uniq'])){
            $args['<?=$table?>'] = $this->_post_data();
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i]!='NONE'){
if($element[$i] == 'IMAGE'){?>
            $args['<?=$table?>']['<?=$name[$i]?>'] = $this->uploader('<?=$name[$i]?>','<?=$table?>');
<?php } }
}?>
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i] == 'PASSWORD'){?>
            if($this->post('<?=$name[$i]?>') == $res['<?=$table?>'][0]['<?=$name[$i]?>'])
                unset($args['<?=$table?>']['<?=$name[$i]?>']);
<?php } 
}?>
            if($this->m<?=$table?>->update($args['<?=$table?>'], $id)>0){
                $this->flash(['message' => 'Perubahan <?=ucwords($table)?> Telah Tersimpan','status'=>'success']);
            } else {
                $this->flash(['message' => 'Oops! Perubahan <?=ucwords($table)?> Gagal Tersimpan, Silahkan Coba Lagi','status'=>'failed']);
            }
            redirect(base_url('<?=$path?><?=$table?>/edit/'.$id),'refresh');
        } else {
            template(
                title: 'Update Data <?=ucwords($table)?>',
                content: '<?=$path?><?=$table?>/edit',
                data: [
                    '<?=$table?>' => $res['<?=$table?>'][0],
                ]
            );
        }
    }
    
    function delete(){
        $this->unlock('<?=ucwords($table)?>|DELETE');
        if($this->m<?=$table?>->delete($this->post('id'))>0){
            $this->flash(['message'=>'<?=ucwords($table)?> Telah Terhapus', 'status'=>'success']);
        } else {
            $this->flash(['message'=>'Oops! <?=ucwords($table)?> Gagal Terhapus, Silahkan Coba Lagi', 'status'=>'failed']);
        }
        redirect(base_url('<?=$path?><?=$table?>/'),'refresh');
    }

    private function _validation($uniqlist=array(),$state='default'){
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i]!='NONE'){
if(str_contains($validation[$i], 'is_unique')){?>
        $uniq['<?=$name[$i]?>'] = '|is_unique[<?=$table?>.<?=$name[$i]?>]';
        if(!empty($uniqlist['<?=$name[$i]?>']))
            $uniq['<?=$name[$i]?>'] = '';
<?php } }
}?>
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i]!='NONE'){
if(str_contains($validation[$i], 'is_unique')){
$validation[$i] = str_replace('|is_unique','',$validation[$i]);
?>
        $this->set_rules('<?=$name[$i]?>','<?=$label[$i]?>','<?=$validation[$i]?>'.$uniq['<?=$name[$i]?>']);
<?php } else if($element[$i] == 'IMAGE' && str_contains($validation[$i], 'required')){ ?>
        if($state=='add'){
            $this->set_rules('<?=$name[$i]?>','<?=$label[$i]?>','callback_<?=$name[$i]?>_required');
        }
<?php } else if(!empty($validation[$i])) { ?>
        $this->set_rules('<?=$name[$i]?>','<?=$label[$i]?>','<?=$validation[$i]?>');
<?php } }
}?>    
        return $this->validation_run();
    }

    private function _post_data(){
        return [
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i]!='NONE'){
if($element[$i] == 'DATE'){?>
            '<?=$name[$i]?>' => $this->post('<?=$name[$i]?>') != '01-01-1970' ? date('Y-m-d', strtotime($this->post('<?=$name[$i]?>'))) : NULL,
<?php } else if($element[$i] == 'PASSWORD'){ ?>
            '<?=$name[$i]?>' => password_hash($this->post('<?=$name[$i]?>'))    
<?php } else if($element[$i] != 'IMAGE') { ?>
            '<?=$name[$i]?>' => $this->post('<?=$name[$i]?>'),
<?php } }
}?>
        ];
    } 
    
<?php for ($i=0; $i < count($name); $i++) {
if($element[$i] == 'IMAGE' && str_contains($validation[$i], 'required')){ ?>
    function <?=$name[$i]?>_required(){
        $this->form_validation->set_message('<?=$name[$i]?>_required','Belum Memilih File');
        if (empty($_FILES['<?=$name[$i]?>']['name'])) {
            return false;
        } else {
            return true;
        }
    }
<?php }
}?>


}