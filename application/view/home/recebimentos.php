

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Recebimentos
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
                    <h3 class="box-title">Contas a Receber</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                     <table class="table table-bordered table-striped smarttable2">
                        <thead>
                            <tr>
                                <th>Contrato</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Status</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($recebimentos as $r) : ?>
                            <tr>
                                <td><?php echo $r->intContratoID; ?></td>
                                <td>R$<?php echo $r->strContaReceberValor; ?></td>
                                <td><?php echo $r->strContaReceberDateVenc; ?></td>
                                <td>
                                    <?php 
                                        switch ($r->strContaReceberStatus) {
                                            case 'v':
                                                echo "<span class='label label-danger'>Vencido</span>";
                                                break;
                                            case 'c':
                                                echo "<span class='label label-warning'>Cancelado</span>";
                                                break;
                                            
                                            default:
                                                echo "<span class='label label-success'>Aberto</span>";
                                                break;
                                        }
                                    ?>
                                </td>
                                <td><a href="<?php echo URL; ?>home/verrecebimento/<?php echo $r->intContaReceberID; ?>">Editar</a></td>
                                <td><a href="<?php echo URL; ?>home/editarrecebimento/<?php echo $r->intContaReceberID; ?>">Editar</a></td>
                                <td><a href="<?php echo URL; ?>home/excluirrecebimento/<?php echo $r->intContaReceberID; ?>">Excluir</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Contrato</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Status</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4 col-sm-12">
        <div class="box">
            <?php if(isset($prod)) : ?>
                <div class="box-header">
                    <h3 class="box-title">Editar Produto</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo URL; ?>home/editarproduto" method="post">
                        <div class="form-group">
                            <label for="">Nome do Produto</label>
                            <input type="text" required name="name" class="form-control" value="<?php echo $prod->strProdutoNome; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Categoria</label>
                            <select name="categoria" id="" class="form-control">
                                <?php foreach($categs as $c): ?>
                                    <option value="<?php echo $c->intProdutoCategID; ?>" <?php  if($prod->intProdutoCategID == $c->intProdutoCategID) { echo "selected"; }  ?>><?php echo $c->strProdutoCategNome; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Preço</label>
                            <div class="input-group">
                                <div class="input-group-addon">R$</div>
                                <input type="text" id="money" name="preco" class="form-control" placeholder="10.000,00" value="<?php echo $prod->strProdutoVal; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Descrição</label>
                            <textarea name="descricao" id="" cols="30" rows="10" class="form-control" placeholder="Descreva o produto"><?php echo $prod->strProdutoDesc; ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $prod->intContaReceberID; ?>">
                        <button type="submit" class="btn btn-primary">Editar Produto</button>
                    </form>
                </div>
                <!-- /.box-body -->
            <?php else: ?>
                <div class="box-header">
                    <h3 class="box-title">Cadastro de Produtos</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo URL; ?>home/cadastraproduto" method="post">
                        <div class="form-group">
                            <label for="">Nome do Produto</label>
                            <input type="text" required name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Categoria</label>
                            <select name="categoria" id="" class="form-control">
                                <?php foreach($categs as $c): ?>
                                    <option value="<?php echo $c->intProdutoCategID; ?>"><?php echo $c->strProdutoCategNome; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Preço</label>
                            <div class="input-group">
                                <div class="input-group-addon">R$</div>
                                <input type="text" id="money" name="preco" class="form-control" placeholder="10.000,00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Descrição</label>
                            <textarea name="descricao" id="" cols="30" rows="10" class="form-control" placeholder="Descreva o produto"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                    </form>
                </div>
                <!-- /.box-body -->
            <?php endif; ?>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->