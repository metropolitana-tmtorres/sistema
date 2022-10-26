

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categorias de Produtos
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
            <h3 class="box-title">Cadastro de Categorias</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php if(isset($categ)) : ?>
                <form action="<?php echo URL; ?>home/editaprodcateg" method="post" class="inline-form">
                    <div class="form-group">
                        <label for="categoria">Nome da Categoria</label>
                        <input type="text" required class="form-control" id="categoria" name="categoria" value="<?php echo $categ->strProdutoCategNome; ?>">
                    </div>
                    <input type="hidden" name="categid" value="<?php echo $categ->intProdutoCategID; ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Editar</button>
                </form>
            <?php else: ?>
                <form action="<?php echo URL; ?>home/cadastraprodcateg" method="post" class="inline-form">
                    <div class="form-group">
                        <label for="categoria">Nome da Categoria</label>
                        <input type="text" required class="form-control" id="categoria" name="categoria" placeholder="Ex.: Comerciais Metropolitana FM">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Cadastrar</button>
                </form>
            <?php endif; ?>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Categorias de Produtos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($categorias as $pc) : ?>
                    <tr>
                        <td><?php echo $pc->strProdutoCategNome; ?></td>
                        <td><a href="<?php echo URL; ?>home/produtoscategoria/<?php echo $pc->intProdutoCategID; ?>">Editar</a></td>
                        <td><a href="<?php echo URL; ?>home/excluirprodcateg/<?php echo $pc->intProdutoCategID; ?>">Excluir</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->