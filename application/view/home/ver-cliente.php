

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clientes
        <!-- <small>Optional description</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn-sm btn-goBack btn-flat" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-edit"></i> Cadastrar
            </button>
        </li>
      </ol> -->
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
        <!-- <div class="box-header">
            <h3 class="box-title">Clientes Cadastrados</h3>
        </div> -->
        <!-- /.box-header -->
        <div class="box-body">
            <h3>Dados da Empresa</h3>
             <table class="table table-bordered table-striped smarttable2">
                <tbody>
                    <tr>
                        <td><strong>CNPJ:</strong></td>
                        <td><?php echo $c->strClienteCNPJ; ?></td>
                        <td><strong>Razão Social</strong></td>
                        <td><?php echo $c->strClienteFantasia; ?></td>
                        <td><strong>Nome Fantasia</strong></td>
                        <td><?php echo $c->strClienteFantasia; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Agência</strong></td>
                        <td colspan="1"><?php if($c->intAgenciaID == 0) : echo "Não Especifidado"; else: echo $agencia; endif; ?></td>
                        <td><strong>Segmento</strong></td>
                        <td colspan="1"><?php echo $segmento; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Endereço:</strong></td>
                        <td><?php echo $c->strClienteEndereco; ?></td>
                        <td><strong>Cidade / UF:</strong></td>
                        <td><?php echo $c->strClienteCidade . " / " . $c->strClienteEstado; ?></td>
                        <td><strong>CEP:</strong></td>
                        <td><?php echo $c->strClienteCep; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3>Dados do Responsável</h3>
             <table class="table table-bordered table-striped smarttable2">
                <tbody>
                    <tr>
                        <td><strong>Responsável</strong></td>
                        <td><?php echo $c->strClienteResponsavel; ?></td>
                        <td><strong>RG do Responsável</strong></td>
                        <td><?php echo $c->strClienteRg; ?></td>
                        <td><strong>CPF do Responsável</strong></td>
                        <td><?php echo $c->strClienteCpf; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3>Dados do Contato</h3>
             <table class="table table-bordered table-striped smarttable2">
                <tbody>
                    <tr>
                        <td><strong>Nome</strong></td>
                        <td><?php echo $c->strClienteContato; ?></td>
                        <td><strong>Cargo</strong></td>
                        <td><?php echo $c->strClienteContatoCargo; ?></td>
                        <td><strong>E-Mail</strong></td>
                        <td><?php echo $c->strClienteEmail; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Telefone</strong></td>
                        <td colspan="1"><?php echo $c->strClienteTelefone; ?></td>
                        <td><strong>Celular</strong></td>
                        <td colspan="1"><?php echo $c->strClienteCelular; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <a href="<?php echo URL; ?>home/clientes" class="btn btn-primary btn-lg">Voltar aos Clientes</a>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

