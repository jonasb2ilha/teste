<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Model
 */
class Login_model extends CI_Model {


	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('LoginAttempt_model', 'attempt');
	}
	/**
	 * get_sistema function.
	 *
	 * @access public
	 * @return void
	 */
	//verifica se o sistema já foi instalado
    public function get_sistema() {
       $query= $this->db->get('install')->result();
        foreach ($query as $result):
            if ($result->setup_install == 1):
                return true;
            else:
                return false;
            endif;
        endforeach;
    }
    /**
     * verify_password_hash function.
     * @param $password
     * @param $hash
     * @access private
     * @return retorna password criptografado e hash
     */
   //verifica hash
    private function verify_password_hash($password, $hash) {
        return password_verify($password, $hash);
    }
    /**
     *retornaUsuario function.
     * @param $username
     * @access public
     * @return retorna o usuário
     */
    public function returnUsuario($username)
    {
    	$this->db->from('users');
        $this->db->where('username', $username);
        return $this->db->get()->row();
    }
    /**
     *returnPassword function.
     * @param $username
     * @param $password
     * @access public
     * @return retorna o password do usuario
     */
    public function returnPassword($username, $password)
    {
    	$this->db->select('password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $hash = $this->db->get()->row('password');
       	return $this->verify_password_hash($password, $hash);
    }
    /**
     * returnId function.
     * @param $username
     * @access public
     * @return retorna id do usuário
     */
    public function returnId($username)
    {
    	$this->db->select('id');
        $this->db->from('users');
        $this->db->where('username', $username);
        return $this->db->get()->row('id');
    }
    /**
     * returnStatus function.
     * @param $username
     * @access public
     * @return retorna os status do usuário
     */
    public function returnStatus($username)
    {
    	$this->db->select('status');
        $this->db->from('users');
        $this->db->where('username', $username);
        return $this->db->get()->row('status');

    }

}
/* End of file Login_model.php */
/* Location: ./application/modules/login/models/Login_model.php */
