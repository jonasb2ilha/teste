<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top'); ?>
<aside class="main-sidebar">
   <section class="sidebar">
      <?php get_menu('menu'); ?>
   </section>
</aside>
<div class="content-wrapper">
   <section class="content-header">
      <?php echo breadcrumb(); ?>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-lg-12">
            <div class="panel panel-primary">
               <div class="panel-heading" style="background:#364956;">
                  <h4 class="panel-title">
                     <center><i class="fa fa-folder-open-o"></i>&nbsp; Cadastros de Turnos, Turmas e Séries</center>
                  </h4>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <?php erros_validacao();get_msg('msgok'); ?>
                     </div>
                  </div>
                  <?php echo form_open('',array('class'=>'form-horizontal'));?>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-1 control-label col-sm-offset-3 ">Turno</label>
                     <div class="col-sm-4 ">
                        <input type="text" class="form-control" name="turno" placeholder="Ex: Manhã, Tarde, Noite">
                     </div>
                     <button type="submit" value="enviar_turno"class="btn btn-success bt"><i class="fa fa-check"></i> Cadastrar</button>
                  </div>
                  <?php echo form_close(); ?>
                  <hr>
                  <?php echo form_open('',array('class'=>'form-horizontal'));?>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-1 control-label col-sm-offset-3 ">Turma</label>
                     <div class="col-sm-2 ">
                        <input type="text" class="form-control" name="turma" placeholder="Ex:1902">
                     </div>
                     <div class="col-sm-2 ">
                        <select name="turno" class="form-control">
                           <option value="">Turnos</option>
                           <?php
                           foreach ($turno as $linha)
                           {
                              echo '<option value="'.$linha->turn.'">'.$linha->turn.'</option>';
                           }
                           ?>
                        </select>
                     </div>
                     <button type="submit" value="enviar_turma"class="btn btn-success bt"><i class="fa fa-share"></i>&nbsp; Associar</button>
                  </div>
                  <?php echo form_close(); ?>
                  <hr>
                  <?php echo form_open('',array('class'=>'form-horizontal'));?>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-1 control-label col-sm-offset-3 ">Série</label>
                     <div class="col-sm-2 ">
                        <input type="text" class="form-control" name="serie" placeholder="Ex: 1º ano">
                     </div>
                     <div class="col-sm-2 ">
                        <select name="turma" class="form-control">
                           <option value="">Turma</option>
                           <?php
                           foreach ($turma as $linha)
                           {
                              echo '<option value="' .$linha->turma. '">' .$linha->turma. ' - ' .$linha->turno. '</option>';
                           }
                           ?>
                        </select>
                     </div>
                     <button type="submit" value="enviar_serie" class="btn btn-success bt"><i class="fa fa-share"></i>&nbsp; Associar</button>
                  </div>
                  <?php echo form_close(); ?>
                  <hr>
               </div>
            </div>
         </div>
      </div><!-- fecha row-->
      <div class="row">
         <div class="col-lg-12">
            <div class="panel panel-primary">
               <div class="panel-heading" style="background:#364956;">
                  <h4 class="panel-title">
                     <center><i class="fa fa-folder-open-o"></i>&nbsp; Associar professores a turmas</center>
                  </h4>
               </div>
               <div class="panel-body">
                  <?php echo form_open('',array('class'=>'form-horizontal'));?>
                     <div class="col-sm-2 ">
                        <select name="turma" class="form-control">
                           <option value="">Professor</option>
                           <?php
                           foreach ($profe as $linha)
                           {
                              $nome = $linha->name;
                              $array = explode(" ", $nome);
                              echo '<option value="' .$linha->id. '">' .$linha->name.' - ' .$linha->matter. '</option>';
                           }
                           ?>
                        </select>
                  </div>
                  <div class="col-sm-2">
                     <button type="submit" name="button" class="btn btn-success"><i class="fa fa-share"></i> Associar</button>
                  </div>
                  <table id="example2" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th style="border-left:1px solid #364956"></th>
                           <th>Série</th>
                           <th>Turma</th>
                           <th>Turno</th>
                           <th class="text-center">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($serie as $linha):
                           ?>
                           <tr>
                              <td><input type="checkbox" name="escolher" value="<?php echo $linha->id; ?>"></td>
                              <td><?php echo $linha->serie; ?></td>
                              <td><?php echo $linha->turma; ?></td>
                              <td><?php echo $linha->turno; ?></td>
                              <td class="text-center">
                                 <a href='<?php echo base_url('professor/editar/'.$linha->id)?>' title='editar' data-toggle='tooltip' data-placement='top' style="margin-right:10px">
                                    <i class="fa fa-edit ico"></i>
                                 </a>
                                 <span  title='excluir' data-toggle='tooltip' data-placement='top'>
                                    <a href="#" class="text-red" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $linha->id?>">
                                       <i class="fa fa-trash-o ico"></i>
                                    </a>
                                 </span>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
                  <?php form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php $this->load->view('include/footer'); ?>
<script type="text/javascript">
$(function () {
   $('#example2').DataTable({
      "oLanguage": {
         "sSearch": "",
         "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros"
      },
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": true,
   }
);
$(".div.dataTables_filter input").first().focus();
$('.dataTables_filter input').attr("placeholder", " Buscar");
$('.dataTables_filter input').attr("class", "dataTables_filter input bus");
});
</script>
