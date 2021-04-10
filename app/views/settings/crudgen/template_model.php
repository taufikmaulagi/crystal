<?='<?php'?>

class <?=ucwords($table)?>_model extends CI_Model {

    function read($id='',$limit=''){
        if(!empty($id)) $this->db->where('<?=$table?>.id',$id);
        if(!empty($limit)) $this->db->where('limit',$limit);
<?php for ($i=0; $i < count($name); $i++) { 
if($name[$i] == 'delete_at'){ ?>
        $this->db->where(['<?=$table?>.<?=$name[$i]?>' => NULL]);
<?php } ?>
<?php } ?>
        return $this->db->get('<?=$table?>')->result_array();
    }

    function create($args){
        $this->db->insert('<?=$table?>', $args);
        return $this->db->affected_rows();
    }

    function update($args, $id){
<?php for ($i=0; $i < count($name); $i++) { 
if($name[$i] == 'updated_at'){ ?>
        $args['updated_at'] = date('Y-m-d H:i:s');
<?php } ?>
<?php } ?>
        $res['<?=$table?>'] = $this->read(id: $id)[0];
<?php for ($i=0; $i < count($name); $i++) { 
if($element[$i] == 'IMAGE'){ ?>
        if(empty($args['<?=$name[$i]?>'])) unset($args['<?=$name[$i]?>']);
<?php } ?>
<?php } ?>
        $this->db->update('<?=$table?>', $args, ['id' => $id]);
<?php for ($i=0; $i < count($name); $i++) { 
if($element[$i] == 'IMAGE'){ ?>
        if(!empty($args['$name[$i]'])) unlink('./public/images/'.$res['<?=$table?>']['$name[$i]']);
<?php } ?>
<?php } ?>
        return $this->db->affected_rows();
    }

    function delete($id){
<?php if(in_array('deleted_at',$name)){ ?>
        $this->db->update('<?=$table?>',['deleted_at'=>date('Y-m-d H:i:s')],['id' => $id]);
<?php } else { ?>
        $this->db->delete('<?=$table?>',['id'=>$id]);
<?php } ?>
        return $this->db->affected_rows();
    }
}