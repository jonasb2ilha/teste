<?php $this->load->view('include/header'); ?>
<div class="container">

   <div class="row ">

      <div class="col-sm-6 col-lg-6 col-lg-offset-3  col-sm-offset-3" style="margin-top: 40px;">
         <div class="panel panel-gree">
            <div class="panel-heading">
               <h3 class="panel-title">Recuperação de conta</h3>
            </div>
            <div class="panel-body">
               <?php erros_validacao(); get_msg('msgok');?>
               <?php echo form_open('', array('class'=>'form-horizontal')); ?>
               <div class="main-login main-center">
                  <div class="form-group">
                     <label for="nome" class="cols-sm-2 control-label">E-mail</label>
                     <div class="cols-sm-10">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                           <input type="email" class="form-control" name="email" id="name" placeholder="Entre com seu email" value="<?=set_value('email')?>">
                        </div>
                     </div>
                  </div>
                  <div class="form-group ">
                     <input type="submit" class="btn btn-gree btn-block login-button" value="Enviar link de redefinição">
                  </div>
                  <div class="form-group ">
                     <?php echo anchor('login', 'Login', array('class'=>'login-register')); ?>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?php $this->load->view('include/footer'); ?>
