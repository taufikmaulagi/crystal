<?php

    function send_mail($to='',$subject='',$message='',$attach=''){

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

        $el =& get_instance();
        $el->load->library('email', $config);
        $el->email->from('no-reply@crystal.com', 'crystal.com');
        $el->email->to($to);
        if(!empty($attach)){
            $el->email->attach($attach);
        }
        $el->email->subject($subject);
        $el->email->message($message);
        if ($el->email->send()) 
            return true;
        return false;
    }

    function send_fcm(){

    }

    function send_sms(){

    }