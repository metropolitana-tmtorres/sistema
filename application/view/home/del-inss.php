

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Deletar agência
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn-sm btn-goBack btn-flat" data-toggle="modal" data-target="#modal-info">
                <i class="fa fa-edit"></i> Cadastrar
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
            <p>Tem certeza de que deseja excluir <strong><?php echo  $a->strAgenciaNome;?></strong>, todos os dados e informações serão excluidos do banco de dados?</p>
            <a href="<?php echo URL; ?>home/excagencia/<?php echo $usrID; ?>" class="btn btn-danger btn-lg pull-right">Sim, excluir</a> 
            <a href="<?php echo URL; ?>home/agencias" class="btn btn-primary btn-lg pull-right">Não, voltar</a>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->