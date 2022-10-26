

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dados da Planilha Orçamentária
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
   
    <?php 
         $f = $this->getFornecedorByID($po->intFornecedorID);
    ?>
    <div class="box">
        <div class="box-body">
            <h3>Dados do Produto</h3>
             <table class="table table-bordered table-striped smarttable2">
                <tbody>
                    <tr>
                        <td><strong>Item</strong></td>
                        <td><?php echo $po->strPoDataItem; ?></td>
                        <td><strong>Especificação</strong></td>
                        <td><?php echo $po->strPoDataEspecificacao; ?></td>
                        <td><strong>Tópico</strong></td>
                        <td><?php echo $po->strPoDataTopico; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Data</strong></td>
                        <td colspan="1"><?php echo $this->mostraData($po->strPoDataData); ?></td>
                        <td><strong>Prazo de Produção</strong></td>
                        <td colspan="1"><?php echo $po->strPoDataPrazoProd; ?></td>
                        <td><strong>Fornecedor</strong></td>
                        <td colspan="1"><?php echo $f->strFornecedorNome; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Quantidade</strong></td>
                        <td><?php echo $po->intPoDataQtd; ?></td>
                        <td><strong>Valor Unitário</strong></td>
                        <td><?php echo $po->strPoDataValorUnitario; ?></td>
                        <td><strong>Cotação</strong></td>
                        <td><?php echo $po->strPoDataCotacao; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Valor Total</strong></td>
                        <td><?php echo $po->strPoDataValorTotal; ?></td>
                        <td><strong>Valor Total(R$)</strong></td>
                        <td><?php echo $po->strPoDataValorTotalRs; ?></td>
                        <td><strong>Forma de Pagamento</strong></td>
                        <td><?php echo $po->strPoDataFormaPagamento; ?></td>
                    </tr>
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

