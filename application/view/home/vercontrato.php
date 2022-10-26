

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dados do Contrato
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
      $cliCnpj = $this->getClienteCnpj($c->intClienteID);
      $aCnpj = $this->getAgenciaCnpj($c->intAgenciaID);
    ?>
    <div class="box">
        <div class="box-body">
            <h3>Contrato</h3>
             <table class="table table-bordered table-striped smarttable2">
                <tbody>
                    <tr>
                        <td><strong>Nº de Contrato</strong></td>
                        <td><?php echo $this->showCode($c->intContratoID, 'CT'); ?> (<a href="<?php echo URL; ?>uploads/<?php echo $c->strContratoPDF; ?>">Ver Contrato</a>)</td>
                        <td><strong>Tipo</strong></td>
                        <td><?php echo $this->mostraTipo($c->strContratoTipo); ?></td>
                        <td><strong>Autorização</strong></td>
                        <td><?php echo $c->strContratoAutorizacao; ?></td>
                    </tr>
                    <tr>
                        <td><strong>CNPJ do Cliente</strong></td>
                        <td><?php echo $cliCnpj->strClienteCNPJ; ?></td>
                        <td><strong>CNPJ da Agência</strong></td>
                        <td><?php echo $aCnpj->strAgenciaCNPJ; ?></td>
                        <td><strong>Nome do Projeto</strong></td>
                        <td><?php echo $c->strProjetoNome; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nº do Vendedor</strong></td>
                        <td><?php echo $this->showCode($c->intAdmID, 'V'); ?></td>
                        <td><strong>Valor do Contrato</strong></td>
                        <td><?php echo $c->strContratoValor; ?></td>
                        <td><strong>Data</strong></td>
                        <td><?php echo $this->mostraData($c->strContratoData); ?></td>
                    </tr>
                </tbody>
            </table>     
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Editar Arquivo de Contrato</h3>
          </div>
          <div class="box-body">
            <form method="POST" action="<?php echo URL; ?>home/editcontratopdf" enctype="multipart/form-data">
              <div class="form-group">
                <label for="">Selecione o Contrato</label>
                <input type="file" value="<?php if(isset($c->strContratoPDF)) {echo $c->strContratoPDF;} ?>" name="contratoPdf" id="contratoPdf" class="form-control" />
              </div> 

              <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
              <input name="contratoId" type="hidden" value="<?php echo $c->intContratoID; ?>">
              <button type="submit" class="btn btn-primary">Editar Contrato</button>
            <!-- /.box-body -->
            </form>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

