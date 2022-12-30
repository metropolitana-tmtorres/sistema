
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>Cadastrar dedução Inss</h1>
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

                  <form method="POST" action="<?php echo URL; ?>home/addinss">
                      <div class="box-body">
                          <div class="content">
                              <fieldset>
                                  <legend>INSS</legend>
                                  <div class="row">
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Cod.Dedução INSS</label>
                                              <input type="text" name="cod_deducao_inss" class="form-control">


                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Base de Cálculo de (R$)</label>
                                              <input type="text" name="base_calculo_de" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Base de Cálculo até (R$)</label>
                                              <input type="text" name="base_calculo_ate" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Alíquota</label>
                                              <input type="text" name="aliquota" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Dedução INSS</label>
                                              <input type="text" name="deducao_inss" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Parcela a deduzir do INSS (R$)</label>
                                              <input type="text" name="valor_deducao_inss" class="form-control">
                                          </div>
                                      </div>
                                  </div>
                              </fieldset>
                          </div>





                          <div class="row">
                              <div class="col-md-12 col-xs-12 text-center">
                                  <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                                  <button type="submit" class="btn btn-register btn-flat"><i class="fa fa-check"></i> Cadastrar</button>
                              </div>
                          </div>


                      </div>
                  </form>



</div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

