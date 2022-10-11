<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Permissões
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li>
        <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
          <i class="fa fa-arrow-left"></i> Voltar
        </button>

      </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <BR>

    <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
      <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>";?>
      <!--div class="alert alert-success">Dados salvos com sucesso</div-->
    <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
      <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados!') }); </script>"; ?>
    <?php endif; ?>

    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title">Selecionar Permissões</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="<?php echo URL; ?>home/registerpermission" method="post">
          <div class="form-group">
            <select name="cargo" id="cargo" class="form-control">
              <option value="0">Selecione o Cargo</option>
              <?php foreach ($cargos as $c) : ?>
                <option value="<?php echo $c->intCargoID; ?>"><?php echo $c->strCargoNome; ?> (<?php echo $c->strDepartamentoNome; ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div id="cargo-result" class="row">
          </div><br><br>
          <div class="form-group">
            <div class="col-md-12 col-xs-12 text-center">
              <button type="submit" class="btn btn-register btn-flat"><i class="fa fa-check"></i> Salvar</button>
              <button type='button' class="btn btn-cancel btn-flat"><i class="fa fa-close"></i> Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--div class="modal fade in" id="modal-success">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span></button>
<h4 class="modal-title">Sucesso.</h4>
</div>
<div class="modal-body">
<p>Dados salvos com sucesso</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
</div>
</div>

</div>

</div-->