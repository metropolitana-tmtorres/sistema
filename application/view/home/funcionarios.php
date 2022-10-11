

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Colaboradores
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
        <?php if(isset($_GET['salvo'])) : ?>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.loption.href = '<?=URL; ?>/home/crm';">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php else: ?>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php endif; ?>
            <button type="button" class="btn-sm btn-register btn-flat" onclick="window.location.href='<?=URL; ?>home/cadastrarfuncionario'">
                <i class="fa fa-plus"></i> Cadastrar 
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
        <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>";?>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
        <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados!') }); </script>"; ?>
    <?php endif; ?>
    
    <?php if (in_array('aprovarColaboradores', $access)) : ?>
    <div class="box box-primary">
        <!--div class="box-header">
            <h3 class="box-title">Colaboradores no Sistema</h3>
        </div-->
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Data de Pagamento</th>
                        <th>Data de Admissão</th>
                        <th>Ações</th>
                        <!--th>Editar</th-->
                    </tr>
                </thead>
                <tbody>
                <?php foreach($funcionarios as $f) :
                         //   $nome = $this->funcionariosModel->getSalario($f->intFuncionarioID); 
                           //    echo '<pre>', var_dump($nome); echo '</pre>';
                    ?>
                    <tr>
                        <td><a href="<?=URL; ?>home/editarfuncionario/<?=$f->intFuncionarioID; ?>"><?=$f->strFuncionarioNome; ?></a></td>
                        <td><?=$f->strCargoNome; ?></td>
                        <td><?=$f->strFuncionarioDatePagamento; ?></td>
                        <td><?=$this->mostraData($f->strFuncionarioDateAdmissao); ?></td>
                        <td>
                            <a class="btn-sm btn-info btn-flat" href="<?=URL; ?>home/verfuncionario/<?=$f->intFuncionarioID; ?>"><i class="fa fa-eye"></i> Visualizar</a>
                            <a class="btn-sm bg-orange btn-flat" href="<?=URL; ?>home/editarfuncionario/<?=$f->intFuncionarioID; ?>"><i class="fa fa-edit"></i> Editar</a></td>
                      
                    </tr>
                <?php endforeach; ?>
                </tbody>                
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php endif; ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->