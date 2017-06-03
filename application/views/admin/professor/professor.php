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
                     <center><i class="fa fa-folder-open-o"></i> Registros de Professores</center>
                  </h4>
               </div>
               <div class="panel-body">
                  <?php get_msg('msgok'); ?>
                  <a href="<?php base_url()?>cadastrar" class='btn btn-gree r' style='float:left' >
                     <i class="fa fa-user-plus"></i>&nbsp; Adicionar professor
                  </a>
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th style="border-left:1px solid #364956">Professor</th>
                           <th>Disciplina</th>
                           <th>Usuário</th>
                           <th>E-mail</th>
                           <th>Status</th>
                           <th class="text-center ">Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        foreach ($total as $linha):
                           ?>
                           <tr class="<?php echo ($linha->status == 0) ? 'alert-danger ' : ''; ?>">
                              <td><?php echo $linha->name; ?></td>
                              <td><?php echo $linha->matter; ?></td>
                              <td><?php echo $linha->username; ?></td>
                              <td><?php echo $linha->email; ?></td>
                              <td><?php echo ($linha->status == 0) ?
                              ''. anchor('admin/professor/bloqueados', 'Bloqueado', array('class'=>'link_bloq','title'=>'+ informações','data-toggle' =>'tooltip','data-placement' => 'top',)) .''
                              :
                              'Ativo';
                              ?>
                           </td>
                           <td class="text-center">
                              <a href='<?php echo base_url('professor/editar/'.$linha->user_id)?>' title='editar' data-toggle='tooltip' data-placement='top' style="margin-right:10px">
                                 <i class="fa fa-edit ico"></i>
                              </a>
                              <?php if ($linha->status == 0): ?>
                                 <?php echo anchor('admin/professor/desbloquear/'.$linha->user_id, '<i class="fa fa-lock ico"></i>', array(
                                    'class'=>'text-warning',
                                    'title'=>'Desbloquear',
                                    'style'=>'margin-right:10px',
                                    'data-toggle' =>'tooltip',
                                    'data-placement' => 'top',
                                 ));
                                 ?>
                              <?php else: ?>
                                 <?php echo anchor('admin/professor/bloquear/'.$linha->user_id, '<i class="fa fa-unlock ico"></i>', array(
                                    'class'=>'text-warning',
                                    'title'=>'bloquear',
                                    'style'=>'margin-right:10px',
                                    'data-toggle' =>'tooltip',
                                    'data-placement' => 'top',
                                 ));
                                 ?>
                              <?php endif; ?>
                              <span  title='excluir' data-toggle='tooltip' data-placement='top'>
                                 <a href="#" class="text-red" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $linha->user_id?>">
                                    <i class="fa fa-trash-o ico"></i>
                                 </a>
                              </span>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>
</div>

<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="<?php base_url()?>/admin/professor/excluir" method="post">
         <div class="modal-content">
            <div class="modal-header">
               <h3 class="modal-title" id="exampleModalLabel">Excluir Produto</h3>
            </div>
            <div class="modal-body">
               <h4 style="text-align: center">Deseja realmente excluir esse professor?</h4>
               <input type="hidden" name="id" id="recipient-name">
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-danger">Excluir</button>
               <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            </div>
         </div>
      </form>
   </div>
</div>



<?php $this->load->view('include/footer'); ?>
<script type="text/javascript">
$(function () {
   $('#example1').DataTable({
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
});
</script>
<script type="text/javascript">
   $('#exampleModal').on('show.bs.modal', function (event) {
   var button = $(event.relatedTarget)
   var recipient = button.data('whatever')
   var modal = $(this)
   modal.find('.modal-title').text('Excluir Produto')
   modal.find('.modal-body input').val(recipient)
   })
</script>
