

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Estoque
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo URL; ?>home/estoqueform'">
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
            <h3 class="box-title">Itens em Estoque</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Qtd</th>
                        <th>Validade</th>
                        <th>Setor</th>
                        <th>Fila</th>
                        <th>Caixa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($estoque as $e) :
                    ?>
                        <tr>
                            <td><a href="<?php echo URL; ?>home/estoqueform/<?php echo $e->intEstoqueID; ?>" title="Editar Estoque"><?php echo $e->strEstoqueCliente; ?></td>
                            <td><a href="<?php echo URL; ?>home/estoqueitem/<?php echo $e->intEstoqueID; ?>"><?php echo $e->strEstoqueNomeProduto; ?></a></td>
                            <td><?php echo $e->intEstoqueQtd; ?></td>
                            <td><?php echo $this->mostraData($e->strEstoqueValidade); ?></td>
                            <td><?php echo $e->strEstoqueSetor; ?></td>
                            <td><?php echo $e->strEstoqueFila; ?></td>
                            <td><?php echo $e->strEstoqueCaixa; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Qtd</th>
                        <th>Validade</th>
                        <th>Setor</th>
                        <th>Fila</th>
                        <th>Caixa</th>
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

  