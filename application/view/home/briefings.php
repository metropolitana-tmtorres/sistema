

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Briefings
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
            <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-plus"></i> Cadastrar
            </button> -->
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
            <h3 class="box-title">Briefings no Sistema</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Executivo de Vendas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($briefings as $b) : ?>
                        <tr>
                            <td><?php echo $this->showCode($b->intBriefingID, 'B'); ?></td>
                            <td><?php echo $b->strCrmFantasia; ?></td>
                            <td><?php echo $b->strAdmNome; ?></td>
                            <td><a href="<?php echo URL; ?>home/briefings/<?php echo $b->intCrmID; ?>/<?php echo $b->intBriefingID; ?>">Ver Briefing</a></td>
                            <td><a href="<?php echo URL; ?>home/intervencoes/<?php echo $b->intCrmID; ?>">Ver CRM</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Executivo de Vendas</th>
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
    <form action="<?php echo URL; ?>home/addagencia" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de Agências</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nome da Agência</label>
                        <input type="text" required name="nome" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Contato</label>
                        <input type="text" required name="contato" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="mail" required name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Telefone</label>
                        <input type="text" required name="telefone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">CNPJ</label>
                        <input type="text" required name="cnpj" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
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