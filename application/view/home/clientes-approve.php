

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Aprovações do Sistema
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <a type="button" class="btn btn-danger" style=color:#fff href='<?=URL?>home/reprovados'>
                <i class="fa fa-trash"></i> Ver Reprovados
            </a>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
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
    <?php elseif(isset($_GET['approved']) && $_GET['approved'] == 'true') : ?>
        <div class="alert alert-success">Solicitação aprovada com sucesso!</div>
    <?php elseif(isset($_GET['approved']) && $_GET['approved'] == 'error') : ?>
        <div class="alert alert-danger">Hove um erro ao aprovar a solicitação</div>
    <?php elseif(isset($_GET['add']) && $_GET['add'] == 'true') : ?>
        <div class="alert alert-danger">Por favor, cadastre o cliente <?=$_GET['client']; ?> utilizando o botão "Cadastrar" ao lado.</div>
    <?php endif; ?>


    <?php if(in_array('aprovarClientes', $access)):?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Clientes para Aprovar</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped smarttable2">
                <thead>
                    <tr>
                        <th>Nome Fantasia</th>
                        <th>Solicitante</th>
                        <th>Editar</th>
                        <th>Aprovar</th>
                        <th>Reprovar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($clientes as $c) :
                            // $nome = $this->admModel->getAdmNameByID($c->intUserAdmID); 
                            // var_dump($nome);
                    ?>
                        <tr>
                            <td><?=$c->strClienteFantasia; ?></a></td>
                            <td><?=$c->strAdmNome; ?></td>
                            <td><a href="<?=URL; ?>home/clienteform/<?=$c->intClienteID; ?>" title="Editar Cliente">Editar</a></td>
                            <td><a href="<?=URL; ?>home/approveClient/<?=$c->intClienteID; ?>/<?=$c->intUserAdmID; ?>/<?=$c->strClienteFantasia; ?>" title="Aprovar Cliente">Aprovar</a></td>
                            <td><a href="#" data-toggle="modal" data-target="#modal-<?=$c->intClienteID; ?>" title="Reprovar Cliente">Reprovar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php endif;?>
        <?php if(in_array('aprovarContas', $access)):?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Contas para Aprovar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="contas" class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Conta</th>
                            <th>Cliente</th>
                            <th>Solicitante</th>
                            <th>Editar</th>
                            <th>Aprovar</th>
                            <th>Reprovar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($contas as $co) :
                                // $nome = $this->admModel->getAdmNameByID($c->intUserAdmID); 
                                // var_dump($nome);
                        ?>
                            <tr>
                                <td><?=$co->strContaNome; ?></a></td>
                                <td><?=$co->strClienteFantasia; ?></a></td>
                                <td><?=$co->strAdmNome; ?></td>
                                <td><a href="<?=URL; ?>home/editarconta/<?=$co->intContaID; ?>" title="Editar Conta">Editar</a></td>
                                <td><a href="<?=URL; ?>home/approveConta/<?=$co->intContaID; ?>" title="Aprovar Conta">Aprovar</a></td>
                                <td><a href="#" data-toggle="modal" data-target="#modal-<?=$co->intContaID; ?>" title="Reprovar Fornecedor">Reprovar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody> 
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php endif;?>
        <?php if(in_array('aprovarFornecedores', $access)):?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Fornecedores para Aprovar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="contas" class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>CNPJ</th>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>VIP</th>
                            <th>Editar</th>
                            <th>Aprovar</th>
                            <th>Reprovar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($fornecedores as $f) :
                        ?>
                            <tr>
                                <td><a href="<?=URL; ?>home/fornecedorform/<?=$f->intFornecedorID; ?>?aprovar=true" title="Editar Fornecedor"><?=$f->strFornecedorCnpj; ?></a></td>
                                <td><a href="<?=URL; ?>home/fornecedorform/<?=$f->intFornecedorID; ?>?aprovar=true" title="Editar Fornecedor"><?=$f->strFornecedorRazao; ?></a></td>
                                <td><a href="<?=URL; ?>home/fornecedorform/<?=$f->intFornecedorID; ?>?aprovar=true" title="Editar Fornecedor"><?=$f->strFornecedorFantasia; ?></a></td>
                                <td><?php if($f->strFornecedorVip == "y"){ echo "Sim"; }else{ echo "Não"; }?></td>
                                <td><a href="<?=URL; ?>home/fornecedorform/<?=$f->intFornecedorID; ?>?aprovar=true" title="Editar Fornecedor">Editar</a></td>
                                <td><a href="<?=URL; ?>home/approvefornecedor/<?=$f->intFornecedorID; ?>" title="Aprovar Fornecedor">Aprovar</a></td>
                                <td><a href="#" data-toggle="modal" data-target="#modal-<?=$f->intFornecedorID; ?>" title="Reprovar Fornecedor">Reprovar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php endif;?>
        <?php if(in_array('aprovarColaboradores', $access)):?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Colaboradores para Aprovar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="contas" class="table table-bordered table-striped smarttable2">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Data de Pagamento</th>
                        <th>Data de Admissão</th>
                        <th>Editar</th>
                        <th>Aprovar</th>
                        <th>Reprovar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($funcionarios as $f) : ?>
                    <tr>
                        <td><a href="<?=URL; ?>home/editarfuncionario/<?=$f->intFuncionarioID; ?>?aprovar=true"><?=$f->strFuncionarioNome; ?></a></td>
                        <td><?=$f->strCargoNome; ?></td>
                        <td><?=$f->strFuncionarioDatePagamento; ?></td>
                        <td><?=$this->mostraData($f->strFuncionarioDateAdmissao); ?></td>                        
                        <td><a href="<?=URL; ?>home/editarfuncionario/<?=$f->intFuncionarioID; ?>?aprovar=true">Editar</a></td>
                        <td><a href="<?=URL; ?>home/approveFuncionario/<?=$f->intFuncionarioID; ?>" title="Aprovar Fornecedor">Aprovar</a></td>
                        <td><a href="#" data-toggle="modal" data-target="#modalFuncionario-<?=$f->intFuncionarioID; ?>" title="Reprovar Funcionario">Reprovar</a></td>
                    </tr>
                <?php endforeach;?>
                    </tbody>
                    
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <?php endif;?>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php foreach($clientes as $c) : ?>
    <div class="modal modal-info fade" id="modal-<?=$c->intClienteID; ?>">
    <form action="<?=URL; ?>home/reproveClient" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reprovar Cliente</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input type="text" readonly class="form-control" name="fantasia" value="<?=$c->strClienteFantasia; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Motivo de Reprovação</label>
                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?=$co->intContaID; ?>">
                    <input type="hidden" name="adm" value="<?=$adm->strAdmNome; ?>">
                    <input type="hidden" name="solicitante" value="<?=$c->strAdmNome; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Reprovar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

