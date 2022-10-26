

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detalhes
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <a href="<?php echo URL; ?>home/createbriefing/<?php echo $crm; ?>/<?php echo $brief; ?>" class="btn-sm btn-goBack btn-flat">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
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
        <div class="box-header">
            <h3 class="box-title">Calendário</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="calendario">
                <?php $this->montaCalendario($prod, $brief, $crm); ?>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo $p->strProdutoNome; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="<?php echo URL; ?>home/addBriefingDetail" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="date" name='date' required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" name='qtd' required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="prod" value="<?php echo $prod; ?>">
                        <input type="hidden" name="brief" value="<?php echo $brief; ?>">
                        <input type="hidden" name="crm" value="<?php echo $crm; ?>">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </div>
            </form>
            <div id="return">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Veiculações</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($dates as $d) : ?>
                    <tr>
                        <td><?php echo $this->mostraData($d->strBriefingProdutoData); ?></td>
                        <td><?php echo $d->intBriefingProdutoDataQtd; ?></td>
                        <td><a href="<?php echo URL; ?>home/excluirbriefingdetail/<?php echo $d->intBriefingProdutoDataID ?>/<?php echo $prod; ?>/<?php echo $brief; ?>/<?php echo $crm; ?>">Excluir</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Data</th>
                        <th>Veiculações</th>
                        <th>Excluir</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->