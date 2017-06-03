<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('verifica_login')){
   //verifica se o usuário está logado, caso negativa redireciona para outra página
   function verifica_login($redirect='login'){
      $ci = & get_instance();
      if($ci->session->userdata('logged') != TRUE):
         set_msg('invalid', 'Acesso restrito!', 'Realize seu login para continuar.', 'erro');
         redirect($redirect);
      endif;
   }
}

if(!function_exists('verifica_nivel')){
   //verifica se o usuário está logado, caso negativa redireciona para outra página
   function verifica_nivel(){
      $ci = & get_instance();
      $nivel = $ci->session->userdata('role_id');
      if($nivel == 2):
         set_msg('invalid', 'Acesso restrito!', 'Área restrita a administradores.', 'erro');
         redirect('professor/home');
      elseif($nivel == 3):
         set_msg('invalid', 'Acesso restrito!', 'Área restrita a administradores.', 'erro');
         redirect('aluno/home');
      endif;
   }
}

if(!function_exists('verifica_nivel_profe')){
   //verifica se o usuário está logado, caso negativa redireciona para outra página
   function verifica_nivel_profe($redirect='login'){
      $ci = & get_instance();
      $nivel = $ci->session->userdata('role_id');
      if($nivel == 1):
         set_msg('invalid', 'Acesso restrito!', 'Área restrita a professores.', 'erro');
         redirect('admin/home');
      elseif($nivel == 3):
         set_msg('invalid', 'Acesso restrito!', 'Área restrita a professores.', 'erro');
         redirect('aluno/home');
      endif;
   }
}

if(!function_exists('verifica_nivel_alunos')){
   //verifica se o usuário está logado, caso negativa redireciona para outra página
   function verifica_nivel_alunos($redirect='login'){
      $ci = & get_instance();
      $nivel = $ci->session->userdata('role_id');
      if($nivel == 1):
         set_msg('invalid', 'Acesso restrito!', 'Área restrita a alunos.', 'erro');
         redirect('admin/home');
      elseif($nivel == 2):
         set_msg('invalid', 'Acesso restrito!', 'Área restrita a alunos.', 'erro');
         redirect('professor/home');
      endif;
   }
}


if(!function_exists('set_menu')){
   function set_menu($nivel='nivel', $tipo='user'){
      $CI =& get_instance();

      switch ($tipo) {
         case '1':
         $CI->session->set_flashdata($nivel, '
         <ul class="sidebar-menu">
         <li class="header">MENU DE NAVEGAÇÃO</li>
         <li class="treeview">
         ' . anchor('home', '<i class="fa fa-home"></i><span>Home</span>') . '
         </li>
         <li class="treeview">
         ' . anchor('professor/registros', '<i class="fa fa-graduation-cap"></i><span>Professores</span>') . '
         </li>
         <li class="treeview">
         ' . anchor('admin/aluno', '<i class="fa fa-user-circle-o"></i><span>Alunos</span>') . '
         </li>
         <li class="treeview">
         ' . anchor('turmas-series/registros', '<i class="fa fa-navicon"></i><span>Turmas e Séries</span>') . '
         </li>
         <li class="treeview">
         ' . anchor('admin/user', '<i class="fa fa-print"></i><span>Usuários</span>')  . '
         </li>
         <li class="treeview">
         ' . anchor('admin/config', '<i class="fa fa-wrench"></i><span>Configuraçoes</span>')   . '
         </li>
         </ul>
         ');
         break;
         case '2':
         $CI->session->set_flashdata($nivel, '
         <div class="panel panel-gree" style="position: fixed">
         <div class="panel-heading pa">Painel de Controler</div>
         <ul class="nav nav-pills nav-stacked">
         <li role="presentation">' . anchor('professor/home'     , '<i class="fa fa-home"></i> Home')                     . '</li>
         <li role="presentation">' . anchor('professor/mensagem' , '<i class="fa fa-envelope"></i> Enviar Mensagens')     . '</li>
         <li role="presentation">' . anchor('professor/boletim'  , '<i class="fa fa-vcard"></i> Enviar Boletins')         . '</li>
         <li role="presentation">' . anchor('professor/arquivos' , '<i class="fa fa-cloud-upload"></i> Enviar Arquivos')  . '</li>
         </ul>
         </div>
         ');
         break;
         case '3':
         $CI->session->set_flashdata($nivel, '
         <div class="panel panel-gree" style="position: fixed">
         <div class="panel-heading pa">Painel de Controler</div>
         <ul class="nav nav-pills nav-stacked">
         <li role="presentation">' . anchor('home/home'      , 'Home')          . '</li>
         <li role="presentation">' . anchor('admin/mensagem' , 'Ver Mensagens') . '</li>
         <li role="presentation">' . anchor('admin/boletim'  , 'Ver Boletins')  . '</li>
         <li role="presentation">' . anchor('admin/arquivos' , 'Ver arquivos')  . '</li>
         </ul>
         </div>
         ');
         break;
         default:
         # code...
         break;
      }

   }
}

if (!function_exists('get_menu')) {
   function get_menu($nivel, $printar=TRUE){
      $CI =& get_instance();
      if ($CI->session->flashdata($nivel)):
         if ($printar):
            echo $CI->session->flashdata($nivel);
            return TRUE;
         else:
            return $CI->session->flashdata($nivel);
         endif;
      endif;
      return FALSE;
   }
}

function breadcrumb(){
	$CI =& get_instance();
	$CI->load->helper('url');

	$classe = ucfirst($CI->router->class);
	if ($classe == 'Home'):
		$classe = anchor('home', 'Início');
	else:
		$classe = anchor($CI->router->class."/".$CI->router->method, $classe);
	endif;

	$metodo = ucwords(str_replace('_', ' ', $CI->router->method));
	if ($metodo && $metodo != 'Index'):
		$metodo = " &raquo; ".anchor($CI->router->class."/".$CI->router->method, $metodo);
	else:
		$metodo = '';
	endif;
	return '<p>'.anchor('home', 'Painel').' &raquo; '.$classe.$metodo.'</p>';
}
