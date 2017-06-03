<?php defined('BASEPATH') OR exit('No direct script access allowed');

//mostra erros de validação em forms
if(!function_exists('erros_validacao')){
   function erros_validacao(){
      if (validation_errors())
      echo'
      <div class="alert alert-dismissible alert-danger">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <h4>Verifique os erros abaixo!</h4>
         '.validation_errors('<p>', '</p>').'
      </div>
      ';
   }
}

//define uma mensagem para ser exibida na próxima tela carregada
if(!function_exists('set_msg')){
    function set_msg($id='msgerro', $titulo=NULL, $msg=NULL, $tipo='erro'){
        $CI =& get_instance();

        switch ($tipo):
            case 'erro':
                $CI->session->set_flashdata($id, '
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>'.$titulo.'</h4>
                        '.$msg.'
                    </div>
                ');
                break;
            case 'warning':
                $CI->session->set_flashdata($id, '
                    <div class="alert alert-dismissible alert-warning">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>'.$titulo.'</h4>
                        '.$msg.'
                    </div>
                ');
                break;
            case 'info':
                $CI->session->set_flashdata($id, '
                    <div class="alert alert-dismissible alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>'.$titulo.'</h4>
                        '.$msg.'
                    </div>
                ');
                break;
            case 'sucesso':
                $CI->session->set_flashdata($id, '
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>'.$titulo.'</h4>
                        '.$msg.'
                    </div>
                ');
                break;
            default:
                $CI->session->set_flashdata($id, '
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>'.$titulo.'</h4>
                        '.$msg.'
                    </div>
                ');
                break;
        endswitch;
    }
}

//verifica se existe uma mensagem para ser exibida na tela atual
if(!function_exists('get_msg')){
    function get_msg($id, $printar=TRUE){
        $CI =& get_instance();
        if ($CI->session->flashdata($id)):
            if ($printar):
                echo $CI->session->flashdata($id);
                return TRUE;
            else:
                return $CI->session->flashdata($id);
            endif;
        endif;
        return FALSE;
    }
}
