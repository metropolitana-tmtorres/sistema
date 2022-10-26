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
              <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>"; ?>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
               <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
        <?php elseif (isset($_GET['approved']) && $_GET['approved'] == 'true') : ?>
            <div class="alert alert-success">Solicitação aprovada com sucesso!</div>
        <?php elseif (isset($_GET['approved']) && $_GET['approved'] == 'error') : ?>
            <div class="alert alert-danger">Hove um erro ao aprovar a solicitação</div>
        <?php elseif (isset($_GET['add']) && $_GET['add'] == 'true') : ?>
            <div class="alert alert-danger">Por favor, cadastre o cliente <?= $_GET['client']; ?> utilizando o botão "Cadastrar" ao lado.</div>
        <?php endif; ?>



        <?php if (in_array('aprovarContas', $access)) : ?>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Contas para Aprovar</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="contas" class="table table-bordered table-striped smarttable2">
                        <thead>
                            <tr>
                                <th>Conta</th>
                                <th>Cliente</th>
                                <th>Solicitante</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($contas as $co) :
                                // $nome = $this->admModel->getAdmNameByID($c->intUserAdmID); 
                                // var_dump($nome);
                            ?>
                                <tr>
                                    <td><?= $co->strContaNome; ?></a></td>
                                    <td><?= $co->strClienteFantasia; ?></a></td>
                                    <td><?= $co->strAdmNome; ?></td>
                                    <td><a class="btn-sm bg-orange btn-flat" href="<?= URL; ?>home/editarconta/<?= $co->intContaID; ?>" title="Editar Conta"><i class="fa fa-edit"></i> Editar</a></td>
                                    <td><a class="btn-sm btn-success btn-flat" href="<?= URL; ?>home/approveConta/<?= $co->intContaID; ?>" title="Aprovar Conta"><i class="fa fa-check"></i> Aprovar</a></td>
                                    <td><a class="btn-sm btn-danger btn-flat" href="#" data-toggle="modal" data-target="#modal-<?= $co->intContaID; ?>" title="Reprovar Fornecedor"><i class="fa fa-close"></i> Reprovar</a></td>
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



<?php foreach ($contas as $co) : ?>
    <div class="modal modal-info fade" id="modal-<?= $co->intContaID; ?>">
        <form action="<?= URL; ?>home/reproveAccount" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Reprovar Conta</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Cliente</label>
                            <input type="text" readonly class="form-control" name="fantasia" value="<?= $co->strContaNome; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Motivo de Reprovação</label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $co->intContaID; ?>">
                        <input type="hidden" name="adm" value="<?= $adm->strAdmNome; ?>">
                        <input type="hidden" name="solicitante" value="<?= $co->strAdmNome; ?>">
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
