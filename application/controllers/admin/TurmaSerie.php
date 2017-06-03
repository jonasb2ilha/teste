<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TurmaSerie extends CI_Controller{

   public function __construct()
   {
      parent::__construct();
      $nivel = $this->session->userdata('role_id');
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->model('TurmasSeries_model', 'TurmaSerie');
      set_menu('menu', $nivel);
      verifica_login();
   }

   public function index()
   {
      $this->registros();
   }

   public function registros ()
   {
      $turno = $this->input->post('enviar_turno');
		$turma = $this->input->post('enviar_turma');
		$serie = $this->input->post('enviar_serie');
		$this->load->helper('security');

		if ($turno == TRUE) :
			$turno = $this->input->post('turno');
			$this->form_validation->set_message('is_unique', 'Este %s já está cadastrado no sistema');
			$this->form_validation->set_rules('turno', 'TURNO', 'trim|required|xss_clean|strip_tags|is_unique[turn.turn]');

			if ($this->form_validation->run() == FALSE) :
				if (validation_errors()):
					set_msg(validation_errors());
				endif;
			else :
				$cadastrar = $this->TurmaSerie->cadastrarTurno($turno);
				if ($cadastrar) :
					set_msg('msgok', 'Sucesso', 'Turno cadastrado com sucesso.', 'sucesso');
					redirect('turmas-series/registros');
				else :
					set_msg('msgok', 'Error', 'Error inisperado, tente novamente!', 'erro');
					redirect('turmas-series/registros');
				endif;
			endif;
		elseif ($turma == TRUE) :
			$turma = $this->input->post('turma');
			$turno = $this->input->post('turno');
			$this->form_validation->set_message('is_unique', "Esta $turma já está cadastrado no sistema");
			$this->form_validation->set_rules('turma', 'TURMA', 'required|trim|xss_clean|strip_tags|is_unique[classes.turma]');
			$this->form_validation->set_rules('turno', 'TURNO', 'required|trim|xss_clean|strip_tags');
			if ($this->form_validation->run() == FALSE) :
				if (validation_errors()) :
					set_msg(validation_errors());
				endif;
			else :
				$cadastrar = $this->TurmaSerie->cadastrarTurma($turma, $turno);
				if ($cadastrar == TRUE) :
					set_msg('msgok', 'Sucesso', "Turma $turma cadastrada com sucesso!", 'info');
					redirect('turmas-series/registros');
				else :
					set_msg('msgok', 'Ops!', "Houve um erro inesperado, tente novamente ou contacte o programador!", 'warning');
					redirect('turmas-series/registros');
				endif;
			endif;
		else :
			$serie = $this->input->post('serie');
			$turma = $this->input->post('turma');
			$this->form_validation->set_rules('turma', 'TURMA', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('serie', 'SÉRIE', 'required|trim|xss_clean|strip_tags');
			if ($this->form_validation->run() == FALSE) :
				if (validation_errors()) :
					set_msg(validation_errors());
				endif;
			else :
				$verifica 		  = $this->TurmaSerie->retornaTurma($serie, $turma);
				$retornaTurno    = $this->TurmaSerie->retornaTurno($turma);
				$cadastra		  = $this->TurmaSerie->cadastrarSerie($serie, $turma, $retornaTurno);
			endif;
		endif;
      $data['turno'] = $this->TurmaSerie->get_all_turno();
      $data['turma'] = $this->TurmaSerie->get_all_turma();
      $data['serie'] = $this->TurmaSerie->get_all_serie();
      $data['profe'] = $this->TurmaSerie->get_all_profe();
      $data['titulo']   = 'Turmas e Séries';
      $this->load->view('admin/turmas_serie/turmaSerie', $data);
   }

}
