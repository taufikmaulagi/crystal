<?php
class Petugas_model extends CI_Model {

    function read($id='',$limit=''){
        if(!empty($id)) $this->db->where('petugas.id',$id);
        if(!empty($limit)) $this->db->where('limit',$limit);
        return $this->db->get('petugas')->result_array();
    }

    function create($args){
        $this->db->insert('petugas', $args);
        return $this->db->affected_rows();
    }

    function update($args, $id){
        $res['petugas'] = $this->read(id: $id)[0];
        if(empty($args['foto'])) unset($args['foto']);
        $this->db->update('petugas', $args, ['id' => $id]);
        if(!empty($args['$name[$i]'])) unlink('./public/images/'.$res['petugas']['$name[$i]']);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->delete('petugas',['id'=>$id]);
        return $this->db->affected_rows();
    }
}