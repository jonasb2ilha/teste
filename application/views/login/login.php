<?php $this->load->view('include/header'); ?>
<div class="container">

   <div class="row ">

      <div class="col-sm-6 col-lg-6 col-lg-offset-3  col-sm-offset-3" style="margin-top: 40px;">
         <div class="panel panel-gree">
            <div class="panel-heading">
               <h3 class="panel-title">Login de Usuário</h3>
            </div>
            <div class="panel-body">
               <?php echo form_open('', array('class'=>'form-horizontal')); ?>
               <div class="main-login main-center">
                  <?php erros_validacao();get_msg('valid');get_msg('msgok');get_msg('invalid'); ?>
                  <div class="form-group">
                     <label for="nome" class="cols-sm-2 control-label">Usuário</label>
                     <div class="cols-sm-10">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                           <input type="text" class="form-control" name="username" id="name" placeholder="Entre com seu nome" value="<?=set_value('username')?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="password" class="cols-sm-2 control-label">Password</label>
                     <div class="cols-sm-10">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                           <input type="password" class="form-control" name="password" id="password" placeholder="Entre com uma senha" value="">
                        </div>
                     </div>
                  </div>
                  <div class="form-group ">
                     <input type="submit" class="btn btn-gree btn-block login-button" value="Entrar">
                  </div>
                  <div class="form-group ">
                     <?php echo anchor('recuperar', 'Esqueci minha senha', array('class'=>'login-register','style'=>'float:right')); ?>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?php $this->load->view('include/footer'); ?>
