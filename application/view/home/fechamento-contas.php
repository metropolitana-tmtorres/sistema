<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fechamento de Contas
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <?php if(isset($_GET['salvo'])) : ?>
                <button type="button" class="btn btn-info"
                    onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
                <?php else: ?>
                <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
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
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Fechamento de contas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?=URL;?>home/gerarFechamentoContas" method="post" class="inline-form">
                    <div class="row">
                        <div class=col-md-4>
                            <div class="form-group">
                                <label for=tipoFuncionario>Tipo de conta</label>
                                <select id=tipoFuncionario name="tipoFuncionario" class="form-control">
                                    <option value=0>Fornecedores Vip</option>
                                    <option value=1>Colaboradores</option>
                                </select>
                            </div>
                        </div>
                        <div class=col-md-1>
                            <div class="form-group">
                                <label for=mes>Mês</label>
                                <select id=mes name=mes required class="selectpicker form-control" data-live-search="true" searchable="Mês">
                                    <option value='01'>janeiro</option>
                                    <option value='02'>fevereiro</option>
                                    <option value='03'>março</option>
                                    <option value='04'>abril</option>
                                    <option value='05'>maio</option>
                                    <option value='06'>junho</option>
                                    <option value='07'>julho</option>
                                    <option value='08'>agosto</option>
                                    <option value='09'>setembro</option>
                                    <option value='10'>outubro</option>
                                    <option value='11'>novembro</option>
                                    <option value='12'>dezembro</option>
                                </select>                                
                            </div>
                        </div>
                        <div class=col-md-2>
                            <div class="form-group">
                                <label for=ano>Ano</label>
                                <input type=number id=ano class="form-control" name=ano value="<?php 
                                if(!isset($_POST['ano']))
                                    echo date("Y"); 
                                else  
                                    echo $_POST['ano']; 
                                
                                ?>">
                            </div>
                        </div>

                        <div class=col-md-1>
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary" name="sobrescrever" value="0"><i
                                        class="fa fa-plus"></i><?php if(in_array('fechamentoContas-add', $permissions)) echo "Gerar"; else echo"Consultar"; ?></button>
                            </div>
                        </div>
                        <div class=col-md-2>
                            <div class="form-group">
                                <br>
                                <?php if(in_array('fechamentoContas-add', $permissions)): ?>
                                    <button type="submit" class="btn btn-primary" name="sobrescrever" value="1"><i class="fa fa-plus"></i> Gerar + Sobrescrever</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=col-md-1>
                            <div class="form-group">
                                <br>
                                <?php if(isset($contasGeradas) && in_array('contasAPagar-add', $permissions)):?>
                                <a href="#" class="btn btn-success" data-toggle=modal data-target=#inserirModal><i
                                        class="fa fa-plus"></i>Inserir contas a pagar</a>
                                <?php endif?>
                            </div>
                        </div>
                    </div>
                </form>
                <?php  if(isset($contasGeradas)): ?>
                <form action="<?=URL;?>home/inserirContasFechadasAPagar" method="post" class="inline-form">
                <input type=checkbox name='IDS[]' value=0 checked style="display:none">
                    <table class="table table-bordered table-striped smarttable2">
                        <thead>
                            <tr>
                                <th><input id="selecionarTodos" type=checkbox ></th>
                                <th>Nome</th>
                                <th>Valor de registro</th>
                                <th>Débito</th>
                                <th>Plano odontológico</th>
                                <th>Plano saúde essencial (30%)</th>
                                <th>Plano saúde extra (100%)</th>
                                <th>Valor VR </th>
                                <th>Valor VT (6%)</th>
                                <th>Total</th>
                                <th>Vencimento</th>
                                <?php if(in_array('fechamentoContas-editar', $permissions)): ?>
                                <th>Editar</th>
                                <?php endif;?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            foreach($contasGeradas as $conta)
                            {
                                $inserido="";
                                if($conta->strFechamentoContasStatus=='inserido'){
                                    $inserido="<span class='badge badge-success' style='background-color:#28a745'>Inserido</span>";
                                }
                                if(in_array('fechamentoContas-editar', $permissions))
                                    $edit="  <td><a href='#editarConta' onclick=carregarInfoConta({$conta->intFechamentoContasID}) data-toggle=modal data-target=#editModal>Editar</a></td>";
                                else
                                    $edit="";
                                echo "
                                    <tr id='conta-{$conta->intFechamentoContasID}'>
                                        <td><input type=checkbox name='IDS[]' value={$conta->intFechamentoContasID} ></td>
                                        <td>{$conta->strFechamentoContasNome} {$inserido}</td>
                                        <td>{$conta->strFechamentoContasValorParcial}</td>
                                        <td>{$conta->strFechamentoContasDebito}</td>
                                        <td>{$conta->strFechamentoContasPlanoOdontologico}</td>
                                        <td>{$conta->strFechamentoContasPlanoSaude}</td>
                                        <td>{$conta->strFechamentoContasPlanoSaudeExtra}</td>
                                        <td>{$conta->strFechamentoContasValorVR}</td>
                                        <td>{$conta->strFechamentoContasValorVT}</td>
                                        <td>{$conta->strFechamentoContasValorTotal}</td>
                                        <td>{$conta->strFechamentoContasVencimento}</td>
                                        $edit
                                    </tr>";
                                
                                
                                
                            }
                        ?>
                        </tbody>
                    </table>

                    <div class="modal fade" id="inserirModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Inserir Contas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class=col-md-12>
                                            <div class="form-group">
                                                <label for=CentroCustos>Selecione um ou mais centro(s) de custos</label>

                                                <select id=CentroCustos multiple name="CentroCustos[]"
                                                    class="selectpicker form-control" data-live-search="true"
                                                    searchable="Buscar Centro de custos">
                                                    <?php
                                    foreach($CentroCustos as $CentroCustos){
                                        echo "<option value='{$CentroCustos->intCentroCustosID}'>{$CentroCustos->strCentroCustosNome}</option>";
                                    }
                                ?>
                                                </select>
                                                <input type=hidden name=mes value='<?=$_POST['mes']?>'>
                                                <input type=hidden name=ano value='<?=$_POST['ano']?>'>
                                                <input type=hidden name=tipoFuncionario
                                                    value='<?=$_POST['tipoFuncionario']?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <input type="submit" value='Inserir Registros' class="btn btn-primary" />
                                </div>

                            </div>
                        </div>
                    </div>
                    </form>
                    <?php endif;?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class=col-md-12>
                        <div class="form-group">
                            <label for=nomeConta>Nome</label>
                            <input type=text id=nomeConta class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=col-md-6>
                        <div class="form-group">
                            <label for=valorParcialConta>Valor parcial</label>
                            <input type=number id=valorParcialConta onchange="calcValorTotal()" class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class=col-md-6>
                        <div class="form-group">
                            <label for=debitoConta>Debito</label>
                            <input type=number id=debitoConta onchange="calcValorTotal()" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=col-md-12>
                        <div class="form-group">
                            <label for=planoOdontologico>Plano odontológico</label>
                            <input type=number id=planoOdontologico onchange="calcValorTotal()" class="form-control"
                                value="0">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=col-md-6>
                        <div class="form-group">
                            <label for=planoSaude>Plano saúde essencial (30%)</label>
                            <input type=number id=planoSaude onchange="calcValorTotal()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class=col-md-6>
                        <div class="form-group">
                            <label for=planoSaudeExtra>Plano saúde extra (100%)</label>
                            <input type=number id=planoSaudeExtra onchange="calcValorTotal()" class="form-control"
                                value="0">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=col-md-6>
                        <div class="form-group">
                            <label for=valorVR>Valor VR</label>
                            <input type=number id=valorVR onchange="calcValorTotal()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class=col-md-6>
                        <div class="form-group">
                            <label for=valorVT>Valor VT (6%)</label>
                            <input type=number id=valorVT onchange="calcValorTotal()" class="form-control" value="0">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=col-md-12>
                        <div class="form-group">
                            <label for=valorTotalConta>Valor total</label>
                            <input type=number id=valorTotalConta class="form-control" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=col-md-12>
                        <div class="form-group">
                            <label for=vencimentoConta>Vencimento</label>
                            <input type=date id=vencimentoConta class="form-control" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" id="salvarConta" class="btn btn-primary">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        <?php
        if (isset($_POST['tipoFuncionario'])) {
            echo "$('#tipoFuncionario').val({$_POST['tipoFuncionario']}).trigger('change');";
        } 


        if(!isset($_POST['mes'])){
            $mes=date("m");
            echo "$('#mes').val('{$mes}').trigger('change')";
        }
        else{     
            echo "$('#mes').val('{$_POST['mes']}').trigger('change')";
        }
        ?>

    }, 100);

    function calcValorTotal() {
        let valorParcialConta = $('#valorParcialConta').val() * 1;
        let debitoConta = $('#debitoConta').val() * 1;
        let planoOdontologico = $('#planoOdontologico').val() * 1;
        let planoSaude = $('#planoSaude').val() * 1;
        let planoSaudeExtra = $('#planoSaudeExtra').val() * 1;
        let valorVR = $('#valorVR').val() * 1;
        let valorVT = $('#valorVT').val() * 1;


        $('#valorTotalConta').val(valorParcialConta + debitoConta - planoOdontologico - planoSaude - planoSaudeExtra -
            valorVR - valorVT);
    }

    function carregarInfoConta(idConta) {
        let vencimentoConta = (date) => {
            let dateArray = date.split("/");
            return `${dateArray[2]}-${dateArray[1]}-${dateArray[0]}`;
        }
        $("#nomeConta").val($(`#conta-${idConta} td`)[1].innerHTML.split('<')[0]);
        $("#valorParcialConta").val($(`#conta-${idConta} td`)[2].innerHTML);
        $("#debitoConta").val($(`#conta-${idConta} td`)[3].innerHTML);
        $("#planoOdontologico").val($(`#conta-${idConta} td`)[4].innerHTML);
        $("#planoSaude").val($(`#conta-${idConta} td`)[5].innerHTML);
        $("#planoSaudeExtra").val($(`#conta-${idConta} td`)[6].innerHTML);
        $("#valorVR").val($(`#conta-${idConta} td`)[7].innerHTML);
        $("#valorVT").val($(`#conta-${idConta} td`)[8].innerHTML);
        $("#valorTotalConta").val($(`#conta-${idConta} td`)[9].innerHTML);
        $("#vencimentoConta").val(vencimentoConta($(`#conta-${idConta} td`)[10].innerHTML));
        $("#salvarConta").attr("onclick", `salvarConta(${idConta})`);
    }
    $("#selecionarTodos").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    function salvarConta(idConta) {
        let vencimentoConta = (date) => {
            let dateArray = date.split("-");
            return `${dateArray[2]}/${dateArray[1]}/${dateArray[0]}`;
        }
        $.ajax({
            url: '<?=URL;?>api/editarContas',
            method: 'POST',
            data: {
                intFechamentoContasID: idConta,
                strFechamentoContasNome: $("#nomeConta").val(),
                strFechamentoContasValorParcial: $("#valorParcialConta").val(),
                strFechamentoContasDebito: $("#debitoConta").val(),
                strFechamentoContasPlanoOdontologico: $("#planoOdontologico").val(),
                strFechamentoContasPlanoSaude: $("#planoSaude").val(),
                strFechamentoContasPlanoSaudeExtra: $("#planoSaudeExtra").val(),
                strFechamentoContasValorVR: $("#valorVR").val(),
                strFechamentoContasValorVT: $("#valorVT").val(),
                strFechamentoContasValorTotal: $("#valorTotalConta").val(),
                strFechamentoContasVencimento: vencimentoConta($("#vencimentoConta").val())
            },
            dataType: 'json',
            async: false
        }).done(function (result) {
            if (result.success) {
                $(`#conta-${idConta} td`)[1].innerHTML = $("#nomeConta").val();
                $(`#conta-${idConta} td`)[2].innerHTML = $("#valorParcialConta").val();
                $(`#conta-${idConta} td`)[3].innerHTML = $("#debitoConta").val();
                $(`#conta-${idConta} td`)[4].innerHTML = $("#planoOdontologico").val();
                $(`#conta-${idConta} td`)[5].innerHTML = $("#planoSaude").val();
                $(`#conta-${idConta} td`)[6].innerHTML = $("#planoSaudeExtra").val();
                $(`#conta-${idConta} td`)[7].innerHTML = $("#valorVR").val();
                $(`#conta-${idConta} td`)[8].innerHTML = $("#valorVT").val();
                $(`#conta-${idConta} td`)[9].innerHTML = $("#valorTotalConta").val();
                $(`#conta-${idConta} td`)[10].innerHTML = vencimentoConta($("#vencimentoConta").val());
                $("#editModal").modal('hide');
            }
        });

    }
</script>