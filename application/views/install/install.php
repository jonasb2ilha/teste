<?php $this->load->view('include/header'); ?>
<div class="container">
   <div class="row ">
      <div class="col-sm-6 col-lg-6 col-lg-offset-3  col-sm-offset-3" style="margin-top: 40px;">
         <div class="panel panel-gree">
            <div class="panel-heading">
               <h3 class="panel-title">Cadastro de Usuários</h3>
            </div>
            <div class="panel-body">
               <?php erros_validacao();get_msg('msgok'); ?>
               <?php echo form_open('', array('class'=>'form-horizontal')); ?>
               <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Nome:</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="name" placeholder="Nome Completo" name="name" value="<?=set_value('name')?>">
                  </div>
               </div>
               <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">E-mail:</label>
                  <div class="col-sm-8">
                     <input type="email" class="form-control" id="email" placeholder="seuemail@site.com" name="email" value="<?=set_value('email')?>">
                  </div>
               </div>
               <div class="form-group">
                  <label for="username" class="col-sm-3 control-label">Usuário:</label>
                  <div class="col-sm-8">
                     <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?=set_value('username')?>">
                  </div>
               </div>
               <div class="form-group">
                  <label for="Password" class="col-sm-3 control-label">Senha:</label>
                  <div class="col-sm-8">
                     <input type="password" class="form-control" id="password" placeholder="Sua senha" name="password">
                  </div>
               </div>
               <div class="form-group">
                  <label for="Password" class="col-sm-3 control-label">Confirme a senha:</label>
                  <div class="col-sm-8">
                     <input type="password" class="form-control" id="password" placeholder="Confirme a senha" name="password2">
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-10">
                     <button type="submit" class="btn btn-gree">Cadastrar</button>
                  </div>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('include/footer'); ?>
