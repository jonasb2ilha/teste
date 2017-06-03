<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TurmasSeries_model extends CI_Model{

   public function __construct()
   {
      parent::__construct();
      //Codeigniter : Write Less Do More
   }

   public function cadastrarTurno($turno) {
		$dados = array('turn' => $turno);
		return $this->db->insert('turn', $dados);
	}


	public function cadastrarTurma($turma, $turno)
	{
		$dados = array ('turma' => $turma, 'turno' => $turno);
		return $this->db->insert('classes', $dados);
	}

	public function retornaTurma($serie, $turma)
	{
		$this->db->where('serie', $serie);
		$this->db->where('turma', $turma);
		$this->db->from('series');
		$retorno = $this->db->count_all_results();
		if ($retorno == 1) :
			set_msg('msgok', 'Ops!', "Essa série($serie) já está associada a está turma.", 'erro');
			redirect('turmas-series/registros');
		endif;
	}


	public function retornaTurno($turma)
	{
		$this->db->where('turma', $turma);
		$this->db->from('classes');
		return $this->db->get()->row('turno');

	}


	public function retornaTurno2($turma)
	{
		$this->db->where('turma', $turma);
		$this->db->from('series');
		return $this->db->get()->row('turno');

	}


	public function retornaSerie($turma)
	{
		$this->db->where('turma', $turma);
		$this->db->from('series');
		return $this->db->get()->row('serie');

	}

	public function cadastrarSerie($serie, $turma, $retornaTurno)
	{
		$data = array (
			'serie' => $serie,
			'turma' => $turma,
			'turno' => $retornaTurno
		);
		$insert = $this->db->insert('series', $data);
		if ($insert) :
			set_msg('msgok', 'Sucesso', 'Série associada com sucesso.', 'sucesso');
			redirect('turmas-series/registros');
		else :
			set_msg('msgok', 'Ops!', 'Error inesperado, tente novamente', 'erro');
			redirect('turmas-series/registros');
		endif;
	}

   public function get_all_turno() {
      return $this->db->get('turn')->result();
   }

   public function get_all_turma() {
      return $this->db->get('classes')->result();
   }

   public function get_all_serie() {
      return $this->db->get('series')->result();
   }

   public function get_all_profe() {
      $this->db->order_by('name', 'asc');
      return $this->db->get('teachers')->result();
   }

}
