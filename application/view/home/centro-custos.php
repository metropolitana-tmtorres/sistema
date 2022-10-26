<!-- Content Wrapper. planoins page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Centro de custos
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <?php if(isset($_GET['salvo'])) : ?>
                <button type="button" class="btn-sm btn-goBack btn-flat"
                    onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
                <?php else: ?>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
                <?php endif; ?>
                <?php   if(in_array('centroCustos-add', $permissions)): ?>
                <button type="button" class="btn-sm btn-register btn-flat" data-toggle=modal data-target=#cadModal>  
                    <i class="fa fa-edit"></i> Cadastrar
                </button>
                <?php endif; ?>
            </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content planoiner-fluid">
        <BR>
        <?php if(isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
          <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>"; ?>
        <?php elseif(isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados. Caso persista contato o administrador do sistema.') }); </script>"; ?>
        <?php endif; ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Centro de custos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <?php  if(in_array('centroCustos-editar', $permissions)): ?>
                                <th>Editar</th>
                            <?php endif;?>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                          
                            foreach($CentroCustos as $centro)
                            {
                                if(in_array('centroCustos-editar', $permissions))
                                echo "
                                <tr id='plano-{$centro->intCentroCustosID}'>
                                    <td>{$centro->strCentroCustosNome}</td>
                                    <td>{$centro->strCentroCustosDesc}</td>                                   
                                    <td><a href='#editarplano' onclick=carregarInfoplano({$centro->intCentroCustosID}) data-toggle=modal data-target=#editModal>Editar</a></td>  
                                    <td><a href='".URL."home/excluirCentro?id={$centro->intCentroCustosID}'>Excluir</a></td>                         
                                </tr>";
                                else
                                echo "
                                <tr id='plano-{$centro->intCentroCustosID}'>
                                    <td>{$centro->strCentroCustosNome}</td>
                                    <td>{$centro->strCentroCustosDesc}</td>                                                    
                                </tr>";

                            }
                        ?>
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
<div class="modal fade" id="cadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Plano</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?=URL;?>home/cadastrarCentro">
                <div class="modal-body">
                    <div class="row">
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for=nomec>Nome</label>
                                <input type=text id=nomec name="nome" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for=descc>Descrição</label>
                                <textarea id=descc name="desc" class="form-control">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Plano</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class=col-md-12>
                        <div class="form-group">
                            <label for=nome>Nome</label>
                            <input type=text id=nome class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=col-md-12>
                        <div class="form-group">
                            <label for=desc>Descrição</label>
                            <textarea id=desc class="form-control">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" id="salvarplano" class="btn btn-primary">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>
<script>
    function carregarInfoplano(idplano) {
        $("#nome").val($(`#plano-${idplano} td`)[0].innerHTML);
        $("#desc").val($(`#plano-${idplano} td`)[1].innerHTML);
        $("#salvarplano").attr("onclick", `salvarplano(${idplano})`);
    }
    function salvarplano(idplano) {
        $.ajax({
            url: '<?=URL;?>api/editarCentroCustos',
            method: 'POST',
            data: {
                intCentroCustosID: idplano,
                strCentroCustosNome: $("#nome").val(),
                strCentroCustosDesc: $("#desc").val()
            },
            dataType: 'json',
            async: false
        }).done(function (result) {
            if (result.success) {
                $(`#plano-${idplano} td`)[0].innerHTML = $("#nome").val();
                $(`#plano-${idplano} td`)[1].innerHTML = $("#desc").val();


                $("#editModal").modal('hide');
            }
        });

    }
</script>