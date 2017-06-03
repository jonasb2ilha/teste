<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor_model extends CI_Model{

   public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   //hash password
	private function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

   public function get_all_profe()
   {
      $this->db->order_by('id', 'desc');
      return $this->db->get('teachers')->result();
   }

   public function cadastrar($name, $mat, $email, $username, $password)
   {
      $this->db->trans_start();
         $dados = array(
            'name'     => $name,
            'email'    => $email,
            'username' => $username,
            'password' => $this->hash_password($password),
            'role_id'  => 2,
            'status'   => 1
         );
         $this->db->insert('users', $dados);
         $id = $this->db->insert_id();

         $dados = array(
           'name'       => $name,
           'matter'     => $mat,
           'email'      => $email,
           'username'   => $username,
           'role_id'    => 2,
           'user_id'    => $id,
           'status'     => 1
         );
         $this->db->insert('teachers', $dados);
      $this->db->trans_complete();

      if ($this->db->trans_status() == FALSE) :
         return FALSE;
      else :
         return TRUE;
      endif;

   }

   public function editar($nome, $usuario, $email, $materia, $password, $iduser)
   {
      $this->db->trans_start();
         $dados = array(
            'name'     => $nome,
            'username' => $usuario,
            'email'    => $email,
            'matter'  => $materia
         );
         $this->db->where('user_id', $iduser);
         $this->db->update('teachers', $dados);

         $dados2 = array(
            'name'     => $nome,
            'username' => $usuario,
            'email'    => $email,
            'password' => $this->hash_password($password)
         );
         $this->db->where('id', $iduser);
         $this->db->update('users', $dados2);
      $this->db->trans_complete();

      if ($this->db->trans_status() == FALSE) :
         return FALSE;
      else :
         return TRUE;
      endif;

   }

   public function bloquearUser ($user_id)
	{
		$dados = array('status' => 0);
		$this->db->where('id', $user_id);
		$update = $this->db->update('users', $dados);
		if ($update):
			$this->db->where('user_id', $user_id);
			$this->db->update('teachers', $dados);
		endif;
	}



	public function desbloquearUser ($user_id)
	{
		$dados = array('status' => 1);
		$this->db->where('id', $user_id);
		$update = $this->db->update('users', $dados);
		if ($update):
			$this->db->where('user_id', $user_id);
			$this->db->update('teachers', $dados);
		endif;
	}

   public function get_byid($user_id=NULL){
      if ($user_id != NULL):
         $this->db->where('user_id', $user_id);
         $this->db->limit(1);
         return $this->db->get('teachers');
      else:
         return FALSE;
      endif;
   }

   public function excluirUser ($iduser)
   {
      $this->db->trans_start();
         $this->db->where('user_id', $iduser);
         $del = $this->db->delete('teachers');

         $this->db->where('id', $iduser);
         $this->db->delete('users');
      $this->db->trans_complete();
      if ($this->db->trans_status() == FALSE) :
         return FALSE;
      else :
         return TRUE;
      endif;
   }

}
