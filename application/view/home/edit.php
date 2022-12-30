<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Holerite
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
                  <!-- /.box-header -->
                  <div class="box-header">
                      <h3 class="box-title">Dedução do INSS</h3>

                  </div>
                  <div class="box-body">





                  </div>
                  <!-- /.box-body -->




  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