</div>
<!-- /.modal -->
 <?php endforeach; ?>


 <?php foreach($contas as $co) : ?>
<div class="modal modal-info fade" id="modal-<?=$co->intContaID; ?>">
    <form action="<?=URL; ?>home/reproveAccount" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reprovar Conta</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input type="text" readonly class="form-control" name="fantasia" value="<?=$co->strContaNome; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Motivo de Reprovação</label>
                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?=$co->intContaID; ?>">
                    <input type="hidden" name="adm" value="<?=$adm->strAdmNome; ?>">
                    <input type="hidden" name="solicitante" value="<?=$co->strAdmNome; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Reprovar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->
 <?php endforeach; ?>

 <?php foreach($fornecedores as $f) { ?>
<div class="modal modal-info fade" id="modal-<?=$f->intFornecedorID; ?>">
    <form action="<?=URL; ?>home/reproveFornecedor" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reprovar Fornecedor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Fornecedor</label>
                        <input type="text" readonly class="form-control" name="fantasia" value="<?=$f->strFornecedorFantasia; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Motivo de Reprovação</label>
                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?=$f->intFornecedorID; ?>">
                    <input type="hidden" name="adm" value="<?=$adm->strAdmNome; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Reprovar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->
<?php } ?>

<?php foreach($funcionarios as $f) { ?>
<div class="modal modal-info fade" id="modalFuncionario-<?=$f->intFuncionarioID; ?>">
    <form action="<?=URL; ?>home/reproveFuncionario" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reprovar Funcionario</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Funcionario</label>
                        <input type="text" readonly class="form-control" name="nome" value="<?=$f->strFuncionarioNome; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Motivo de Reprovação</label>
                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?=$f->intFuncionarioID; ?>">
                    <input type="hidden" name="adm" value="<?=$adm->strAdmNome; ?>">
                    <input type="hidden" name="solicitante" value="<?=$adm->strAdmNome; ?>">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-outline">Reprovar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->
<?php } ?>