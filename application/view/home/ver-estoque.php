

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ver Produto 
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-saida">
                <i class="fa fa-minus"></i> Registrar Saída
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-entrada">
                <i class="fa fa-plus"></i> Registrar Entrada
            </button>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <BR>
    <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
          <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>"; ?>
    <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
           <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
    <?php endif; ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo $p->strEstoqueNomeProduto; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <td><strong>Cliente:</strong></td>
                        <td><?php echo $p->strEstoqueCliente; ?></td>
                        <td><strong>Quantidade em Estoque</strong></td>
                        <td><?php echo $p->intEstoqueQtd; ?></td>
                        <td><strong>Validade</strong></td>
                        <td><?php echo $this->mostraData($p->strEstoqueValidade); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Setor:</strong></td>
                        <td><?php echo $p->strEstoqueSetor; ?></td>
                        <td><strong>Fila</strong></td>
                        <td><?php echo $p->strEstoqueFila; ?></td>
                        <td><strong>Caixa</strong></td>
                        <td><?php echo $p->strEstoqueCaixa; ?></td>
                    </tr>
                    <tr>
                        <td colspan="1"><strong>Observações:</strong></td>
                        <td colspan="9"><?php echo $p->strEstoqueObs; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box">
        <div class="box-header">
            <h3 class="box-title">Registro de Saídas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Retirou</th>
                        <th>Entregou</th>
                        <th>Data - Hora</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($saidas as $s) :
                    ?>
                        <tr>
                            <td><?php echo $s->strEstoqueRetirou; ?></td>
                            <td><?php echo $this->admModel->getAdmNameByID($s->intAdmID); ?></a></td>
                            <td>
                                <button type="button" class="btn" data-toggle="modal" data-target="#modal-saidaobs">
                                    <?php echo $this->convertTimestamp($s->strEstoqueData); ?>
                                </button>
                            </td>
                            <td><?php echo $s->intEstoqueRetiradaQtd; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Retirou</th>
                        <th>Entregou</th>
                        <th>Data - Hora</th>
                        <th>Quantidade</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Registro de Entradas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Entregou</th>
                        <th>Recebeu</th>
                        <th>Data - Hora</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($entradas as $e) :
                    ?>
                        <tr>
                            <td><?php echo $e->strEstoqueEntregou; ?></td>
                            <td><?php echo $this->admModel->getAdmNameByID($e->intAdmID); ?></a></td>
                            <td>
                                <button type="button" class="btn" data-toggle="modal" data-target="#modal-entregaobs">
                                    <?php echo $this->convertTimestamp($e->strEstoqueEntregaData); ?>
                                </button>    
                            </td>
                            <td><?php echo $e->intEstoqueEntradaQtd; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Entregou</th>
                        <th>Recebeu</th>
                        <th>Data - Hora</th>
                        <th>Quantidade</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!--/.box -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal modal-info fade" id="modal-saida">
    <form action="<?php echo URL; ?>home/registrarSaida" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar Saída</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nome do Retirante</label>
                        <input type="text" required name="retirou" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Quantidade Retirada</label>
                        <input type="number" required name="qtd" min="1" max="<?php echo $p->intEstoqueQtd; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Observações</label>
                        <textarea name="obs" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="entregador" value="<?php echo $adm->intAdmID; ?>">
                    <input type="hidden" name="produto" value="<?php echo $p->intEstoqueID; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Registrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

</div>
<!-- /.modal -->


<div class="modal modal-info fade" id="modal-entrada">
    <form action="<?php echo URL; ?>home/registrarEntrada" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar Entrada</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nome do Entregador</label>
                        <input type="text" required name="entregou" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Quantidade Entrega</label>
                        <input type="number" required name="qtd" min="1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Observações</label>
                        <textarea name="obs" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="entregador" value="<?php echo $adm->intAdmID; ?>">
                    <input type="hidden" name="produto" value="<?php echo $p->intEstoqueID; ?>">
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

<div class="modal fade" id="modal-saidaobs">
        <form action="<?php echo URL; ?>home/saidaobs" method="post">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Observações de Saída</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p><?php echo $saidaObs->strEstoqueRetiradaObs ; ?></p>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </form>
      </div>
<!-- /.modal -->

<div class="modal fade" id="modal-entregaobs">
        <form action="<?php echo URL; ?>home/entregaobs" method="post">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Observações de Entrega</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p><?php echo $entregaObs->strEstoqueEntregaObs ; ?></p>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </form>
      </div>
<!-- /.modal -->