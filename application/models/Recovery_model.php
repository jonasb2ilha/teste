<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Model
 */
class Recovery_model extends CI_Model {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * hash_password function.
     * @param $password
     * @access private
     * @return hash password criptografia de password
     */
    private function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * hash_password function.
     * @param $email
     * @access public
     * @return verifica se o email informado é valido
     */
    public function validar($email) {

        $callback_obj = new \stdClass;
        $callback_obj->user = null;
        $callback_obj->status = false;


        if ($email):
            $this->db->from('users');
            $this->db->where('email', $email);
            $user_exists = $this->db->get()->row();

            if (!is_null($user_exists)):
                $callback_obj->status = true;
                $callback_obj->user = $user_exists;

                $this->db->where('user_id', $user_exists->id);
                $this->db->delete('recoveries');

            else:
                set_msg('invalid', 'Oops! Nenhum usuário encontrado', 'Por favor, verifique o e-mail informado e tente novamente!', 'erro');
            endif;

        endif;

        return $callback_obj;
    }

    /**
     * hash_password function.
     * @param $id
     * @access public
     * @return cria o token para acessar page redefinir
     */
    public function criar_token($id) {
        $dados = array(
            'user_id' => $id,
            'token' => $this->token = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true)),
            'status' => 0
        );

        $this->db->insert('recoveries', $dados);
    }

    /**
     * hash_password function.
     * @param $id
     * @access public
     * @return retorna o id do token
     */
    public function pegar_token($id) {
        $this->db->select('token');
        $this->db->from('recoveries');
        $this->db->where('user_id', $id);
        return $this->db->get()->row('token');
    }

    /**
     * hash_password function.
     * @param $token
     * @access public
     * @return retorna o token gerado
     */
    public function recuperar_token($token) {

        $callback_obj = new \stdClass;
        $callback_obj->user = null;
        $callback_obj->id = null;
        $callback_obj->status = false;

        $this->db->from('recoveries');
        $this->db->where('token', $token);
        $validar = $this->db->get()->row();


        if (!is_null($validar)):
            $callback_obj->status = true;
            $callback_obj->user = $validar->user_id;
            $callback_obj->id = $validar->id;
        endif;

        return $callback_obj;
    }

    /**
     * hash_password function.
     * @param $user_id
     * @param $password
     * @access public
     * @return atualiza a senha do usuário
     */
    public function atualizarSenha($user_id, $password) {
        $dados = array(
            'password' => $this->hash_password($password)
        );

        $this->db->where('id', $user_id);
        return $this->db->update('users', $dados);
    }

    /**
     * hash_password function.
     * @param $id
     * @access public
     * @return deleta o token após atualização da senha
     */
    public function limpar($id) {
        $this->db->where('id', $id);
        return $this->db->delete('recoveries');
    }

}

/* End of file Recovery_model.php */
/* Location: ./application/modules/login/models/Recovery_model.php */
