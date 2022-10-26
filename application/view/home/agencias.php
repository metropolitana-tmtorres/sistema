

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Agências
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
        <?php if(isset($_GET['salvo'])) : ?>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php else: ?>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php endif; ?>
            <button type="button" class="btn-sm btn-register btn-flat" onclick="window.location.href='<?php echo URL; ?>home/agenciaform'">
                <i class="fa fa-edit"></i> Cadastrar
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
        <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>"; ?>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
        <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
    <?php endif; ?>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Nome Fantasia</th>
                        <th>Contato</th>
                        <th>E-Mail</th>
                        <th>Telefone</th>
                        <th>CNPJ</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($agencias as $a) : ?>
                        <tr>
                            <td><?php echo $a->strAgenciaNome; ?></td>
                            <td><?php echo $a->strAgenciaContato; ?></td>
                            <td><?php echo $a->strAgenciaEmail; ?></td>
                            <td><?php echo $a->strAgenciaTelefone; ?></td>
                            <td><?php echo $a->strAgenciaCNPJ; ?></td>
                            <td>
                                <a class="btn-sm bg-orange btn-flat" href="<?php echo URL; ?>home/agenciaform/<?php echo $a->intAgenciaID; ?>" title="Editar Cliente"><i class="fa fa-edit"></i> Editar</a>
                                <a class="btn-sm btn-cancel btn-flat" href="<?php echo URL; ?>home/excluiragencia/<?php echo $a->intAgenciaID; ?>"><i class="fa fa-close"></i> Excluir</a>
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
