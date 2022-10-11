

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
            <button type="button" class="btn btn-info" onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php else: ?>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php endif; ?>
            <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo URL; ?>home/agenciaform'">
                <i class="fa fa-plus"></i> Cadastrar
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
        <div class="alert alert-success">Dados salvos com sucesso</div>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
        <div class="alert alert-danger">Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Agências Cadastradas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable">
                <thead>
                    <tr>
                        <th>Nome Fantasia</th>
                        <th>Contato</th>
                        <th>E-Mail</th>
                        <th>Telefone</th>
                        <th>CNPJ</th>
                        <th>Editar</th>
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
                            <td><a href="<?php echo URL; ?>home/agenciaform/<?php echo $a->intAgenciaID; ?>" title="Editar Cliente">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nome Fantasia</th>
                        <th>Contato</th>
                        <th>E-Mail</th>
                        <th>Telefone</th>
                        <th>CNPJ</th>
                        <th>Editar</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
