

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clientes
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <?php if(isset($_GET['salvo'])) : ?>
                <button type="button" class="btn btn-info" onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php else: ?>
                <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php endif; ?>

            <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo URL; ?>home/clienteform'">
                <i class="fa fa-plus"></i> Cadastrar
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
        <div class="alert alert-danger">Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.</div>
    <?php elseif(isset($_GET['add']) && $_GET['add'] == 'true') : ?>
        <div class="alert alert-danger">Por favor, cadastre o cliente <?php echo $_GET['client']; ?> utilizando o botão "Cadastrar" ao lado.</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Seus Clientes</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable">
                <thead>
                    <tr>
                        <th>CNPJ</th>
                        <th>Nome Fantasia</th>
                        <th>Contato</th>
                        <th>E-Mail</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>Editar</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $c) : ?>
                        <tr>
                            <td><?php echo $c->strClienteCNPJ; ?></a></td>
                            <td><?php echo $c->strClienteFantasia; ?></a></td>
                            <td><?php echo $c->strClienteContato; ?></td>
                            <td><?php echo $c->strClienteEmail; ?></td>
                            <td><?php echo $c->strClienteTelefone; ?></td>
                            <td><?php echo $c->strClienteCelular; ?></td>
                            <td><a href="<?php echo URL; ?>home/clienteform/<?php echo $c->intClienteID; ?>" title="Editar Cliente">Editar</a></td>
                            <td><a href="<?php echo URL; ?>home/vercliente/<?php echo $c->intClienteID; ?>" title="Visualizar Cliente">Visualizar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <!--tfoot>
                    <tr>
                        <th>CNPJ</th>
                        <th>Nome Fantasia</th>
                        <th>Contato</th>
                        <th>E-Mail</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>Editar</th>
                        <th>Visualizar</th>
                    </tr>
                </tfoot-->
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 