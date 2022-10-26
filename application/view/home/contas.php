

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contas de Clientes
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <?php if(isset($_GET['salvo'])) : ?>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php else: ?>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php endif; ?>

            <button type="button" class="btn-sm btn-register btn-flat" onclick="window.location.href='<?php echo URL; ?>home/adicionarconta'">
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
    <?php elseif(isset($_GET['add']) && $_GET['add'] == 'true') : ?>
        <div class="alert alert-danger">Por favor, cadastre a conta <?php echo $_GET['client']; ?> utilizando o botão "Cadastrar" ao lado.</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Contas Cadastradas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Conta</th>
                        <th>Cliente</th>
                        <th>Agência</th>
                        <th>Segmento</th>
                        <th>Editar</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contas as $c) : ?>
                        <tr>
                            <td><?php echo $c->strContaNome; ?></a></td>
                            <td><a href="<?php echo URL; ?>home/vercliente/<?php echo $c->intClienteID; ?>" title="Ver Cliente"><?php echo $c->strClienteFantasia; ?></a></td>
                            <td><?php if($c->intAgenciaID == '0'){ echo "Cliente Direto"; } else { echo $c->strAgenciaNome; } ?></td>
                            <td><?php echo $c->strSegmentoNome; ?></td>
                            <td><a href="<?php echo URL; ?>home/editarconta/<?php echo $c->intContaID; ?>" title="Editar Conta">Editar</a></td>
                            <td><a href="<?php echo URL; ?>home/verconta/<?php echo $c->intContaID; ?>" title="Visualizar Conta">Visualizar</a></td>
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

 