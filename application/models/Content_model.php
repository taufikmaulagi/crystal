<?php

class Content_model extends CI_Model {

    function read(){
        return $this->db->get('content')->result_array()[0];
    }

    function update($args){
        $res['content'] = $this->read();
        $this->db->update('content',$args, ['id' => 1]);
        if(!empty($args['logo']))
            unlink('./public/images/'.$res['content']['logo']);
        if(!empty($args['favicon']))
            unlink('./public/images/'.$res['content']['favicon']);
        return $this->db->affected_rows();
    }

}