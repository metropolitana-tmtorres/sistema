

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cargos
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-plus"></i> Cadastrar
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Ação Necessária</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <p>Este cargo possui usuários, antes de excluí-lo é necessário mudar o cargo destes usuários. Selecione abaixo para qual cargo deseja mover estes usuários:</p>
            <form action="<?php echo URL; ?>home/changeanddeleteusersjobrole" method="post">
                <div class="form-group">
                    <label for="">Selecione o novo cargo:</label>
                    <select name="new" id="" class="form-control">
                        <?php 
                            foreach($cargos as $c) :
                                if($cargoID != $c->intCargoID) :
                        ?>
                            <option value="<?php echo $c->intCargoID; ?>"><?php echo $c->strCargoNome; ?></option>
                        <?php 
                                endif;
                            endforeach;
                        ?>
                    </select>
                </div>
                <input type="hidden" name="old" value="<?php echo $cargoID; ?>">
                <button class="btn btn-primary btn-lg">Mudar Cargo</button>
                <a href="<?php echo URL; ?>home/cargos" class="btn btn-danger btn-lg pull-right">Cancelar</a>
            </form>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->