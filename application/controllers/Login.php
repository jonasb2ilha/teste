<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->library('form_validation');
        $this->load->model('Login_model', 'login');
        $this->load->model('LoginAttempt_model', 'attempt');
        $this->load->model('Recovery_model', 'recovery');
        if ($this->login->get_sistema() == false):
            redirect('install');
        endif;
    }

    public function index() {
        $this->load->helper('security');

        $this->form_validation->set_rules('username', 'USUÁRIO', 'trim|required|xss_clean|strip_tags');
        $this->form_validation->set_rules('password', 'SENHA', 'trim|required|xss_clean|strip_tags');

        //verifica validação
        if ($this->form_validation->run() == FALSE) :

            if (validation_errors()) :
                set_msg(validation_errors());
            endif;
        else :
            // set variables from the form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $userId = $this->login->returnId($username);
            $status = $this->login->returnStatus($username);
            $pass = $this->login->returnPassword($username, $password);
            $user = $this->login->returnUsuario($username);
            //verifica se o usuário existe
            if (!is_null($userId)) :
                //se existe verifica os statud do usuário bloqueado/desbloqueado
                if ($status == 1) :
                    //verifica tentativa de login erradas
                    if ($this->attempt->ExistemTentativas($user->id)) :
                        //verifica password digitado com o do banco de dados
                        if ($pass == $password) :
                            //se tudo estiver OK realiza uma session
                            $dados = array(
                                'id' => (int) $user->id,
                                'name' => (string) $user->name,
                                'username' => (string) $user->username,
                                'logged' => (bool) TRUE,
                                'email' => (string) $user->email,
                                'role_id' => (int) $user->role_id,
                                'status' => 1
                            );
                            $this->session->set_userdata($dados);
                            $this->attempt->LimparTentativas($user->id);

                            //redireciona para home administrador
                            if ($user->role_id == 1):
                                set_msg('msgok', 'Bem vindo!', 'Administrador(a), <b>' . $user->name . '</b>, você foi logado com sucesso!', 'sucesso');
                                redirect('home');
                            //redireciona para home professor
                            elseif ($user->role_id == 2):
                                set_msg('msgok', 'Bem vindo!', 'Professor(a), <b>' . $user->name . '</b>, você foi logado com sucesso!', 'sucesso');
                                redirect('home');
                            //redireciona para home aluno
                            else :
                                set_msg('msgok', 'Bem vindo!', 'Aluno(a), <b>' . $user->name . '</b>, você foi logado com sucesso!', 'sucesso');
                                redirect('admin/home');
                            endif;
                        //erro mostra quantas tentativas faltam
                        else:
                            //erro se forem gastas 4 tentativas mensagem de alerta
                            if ($this->attempt->TentativasRestantes($user->id) >= 4):
                                set_msg('msgok', 'Ops! Verifique com cuidado os dados!', 'Suas tentativas estão acabando. Você só tem mais 1(uma) tentativa(s)! Após exceder esse número, seu acesso só será liberado através da aprovação do administrador!', 'warning');
                            //erro password errado
                            else:
                                set_msg('msgok', 'Ops! Verifique com cuidado os dados!', 'Não foi possível realizar a autenticação. Por favor, confira seus dados!', 'info');
                            endif;
                            //erro registra tentativas erradas para bloqueio
                            $this->attempt->RegistrarTentativa($user->id);
                        endif;
                    //erro se passar de 5 tentativas usuário bloqueado
                    else:
                        $this->attempt->Bloqueado($user->id);
                        set_msg('msgok', 'Acesso bloqueado por excesso de tentativas', 'Olá ' . $user->name . ', <br /> Seu acesso foi bloqueado pelo excesso de tentativas. Por favor, contate o administrador para liberação. Lembre-se de que esse recurso é para sua segurança.', 'erro');
                    endif;
                //erro usuário bloqueado
                else:
                    set_msg('msgok', 'Ops! Usuário bloqueado!', 'Não foi possível realizar a autenticação, pois este usuário encontra-se bloqueado no sistema. Por favor, contate o administrador para liberação!', 'erro');
                endif;
            //erro se não existe usuário
            else :
                set_msg('msgok', 'Ops! Verifique com cuidado os dados!', 'Não foi possível realizar a autenticação. Por favor, confira seus dados!', 'info');
            endif;

        endif;

        $data['titulo'] = 'Realizar login';
        $this->load->view('login/login', $data);
    }

    /**
     * logout function.
     * @access public
     * @return void
     */
    public function logout() {

        $this->session->sess_destroy();

        set_msg('invalid', 'Logout', 'Logout realizado com sucesso!', 'erro');
        redirect('login');
    }

    public function recuperar() {
        $this->load->helper('security');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|xss_clean|strip_tags|valid_email');

        //verifica validação
        if ($this->form_validation->run() == FALSE) :

            if (validation_errors()) :
                set_msg(validation_errors());
            endif;

        else :

            $email = $this->input->post('email');
            if (!is_null($email) && $email !== false):
                $validar = $this->recovery->validar($email);
                if ($validar->status === false):
                    set_msg('invalid', 'Oops! Nenhum usuário encontrados', 'Por favor, verifique o e-mail informado e tente novamente!', 'erro');
                    redirect('login/recuperar');
                else:
                    $id = $validar->user->id;
                    $this->recovery->criar_token($id);

                    $token = $this->recovery->pegar_token($id);
                    $envioDoEmail = $this->sistema->enviar_email($email, $token);

                    if ($envioDoEmail === false):
                        set_msg('invalid', 'Oops! E-mail não enviado', 'Por favor, contate o administrador para corrigir este problema.', 'erro');
                        redirect('recuperar');
                    else:
                        set_msg('msgok', 'Uhull! O link de redefinição de sua senha foi enviado com sucesso!', 'Verifique a sua caixa de entrada ou de SPAM para encontrar nosso e-mail.', 'sucesso');
                        redirect('recuperar');
                    endif;
                endif;
            else:
                set_msg('invalid', 'Oops! E-mail não enviado', 'Por favor, verifique o e-mail informado e tente novamente!', 'erro');
                redirect('recuperar');
            endif;
        endif;
        $data['titulo'] = 'Recupera senha';
        $this->load->view('login/recuperar', $data);
    }

    public function redefinir($token) {

        $validarToken = $this->recovery->recuperar_token($token);

        if ($validarToken->status == false):
            set_msg('msgok', 'Oops! Código inválido ou expirado!', 'Por favor, solicite um novo link de redefinição.', 'erro');
            redirect('recuperar');
        endif;

        $this->load->helper('security');

        $this->form_validation->set_message('matches', 'O campo %s está diferente do campo %s');
        $this->form_validation->set_rules('password', 'PASSWORD', 'trim|required|min_length[5]|xss_clean|strip_tags');
        $this->form_validation->set_rules('password2', 'CONFIRMA PASSWORD', 'trim|required|min_length[5]|xss_clean|strip_tags|matches[password]');

        //verifica validação
        if ($this->form_validation->run() == FALSE):

            if (validation_errors()):
                set_msg(validation_errors());
            endif;

        else:

            $password = $this->input->post('password');

            if (!is_null($password)):

                $user_id = $validarToken->user;

                $atualizarSenha = $this->recovery->atualizarSenha($user_id, $password);

                if ($atualizarSenha === true):
                    $id = $validarToken->id;
                    $this->recovery->limpar($id);
                    set_msg('msgok', 'Uhull! Sua senha foi redefinida com sucesso!', 'Faça login com seus novos dados.', 'sucesso');
                    redirect('login');
                endif;

            endif;

        endif;

        $data['titulo'] = 'Redefinir sua senha';
        $this->load->view('login/redefinir', $data);
    }

}
