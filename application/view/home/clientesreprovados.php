<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clientes - Reprovados
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <button type="button" class="btn bg-orange btn-flat margin" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
                <button type="button" class="btn bg-olive btn-flat" onclick="window.location.href='<?php echo URL; ?>home/fornecedorform'">
                    <i class="fa fa-plus"></i> Cadastrar
                </button>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <BR>
        <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
            <div class="alert alert-success">Dados salvos com sucesso</div>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <div class="alert alert-danger">Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.</div>
        <?php endif; ?>
        <div class="box box-danger">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="myTable" class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>CNPJ</th>
                            <th>Nome Fantasia</th>
                            <th>Contato</th>
                            <th>E-Mail</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c) : ?>

                            <tr>
                                <td><?php echo $c->strClienteCNPJ; ?></a></td>
                                <td><?php echo $c->strClienteFantasia; ?></a></td>
                                <td><?php echo $c->strClienteContato; ?></td>
                                <td><?php echo $c->strClienteEmail; ?></td>
                                <td><?php echo $c->strClienteTelefone; ?></td>
                                <td><?php echo $c->strClienteCelular; ?></td>
                                <td>
                                    <a class="btn-sm btn-info btn-flat" href="<?php echo URL; ?>home/vercliente/<?php echo $c->intClienteID; ?>" title="Visualizar Cliente"><i class="fa fa-eye"></i> Visualizar</a>
                                    <a class="btn-sm bg-orange btn-flat" href="<?php echo URL; ?>home/clienteform/<?php echo $c->intClienteID; ?>" title="Editar Cliente"><i class="fa fa-edit"></i> Editar</a>
                                </td>

                                </td>
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

