

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicionar Cargos ao Departamento <?php echo $depto->strDepartamentoNome; ?>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
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
        <div class="alert alert-danger">Houve um erro ao salvar os dados</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Cargos Disponíveis</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <p>Selecione os cargos desejados abaixo:</p>
            <form action="<?php echo URL; ?>home/registerpermission" method="post">
                <div id="cargo-result" class="row">
                    <div class="col-md-6 col-xs-12">
                        <?php 
                            foreach($cargos as $c) : 
                                if($c->intCargoID != 1) :
                        ?>
                                    <div class="checkbox">
                                        <label>
                                            <input name="p[]" value="<?php echo $c->intCargoID; ?>" type="checkbox"> <?php echo $c->strCargoNome; ?>
                                        </label>
                                    </div>
                        <?php 
                                endif;
                            endforeach;
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-xs-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Salvar Cargos</button>
                        <button type='button' class="btn btn-danger btn-lg">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal modal-info fade" id="modal-info">
    <form action="<?php echo URL; ?>home/cadastracargo" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cadastro de Usuários</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Cargo</label>
                        <input type="text" required name="cargo" class="form-control">
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