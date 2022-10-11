
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if(isset($obj)) {echo 'Editar Planilha Orçamentária';} else {echo 'Cadastrar Planilha Orçamentária';} ?>
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
    
    <?php if(isset($obj)) {$url = 'editPoData';} else {$url = 'addPoData';} ?>

    <form method="POST" action="<?=URL; ?>home/<?=$url; ?>">
    <div class="box-body">
    <div class="form-group">
            <label for="">Produto</label>
            <select name="produto" class="form-control select2" data-placeholder="Selecione um Produto">
                <?php foreach($produtos as $produto) : ?> 
                    <option <?php if(isset($obj->intProdutoID) && $obj->intProdutoID == $produto->intProdutoID) {echo "selected";}?> 
                    value="<?=$produto->intProdutoID; ?>">
                            <?=$produto->strProdutoNome; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Data</label>
            <input type="date" value="<?php if(isset($obj->strPoDataData)) {echo $obj->strPoDataData;} ?>" name="datas" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Fornecedor</label>
            <select name="fornecedor" class="form-control select2" data-placeholder="Selecione um Fornecedor">
                <option value="" <?php if(!isset($obj)) {echo "selected";}?> disabled>Selecione um Fornecedor</option>    
                <?php foreach($fornecedores as $fornecedor) :
                    $f = $this->getFornecedorNomeByID($fornecedor->intFornecedorID);
                ?> 
                    <option <?php if(isset($obj->intFornecedorID) && $obj->intFornecedorID == $fornecedor->intFornecedorID) {echo "selected";}?> 
                    value="<?=$fornecedor->intFornecedorID; ?>">
                            <?=$f->strFornecedorNome; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Quantidade</label>
            <input type="number" value="<?php if(isset($obj->intPoDataQtd)) {echo $obj->intPoDataQtd;} ?>" required name="qtd" class="form-control">
        </div>
       

        <input type="hidden" name="adm" value="<?=$adm->intAdmID; ?>">  
        <input name="poId" type="hidden" value="<?=$poId; ?>">
        <?php if(isset($obj)) : ?>
            <input name="poDataId" type="hidden" value="<?=$obj->intPoDataID; ?>">
            <button type="submit" class="btn btn-primary">Editar Dados da P.O.</button>
        <?php else : ?>
            <button type="submit" class="btn btn-primary">Cadastrar Dados da P.O.</button>
        <?php endif; ?>
    </div>   
    </form>
<!-- /.box-body -->
</div>