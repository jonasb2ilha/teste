<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top'); ?>
<aside class="main-sidebar">
   <section class="sidebar">
      <?php get_menu('menu'); ?>
   </section>
</aside>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <?php echo $breadcrumb; ?>
      <?php get_msg('msgok'); ?>
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-sm-6 col-md-3">
            <div class="preview">
               <a href="aluno" class="info-caixa">
                  <div class="options bg-light-blue">
                     <i class="fa fa-user-circle-o fa-2"></i>
                     <p>Alunos</p>
                     <h4>1</h4>
                  </div><!-- fecha options-->
               </a>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <a href="professor" class="info-caixa">
               <div class="preview">
                  <div class="options bg-cyan">
                     <i class="fa fa-graduation-cap fa-2"></i>
                     <p>Professores</p>
                     <h4>2</h4>
                  </div><!-- fecha options-->
               </div>
            </a>
         </div>
         <div class="col-sm-6 col-md-3">
            <a href="usuario" class="info-caixa">
               <div class="preview">
                  <div class="options bg-blue">
                     <i class="fa fa-users fa-2"></i>
                     <p>Usuário</p>
                     <h4>3</h4>
                  </div><!-- fecha options-->
               </div>
            </a>
         </div>
         <div class="col-sm-6 col-md-3">
            <a href="#">
               <div class="preview">
                  <div class="options bg-teal">
                     <i class="fa fa-calendar fa-2"></i>
                     <p>Séries</p>
                     <h4>4</h4>
                  </div><!-- fecha options-->
               </div>
            </a>
         </div>
      </div><!--fecha row-->
      <div class="row">
         <div class="col-sm-6 col-md-3">
            <a href="#">
               <div class="preview">
                  <div class="options bg-indigo">
                     <i class="fa fa-comments-o fa-2"></i>
                     <p>Mensagens</p>
                     <h4>5</h4>
                  </div><!-- fecha options-->
               </div>
            </a>
         </div>
         <div class="col-sm-6 col-md-3">
            <a href="#">
               <div class="preview">
                  <div class="options bg-deep-purple">
                     <i class="fa fa-cloud-download fa-2"></i>
                     <p>Downloads</p>
                     <h4>6</h4>
                  </div><!-- fecha options-->
               </div>
            </a>
         </div>
         <div class="col-sm-6 col-md-3">
            <a href="#">
               <div class="preview">
                  <div class="options bg-lime">
                     <i class="fa fa-cloud-upload fa-2"></i>
                     <p>Uploads</p>
                     <h4>7</h4>
                  </div><!-- fecha options-->
               </div>
            </a>
         </div>
         <div class="col-sm-6 col-md-3">
            <a href="#">
               <div class="preview">
                  <div class="options bg-blue-grey">
                     <i class="fa fa-calendar fa-2"></i>
                     <p>Séries</p>
                     <h4>8</h4>
                  </div><!-- fecha options-->
               </div>
            </a>
         </div>
      </div>
   </section>
</div>
<?php $this->load->view('include/footer'); ?>
