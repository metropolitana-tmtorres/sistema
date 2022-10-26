<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contas a pagar
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
                <?php endif; if( in_array('contasAPagar-add', $permissions)):?>
                <button type="button" onclick="gerarFormContas(valoresPadrao)" class="btn-sm btn-register btn-flat" data-toggle=modal data-target=#cadModal>
                    <i class="fa fa-edit"></i> Cadastrar
                </button>
                <?php endif;?>
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
                <h3 class="box-title">Contas a pagar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class=col-md-2>
                        <div class="form-group">
                            <label for=status>Status</label>
                            <select id=status name="status" multiple class="selectpicker form-control">
                                <option value=aberto>Aberto</option>
                                <option value=pago>Pago</option>
                                <option value=vencido>Vencido</option>
                            </select>
                        </div>
                    </div>

                    <div class=col-md-3>
                        <div class="form-group">
                            <label for=CentroCustos>Centro de custos</label>
                            <select id=CentroCustos multiple name="CentroCustos" class="selectpicker form-control"
                                data-live-search="true" searchable="Buscar Centro de custos">
                                <?php
                                foreach($CentroCustos as $CentroCusto){
                                    echo "<option value='{$CentroCusto->intCentroCustosID}'>{$CentroCusto->strCentroCustosNome}</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="form-group">
                                <label for=PlanoContasCad>Sub Plano de Contas</label>
                                <select id=PlanoContas multiple onchange="" name="PlanoContas" class="selectpicker form-control" data-live-search="true">
                                    <?php
                                        foreach($SubPlanoContas as $SubPlanoConta){
                                            echo "<option value='{$SubPlanoConta->intSubPlanoContasID}'>{$SubPlanoConta->strPlanoContasNome} - {$SubPlanoConta->strSubPlanoContasNome} </option>";
                                        }
                                    ?>
                                </select>                                
                            </div>
                        </div>

                    <div class=col-md-1>
                        <div class="form-group">
                            <label for=mes>Mês</label>
                            <select id=mes name=mes class="selectpicker form-control" data-live-search="true" searchable="Mês">
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
                    <div class=col-md-1>
                        <div class="form-group">
                            <label for=ano>Ano</label>
                            <input type=number id=ano class="form-control" name=ano value="<?= date("Y");?>">
                        </div>
                    </div>

                    <div class=col-md-2>
                        <div class="form-group">
                            <br>
                            <a href="#" onclick='carregarContas()' class="btn btn-primary"><i class="fa fa-plus"></i>
                                Gerar</a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped smarttable2">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="cadModal" tabindex="-1" role="dialog" aria-labelledby="tituloJanela"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloJanela">Cadastrar Conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id=form>
                <div class="modal-body">
                    <div class="row">
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for=nomeConta>Nome</label>
                                <input type=text id=nomeConta name="nome" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for=valor>Valor</label>
                                <input type=number id=valor name="valor" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for=desc>Descrição</label>
                                <textarea id=desc name="desc" class="form-control">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=statusCad>Status</label>
                                <select id=statusCad name="status" class="selectpicker form-control">
                                    <option value=aberto>Aberto</option>
                                    <option value=pago>Pago</option>
                                    <option value=vencido>Vencido</option>
                                </select>
                            </div>
                        </div>
                        <div class=col-md-6>
                            <div class="form-group">
                                <label for=vencimentoConta>Vencimento</label>
                                <input type=date id=vencimentoConta name=vencimentoConta class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=col-md-6>
                            <div class="form-group">
                                <label for=mesForm>Mês</label>
                                <select id=mesForm name=mes class="selectpicker form-control" data-live-search="true" searchable="Mês">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=anoForm>Ano</label>
                                <input type=number name=ano id=anoForm class="form-control" value=<?= date('Y') ?>>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=CentroCustosCad>Centro de custos</label>
                                <select id=CentroCustosCad onchange="" multiple name="CentroCustos[]" class="selectpicker form-control" data-live-search="true" searchable="Buscar Centro de custos">
                                    <?php
                                        foreach($CentroCustos as $CentroCusto){
                                            echo "<option value='{$CentroCusto->intCentroCustosID}'>{$CentroCusto->strCentroCustosNome}</option>";
                                        }
                                    ?>
                                </select>                               
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=PlanoContasCad>Sub Plano de Contas</label>
                                <select id=PlanoContasCad onchange="" name="PlanoContas" class="selectpicker form-control" data-live-search="true" searchable="Buscar Centro de custos">
                                <?php
                                        foreach($SubPlanoContas as $SubPlanoConta){
                                            echo "<option value='{$SubPlanoConta->intPlanoContasID}'>{$SubPlanoConta->strSubPlanoContasNome} {$SubPlanoConta->strPlanoContasNome}</option>";
                                        }
                                    ?>
                                </select>                                
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <a onclick="salvarConta()" id="botaoSalvar" class="btn btn-primary">Salvar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(()=> {
        setTimeout(()=>{
        carregarContas();
        <?php
        
        if(!isset($_POST['mes'])){
            $mes=date("m");
            echo "$('#mes').val('{$mes}').trigger('change')";
        }
        else{     
            echo "$('#mes').val('{$_POST['mes']}').trigger('change')";
        }
        ?>

        },100
        );
    });
    let valoresPadrao={
        titulo:'Cadastrar conta',
        nomeConta: ' ',
        valor: '',
        desc: '',
        vencimentoConta:'20/<?=Date('m')?>/<?=Date('Y')?>',
        mes:'<?=Date('m')?>',
        ano:'<?=Date('Y')?>',
        CentroCustos:[],
        PlanoContas:'',
        status:'aberto',
        salvarAcao:'salvarConta()'
    }
    function carregarContas(){
        const dataTable=$('.smarttable2').DataTable();
        dataTable.clear();        
        $.ajax({
            url: '<?=URL;?>api/gerarContasAPagar',
            method: 'POST',
            data: {
                mes: $("#mes").val(),
                ano: $("#ano").val(),
                status: $("#status").val().join(","),
                CentroCustos: $("#CentroCustos").val().join(","),
                PlanoContas: $("#PlanoContas").val().join(",")
            },
            dataType: 'json',
            async: false
        }).done(function (result) {
           
            result.forEach((conta) => {               
                
                if(conta.strContasAPagarNome!==null){     
                    dataTable.row.add([conta.strContasAPagarNome,
                    conta.decContasAPagarValor,
                    conta.strContasAPagarVencimento,
                    conta.strContasAPagarStatus,
                    `<a href="#" data-toggle=modal data-target=#cadModal onclick="gerarFormContas({
                            titulo:'Editar conta',
                            nomeConta: '${conta.strContasAPagarNome}',
                            valor: '${conta.decContasAPagarValor}',
                            desc: '${conta.strContasAPagarDesc}',
                            vencimentoConta:'${conta.strContasAPagarVencimento}',
                            mes:'${conta.intContasAPagarMesRef}',
                            ano:'${conta.intContasAPagarAnoRef}',
                            CentroCustos:[${conta.intCentroCustosID}],
                            PlanoContas:${conta.intPlanoContasID},
                            status:'${conta.strContasAPagarStatus}',
                            salvarAcao:'salvarConta(${conta.intContasAPagarID})'
                    })">Editar</a>`,
                        `<a href="<?=URL;?>home/excluirContaAPagar?id=${conta.intContasAPagarID}">Excluir</a>`
                    ]);
                }
            });
            
            
            dataTable.draw();
            
        });
       


    }
    function salvarConta(id=0){
        let url=`<?=URL;?>api/cadastrarContaAPagar`;
        if(id!=0)
            url=`<?=URL;?>api/editarContaAPagar?id=${id}`;       
        $.ajax({
            url: url,
            method: 'POST',
            data: $('#form').serialize(),
            dataType: 'json',
            async: false
        }).done(function (result) {
            if(result.success){
                carregarContas();
                $("#cadModal").modal('hide');
            }
        });
    }
    function gerarFormContas(values){
        let vencimentoConta=(date)=>{
            let dateArray=date.split("/");
            return `${dateArray[2]}-${dateArray[1]}-${dateArray[0]}`;
        }
        $("#tituloJanela").text(values.titulo);
        $("#nomeConta").val(values.nomeConta);
        $("#valor").val(values.valor);
        $("#desc").val(values.desc);
        $("#vencimentoConta").val(vencimentoConta(values.vencimentoConta));
        $("#mesForm").val(values.mes).trigger('change');
        $("#anoForm").val(values.ano);
        $('#CentroCustosCad').val(values.CentroCustos).trigger('change');
        $('#PlanoContasCad').val(values.PlanoContas).trigger('change');
        $("#statusCad").val(values.status).trigger('change');
        $('#botaoSalvar').attr('onclick',values.salvarAcao);
    }  
</script>