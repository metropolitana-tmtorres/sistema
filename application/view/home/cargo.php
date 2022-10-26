<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cargos e Departamentos
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <?php if (isset($_GET['salvo'])) : ?>
                    <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                        <i class="fa fa-arrow-left"></i> Voltar
                    </button>
                <?php else : ?>
                    <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                        <i class="fa fa-arrow-left"></i> Voltar
                    </button>
                <?php endif; ?>
                <button type="button" class="btn-sm btn-register btn-flat" data-toggle="modal" data-target="#modal-info">
                    <i class="fa fa-edit"></i> Cadastrar
                </button>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <BR>
        <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
              <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>"; ?>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
                <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
        <?php endif; ?>
        <div class="box box-primary">
            <!--div class="box-header">
            <h3 class="box-title">Cargos e Departamentos</h3>
        </div-->
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Cargo</th>
                            <th>Departamento</th>
                            <th>Ações</th>
                            <!-- <th colspan="2">Ação</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $numCargos = count($cargos);
                        if ($numCargos >= 1) :
                            foreach ($cargos as $c) :
                        ?>
                                <tr>
                                    <td><?php echo $c->strCargoNome; ?></td>
                                    <td><?php $dn = $this->departamentosModel->getDepartamentoByID($c->intDepartamentoID);
                                        echo $dn->strDepartamentoNome; ?></td>
                                    <!-- <td><a href="<?php echo URL; ?>home/permissoes/<?php echo $c->intCargoID; ?>">Editar Permissões</a></td> -->
                                    <td><a class="btn-sm btn-danger btn-flat" data-toggle="modal" data-target="#modal-excluir"><i class="fa fa-close"></i> Excluir</a></td>
                                </tr>
                        <?php
                            endforeach;
                        else :
                            echo "<tr><td colspan='2'>Nenhum cargo cadastrado</td></tr>";
                        endif;
                        ?>
                    </tbody>
                    <!--tfoot>
                    <tr>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Excluir</th>
                      <th colspan="2">Ação</th> 
                    </tr>
                </tfoot-->
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal modal-danger fade in" id="modal-excluir">
    <form action="<?php echo URL; ?>home/excluircargo/<?php echo $c->intCargoID; ?>" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Excluir Cargo/Departamento</h4>
                </div>
                <div class="modal-body">
                    <h4>Deseja realmente excluir?</h4>
                    <p>Essa ação é irreversível, caso realmente excluia não será possível reverter.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    <!--href=""-->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>

<div class="modal modal-info fade" id="modal-info">
    <form action="<?php echo URL; ?>home/cadastracargo" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cadastro de Cargos</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="depto">Selecione o Departamento</label>
                        <select name="depto" id="depto" class="form-control">
                            <?php foreach ($deptos as $d) : ?>
                                <option value="<?php echo $d->intDepartamentoID; ?>"><?php echo $d->strDepartamentoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <input type="text" id="cargo" required name="cargo" class="form-control">
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