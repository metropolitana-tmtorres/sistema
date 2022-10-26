
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if(isset($obj)) {echo 'Editar Estoque';} else {echo 'Cadastrar Estoque';} ?>
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

<?php if(isset($obj)) {$url = 'editestoque';} else {$url = 'addEstoque';} ?>
    <form action="<?php echo URL; ?>home/<?php echo $url?>" method="POST">
      <div class="box-body">
        <div class="form-group">
            <label for="">Cliente</label>
            <input value="<?php if(isset($obj->strEstoqueCliente)) {echo $obj->strEstoqueCliente;} ?>" type="text" required name="cliente" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Produto</label>
            <input value="<?php if(isset($obj->strEstoqueNomeProduto)) {echo $obj->strEstoqueNomeProduto;} ?>" type="text" required name="produto" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Quantidade</label>
            <input value="<?php if(isset($obj->intEstoqueQtd)) {echo $obj->intEstoqueQtd;} ?>" type="number" required name="qtd" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Data de Validade</label>
            <input value="<?php if(isset($obj->strEstoqueValidade)) {echo $obj->strEstoqueValidade;} ?>" type="date" name="validade" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Setor</label>
            <input value="<?php if(isset($obj->strEstoqueSetor)) {echo $obj->strEstoqueSetor;} ?>" type="text" name="setor" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Fila</label>
            <input value="<?php if(isset($obj->strEstoqueFila)) {echo $obj->strEstoqueFila;} ?>" type="number" name="fila" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Caixa</label>
            <input value="<?php if(isset($obj->strEstoqueCaixa)) {echo $obj->strEstoqueCaixa;} ?>" type="text" name="caixa" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Observações</label>
            <input value="<?php if(isset($obj->strEstoqueObs)) {echo $obj->strEstoqueObs;} ?>" type="text" name="obs" class="form-control">
        </div>

        <?php if(isset($obj)) : ?>
          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
          <input name="estoqueId" type="hidden" value="<?php echo $obj->intEstoqueID; ?>">
          <button type="submit" class="btn btn-primary">Editar Estoque</button>
        <?php else : ?>
          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
          <button type="submit" class="btn btn-primary">Cadastrar Estoque</button>
        <?php endif; ?>

      </div>
    </form>
    </div>