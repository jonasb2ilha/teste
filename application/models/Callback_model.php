<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback_model extends CI_Model{

   public function __construct()
   {
      parent::__construct();
      $this->load->database();
      $this->load->library('encrypt');
   }

   public function username ($usuario, $iduser)
   {
      if(!empty($iduser) && is_numeric($iduser)):
         $username_old = $this->db->where("id", $iduser)->get('users')->row()->username;
         $this->db->where("username !=", $username_old);
      endif;
      $user = $this->db->where('username', $usuario)->get('users')->num_rows();
      if ($user >= 1):
         set_msg('msgok', 'Verifique o erro abaixo !', 'Este usuário já está cadastrado em nosso sistema!', 'erro');
         redirect('professor/editar/'.$iduser);
         return false;
      else:
         return true;
      endif;
   }

   public function email ($email, $iduser)
   {
      if(!empty($iduser) && is_numeric($iduser)):
         $email_old = $this->db->where("id", $iduser)->get('users')->row()->email;
         $this->db->where("email !=", $email_old);
      endif;
      $user    = $this->db->where('email', $email)->get('users')->num_rows();
      if ($user >= 1):
         set_msg('msgok', 'Verifique o erro abaixo !', 'Este E-mail já está cadastrado em nosso sistema!', 'erro');
         redirect('professor/editar/'.$iduser);
         return false;
      else:
         return true;
      endif;
   }



}
