<!-- Content Wrapper. Contains page content -->
<?php
if (isset($obj)) {
    $url = "editinss";
} else {
    $url = "adddeducaoinss";
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
          <?php if (isset($obj)) {
              echo 'Editar - Dedução do INSS';
          } else {
              echo 'Cadastrar - Dedução do INSS';
          } ?>
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


              <div class="box">

                  <form action="<?php echo URL; ?>home/<?php echo $url ?>" method="POST">
                      <div class="box-body">
                          <div class="content">
                              <fieldset>
                                  <legend>INSS</legend>
                                  <div class="row">
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Cod.Dedução INSS</label>
                                              <input <?php if (isset($deducaoInss)) {echo "value='$deducaoInss->cod_deducao_inss'";} ?>  required name="cod_deducao_inss" id="cod_deducao_inss" class="form-control">


                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Base de Cálculo de (R$)</label>
                                              <input value="<?php if (isset($deducaoInss)) {
                                                  echo $deducaoInss->base_calculo_de;
                                              } ?>" type="text" required name="base_calculo_de" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Base de Cálculo até (R$)</label>
                                              <input value="<?php if (isset($obj->base_calculo_ate)) {
                                                  echo $obj->base_calculo_ate;
                                              } ?>" type="text" required name="base_calculo_ate" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Alíquota</label>
                                              <input value="<?php if (isset($obj->aliquota)) {
                                                  echo $obj->aliquota;
                                              } ?>" type="text" required name="aliquota" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Dedução INSS</label>
                                              <input value="<?php if (isset($obj->deducao_inss)) {
                                                  echo $obj->deducao_inss;
                                              } ?>" type="text" required name="deducao_inss" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Parcela a deduzir do INSS (R$)</label>
                                              <input value="<?php if (isset($obj->valor_deducao_inss)) {
                                                  echo $obj->valor_deducao_inss;
                                              } ?>" type="text" required name="valor_deducao_inss" class="form-control">
                                          </div>
                                      </div>
                                  </div>
                              </fieldset>
                          </div>





                          <div class="row">
                              <div class="col-md-12 col-xs-12 text-center">
                                  <?php if (isset($teste)) : ?>
                                      <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                                      <button type="submit" class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> Editar</button>
                                  <?php else : ?>
                                      <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                                      <button type="submit" class="btn btn-register btn-flat"><i class="fa fa-check"></i> Cadastrar</button>
                                  <?php endif; ?>

                              </div>
                          </div>


                      </div>
                  </form>



</div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

