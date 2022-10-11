<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fornecedores
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
                <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo URL; ?>home/fornecedorform'">
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
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Fornecedores Reprovados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Fornecedor</th>
                            <th>Motivo</th>
                            <th>Data Reprovação</th>
                            <th>Responsável reprovador</th>
                            <th>Visualizar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fornecedor as $f) : ?>
                            <tr>
                                <td><?php echo $f->strFornecedorFantasia; ?></td>
                                <td><?php echo $f->strReproveReason; ?></td>
                                <td><?php echo $f->strReproveDateCad; ?></td>
                                <td><?php echo $f->strReproveAdm; ?></td>
                                <td><a href="<?php echo URL; ?>home/fornecedor/<?php echo $f->intFornecedorID; ?>?aprovar" title="Visualizar Fornecedor">Visualizar</a></td>
                                <td><a href="<?php echo URL; ?>home/fornecedorform/<?php echo $f->intFornecedorID; ?>?aprovar" title="Editar Fornecedor">Editar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->



        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Funcionários Reprovados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Funcionario</th>
                            <th>Motivo</th>
                            <th>Data Reprovação</th>
                            <th>Responsável reprovador</th>
                            <th>Visualizar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($funcionario as $f) :

                            //$nome = $this->funcionariosModel->getFuncionarioByID($f->intFuncionarioID);
                            // echo "<pre>";
                            //var_dump($nome);
                            // echo "</pre>"

                        ?>
                            <tr>
                                <td><?php echo $f->strFuncionarioNome; ?></td>
                                <td><?php echo $f->strReproveReason; ?></td>
                                <td><?php echo $f->strReproveDateCad; ?></td>
                                <td><?php echo $f->strReproveAdm; ?></td>
                                <td><a href="<?php echo URL; ?>home/verfuncionario/<?php echo $f->intFuncionarioID; ?>?aprovar=true" title="Visualizar Funcionario">Visualizar</a></td>
                                <td><a href="<?php echo URL; ?>home/editarfuncionario/<?php echo $f->intFuncionarioID; ?>?aprovar=true" title="Editar Funcionario">Editar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


            

            <?php foreach ($clientes as $c) :
                        $nome = $this->admModel->getAdmNameByID($c->intUserAdmID);
                        var_dump($nome);
                    ?>
                    <?php endforeach; ?>






    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->