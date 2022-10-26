

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pacotes
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
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
    <div class="row">
        <div class="col-md-8 col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pacotes de Produtos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Pacote</th>
                            <th>Gerenciar Produtos</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($pacotes as $p) : ?>
                        <tr>
                            <td><?php echo $p->strPacoteNome; ?></td>
                            <td><a href="<?php echo URL; ?>home/pacotesprodutos/<?php echo $p->intPacoteID; ?>">Gerenciar</a></td>
                            <td><a href="<?php echo URL; ?>home/pacotes/<?php echo $p->intPacoteID; ?>">Editar</a></td>
                            <td><a href="<?php echo URL; ?>home/excluirpacote/<?php echo $p->intPacoteID; ?>">Excluir</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        </div>
        <div class="col-md-4 col-sm-12">
            <?php if(isset($pacote)) : ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Editar Pacote</h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo URL; ?>home/editarpacote" method="post">
                            <div class="form-group">
                                <label for="">Nome do Pacote</label>
                                <input type="text" required class="form-control" placeholder="Vinhetas" name="pacote" value="<?php echo $pacote->strPacoteNome; ?>">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $pacote->intPacoteID; ?>">
                            <button type="submit" class="btn btn-primary">Editar Pacote</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Criar Pacote</h3>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo URL; ?>home/cadastrapacote" method="post">
                            <div class="form-group">
                                <label for="">Nome do Pacote</label>
                                <input type="text" required class="form-control" placeholder="Vinhetas" name="pacote">
                            </div>
                            <button type="submit" class="btn btn-primary">Criar Pacote</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  