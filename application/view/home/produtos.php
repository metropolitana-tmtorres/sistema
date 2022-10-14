

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Produtos
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
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
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Produtos no Sistema</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped smarttable">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($produtos as $p) : ?>
                            <tr>
                                <td><?php echo $p->strProdutoNome; ?></td>
                                <td>R$<?php echo $this->showMoney($p->strProdutoVal); ?></td>
                                <td><a href="<?php echo URL; ?>home/produtos/<?php echo $p->intProdutoID; ?>">Editar</a></td>
                                <td><a href="<?php echo URL; ?>home/excluirproduto/<?php echo $p->intProdutoID; ?>">Excluir</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Produto</th>
                                <th>Valor</th>
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
                            <input type='currency' name="preco" class="form-control" placeholder="10.000,00" value="<?php echo $prod->strProdutoVal; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Descrição</label>
                            <textarea name="descricao" id="" cols="30" rows="10" class="form-control" placeholder="Descreva o produto"><?php echo $prod->strProdutoDesc; ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $prod->intProdutoID; ?>">
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
                            <input type='currency' class=money name="preco" class="form-control" placeholder="10.000,00">
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
  <script src="<?php echo URL; ?>plugins/masks/jquery.mask.js"></script>
  <script>
 $(document).ready(function(){
      $(".money").mask("#.##0,00", {reverse: true});
      $('#cep').mask('99999-999');
      $('#cpf').mask('999.999.999-99');
      $('#rg').mask('99.999.999-9');
      $('#celular').mask('(99) 99999-9999');
      $('#telefone').mask('(99) 9999-9999');
      $('#cnpj').mask('99.999.999/9999-99');
      $('#data').mask('99/99/9999');

      <?php if(isset($obj)):?>
      $('#cargo').val(<?=$obj->intCargoID?>).trigger('change');
      <?php endif;?>
      
    });
  </script>