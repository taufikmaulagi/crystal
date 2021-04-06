<?php

class Auth extends CI_Controller {

    function __construct(){
        parent::__construct();
    }

    function login(){
        if(!empty($this->session->userdata('logged_in')))
            redirect(base_url());
        $data['main'] = $this->db->get('content')->result_array()[0];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','required|min_length[6]|max_length[30]|trim|xss_clean');
        $this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[30]|trim|xss_clean');
        if($this->form_validation->run()){
            $args = [
                'username' => $this->input->post('username'),
                'password' => sha1($this->input->post('password'))
            ];
            $res['user'] = $this->db->get_where('users', $args)->result_array();
            if(count($res['user'])<=0){
                $args = [
                    'email' => $this->input->post('username'),
                    'password' => sha1($this->input->post('password'))
                ];
                $res['user'] = $this->db->get_where('users', $args)->result_array();
            }
            if(count($res['user'])>0){
                $res['users_keys'] = $this->db->get_where('users_keys', ['ip_address'=>$this->input->ip_address(),'user_agent'=>$this->input->user_agent(),'users'=>$res['user'][0]['id']])->result_array();
                $data['users'] = [
                    'users' => $res['user'][0]['id'],
                    'ip_address' => $this->input->ip_address(),
                    'user_agent' => $this->input->user_agent(),
                    'token' => sha1(uniqid()),
                    'token2' => sha1(uniqid().date('Y-m-d H:i:s')),
                    'last_login' => date('Y-m-d H:i:s'),
                    'last_access' => date('Y-m-d H:i:s')
                ];
                if(count($res['users_keys'])>0){
                    $this->db->update('users_keys', $data['users'], ['id' => $res['users_keys'][0]['id']]);
                } else {
                    $this->db->insert('users_keys', $data['users']);
                }
                if($this->input->post('keeplogin') == 'on'){
                    $this->session->set_expiration = '108000';
                }
                $this->session->set_userdata('logged_in',[
                    'id' => $res['user'][0]['id'],
                    'username' => $res['user'][0]['username'],
                    'nama' => $res['user'][0]['nama'],
                    'foto' => $res['user'][0]['foto'],
                    'jenis_kelamin' => $res['user'][0]['jenis_kelamin'],
                    'role' => $res['user'][0]['role'],
                    'token' => $data['users']['token'],
                    'token2' => $data['users']['token2']
                ]);
                redirect(base_url());
            } else {
                $this->session->set_flashdata(['message' => 'Username atau password yang anda masukan salah']);
                $this->load->view('templates/login',$data);
            }
        } else {
            $this->load->view('templates/login',$data);
        }
    }

    function logout(){
        $this->session->unset_userdata('logged_in');
        redirect(base_url('auth/login'));
    }

    function forgot_password(){
        if(!empty($this->session->userdata('logged_in')))
            redirect(base_url());
        $data['main'] = $this->db->get('content')->result_array()[0];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','required|max_length[100]|valid_email|trim|xss_clean');
        if($this->form_validation->run()){
            $res['users'] = $this->db->get_where('users',['email'=>$this->input->post('email')])->result_array();
            if(count($res['users'])<=0){
                $this->session->set_flashdata(['message'=>'Email tidak terdaftar']);
                redirect(base_url('auth/forgot_password'));
            }   
            $this->load->helper('sender_helper');
            $token = strtoupper(sha1(date('Y-m-d H:i:s').'+'.uniqid()));
            $res['verify'] = $this->db->get_where('verify',['users'=>$res['users'][0]['id']])->result_array();
            if(count($res['verify'])>0 && strtotime($res['verify'][0]['expired_at']) > strtotime(date('Y-m-d H-i-s')) && $this->input->ip_address() == $res['verify'][0]['ip_address'] && $this->input->user_agent() == $res['verify'][0]['user_agent']){
                $this->db->update('verify', [
                    'token' => $token,
                    'expired_at' => date('Y-m-d H:i:s',strtotime("+30 minutes"))
                ], ['id'=>$res['verify'][0]['id']]);
            } else {
                $this->db->insert('verify',[
                    'users' => $res['users'][0]['id'],
                    'token' => $token,
                    'ip_address' => $this->input->ip_address(),
                    'user_agent' => $this->input->user_agent(),
                    'expired_at' => date('Y-m-d H:i:s',strtotime("+30 minutes"))
                ]);
            }
            $url = base_url('auth/change_password?token='.$token);
            send_mail([
                'to' => $this->input->post('email'),
                'subject' => 'Lupa Password',
                'message' => 'Silahkan klik link dibawah ini untuk membuat password yang baru <br/><a href="'.$url.'">Membuat Password Baru</a>'
            ]);
            redirect(base_url('auth/forgot_password?state=wait&email='.base64_encode($this->input->post('email'))));
        } else {
            $this->load->view('templates/forgot_password',$data);
        }
    }

