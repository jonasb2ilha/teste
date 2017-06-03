<div class="wrapper">
   <?php
   setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
   date_default_timezone_set('America/Sao_Paulo');
   $date = date('d-m-Y - H:i');
   $nome  = $this->session->userdata('name');
   $nivel = $this->session->userdata('role');
   $array = Explode(" ",$nome);
   ?>
   <header class="main-header">
      <a href="" class="logo" data-toggle="offcanvas" role="button">
         <span class="logo-mini" style="margin-left:1px;">GE</span>
         <span class="logo-lg">
            Sistema Gestor de Escolar
         </span>
      </a>
      <nav class="navbar navbar-static-top">
         <a href="" class="sidebar-toggle visible-xs-block hidden-print" data-toggle="offcanvas" role="button">
            <span class="sr-only ">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </a>
         <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <li>
                  <a href="" class="dropdown-toggle" data-toggle="dropdown">
                     <?php echo $date;  ?>
                  </a>
               </li>
               <li class="dropdown user user-menu">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown">
                     <?php
                        if ($nivel == 1) :
                           echo '<i class="fa fa-shield"></i>&nbsp; Adm - ' . $array[0].' '.$array[1];
                        elseif($nivel == 2) :
                            echo '<i class="fa fa-graduation-cap"></i>&nbsp; Adm - ' . $array[0].' '.$array[1];
                        else :
                           echo '<i class="fa fa-user"></i>&nbsp; Adm - ' . $array[0].' '.$array[1];
                        endif;
                      ?>
                  </a>
                  <ul class="dropdown-menu">
                     <li class="user-header">
                        <img src="<?php echo base_url('assets/css/img/jonas.jpg'); ?>" class="img-circle" alt="User Image">
                        <p>
                           <?php
                              if ($nivel==1) :
                                 echo 'Adm - '. $nome;
                              elseif ($nivel == 2) :
                                 echo 'Prof&nbsp; - &nbsp;'. $nome;
                              else :
                                 echo 'Aluno - &nbsp;'. $nome;
                              endif;
                           ?>
                        </p>
                     </li>
                     <li class="user-footer">
                        <div class="pull-left">
                           <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                           <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-default btn-flat">Sair</a>
                        </div>
                     </li>
               </ul>
            </li>
            <li class="dropdown messages-menu">
               <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
               </a>
               <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                     <ul class="menu">
                        <li>
                           <a href="#">
                              <div class="pull-left">
                                 <img src="<?php echo base_url('assets/css/img/jonas.jpg'); ?>" class="img-circle" alt="User Image">
                              </div>
                              <h4>
                                 Support Team
                                 <small><i class="fa fa-clock-o"></i> 5 mins</small>
                              </h4>
                              <p>Why not buy a new awesome theme?</p>
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </nav>
</header>
