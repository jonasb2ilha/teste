<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct()
  {
      parent::__construct();
      $nivel = $this->session->userdata('role_id');
	   set_menu('menu', $nivel);
		verifica_login();
  }

  function index()
  {
     $data['breadcrumb'] = breadcrumb();
     $data['titulo'] = 'Home Administrativa';
     $this->load->view('admin/home', $data);
  }

}
