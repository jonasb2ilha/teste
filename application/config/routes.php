<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//default
$route['default_controller'] = 'login';

//login e recuperar senha
$route['recuperar'] = 'login/recuperar';
$route['redefinir/(:any)'] = 'login/redefinir/$1';

//área administradora
$route['home'] = 'admin/home';
$route['professor/registros'] = 'admin/professor/registros';
$route['professor/cadastrar'] = 'admin/professor/cadastrar';
$route['professor/editar/(:num)'] = 'admin/professor/editar/$1';

$route['turmas-series/registros'] = 'admin/turmaSerie/registros';












$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
