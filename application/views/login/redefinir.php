<?php $this->load->view('include/header'); ?>
<div class="container">

   <div class="row ">

      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-offset-3  col-xs-offset-3" style="margin-top: 40px;">
         <div class="panel panel-gree">
            <div class="panel-heading">
               <h3 class="panel-title">Redefinição de senha</h3>
            </div>
            <div class="panel-body">
               <?php erros_validacao(); get_msg('msgok'); ?>
               <?php echo form_open('', array('class'=>'form-horizontal')); ?>
               <div class="main-login main-center">
                  <div class="form-group">
                     <label for="password" class="cols-sm-2 control-label">Nova senha</label>
                     <div class="cols-sm-10">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
                           <input type="password" class="form-control" name="password" id="password" placeholder="Nova senha">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="password2" class="cols-sm-2 control-label">Confirma senha</label>
                     <div class="cols-sm-10">
                        <div class="input-group">
                           <span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
                           <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirma senha">
                        </div>
                     </div>
                  </div>
                  <div class="form-group ">
                     <input type="submit" class="btn btn-gree btn-block login-button" value="Cadastrar nova senha">
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php $this->load->view('include/footer'); ?>
