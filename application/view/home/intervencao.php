

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $codeShow; ?> - <?= $crm->strClienteFantasia; ?> - <?= $crm->strContaNome; ?>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-plus"></i> Cadastrar Intervenção
            </button>
            <?php //if(isset($b)) : ?>
                <a href="<?= URL; ?>home/getBriefingsByCrmID/<?= $crm->intCrmID; ?>" class="btn btn-danger btn-red">
                    <i class="fa fa-edit"></i> Ver Briefings
                </a>
            <?php //else: ?>
                <a href="<?= URL; ?>home/createbriefing/<?= $crm->intCrmID; ?>" class="btn btn-danger btn-red">
                    <i class="fa fa-edit"></i> Criar Novo Briefing
                </a>
            <?php //endif; ?>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
        <div class="alert alert-success">Dados salvos com sucesso</div>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
        <div class="alert alert-danger">Houve um erro ao salvar os dados</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Intervenções</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Histórico</th>
                        <th>Data - Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($int as $i) : ?>
                        <tr>
                            <td><?= $i->strIntervencaoHistorico; ?></td>
                            <td><?= $this->convertTimestamp($i->strIntervencaoData); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Histórico</th>
                        <th>Data - Hora</th>
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

  <div class="modal modal-info fade" id="modal-info">
    <form action="<?= URL; ?>home/cadastraintervencao" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CRM - Cadastro de Intervenção</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Histórico</label>
                        <textarea class="form-control" required name="historico" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="crmid" value="<?= $crm->intCrmID; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Cadastrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

</div>
<!-- /.modal -->