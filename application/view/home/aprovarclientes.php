<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Aprovações do Sistema
            <!-- <small>Optional description</small> -->
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <BR>
        <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
            <div class="alert alert-success">Dados salvos com sucesso</div>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <div class="alert alert-danger">Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.</div>
        <?php elseif (isset($_GET['approved']) && $_GET['approved'] == 'true') : ?>
            <div class="alert alert-success">Solicitação aprovada com sucesso!</div>
        <?php elseif (isset($_GET['approved']) && $_GET['approved'] == 'error') : ?>
            <div class="alert alert-danger">Hove um erro ao aprovar a solicitação</div>
        <?php elseif (isset($_GET['add']) && $_GET['add'] == 'true') : ?>
            <div class="alert alert-danger">Por favor, cadastre o cliente <?= $_GET['client']; ?> utilizando o botão "Cadastrar" ao lado.</div>
        <?php endif; ?>


        <?php if (in_array('aprovarClientes', $access)) : ?>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Clientes para Aprovar</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped smarttable2">
                        <thead>
                            <tr>
                                <th>Nome Fantasia</th>
                                <th>Solicitante</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($clientes as $c) :
                                $nome = $this->admModel->getAdmNameByID($c->intUserAdmID);
                                var_dump($nome);
                            ?>
                                <tr>
                                    <td><?= $c->strClienteFantasia; ?></a></td>
                                    <td><?= $c->strAdmNome; ?></td>
                                    <td>
                                        <a class="btn-sm bg-orange btn-flat" href="<?= URL; ?>home/clienteform/<?= $c->intClienteID; ?>" title="Editar Cliente"><i class="fa fa-edit"></i> Editar</a>
                                        <a class="btn-sm btn-success btn-flat" href="<?= URL; ?>home/approveClient/<?= $c->intClienteID; ?>/<?= $c->intUserAdmID; ?>/<?= $c->strClienteFantasia; ?>" title="Aprovar Cliente"><i class="fa fa-check"></i> Aprovar</a>
                                        <a class="btn-sm btn-danger btn-flat" href="#" data-toggle="modal" data-target="#modal-<?= $c->intClienteID; ?>" title="Reprovar Cliente"><i class="fa fa-close"></i> Reprovar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        <?php endif; ?>

        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php foreach ($clientes as $c) : ?>
    <div class="modal modal-info fade" id="modal-<?= $c->intClienteID; ?>">
        <form action="<?= URL; ?>home/reproveClient" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Reprovar Cliente</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Cliente</label>
                            <input type="text" readonly class="form-control" name="fantasia" value="<?= $c->strClienteFantasia; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Motivo de Reprovação</label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $co->intContaID; ?>">
                        <input type="hidden" name="adm" value="<?= $adm->strAdmNome; ?>">
                        <input type="hidden" name="solicitante" value="<?= $c->strAdmNome; ?>">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-outline">Reprovar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>

    </div>
    <!-- /.modal -->
<?php endforeach; ?>