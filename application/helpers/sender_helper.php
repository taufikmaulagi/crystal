<?php

    function send_mail($args=array()){

        $config = [
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
            'protocol'      => 'smtp',
            'smtp_host'     => 'smtp.gmail.com',
            'smtp_user'     => 'taufikm9977@gmail.com', 
            'smtp_pass'     => base64_decode('NG1pU2F5YW5n'), 
            'smtp_crypto'   => 'ssl',
            'smtp_port'     => 465,
            'crlf'          => "\r\n",
            'newline'       => "\r\n"
        ];

        $args['to'] = empty($args['to']) ? '' : $args['to'];
        $args['subject'] = empty($args['subject']) ? '' : $args['subject'];
        $args['message'] = empty($args['message']) ? '' : $args['message'];
        $el =& get_instance();
        $el->load->library('email', $config);
        $el->email->from('no-reply@crystal.com', 'crystal.com');
        $el->email->to($args['to']);
        if(!empty($args['attach'])){
            $el->email->attach($args['attach']);
        }
        $el->email->subject($args['subject']);
        $el->email->message($args['message']);
        if ($el->email->send()) 
            return true;
        return false;
    }

    function send_fcm(){

    }

    function send_sms(){

    }