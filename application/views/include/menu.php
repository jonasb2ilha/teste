<aside class="main-sidebar">
   <section class="sidebar">
      <ul class="sidebar-menu">
         <li class="header">MENU DE NAVEGAÇÃO</li>
         <li class="treeview">
            <?php echo anchor('admin/home', '<i class="fa fa-home"></i><span>Home</span>'); ?>
         </li>
         <li class="treeview">
             <?php echo anchor('admin/professor', '<i class="fa fa-graduation-cap"></i><span>Professores</span>'); ?>
         </li>
         <li class="treeview">
            <?php echo anchor('admin/aluno', '<i class="fa fa-user-circle-o"></i><span>Alunos</span>'); ?>
         </li>
         <li class="treeview">
            <?php echo anchor('admin/aluno', '<i class="fa fa-navicon"></i><span>Turmas e Séries</span>'); ?>
         </li>
         <li class="treeview">
            <?php echo anchor('admin/user', '<i class="fa fa-print"></i><span>Usuários</span>'); ?>
         </li>
         <li class="treeview">
            <?php echo anchor('admin/config', '<i class="fa fa-wrench"></i><span>Configuraçoes</span>'); ?>
         </li>
      </ul>
   </section>
</aside>
