

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calendário
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">

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
                <h3 class="box-title">Calendário</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="calendario">
                    <?php $this->montaCalendario(); ?>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

