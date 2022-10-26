
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contratos
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn-sm btn-register btn-flat" onclick="window.location.href='<?php echo URL; ?>home/contratoform'">
                <i class="fa fa-edit"></i> Cadastrar 
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
            <h3 class="box-title">Contratos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                      <th>Nº de Contrato</th>
                      <th>Tipo</th>
                      <th>Autorização</th>
                      <th>CNPJ-Cliente</th>
                      <th>CNPJ-Agência</th>
                      <th>Nome do Projeto</th>
                      <th>Nº Vendedor</th>
                      <th>Valor do Contrato</th>
                      <th>Data</th>
                      <th>Editar</th>
                      <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($contratos as $c) :
                            $cliCnpj = $this->getClienteCnpj($c->intClienteID);
                            $aCnpj = $this->getAgenciaCnpj($c->intAgenciaID);
                        ?>
                        <tr>
                            <td><?php echo $this->showCode($c->intContratoID, 'CT'); ?></td> 
                            <td><?php echo $this->mostraTipo($c->strContratoTipo); ?></td> 
                            <td><?php echo $c->strContratoAutorizacao; ?></td>
                            <td><?php echo $cliCnpj->strClienteCNPJ; ?></td>
                            <td><?php echo $aCnpj->strAgenciaCNPJ; ?></td>
                            <td><?php echo $c->strProjetoNome; ?></td>
                            <td><?php echo $this->showCode($c->intAdmID, 'V'); ?></td>
                            <td><?php echo $c->strContratoValor; ?></td>
                            <td><?php echo $this->mostraData($c->strContratoData); ?></td>
                            <td><a href="<?php echo URL; ?>home/contratoform/<?php echo $c->intContratoID; ?>" title="Editar Contrato">Editar</a></td>
                            <td><a href="<?php echo URL; ?>home/vercontrato/<?php echo $c->intContratoID; ?>" title="Ver Contrato">Visualizar</a></td>
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
