

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Carteira de Clientes
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                    <i class="fa fa-plus"></i> Adicionar a Carteira
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
        <div class="alert alert-danger">Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.</div>
    <?php elseif(isset($_GET['add']) && $_GET['add'] == 'true') : ?>
        <div class="alert alert-danger">Por favor, cadastre o cliente <?php echo $_GET['client']; ?> utilizando o botão "Cadastrar" ao lado.</div>
    <?php elseif(isset($_GET['clienteAdded']) && $_GET['clienteAdded'] == 'true') : ?>
        <div class="alert alert-danger">Este cliente já esta em uma carteira.</div>
    <?php elseif(isset($_GET['agenciaAdded']) && $_GET['agenciaAdded'] == 'true') : ?>
        <div class="alert alert-danger">Esta agência já esta em uma carteira.</div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Carteira de Clientes <?php if(isset($v)){ echo "de ".$v; }?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="<?php echo URL; ?>home/carteira" method="POST">
                <div class="form-group">
                    <div class="col-md-6">
                        <select name="vendor" class="form-control">
                            <option value="0">Selecione o Vendedor</option>
                            <?php foreach($vendors as $v) : ?>
                                <option <?php if(isset($_POST['vendor']) && $_POST['vendor'] == $v->intAdmID) { echo "selected"; } ?> value="<?php echo $v->intAdmID; ?>"><?php echo $v->strAdmNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Ver Carteira</button>
                    </div>
                </div>
            </form>
            <?php if(isset($clients)) : ?>
                <br><br><h3>Clientes</h3>
                <table class="table table-bordered table-striped smarttable">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Mudar de Vendedor</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clients as $c) : ?>
                            <tr>
                                <td><?php echo $c->strClienteFantasia; ?></a></td>
                                <td><a href="#" data-toggle="modal" data-target="#modal-<?php echo $c->intClienteID; ?>" title="Mudar de Carteira">Mudar</a></td>
                                <td><a href="<?php echo URL; ?>home/vercliente/<?php echo $c->intClienteID; ?>" title="Visualizar Cliente">Visualizar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cliente</th>
                            <th>Mudar de Vendedor</th>
                            <th>Visualizar</th>
                        </tr>
                    </tfoot>
                </table>
            <?php endif; ?>
            <?php if(isset($agencies)) : ?>
                <br><h3>Contas</h3>
                <table id="contas" class="table table-bordered table-striped smarttable">
                    <thead>
                        <tr>
                            <th>Conta</th>
                            <th>Cliente</th>
                            <th>Mudar de Vendedor</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($agencies as $a) : ?>
                            <tr>
                                <td><?php echo $a->strContaNome; ?></a></td>
                                <td><?php echo $a->strClienteFantasia; ?></a></td>
                                <td><a href="#" data-toggle="modal" data-target="#modal-<?php echo $a->intContaID; ?>" title="Mudar de Carteira">Mudar</a></td>
                                <td><a href="<?php echo URL; ?>home/agencias/" title="Visualizar Agência">Visualizar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Conta</th>
                            <th>Cliente</th>
                            <th>Mudar de Vendedor</th>
                            <th>Visualizar</th>
                        </tr>
                    </tfoot>
                </table>
            <?php endif; ?>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal modal-info fade" id="modal-info">
    <form action="<?php echo URL; ?>home/addcarteira" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar a Carteira</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="vendor" class="form-control">
                            <option value="0">Selecione o Vendedor</option>
                            <?php foreach($vendors as $v) : ?>
                                <option value="<?php echo $v->intAdmID; ?>"><?php echo $v->strAdmNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="cliente" class="form-control">
                            <option value="0">Selecione o Cliente</option>
                            <?php foreach($clientes as $c) : ?>
                                <option value="<?php echo $c->intClienteID; ?>"><?php echo $c->strClienteFantasia; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="agencia" class="form-control">
                            <option value="0">Selecione a Agência</option>
                            <?php foreach($agencias  as $a) : ?>
                                <option value="<?php echo $a->intAgenciaID; ?>"><?php echo $a->strAgenciaNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
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
<?php 
    if(isset($clients)) :
        foreach($clients as $c) : ?>
    <div class="modal modal-info fade" id="modal-<?php echo $c->intClienteID; ?>">
    <form action="<?php echo URL; ?>home/mudarcliente" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mudar a Carteira</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input type="text" readonly name="fantasia" class="form-control" value="<?php echo $c->strClienteFantasia; ?>">
                    </div>
                    <div class="form-group">
                        <select name="vendedor" class="form-control">
                            <option value="0">Selecione o Vendedor</option>
                            <?php foreach($vendors as $v) : ?>
                                <option value="<?php echo $v->intAdmID; ?>"><?php echo $v->strAdmNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="cliente" value="<?php echo $c->intClienteID; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Mudar Carteira</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

</div>
<!-- /.modal -->
<?php endforeach; endif; ?>

<?php 
    if(isset($agencies)) :
        foreach($agencies as $co) : 
?>
    <div class="modal modal-info fade" id="modal-<?php echo $co->intContaID; ?>">
    <form action="<?php echo URL; ?>home/mudarconta" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mudar a Carteira</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Conta</label>
                        <input type="text" readonly name="fantasia" class="form-control" value="<?php echo $co->strContaNome; ?>">
                    </div>
                    <div class="form-group">
                        <select name="vendedor" class="form-control">
                            <option value="0">Selecione o Vendedor</option>
                            <?php foreach($vendors as $v) : ?>
                                <option value="<?php echo $v->intAdmID; ?>"><?php echo $v->strAdmNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="cliente" value="<?php echo $co->intContaID; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Mudar Carteira</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

</div>
<!-- /.modal -->
<?php endforeach; endif;?>