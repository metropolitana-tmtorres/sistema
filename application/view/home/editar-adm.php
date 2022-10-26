

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Usuário <?php echo $usr->strAdmNome; ?>  
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <!-- <button type="button" class="btn-sm btn-goBack btn-flat" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-edit"></i> Cadastrar
            </button> -->
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Editar Dados</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="<?php echo URL; ?>home/editAdm" method="post">
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" required name="name" class="form-control" value="<?php echo $usr->strAdmNome; ?>">
                </div>
                <div class="form-group">
                    <label for="">E-Mail</label>
                    <input type="mail" required name="mail" class="form-control" value="<?php echo $usr->strAdmMail; ?>">
                </div>
                <div class="form-group">
                    <label for="depto">Departamento</label>
                    <select name="depto" id="depto" class="form-control">
                        <option value="" selected>Selecione o Departamento</option>
                        <?php foreach($deptos as $d) : ?>
                            <option <?php if($usr->intDepartamentoID == $d->intDepartamentoID) { echo "selected"; } ?> value="<?php echo $d->intDepartamentoID; ?>"><?php echo $d->strDepartamentoNome; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="listcargos" class="form-group">
                    <label for="">Cargo</label>
                    <select name="cargo" id="" class="form-control">
                        <option value="<?php echo $user->intCargoID; ?>"><?php echo $usr->strCargoNome; ?></option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $usr->intAdmID; ?>">
                <button type="submit" class="btn btn-primary btn-lg">Editar Dados</button>
                <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Cancelar</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->