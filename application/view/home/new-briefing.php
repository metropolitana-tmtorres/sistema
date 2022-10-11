

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Briefing - <?php echo $codeShow; ?> - <?php echo $conta->strContaNome; ?> (<?php echo $cliente->strClienteFantasia; ?>)
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
            <?php if(isset($crm->strCrmStatus)) : ?>
                <div class="alert alert-danger">
                    <h3>Status Atual:
                        <?php 
                            switch ($crm->strCrmStatus) {
                                case 'o':
                                    echo "Orçamento";
                                    break;
                                case 'a':
                                    echo "Ativo";
                                    break;
                                case 'ab':
                                    echo "Aberto";
                                    break;
                                
                                default:
                                    echo "Prospecção";
                                    break;
                            }
                        ?>
                    </h3>
                </div>
            <?php else: ?>
            <?php endif; ?>
        </li>
      </ol>
    </section>
    <br>

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if(isset($crm->strCrmStatus)) : ?>
            <div class="row">
                <div class="col-md-12">
                    <h4>Mudar Status</h4>
                    <form class="form-inline" action="<?php echo URL; ?>home/saveBriefingStatus" method="post">
                        <div class="form-group">
                            <select name="status" id="" class="form-control">
                                <option <?php if(isset($crm->strCrmStatus) && $crm->strCrmStatus == 'p') { echo "selected"; } ?> value="p">Prospecção</option>
                                <option <?php if(isset($crm->strCrmStatus) && $crm->strCrmStatus == 'o') { echo "selected"; } ?> value="o">Orçamento</option>
                                <option <?php if(isset($crm->strCrmStatus) && $crm->strCrmStatus == 'a') { echo "selected"; } ?> value="a">Ativo</option>
                                <option <?php if(isset($crm->strCrmStatus) && $crm->strCrmStatus == 'ab') { echo "selected"; } ?> value="ab">Aberto</option>
                            </select>
                        </div>
                        <input type="hidden" name="crmID" value="<?php echo $crm->intCrmID; ?>">
                        <button type="submit" class="btn btn-primary">Salvar Status</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <BR>
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Briefing</h3>
                    </div>
                    <div class="box-body">
                        <div id="briefingItens">
                        <table class='table table-striped table-hover'>
                            <tr>
                                <th>Nome do Item</th>
                                <th>Detalhes</th>
                                <th>Remover</th>
                            </tr>
                            <?php 
                            if(isset($item)) : 
                                foreach($item as $i) :?>
                            <tr>
                                <td><?php echo $i->strProdutoNome; ?></td>
                                <td><a href='<?php echo URL; ?>home/editarbriefingdetalhes/<?php echo $i->intProdutoID; ?>/<?php echo $briefingID; ?>/<?php echo $crmID; ?>' class='btn btn-info'>Detalhes</a></td>
                                <td><button type="button" class='btn btn-danger' onclick='delBriefingItem(<?php echo $i->intProdutoID; ?>,<?php echo $briefingID; ?>);'>Remover</button></td>
                            </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="3">Briefing vazio!</td></tr>
                            <?php endif; ?>
                        </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <h2>Subtotal: R$ <?php echo $this->getBriefingValue($briefingID); ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-12">
                <form action="<?php echo URL; ?>home/addBriefingItem" method="POST">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Adicionar Itens</h3>
                        </div>
                        <div class="box-body">
                           
                                <div class="form-group">
                                    <label for="">Produtos</label>
                                    <select name="produto" id="produtoID" class="form-control">
                                        <option value="" disabled selected>Selecione um Produto</option>
                                        <?php foreach($prod as $pr) : ?>
                                            <option value="<?php echo $pr->intProdutoID; ?>"><?php echo $pr->strProdutoNome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                           
                                <div class="form-group">
                                    <label for="">Pacote de Produtos</label>
                                    <select name="produto" id="produtoID" class="form-control">
                                        <option value="" disabled selected>Selecione um Produto</option>
                                        <?php foreach($pack as $pk) : ?>
                                            <option value="<?php echo $pk->intPacoteID; ?>"><?php echo $pk->strPacoteNome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            
                            
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="briefingID" id="briefingID" value="<?php echo $briefingID; ?>">
                            <input type="hidden" name="crmID" value="<?php echo $crmID; ?>">
                            <button id="produtoBriefing" class="btn btn-primary btn-lg btn-block"><i class="fa fa-plus"></i> Adicionar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
