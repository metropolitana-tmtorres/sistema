

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Moedas
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-plus"></i> Cadastrar
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
        <div class="alert alert-success">Dados salvos com sucesso</div>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
        <div class="alert alert-danger">Houve um erro ao salvar os dados</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Moedas do Sistema</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable">
                <thead>
                    <tr>
                        <th>Moeda</th>
                        <th>Sinal</th>
                        <!-- <th>Editar</th> -->
                        <!-- <th>Excluir</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php foreach($moedas as $m) : ?>
                    <tr>
                        <td><?php echo $m->strMoedaNome; ?></td>
                        <td><?php echo $m->strMoedaSign; ?></td>
                        <!-- <td><a href="<?php echo URL; ?>home/editarmoeda/<?php echo $m->intMoedaID; ?>">Editar</a></td> -->
                        <!-- <td><a href="<?php echo URL; ?>home/excluirmoeda/<?php echo $m->intMoedaID; ?>">Excluir</a></td> -->
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Moeda</th>
                        <th>Sinal</th>
                        <th>Editar</th>
                        <th>Excluir</th>
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
    <form action="<?php echo URL; ?>home/registermoeda" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de Moedas</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Moeda</label>
                        <input type="text" required name="name" class="form-control" placeholder="Real Brasileiro">
                    </div>
                    <div class="form-group">
                        <label for="">Sinal</label>
                        <input type="text" required name="sinal" class="form-control" placeholder="R$">
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