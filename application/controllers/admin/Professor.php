<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller{

  public function __construct()
  {
     parent::__construct();
     $nivel = $this->session->userdata('role_id');
     $this->load->model('Professor_model', 'professor');
     $this->load->helper('form');
     $this->load->library('form_validation');
     set_menu('menu', $nivel);
     verifica_login();
  }

  public function index()
  {
     $this->registros();
  }

  public function registros()
  {
     $data['breadcrumb'] = breadcrumb();
     $data['total'] = $this->professor->get_all_profe();
     $data['titulo'] = 'Professor';
     $this->load->view('admin/professor/professor', $data);
  }

  public function cadastrar()
  {
     $this->load->helper('security');

     $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado no sistema!');
     $this->form_validation->set_message('matches', 'O campos %s está diferente do campo %s!');

     $this->form_validation->set_rules('nome', 'NOME', 'trim|required|xss_clean|strip_tags');
     $this->form_validation->set_rules('materia', 'Máteria', 'trim|required|xss_clean|strip_tags');
     $this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email|xss_clean|strip_tags|is_unique[users.email]');
     $this->form_validation->set_rules('username', 'USUÁRIO', 'trim|required|xss_clean|strip_tags|is_unique[users.username]');
     $this->form_validation->set_rules('password', 'SENHA', 'trim|required|xss_clean|strip_tags');
     $this->form_validation->set_rules('password2', 'REPITA A SENHA', 'trim|required|xss_clean|strip_tags|matches[password]');

     if ($this->form_validation->run() == FALSE) {

        if (validation_errors()) {
           set_msg(validation_errors());
           redirect('admin/professor');
        }

     } else {

        $name     = $this->input->post('nome');
        $mat      = $this->input->post('materia');
        $email    = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        

        $cadastrar = $this->professor->cadastrar($name, $mat, $email, $username, $password);
        $array = Explode(" ",$name);
        if ($cadastrar) {
           set_msg('msgok', 'Cadastro concluído', 'Professor <b>'.$array[0].' '.$array[1].'</b> cadastrado com sucesso.', 'sucesso');
           redirect('admin/professor');
        } else {
           set_msg('msgok', 'Erro inesperado', 'Tente novamente ou contate o programador!', 'erro');
           redirect('admin/professor');
        }

     }
     $data['titulo'] = 'Cadastrar Professor';
     $this->load->view('admin/professor/cadastrar', $data);
   }

   public function editar ()
   {
      $this->load->model('Callback_model', 'callback');
      $this->load->helper('security');
      $iduser = $this->uri->segment(3);
      $this->form_validation->set_message('is_unique', 'Este %s já está cadastrado no sistema!');
      $this->form_validation->set_message('matches', 'O campos %s está diferente do campo %s!');

      $this->form_validation->set_rules('nome', 'NOME', 'trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('materia', 'Máteria', 'trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('email', 'E-MAIL', 'trim|valid_email|xss_clean|strip_tags');
      $this->form_validation->set_rules('username', 'USUÁRIO', 'trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('password', 'SENHA', 'trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('password2', 'REPITA A SENHA', 'trim|xss_clean|strip_tags|matches[password]');

      if ($this->form_validation->run() == FALSE) {
         if (validation_errors()) {
            set_msg(validation_errors());
         }
     } else {


        // create the data object
        $nome 	  = $this->input->post('name');
        $usuario  = $this->input->post('username');
        $email    = $this->input->post('email');
        $materia  = $this->input->post('materia');
        $password = $this->input->post('password');

        $dados = array(
            'nome'  => $nome
        );
        
        
        $verifica_user = $this->callback->username($usuario, $iduser);
        $verifica_email = $this->callback->email($email, $iduser);
        if ($verifica_user && $verifica_email === TRUE) :
           $editar = $this->professor->editar($nome, $usuario, $email, $materia, $password, $iduser);
           if ($editar == TRUE) {
              set_msg('msgok', 'Sucesso', 'Dados Atualizados com sucesso!', 'sucesso');
              redirect('professor/editar/'.$iduser);
          } else {
              set_msg('msgok', 'Error', 'Erro ao atualizar dados', 'erro');
              redirect('professor/editar'.$iduser);
          }
       endif;
     }

     $data['query'] = $this->professor->get_byid($iduser)->row();
     $data['breadcrumb'] = breadcrumb();
     $data['titulo'] = 'Editar Professor';
     $this->load->view('admin/professor/editar', $data);
   }

   public function bloquear($user_id)
	{
		if (is_numeric($user_id)):
			$user = $this->professor->bloquearUser($user_id);
			set_msg('msgok', 'Bloqueado', '<i class="fa fa-lock"></i> Usuário bloqueado.', 'danger');
			redirect('professor/registros');
		endif;
	}

	public function desbloquear($user_id)
	{
		if (is_numeric($user_id)):
			$user = $this->professor->desbloquearUser($user_id);
			set_msg('msgok', 'Desbloqueado', '<i class="fa fa-unlock"></i> Usuário Desbloqueado.', 'info');
			redirect('professor/registros');
		endif;
	}

   public function excluir()
   {
      $id =  $this->input->post('id');
      if ($id == null){
         set_msg('msgok', 'Error', 'Escolha um Professor para excluir.', 'erro');
         redirect('professor/registros');
      }
      $query = $this->professor->get_byid($id);
      if ($query->num_rows() == 1):
         $user = $this->professor->excluirUser($id);
         if ($user == TRUE) :
            set_msg('msgok', 'Sucesso' , 'Professor excluido com sucesso', 'sucesso');
            redirect('professor/registros');
         else :
            set_msg('msgok', 'Erro inesperado!' , 'Tente novamente', 'erro');
            redirect('professor/registros');
         endif;
      else :
         set_msg('msgok', 'Error', 'Professor não encontrado para exclusão', 'erro');
         redirect('professor/registros');
      endif;

   }

}
