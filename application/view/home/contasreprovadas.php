<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="text-danger">
           Contas Reprovadas
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



        <?php if (in_array('aprovarContas', $access)) : ?>
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Contas para Aprovar</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="contas" class="table table-bordered table-striped smarttable2">
                        <thead>
                            <tr>
                                <th>Conta</th>
                                <th>Motivo</th>
                                <th>Responsável reprovador</th>
                                <th>Data da Reprovação</th>
                                <th>Visualizar</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($contas as $co) :
                              //  $nome = $this->clientesModel->getReprovedAccount($co->intClienteID); 
                              //  echo '<pre>', var_dump($nome); echo '</pre>';
                            ?>
                                <tr>
                                    <td><?= $co->strContaNome; ?></a></td>
                                    <td><?= $co->strReproveReason; ?></a></td>
                                    <td><?= $co->strReproveAdm; ?></a></td>
                                    <td><?= $co->strReproveDateCad; ?></a></td>
                                    <td><a href="<?php echo URL; ?>home/vercliente/<?php echo $co->intClienteID; ?>" title="Ver Cliente">Ver Conta</a></td>
                                    <td><a href="<?= URL; ?>home/editarconta/<?= $co->intContaID; ?>" title="Editar Conta">Editar</a></td>
                                    <!--td><a href="<?= URL; ?>home/approveConta/<?= $co->intContaID; ?>" title="Aprovar Conta">Aprovar</a></td>
                                    <td><a href="#" data-toggle="modal" data-target="#modal-<?= $co->intContaID; ?>" title="Reprovar Fornecedor">Reprovar</a></td-->
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

