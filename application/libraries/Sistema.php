<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema
{
    protected $ci;
    public $tema = array();

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->helper('funcoes');
    }

    public function enviar_email($email, $token){
    	$config['protocol']='tsl';
		$config['smtp_host']='ssl://smtp.live.com';
		$config['smtp_port']='587';
		$config['smtp_timeout']='60';
		$config['smtp_user']='jonas.gomesb2@outlook.com';
		$config['smtp_pass']='246676581994';
		$config['charset']='utf-8';
		$config['newline']="\r\n";
		$config['mailtype'] = 'html';
		$config['charset']='utf-8';

		$this->ci->load->library('email', $config);


		$mensagem = '
			<p>Você solicitou uma redefinição de senha.</p>
			<p>Entre no link <a href="'.base_url('redefinir/'.$token).'">' .base_url('redefinir/'.$token). '</a> para redefinição de sua senha<p>

		';
		$this->ci->email->from('jonas.gomesb2@outlook.com','Sistema Escolar');
		$this->ci->email->to($email);
		$this->ci->email->subject('Redefinição de senha');
		$this->ci->email->message($mensagem);

		if ($this->ci->email->send()) {
			return TRUE;
		} else {
			return $this->ci->email->print_debugger();
		}

	}


}

/* End of file sistema.php */
/* Location: ./application/libraries/sistema.php */
 ?>
