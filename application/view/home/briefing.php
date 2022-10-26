

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Briefing - <?php echo $codeShow; ?> - <?php echo $crm->strCrmFantasia; ?>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <?php if(isset($_GET['salvo'])) : ?>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php else: ?>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php endif; ?>
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
        <form action="<?php echo URL; ?>home/savebriefing" method="post">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Briefing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Data de Início</label>
                            <input type="date" class="form-control" name="datainicio" value="<?php if(isset($b->strBriefingPeriodoStart)){ echo $b->strBriefingPeriodoStart; } ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Data de Conclusão</label>
                            <input type="date" class="form-control" name="dataconclusao" value="<?php if(isset($b->strBriefingPeriodoEnd)){ echo $b->strBriefingPeriodoEnd; } ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Ações em Feriado</label>
                            <select name="feriado" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Ações aos Finais de Semana</label>
                            <select name="acaofds" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Ações Noturnas</label>
                            <select name="noturno" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Duração</label>
                            <input type="text" name="duracao" id="" class="form-control" value="<?php if(isset($b->strBriefingDuracao)){ echo $b->strBriefingDuracao; } ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Local da Ação</label>
                            <textarea name="local" id="" cols="30" rows="10" class="form-control"><?php if(isset($b->strBriefingLocal)) { echo $b->strBriefingLocal; } ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Equipe</label>
                            <textarea name="equipe" id="" cols="30" rows="10" class="form-control"><?php if(isset($b->strBriefingEquipe)) { echo $b->strBriefingEquipe; } ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Modelo</label>
                            <select name="modelo" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fotógrafo</label>
                            <select name="fotografo" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Videomaker</label>
                            <select name="videomaker" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="">Mecânica</label>
                        <textarea name="mecanica" id="" cols="30" rows="10" class="form-control"><?php if(isset($b->strBriefingMecanica)) { echo $b->strBriefingMecanica; } ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Equipamentos</label>
                            <textarea name="equipamentos" id="" cols="30" rows="10" class="form-control"><?php if(isset($b->strBriefingEquipamentos)) { echo $b->strBriefingEquipamentos; } ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Brindes</label>
                            <textarea name="brindes" id="" cols="30" rows="10" class="form-control"><?php if(isset($b->strBriefingBrindes)) { echo $b->strBriefingBrindes; } ?> </textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Quantidade de Produtos</label>
                            <textarea name="qtdprodutos" id="" cols="30" rows="10" class="form-control"><?php if(isset($b->strBriefingQtdProdutos)) { echo $b->strBriefingQtdProdutos; } ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Mailing</label>
                            <select name="mailing" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Flyers</label>
                            <input type="number" name="flyers" id="" class="form-control" value="<?php if(isset($b->strBriefingFlyers)){ echo $b->strBriefingFlyers; } ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Uniforme</label>
                            <select name="uniforme" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Plotado</label>
                            <select name="plotado" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fotos Editadas</label>
                            <select name="fotos" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pós em Vídeo</label>
                            <select name="video" id="" class="form-control">
                                <option value="no">Não</option>
                                <option value="yes">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="">Pós em PPT</label>
                        <select name="ppt" id="" class="form-control">
                            <option value="no">Não</option>
                            <option value="yes">Sim</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Prazo</label>
                        <input type="text" name="prazo" id="" class="form-control" value="<?php if(isset($b->strBriefingPrazo)){ echo $b->strBriefingPrazo; } ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h3>Produtos</h3>
                        <?php foreach($prod as $pr) : ?>
                            <div class="checkbox">
                                <label>
                                    <input name="pr[]" value="<?php echo $pr->intProdutoID; ?>" <?php if(isset($product)){ if(in_array($pr->intProdutoID, $product)) { echo 'checked'; }} ?> type="checkbox"> <?php echo $pr->strProdutoNome; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-6">
                        <h3>Pacotes</h3>
                        <?php foreach($pack as $pa) : ?>
                            <div class="checkbox">
                                <label>
                                    <input name="pa[]" value="<?php echo $pa->intPacoteID; ?>"  <?php if(isset($package)){ if(in_array($pa->intPacoteID, $package)) { echo 'checked'; }} ?> type="checkbox"> <?php echo $pa->strPacoteNome; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                <input type="hidden" name="crm" value="<?php echo $crm->intCrmID; ?>">
                <?php if(isset($b->intBriefingID)) : ?>
                <input type="hidden" name="briefingID" value="<?php echo $b->intBriefingID; ?>">
                <?php endif; ?>
                <button type="submit" class="btn btn-primary btn-lg">Salvar Briefing</button>
                <a href="<?php echo URL; ?>home/intervencoes/<?php echo $crm->intCrmID; ?>" class="btn btn-danger btn-lg">Cancelar</a>
                
            </div>
            <!-- / .box-footer -->
        </div>
        <!-- /.box -->
    </form>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->