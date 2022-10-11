

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Propostas
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
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
        <div class="alert alert-danger">Houve um erro ao salvar os dados</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Propostas Geradas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Código de Orçamento</th>
                        <th>Cliente</th>
                        <th>CRM</th>
                        <th>Código do Briefing</th>
                        <th>Data Solicitada</th>
                        <th>Data Envio</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($propostas as $p) :
                        $c = $this->getClienteByID($p->intPoID);
                        $crm = $this->getCrmByID($p->intPoID);
                        $status = $this->getStatusByID($p->intPoID);
                        $briefingId = $this->getBriefingIdByID($p->intPoID)
                    ?>
                        <tr>
                            <td><?php echo $this->showCode($p->intPoID, 'PO'); ?></a></td>
                            <td><?php echo $c->strClienteFantasia; ?></td>
                            <td><?php echo $crm->strCrmFantasia; ?></td>
                            <td><?php echo $this->showCode($briefingId->intBriefingID, 'B'); ?></td>
                            <td><?php echo $this->mostraData($p->strPropostaDataSolicitada); ?></td>
                            <td><?php echo $this->mostraData($p->strPropostaDataEnvio); ?></td>
                            <td><?php echo $this->mostraStatus($status->strPoStatus); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código de Orçamento</th>
                        <th>Cliente</th>
                        <th>CRM</th>
                        <th>Código do Briefing</th>
                        <th>Data Solicitada</th>
                        <th>Data Envio</th>
                        <th>Status</th>
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