    function change_password(){
        if(!empty($this->session->userdata('logged_in')))
            redirect(base_url());
        $data['main'] = $this->db->get('content')->result_array()[0];
        $token = $this->input->get('token');
        $res['verify'] = $this->db->get_where('verify',
        [
            'token' => $token,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'status' => 'Avaliable'
        ])->result_array();
        if(count($res['verify'])>0 && strtotime(date('Y-m-d H:i:s')) < strtotime($res['verify'][0]['expired_at'])){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[30]|trim|xss_clean');
            $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password','required|min_length[8]|max_length[30]|matches[password]|trim|xss_clean');
            if(!$this->form_validation->run()){
                $this->load->view('templates/change_password',$data);
            } else {
                $this->db->update('verify', ['status' => 'Expired'], ['id' => $res['verify'][0]['id']]);
                $this->load->model('users_model','musers');
                $this->musers->update([
                    'password'=>sha1($this->input->post('password'))
                ], $res['verify'][0]['users']);
                $this->session->set_flashdata(['message'=>'Password Baru Berhasil Dibuat','status'=>'success']);
                redirect(base_url('auth/login'));
            }
        } else {
            $this->load->view('templates/expired',$data);
        }
    }

    function signup(){
        if(!empty($this->session->userdata('logged_in')))
            redirect(base_url());
        $data['main'] = $this->db->get('content')->result_array()[0];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama','Nama Lengkap','required|max_length[50]|trim|xss_clean');
        $this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required|trim|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required|trim|xss_clean');
        $this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean');
        $this->form_validation->set_rules('username','Username','required|is_unique[users.username]|min_length[6]|max_length[30]|trim|xss_clean');
        $this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[30]|trim|xss_clean');
        $this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password','required|min_length[8]|max_length[30]|matches[password]|trim|xss_clean');
        $this->form_validation->set_rules('accept_terms', '...', 'callback_accept_terms');
        if(!$this->form_validation->run()){
            $this->load->view('templates/signup',$data);
        } else {
            $args['users'] = [
                'nama' => $this->input->post('nama'),
                'tanggal_lahir' => date('Y-m-d',strtotime($this->input->post('tanggal_lahir'))),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => sha1($this->input->post('password')),
                'role' => 2
            ];
            $this->load->model('users_model','musers');
            if($this->musers->add($args['users'])){
                $this->session->set_flashdata(['message'=>'Pendaftaran telah selesai! anda dapat login sekarang','status'=>'success']);
                redirect(base_url('auth/login'));
            } else {
                $this->session->set_flashdata(['message'=>'Oops! ada kesalahan. silahkan coba lagi']);
                redirect(base_url('auth/signup'));
            }
        }
    }

    function accept_terms() {
        if (isset($_POST['accept_terms'])) return true;
        $this->form_validation->set_message('accept_terms', 'Harap baca dan setujui syarat dan ketentuan kami.');
        return false;
    }

}