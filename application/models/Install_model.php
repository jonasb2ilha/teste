<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Model
 */
class Install_model extends CI_Model {

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
     *
     * @access private
     * @return void
     */
    //hash password criptografia de password
    private function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * get_sistema function.
     *
     * @access public
     * @return void
     */
    //verifica se o sistema já foi instalado
    public function get_sistema() {
        $query = $this->db->get('install')->result();
        foreach ($query as $result):
            if ($result->setup_install == 1):
                return true;
            else:
                return false;
            endif;
        endforeach;
    }

    /**
     * instalar function.
     *
     * @access public
     * @return void
     */
    //instalar o sistema
    public function instalar($nome, $email, $usuario, $password) {
        $this->db->trans_start();

        $dados = array(
            'name' => $nome,
            'email' => $email,
            'username' => $usuario,
            'password' => $this->hash_password($password),
            'setup_install' => 1,
            'role_id' => 1,
            'created_at' => date("d/m/Y H:i:s")
        );

        $install = $this->db->insert('install', $dados);

        $dados2 = array(
            'name' => $nome,
            'email' => $email,
            'username' => $usuario,
            'password' => $this->hash_password($password),
            'role_id' => 1,
            'status' => 1
        );

        $user = $this->db->insert('users', $dados2);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) :
            return FALSE;
        else:
            return TRUE;
        endif;
    }

}
