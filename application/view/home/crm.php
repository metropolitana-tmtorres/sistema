

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CRM
        <!-- <small>Optional description</small> -->
      </h1>
      
      <ol class="breadcrumb">
        <li>
        <?php if(isset($_GET['salvo'])) : ?>
            <button type="button" class="btn btn-info" onclick="window.location.href = '<?php echo URL; ?>/home/dashboard';">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php else: ?>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        <?php endif; ?>
            <?php if(in_array('crm-add', $permissions)) : ?>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                    <i class="fa fa-plus"></i> Cadastrar
                </button>
            <?php endif; ?>
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

    <br>
    <div class="container">
        <div class="row">
            <div class="com-md-12">
                <form action="<?php echo URL; ?>home/crm" class="form-inline pull-right" method="post">
                    <div class="form-group">
                        <label for="crm">Selecione o Status</label>
                        <select name="filtrastatus" class="form-control" required id="crm">
                            <option <?php if(isset($_POST['filtrastatus']) && $_POST['filtrastatus'] == 't') { echo "selected"; } ?> value="t">Todos</option>
                            <option <?php if(isset($_POST['filtrastatus']) && $_POST['filtrastatus'] == 'p') { echo "selected"; } ?>  value="p">Prospecção</option>
                            <option <?php if(isset($_POST['filtrastatus']) && $_POST['filtrastatus'] == 'o') { echo "selected"; } ?>  value="o">Orçamento</option>
                            <option <?php if(isset($_POST['filtrastatus']) && $_POST['filtrastatus'] == 'a') { echo "selected"; } ?>  value="a">Ativo</option>
                            <option <?php if(isset($_POST['filtrastatus']) && $_POST['filtrastatus'] == 'ab') { echo "selected"; } ?>  value="ab">Aberto</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
            </div>
        </div>
    </div>
    <br><br>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Dados do CRM</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Conta</th>
                        <th>Segmento</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(in_array('crm-ver-tudo', $permissions) || in_array('crm-ver-meus', $permissions)) :
                        foreach($crm as $c) :
                            $codeCrm = $this->showCode($c->intCrmID, 'C');
                    ?>
                        <tr>
                            <td>
                            <?php if(in_array('crm-editar', $permissions)) :?>
                                <a href="<?php echo URL; ?>home/intervencoes/<?php echo $c->intCrmID; ?>"><?php echo $codeCrm; ?></a>
                            <?php else: ?>
                                <?php echo $codeCrm; ?>
                            <?php endif; ?>
                            </td>
                            <td><?php echo $c->strClienteFantasia; ?></td>
                            <td><?php echo $c->strContaNome; ?></td>
                            <td><?php echo $c->strSegmentoNome; ?></td>
                            <td>
                                <?php 
                                    switch($c->strCrmStatus) { 
                                        case 'o':
                                            echo "<span class='label label-primary'>Orçamento</span>";
                                            break;
                                        case 'a':
                                            echo "<span class='label label-success'>Ativo</span>";
                                            break;
                                        case 'ab':
                                            echo "<span class='label label-danger'>Aberto</span>";
                                            break;
                                        default: 
                                            echo "<span class='label label-default'>Prospecção</span>";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; else:?>
                        <tr>
                            <td colspan="8">Você não tem acesso para visualizar o CRM.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Conta</th>
                        <th>Segmento</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal modal-info fade" id="modal-info">
    <form action="<?php echo URL; ?>home/cadastracrm" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CRM - Cadastro de Clientes</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Código</label>
                        <input type="text" required name="ncode" disabled value="<?php echo $code; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Cliente</label>
                        <select class="form-control select2" name="cliente" style="width: 100%;" onchange="contaSearch(this.value)">
                            <option value="" disabled selected>Selecione o Cliente</option>
                            <?php foreach($clients as $c) : ?>
                            <option value="<?php echo $c->intClienteID; ?>"><?php echo $c->strClienteFantasia; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br><br><a href="<?php echo URL; ?>home/clienteform" class="btn btn-block btn-primary">Clique aqui para cadastrar o cliente</a>
                    </div>
                    <div id="conta" class="form-group"></div>
                    <div id="contato"></div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="p">Prospecção</option>
                            <option value="o">Orçamento</option>
                            <option value="a">Ativo</option>
                            <option value="ab">Aberto</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="code" value="<?php echo $code; ?>">
                    <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Cadastrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

</div>
<!-- /.modal -->