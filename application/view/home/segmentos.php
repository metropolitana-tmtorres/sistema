

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Segmentos
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn-sm btn-register btn-flat" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-edit"></i> Cadastrar
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
          <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>"; ?>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Segmentos do Sistema</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Segmento</th>
                        <!-- <th>Editar</th> -->
                        <!-- <th>Excluir</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php foreach($segmentos as $s) : ?>
                    <tr>
                        <td><?php echo $s->strSegmentoNome; ?></td>
                        <!-- <td><a href="<?php echo URL; ?>home/editarsegmento/<?php echo $s->intSegmentoID; ?>">Editar</a></td> -->
                        <!-- <td><a href="<?php echo URL; ?>home/excluirsegmento/<?php echo $s->intSegmentoID; ?>">Excluir</a></td> -->
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Segmento</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal modal-info fade" id="modal-info">
    <form action="<?php echo URL; ?>home/registersegmento" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de Segmentos</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Segmento</label>
                        <input type="text" required name="name" class="form-control" placeholder="Ex.: Varejo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Cadastrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->