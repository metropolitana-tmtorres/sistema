
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
            <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo URL; ?>home/poDataForm/<?php echo $po->intPoID; ?>'">
                <i class="fa fa-plus"></i> Cadastrar Produtos
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
                <h3 class="box-title">Dados da P.O.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <td><strong>CRM</strong></td>
                            <td><?php echo $this->showCode($crm->intCrmID, 'C') ?></td>
                            <td><strong>Cliente</strong></td>
                            <td><?php echo $c->strClienteFantasia; ?></td>
                            <td><strong>Data</strong></td>
                            <td><?php echo $this->mostraData($po->strPoDate); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td><?php echo $this->mostraStatus($po->strPoStatus); ?></td>
                            <td><strong>Validade</strong></td>
                            <td><?php echo $this->mostraData($po->strPoValidade); ?></td>
                            <td><strong>Prazo</strong></td>
                            <td><?php echo $po->strPoPrazo; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Itens da P.O.</h3>
            </div>
            <div class="box-body">
                <table id="data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Especificação</th>
                            <th>Fornecedor</th>
                            <th>Valor Total</th>
                            <th>Data</th>
                            <th>Prazo de Produção</th>
                            <th>Editar</th>
                            <th>Visualizar</th>
                            <?php if(isset($po->strPoStatus) && $po->strPoStatus != "AP"): ?> 
                                <th>Deletar</th> 
                            <?php elseif(isset($po->strPoStatus) && $po->strPoStatus == "AP"):?>
                                <th>Gerar Proposta</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($poData as $p) :
                                $f = $this->getFornecedorByID($p->intFornecedorID);
                            ?>
                            <tr>
                                <td><?php echo $p->strPoDataItem; ?></td>
                                <td><?php echo $p->strPoDataEspecificacao; ?></td>
                                <td><?php echo $f->strFornecedorNome; ?></td>
                                <td><?php echo $p->strPoDataValorTotal; ?></td>
                                <td><?php echo $this->mostraData($p->strPoDataData); ?></td>
                                <td><?php echo $p->strPoDataPrazoProd; ?></td>
                                <td><a href="<?php echo URL; ?>home/podataform/<?php echo $p->intPoID; ?>/<?php echo $p->intPoDataID; ?>" title="Editar Produto">Editar</a></td>
                                <td><a href="<?php echo URL; ?>home/verpodata/<?php echo $p->intPoDataID; ?>" title="Visualizar Produto">Visualizar</a></td>
                                <?php if(isset($po->strPoStatus) && $po->strPoStatus != "AP"): ?>
                                    <td><a href="<?php echo URL.'/home/deletepodata/'.$p->intPoDataID.'/'.$p->intPoID; ?>" title="Deletar Dados da P.O.">Deletar</a></td>
                                <?php elseif(isset($po->strPoStatus) && $po->strPoStatus == "AP"): ?>
                                    <td><a href="<?php echo URL.'/home/#modal-info/'.$p->intPoID; ?>" data-toggle="modal" data-target="#modal-info" title="Gerar Proposta">Gerar Proposta</a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Item</th>
                            <th>Especificação</th>
                            <th>Fornecedor</th>
                            <th>Valor Total</th>
                            <th>Data</th>
                            <th>Prazo de Produção</th>
                            <th>Editar</th>
                            <th>Visualizar</th>
                            <?php if(isset($po->strPoStatus) && $po->strPoStatus != "AP"): ?> 
                                <th>Deletar</th> 
                            <?php elseif(isset($po->strPoStatus) && $po->strPoStatus == "AP"):?>
                                <th>Gerar Proposta</th>
                            <?php endif; ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Editar Status da P.O.</h3>
                </div>
                <div class="box-body">
                <form method="POST" action="<?php echo URL; ?>home/editpostatus">
                    <div class="form-group">
                        <label for="">Status</label>
                            <select name="stats" class="form-control select2" data-placeholder="Escolha um Status">
                                <option value="" <?php if(!isset($po)) {echo "selected";}?> disabled>Escolha um Status</option>
                                <option <?php if(isset($po->strPoStatus) && $po->strPoStatus == "NE") {echo "selected";} ?> value="NE">Negativa</option>
                                <option <?php if(isset($po->strPoStatus) && $po->strPoStatus == "AN") {echo "selected";} ?> value="AN">Andamento</option>
                                <option <?php if(isset($po->strPoStatus) && $po->strPoStatus == "AP") {echo "selected";} ?> value="AP">Aprovada</option>
                                <option <?php if(isset($po->strPoStatus) && $po->strPoStatus == "EN") {echo "selected";} ?> value="EN">Entregue</option>
                            </select>
                    </div>
                    <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                    <input name="poId" type="hidden" value="<?php echo $po->intPoID; ?>">
                    <button type="submit" class="btn btn-primary">Editar Status</button>
                <!-- /.box-body -->
                </form>
                </div>
            <!-- /.box -->
            </div>      
    </section>
    <!-- /.content -->
  </div>
 
  <!-- /.content-wrapper -->
  <div class="modal modal-info fade" id="modal-info">
    <form action="<?php echo URL.'/home/addProposta/'.$p->intPoID;?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Gerar Proposta</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Data Solicitada</label>
                        <input type="date" required name="dataSolicitada" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Data Envio</label>
                        <input type="date" required name="dataEnvio" class="form-control">
                    </div>
                    <input name="codigo" type="hidden" value="<?php echo $po->intPoID; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Gerar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->