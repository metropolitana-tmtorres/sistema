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

                          <?php foreach($testeNomemclatura as $tn) : ?>


                          <tr>

                              <td><?= $tn->intTesteID; ?></td>
                              <td><?= $tn->strTesteNome; ?></td>
                              <td><?= $tn->intTesteStatus; ?></td>
                              <td>
                                  <a class="btn-sm btn-info btn-flat" href="<?php echo URL; ?>home/deducaodoinss/<?php echo $deducaoInss->intInssID; ?>" title="Visualizar Fornecedor"><i class="fa fa-eye"></i> Visualizar</a>
                                  <a class="btn-sm bg-orange btn-flat" href="<?=URL; ?>home/deducaodoinssform/<?php echo $deducaoInss->intInssID; ?>"><i class="fa fa-edit"></i> Editar</a>
                                  <a class="btn-sm btn-cancel btn-flat" href="<?php echo URL; ?>home/excluirinss/<?php echo $deducaoInss->intInssID; ?>"><i class="fa fa-close"></i> Excluir</a>
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

