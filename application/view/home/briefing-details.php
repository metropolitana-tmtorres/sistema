

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detalhes
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <a href="<?php echo URL; ?>home/createbriefing/<?php echo $crm; ?>/<?php echo $brief; ?>" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
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
            <h3 class="box-title">Calendário</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="calendario">
                <?php $this->montaCalendario($prod, $brief, $crm); ?>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo $p->strProdutoNome; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="<?php echo URL; ?>home/addBriefingDetail" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="date" name='date' required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" name='qtd' required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="prod" value="<?php echo $prod; ?>">
                        <input type="hidden" name="brief" value="<?php echo $brief; ?>">
                        <input type="hidden" name="crm" value="<?php echo $crm; ?>">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </div>
            </form>
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Veiculações</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($dates as $d) : ?>
                    <tr>
                        <td><?php echo $this->mostraData($d->strBriefingProdutoData); ?></td>
                        <td><?php echo $d->intBriefingProdutoDataQtd; ?></td>
                        <td><a href="<?php echo URL; ?>home/excluirbriefingdetail/<?php echo $d->intBriefingProdutoDataID ?>/<?php echo $prod; ?>/<?php echo $brief; ?>">Excluir</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Data</th>
                        <th>Veiculações</th>
                        <th>Excluir</th>
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
    <form action="<?php echo URL; ?>home/registerAdm" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de Usuários</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" required name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="mail" required name="mail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Senha</label>
                        <input type="password" required name="pass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="depto">Departamento</label>
                        <select name="depto" id="depto" class="form-control">
                            <option value="" selected>Selecione o Departamento</option>
                            <?php foreach($deptos as $d) : ?>
                                <option value="<?php echo $d->intDepartamentoID; ?>"><?php echo $d->strDepartamentoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="listcargos" class="form-group">
                        <label for="">Cargo</label>
                        <select name="cargo" id="" class="form-control">
                            <option value="false">Selecione o Departamento</option>
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