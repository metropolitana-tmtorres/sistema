<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Holerite - Modelo
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

      <div class="row">
          <div class="col-md-6 col-xs-12">
              <div class="box">
                  <!-- /.box-header -->
                  <div class="box-header">
                      <h3 class="box-title">Dedução do INSS</h3>
                  </div>
                  <div class="box-body">
                      <table class="table table-striped">
                          <tbody>
                          <tr>
                              <th>ID</th>
                              <th>Base do Cálculo (R$)</th>
                              <th>Alíquota</th>
                              <th>Dedução INSS</th>
                              <th>Parcela a deduzir do INSS (R$)</th>
                          </tr>
                          <tr>
                              <td>AL01</td>
                              <td>Até R$ 0,00</td>
                              <td>0,00%</td>
                              <td>0,00%</td>
                              <td>R$ 0,00</td>

                          </tr>
                          <tr>
                              <td>AL02</td>
                              <td>De R$ 0,01 a R$ 1.212,00</td>
                              <td>7,5%</td>
                              <td>0,00%</td>
                              <td>R$ 0,00</td>

                          </tr>
                          <tr>
                              <td>AL03</td>
                              <td>De R$ 1.212,00 a R$ 2.427,35</td>
                              <td>9%</td>
                              <td>1,5%</td>
                              <td>R$ 18,18</td>

                          </tr>
                          <tr>
                              <td>AL04</td>
                              <td>De R$ 2.427,35 a R$ 3.641,03</td>
                              <td>12%</td>
                              <td>3%</td>
                              <td>R$ 91,00</td>

                          </tr>
                          <tr>
                              <td>AL05</td>
                              <td>De R$ 3.641,03 a R$ 7.087,22</td>
                              <td>14%</td>
                              <td>2%</td>
                              <td>R$ 163,82</td>

                          </tr>
                          <tr>
                              <td>AL06</td>
                              <td>Acima de R$ 7.087,23</td>
                              <td>-</td>
                              <td>-</td>
                              <td>R$ 828,39</td>

                          </tr>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.box-body -->
              </div>
          </div>

          <div class="col-md-6 col-xs-12">
              <div class="box">
                  <!-- /.box-header -->
                  <div class="box-header">
                      <h3 class="box-title">Dedução do Imposto de Renda</h3>
                  </div>
                  <div class="box-body">
                      <table class="table table-striped">
                          <tbody>
                          <tr>
                              <th>ID</th>
                              <th>Base do Cálculo (R$)</th>
                              <th>Alíquota</th>
                              <th>Parcela a deduzir do IRPF (R$)</th>
                          </tr>
                          <tr>
                              <td>AL01</td>
                              <td>Até R$ 1.903,98</td>
                              <td>-</td>
                              <td>-</td>

                          </tr>
                          <tr>
                              <td>AL02</td>
                              <td>De R$ 1.903,99 a R$ 2.826,65</td>
                              <td>7,5%</td>
                              <td>R$ 142,80</td>

                          </tr>
                          <tr>
                              <td>AL03</td>
                              <td>De R$ 2.826,66 a R$ 3.751,05</td>
                              <td>15%</td>
                              <td>R$ 354,80</td>

                          </tr>
                          <tr>
                              <td>AL04</td>
                              <td>De R$ 3.751,06 a R$ 4.664,68</td>
                              <td>22,5%</td>
                              <td>R$ 636,13</td>

                          </tr>
                          <tr>
                              <td>AL05</td>
                              <td>Acima de R$ 4.664,69</td>
                              <td>27,5%</td>
                              <td>R$ 869,36</td>

                          </tr>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.box-body -->
              </div>
          </div>
      </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

