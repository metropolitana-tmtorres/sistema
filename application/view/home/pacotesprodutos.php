

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gerenciar Produtos do Pacote <?php echo $pacote->strPacoteNome; ?>
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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Adicionar Produto</h3>
        </div>
        <div class="box-body">
            <form action="<?php echo URL; ?>home/addProdutoPacote" method="post">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Produto</label>
                        <select name="produto" required id="" class="form-control">
                            <option value="" disabled selected>Selecione o Produto</option>
                            <?php foreach($produtos as $pr) : ?>
                                <option value="<?php echo $pr->intProdutoID; ?>"><?php echo $pr->strProdutoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Quantidade</label>
                        <input type="number" required name="qtd" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="pacote" value="<?php echo $id; ?>"><br>
                    <button type="submit" class="btn btn-primary">Adicionar ao Pacote</button>
                </div>
            </form>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Produtos do Pacote</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Qtd</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($ps as $ppp) : ?>
                    <tr>
                        <td><?php echo $ppp->strProdutoNome; ?></td>
                        <td><?php echo $ppp->intPacoteProdutoQtd; ?></td>
                        <td><a href="<?php echo URL; ?>home/excluirprodutopacote/<?php echo $ppp->intProdutoPacoteID; ?>/<?php echo $id; ?>">Excluir</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Produto</th>
                        <th>Qtd</th>
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