

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $codeShow; ?> - <?php echo $conta->strContaNome; ?> - Briefings
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <a href="<?php echo URL; ?>home/createbriefing/<?php echo $crm->intCrmID; ?>" class="btn btn-danger btn-red">
                <i class="fa fa-edit"></i> Criar Novo Briefing
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
            <h3 class="box-title">Briefings do CRM</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Usuário</th>
                        <th>Data de Criação</th>
                        <th>Ver / Editar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($briefings as $b) : ?>
                    <tr>
                        <td><?php echo $this->showCode($b->intBriefingID, 'B'); ?></td>
                        <td><?php echo $this->admModel->getAdmNameByID($b->intAdmID); ?></td>
                        <td><?php echo $this->convertTimestamp($b->strBriefingDateCad); ?></td>
                        <td><a href="<?php echo URL; ?>home/createbriefing/<?php echo $id; ?>/<?php echo $b->intBriefingID; ?>">Ver / Editar</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Usuário</th>
                        <th>Data de Criação</th>
                        <th>Ver / Editar</th>
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
    <form action="<?php echo URL; ?>home/registerAdm" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de Usuários</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" required name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="mail" required name="mail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Senha</label>
                        <input type="password" required name="pass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="depto">Departamento</label>
                        <select name="depto" id="depto" class="form-control">
                            <option value="" selected>Selecione o Departamento</option>
                            <?php foreach($deptos as $d) : ?>
                                <option value="<?php echo $d->intDepartamentoID; ?>"><?php echo $d->strDepartamentoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="listcargos" class="form-group">
                        <label for="">Cargo</label>
                        <select name="cargo" id="" class="form-control">
                            <option value="false">Selecione o Departamento</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
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