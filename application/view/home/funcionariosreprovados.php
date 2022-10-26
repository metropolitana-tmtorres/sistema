<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Colaboradores - Reprovados
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
            <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>";?>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados!') }); </script>"; ?>
        <?php endif; ?>

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Funcionários Reprovados</h3>
            </div>

            <div class="box-body">
                <table id="example" class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Funcionario</th>
                            <th>Motivo</th>
                            <th>Data Reprovação</th>
                            <th>Responsável reprovador</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($funcionario as $f) :
                            
                            //$nome = $this->funcionarioModel->getFuncionarioByID($f->intFuncionarioID); 
                            //echo "<pre>", var_dump ($nome), "</pre>";

                            ?>
                            <tr>
                                <td><?php echo $f->strFuncionarioNome; ?></td>
                                <td><?php echo substr($f->strReproveReason, 0, 25).'...'; ?></td>
                                <td><?php echo $f->strReproveDateCad; ?></td>
                                <td><?php echo $f->strReproveAdm; ?></td>
                                <td>
                                    <a class="btn-sm btn-info btn-flat" href="<?php echo URL; ?>home/verfuncionario/<?php echo $f->intFuncionarioID; ?>?aprovar=true" title="Visualizar Funcionario"><i class="fa fa-eye"></i> Visualizar</a>
                                    <a class="btn-sm bg-orange btn-flat" href="<?php echo URL; ?>home/editarfuncionario/<?php echo $f->intFuncionarioID; ?>?aprovar=true" title="Editar Funcionario"><i class="fa fa-edit"></i> Editar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>    
$('#example').dataTable( {
  "columns": [
    null,
    { "width": "20%" },
    null,
    null,
    null
  ]
} );
</script>