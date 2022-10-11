
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Planilha Orçamentária
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo URL; ?>home/poform'">
                <i class="fa fa-plus"></i> Cadastrar 
            </button>
        </li>
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
            <h3 class="box-title">Planilha Orçamentária</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>CRM</th>
                        <th>Cliente</th>
                        <th>Conta</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Validade</th>
                        <th>Prazo</th>
                        <th>Editar</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($po as $p) :
                        ?>
                        <tr>
                            <td><?php echo $this->showCode($p->intCrmID, 'C') ?></td> 
                            <td><?php echo $p->strClienteFantasia; ?></td> 
                            <td><?php echo $p->strContaNome; ?></td> 
                            <td><?php echo $this->mostraData($p->strPoDate); ?></td>
                            <td>
                            <?php 
                                switch($p->strPoStatus) { 
                                    case 'NE':
                                        echo "<span class='label label-primary'>Negativa</span>";
                                        break;
                                    case 'AN':
                                        echo "<span class='label label-success'>Andamento</span>";
                                        break;
                                    case 'AP':
                                        echo "<span class='label label-danger'>Aprovada</span>";
                                        break;
                                    default: 
                                        echo "<span class='label label-default'>Entregue</span>";
                                }
                                ?>
                            </td>
                            <td><?php echo $this->mostraData($p->strPoValidade); ?></td>
                            <td><?php echo $p->strPoPrazo; ?></td>
                            <td><a href="<?php echo URL; ?>home/poform/<?php echo $p->intPoID; ?>" title="Editar P.O.">Editar</a></td>
                            <td><a href="<?php echo URL; ?>home/podata/<?php echo $p->intPoID; ?>" title="Ver Produtos da P.O.">Visualizar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
