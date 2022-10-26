

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuários
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
            <button type="button" class="btn-sm btn-register btn-flat" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-edit"></i> Cadastrar
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
        <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>";?>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
        <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados!') }); </script>"; ?>
    <?php endif; ?>
    <div class="box box-success">
        <div class="box-body">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-Mail</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($usrs as $u) : ?>
                    <tr>
                        <td><?php echo $u->strAdmNome; ?></td>
                        <td><?php echo $u->strAdmMail; ?></td>
                        <td><?php echo $u->strDepartamentoNome; ?></td>
                        <td><?php echo $u->strCargoNome; ?></td>
                        <td>
                            <a class="btn-sm bg-orange btn-flat" href="#" data-toggle="modal" data-target="#modal-<?php echo $u->intAdmID; ?>"><i class="fa fa-edit"></i> Editar</a>
                        <a class="btn-sm btn-cancel btn-flat" href="<?php echo URL; ?>home/excluiradm/<?php echo $u->intAdmID; ?>"><i class="fa fa-close"></i> Excluir</a>
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

<?php 
    foreach($usrs as $u) :
        $cargos = $this->admModel->getAllRolesByDeptoID($u->intDepartamentoID);
?>

    <div class="modal modal-info fade" id="modal-<?php echo $u->intAdmID; ?>">
    <form action="<?php echo URL; ?>home/editAdm" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar de Usuário <?php echo $u->strAdmNome; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" required name="name" class="form-control" value="<?php echo $u->strAdmNome ;?>">
                    </div>
                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="mail" required name="mail" class="form-control" value="<?php echo $u->strAdmMail ;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Senha</label>
                        <input type="password" name="pass" class="form-control" placeholder="Preencha apenas se quiser mudar a senha do usuário.">
                    </div>
                    <div class="form-group">
                        <label for="depto">Departamento</label>
                        <select name="depto" class="form-control depto" onchange="getCargoList(this.value)">
                            <option value="" selected>Selecione o Departamento</option>
                            <?php foreach($deptos as $d) : ?>
                                <option <?php if($u->intDepartamentoID == $d->intDepartamentoID) { echo "selected"; } ?> value="<?php echo $d->intDepartamentoID; ?>"><?php echo $d->strDepartamentoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group listcargos">
                        <label for="">Cargo</label>
                        <select name="cargo" required class="form-control">
                            <?php foreach($cargos as $c) : ?>
                                <option <?php if($u->intCargoID == $c->intCargoID) { echo "selected"; } ?> value="<?php echo $c->intCargoID; ?>"><?php echo $c->strCargoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $u->intAdmID; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Editar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->
<?php endforeach; ?>

