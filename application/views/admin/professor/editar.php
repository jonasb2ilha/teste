<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top'); ?>
<aside class="main-sidebar">
   <section class="sidebar">
      <?php get_menu('menu'); ?>
   </section>
</aside>
<div class="content-wrapper">
   <section class="content-header">
      <div class="row">
         <div class="col-lg-6">
            <?php echo breadcrumb(); ?>
         </div>
         <div class="col-lg-6">
            <?php
               echo anchor('professor/registros', '<i class="fa fa-list-alt"></i>&nbsp; Registros de Professores', array(
                  'class'=>'btn btn-gree',
                  'style'=>'float:right;'
               ));
            ?>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-lg-12">
            <div class="panel panel-primary">
               <div class="panel-heading" style="background:#364956;">
                  <h4 class="panel-title">
                     <center><i class="fa fa-edit"></i> Editar Professor</center>
                  </h4>
               </div>
               <div class="panel-body">
                  <?php echo form_open('',array('class'=>'form-horizontal'));?>
                  <div class="form-group">
                     <div class="col-sm-8 col-sm-offset-2">
                        <?php erros_validacao(); get_msg('msgok'); ?>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" placeholder="Nome" value="<?php echo $query->name; ?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Matéria</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="materia" placeholder="Matéria" value="<?php echo $query->matter; ?>">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">E-mail</label>
                     <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $query->email; ?>" >
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Usuário</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="username" placeholder="Usuário" value="<?php echo $query->username; ?>" >
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                     <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Confirma Password</label>
                     <div class="col-sm-8">
                        <input type="password" class="form-control" name="password2" placeholder="Confirma Password">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="idusuario" value="<?php $iduser;?>">
                        <button type="submit" name="button" class='btn btn-info bt'><i class="fa fa-refresh"></i> Atualizar</button>
                        <button type="reset" name="button" class='btn btn-danger bt'><i class="fa fa-close"></i> Cancelar</button>
                        <a href="<?php base_url()?>/professor/registros" class='btn btn-default bt'><i class="fa fa-arrow-left"></i> Voltar</a>
                     </div>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php $this->load->view('include/footer'); ?>
