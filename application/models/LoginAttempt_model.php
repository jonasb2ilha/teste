<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Model
 */
class LoginAttempt_model extends CI_Model {


	/**
	 * TotalDeTentativas function.
	 * @param $user_id
	 * @access public
	 * @return retorna quantidade de tentativas de login erradas
	 */
	public function TotalDeTentativas($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->from('login_attempts');
		return $this->db->count_all_results();
	}



	/**
	 * ExistemTentativas function.
	 * @param $user_id
	 * @access public
	 * @return verifica se existem tentativas registradas
	 */
	public function ExistemTentativas($user_id)
	{
		return $this->TotalDeTentativas($user_id) < 5 ? true : false;
	}



	/**
	 * TentativasRestantes function.
	 * @param $user_id
	 * @access public
	 * @return verifica se existem tentativas restantes antes de bloquear
	 */
	public function TentativasRestantes($user_id)
	{
		 return $this->TotalDeTentativas($user_id);
	}



	/**
	 * RegistrarTentativa function.
	 * @param $user_id
	 * @access public
	 * @return registrar tentativas erradas
	 */
	public function RegistrarTentativa($user_id)
	{
		$dados = array(
			'user_id' 	 => $user_id,
			'created_at' =>	date("d/m/Y H:i:s")
		);
		$this->db->insert('login_attempts', $dados);
	}



	/**
	 * LimparTentativas function.
	 * @param $user_id
	 * @access public
	 * @return limpa as tentativas após efetuar o login
	 */
	public function LimparTentativas($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('login_attempts');
	}



	/**
	 * Bloqueado function.
	 * @param $user_id
	 * @access public
	 * @return bloquea o usuário após 5 tentativas erradas
	 */
	public function Bloqueado($user_id)
	{
		$dados = array(
			'status' => 0
		);
        $this->db->where('id', $user_id);
        $this->db->update('users', $dados);
	}

}

/* End of file LoginAttempt_model.php */
/* Location: ./application/modules/login/models/LoginAttempt_model.php */
