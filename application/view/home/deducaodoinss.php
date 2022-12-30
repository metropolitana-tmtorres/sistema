<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>Dedução do INSS</h1>
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
            <button type="button" class="btn-sm btn-register btn-flat" onclick="window.location.href='<?php echo URL; ?>home/deducaodoinssform'">
                <i class="fa fa-edit"></i> Cadastrar
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

                  <div class="box-body">


                      <table class="table table-striped">
                          <theady>
                              <tr>
                                  <th>ID</th>
                                  <th>Cod.Dedução INSS</th>
                                  <th>Base do Cálculo de (R$)</th>
                                  <th>Base do Cálculo até (R$)</th>
                                  <th>Alíquota</th>
                                  <th>Dedução INSS</th>
                                  <th>Parcela a deduzir do INSS (R$)</th>
                                  <th>Ações</th>
                              </tr>
                          </theady>
                          <tbody>

                          <?php foreach($deducaoInss as $deducaoInss) : ?>


                          <tr>
                              <td><?= $deducaoInss->id_inss; ?></td>
                              <td><?= $deducaoInss->cod_deducao_inss; ?></td>
                              <td><?= $deducaoInss->base_calculo_de; ?></td>
                              <td><?= $deducaoInss->base_calculo_ate; ?></td>
                              <td><?= $deducaoInss->aliquota; ?></td>
                              <td><?= $deducaoInss->deducao_inss; ?></td>
                              <td><?= $deducaoInss->valor_deducao_inss; ?></td>
                              <td>
                                  <a class="btn-sm btn-info btn-flat" href="#"><i class="fa fa-eye"></i> Visualizar</a>
                                  <a class="btn-sm bg-orange btn-flat" href="<?=URL; ?>home/editdeducaodoinss/<?=$deducaoInss->id_inss; ?>"><i class="fa fa-edit"></i> Editar</a>
                              </td>
                          </tr>
                          <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.box-body -->




  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

