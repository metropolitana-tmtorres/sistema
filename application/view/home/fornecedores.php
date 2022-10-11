<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Fornecedores</h1>
        <ol class="breadcrumb">
            <li>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
                <button type="button" class="btn-sm btn-register btn-flat" onclick="window.location.href='<?php echo URL; ?>home/fornecedorform'">
                    <i class="fa fa-edit"></i> Cadastrar
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
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Nome Fantasia</th>
                            <th>Contato</th>
                            <th>E-Mail</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fornecedor as $f) :


                            //$nome = $this->fornecedorModel->getExportDados($f->intFornecedorID); 
                            //echo '<pre>', var_dump($nome); echo '</pre>';

                        ?>
                            <tr>
                                <td><?php echo $f->strFornecedorFantasia; ?></td>
                                <td><?php echo $f->strFornecedorContato; ?></td>
                                <td><?php echo $f->strFornecedorEmail; ?></td>
                                <td><?php echo $f->strFornecedorTelefone; ?></td>
                                <td>
                                    <a class="btn-sm btn-info btn-flat" href="<?php echo URL; ?>home/fornecedor/<?php echo $f->intFornecedorID; ?>" title="Visualizar Fornecedor"><i class="fa fa-eye"></i> Visualizar</a>
                                    <a class="btn-sm bg-orange btn-flat" href="<?php echo URL; ?>home/fornecedorform/<?php echo $f->intFornecedorID; ?>" title="Editar Fornecedor"><i class="fa fa-edit"></i> Editar</a>
                                </td>
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