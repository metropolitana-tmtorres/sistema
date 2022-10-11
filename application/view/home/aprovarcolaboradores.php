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
            <?php echo "<script> $(function () {toastr['success']('Dados salvos com sucesso!') }); </script>"; ?>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
        <?php elseif (isset($_GET['approved']) && $_GET['approved'] == 'true') : ?>
            <?php echo "<script> $(function () {toastr['success']('Dados salvos com sucesso!') }); </script>"; ?>
        <?php elseif (isset($_GET['approved']) && $_GET['approved'] == 'error') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve uum erro ao aprovar a solicitação.') }); </script>"; ?>
        <?php elseif (isset($_GET['add']) && $_GET['add'] == 'true') : ?>
            <div class="alert alert-danger">Por favor, cadastre o cliente <?= $_GET['client']; ?> utilizando o botão "Cadastrar" ao lado.</div>
        <?php endif; ?>


        <?php if (in_array('aprovarColaboradores', $access)) : ?>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Colaboradores para Aprovar</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="contas" class="table table-bordered table-striped smarttable2">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>Data de Pagamento</th>
                                <th>Data de Admissão</th>
                                <th>Ações</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($funcionarios as $f) : ?>
                                <tr>
                                    <td><a href="<?= URL; ?>home/editarfuncionario/<?= $f->intFuncionarioID; ?>?aprovar=true"><?= $f->strFuncionarioNome; ?></a></td>
                                    <td><?= $f->strCargoNome; ?></td>
                                    <td><?= $f->strFuncionarioDatePagamento; ?></td>
                                    <td><?= $this->mostraData($f->strFuncionarioDateAdmissao); ?></td>
                                    <td>
                                        <a class="btn-sm bg-orange btn-flat" href="<?= URL; ?>home/editarfuncionario/<?= $f->intFuncionarioID; ?>?aprovar=true"><i class="fa fa-edit"></i> Editar</a>
                                        <a class="btn-sm btn-success btn-flat" href="<?= URL; ?>home/approveFuncionario/<?= $f->intFuncionarioID; ?>" title="Aprovar Fornecedor"><i class="fa fa-check"></i> Aprovar</a>
                                        <a class="btn-sm btn-danger btn-flat" href="#" data-toggle="modal" data-target="#modalFuncionario-<?= $f->intFuncionarioID; ?>" title="Reprovar Funcionario"><i class="fa fa-close"></i> Reprovar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        <?php endif; ?>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php foreach ($funcionarios as $f) { ?>
    <div class="modal modal-info fade" id="modalFuncionario-<?= $f->intFuncionarioID; ?>">
        <form action="<?= URL; ?>home/reproveFuncionario" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Reprovar Funcionario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Funcionario</label>
                            <input type="text" readonly class="form-control" name="nome" value="<?= $f->strFuncionarioNome; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Motivo de Reprovação</label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $f->intFuncionarioID; ?>">
                        <input type="hidden" name="adm" value="<?= $adm->strAdmNome; ?>">
                        <input type="hidden" name="solicitante" value="<?= $adm->strAdmNome; ?>">
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
<?php } ?>