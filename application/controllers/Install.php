<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Instalação dos sistema
 *
 * @extends CI_Controller
 */
class Install extends CI_Controller {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->library('form_validation');
        $this->load->model('Install_model', 'install');

        if ($this->install->get_sistema() === true):
            redirect('login');
        endif;
    }

    public function index() {

        $this->load->helper('security');
        //seta msg
        $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado no sistema');
        $this->form_validation->set_message('matches', 'O campo %s está diferente do campo %s');


        $this->form_validation->set_rules('name', 'NOME', 'trim|required|min_length[5]|xss_clean|strip_tags');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|min_length[5]|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'USUÁRIO', 'trim|required|min_length[5]|xss_clean|strip_tags|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'PASSWORD', 'trim|required|min_length[5]|xss_clean|strip_tags');
        $this->form_validation->set_rules('password2', 'CONFIRMA PASSWORD', 'trim|required|min_length[5]|xss_clean|strip_tags|matches[password]');


        if ($this->form_validation->run() == FALSE) :
            if (validation_errors()):
                set_msg(validation_errors());
            endif;
        else :
            $nome = $this->input->post('name');
            $email = $this->input->post('email');
            $usuario = $this->input->post('username');
            $password = $this->input->post('password');
            $instalar = $this->install->instalar($nome, $email, $usuario, $password);
            if ($instalar == TRUE) {
                set_msg('msgok', 'Parabéns', 'Sistema instalado com sucesso!', 'sucesso');
                redirect('login');
            } else {
                set_msg('msgok', 'Ops!', 'Houve um erro ao instalar o sistema! contate o desenvolvedor.', 'erro');
                redirect('install');
            }
        endif;
        $data['titulo'] = 'Instalação do sistema';
        $this->load->view('install/install', $data);
    }

}

/* End of file Install.php */
/* Location: ./application/Install.php */
