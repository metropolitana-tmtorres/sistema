<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fornecedores - Reprovados
            <!-- <small>Optional description</small> -->
        </h1>
        <!--ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.location.href='<?php echo URL; ?>home/fornecedorform'">
                <i class="fa fa-edit"></i> Cadastrar
            </button>
        </li>
      </ol-->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <BR>
        <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
              <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>"; ?>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
               <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
        <?php endif; ?>
        <div class="box box-danger">
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
                            <!--th>Responsável reprovador</th-->
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fornecedor as $f) : ?>
                            <tr>
                                <td><?php echo $f->strFornecedorFantasia; ?></td>
                                <td><?php echo substr($f->strReproveReason,0,50).'....'; ?></td>
                                <!--td><?php echo $f->strReproveDateCad; ?></td-->
                                <td><?php echo $f->strReproveAdm; ?></td>
                                <td>
                                    <a class="btn-sm btn-info btn-flat" href="<?php echo URL; ?>home/fornecedor/<?php echo $f->intFornecedorID; ?>?aprovar" title="Visualizar Fornecedor"><i class="fa fa-eye"></i> Visualizar</a>
                                    <a class="btn-sm bg-orange btn-flat" href="<?php echo URL; ?>home/fornecedorform/<?php echo $f->intFornecedorID; ?>?aprovar" title="Editar Fornecedor"><i class="fa fa-edit"></i> Editar</a>
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