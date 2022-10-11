<?php
if (isset($funcionario)) {
    $action = "editFuncionario";
} else {
    $action = "addfuncionario";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            Visualizar Colaborador
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <BR>
        <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
            <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>";?>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados!') }); </script>"; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form method="POST" action="<?php echo URL; ?>home/<?php echo $action; ?>" enctype='multipart/form-data'>
                    <div class="box box-primary">
                        <!--div class="box-header">
                            <h3 class="box-title">
                                Visualizar Funcionario
                            </h3>
                        </div-->
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="content">
                                <fieldset>
                                    <legend>Dados Pessoais</legend>
                                    <div class="form-group">
                                        <label for="nome">Nome Completo</label>
                                        <input readonly required type="text" id="nome" name="nome" class="form-control" placeholder="Nome Completo" <?php if (isset($funcionario)) {
                                                                                                                                                        echo "value='$funcionario->strFuncionarioNome'";
                                                                                                                                                    } ?>>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="rg">RG</label>
                                                <input readonly required type="text" id="rg" name="rg" class="form-control rg" placeholder="RG" <?php if (isset($funcionario)) {
                                                                                                                                                    echo "value='$funcionario->strFuncionarioRG'";
                                                                                                                                                } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cpf">CPF</label>
                                                <input readonly required type="text" id="cpf" name="cpf" class="form-control cpf" placeholder="CPF" <?php if (isset($funcionario)) {
                                                                                                                                                        echo "value='$funcionario->strFuncionarioCPF'";
                                                                                                                                                    } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nascimento">Data de Nascimento</label>
                                                <input readonly required type="date" id="nascimento" name="nascimento" class="form-control" <?php if (isset($funcionario)) {
                                                                                                                                                echo "value='$funcionario->strFuncionarioDateNascimento'";
                                                                                                                                            } ?>>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="content">
                                <fieldset>
                                    <legend>Dados Bancários</legend>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="banco">Banco</label>
                                                <input readonly required type="text" id="banco" name="banco" class="form-control" placeholder="Nome do Banco" <?php if (isset($funcionario)) {
                                                                                                                                                                    echo "value='$funcionario->strFuncionarioBanco'";
                                                                                                                                                                } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <div class="form-group">
                                                <label for="agencia">Agência</label>
                                                <input readonly required type="text" id="agencia" name="agencia" class="form-control" placeholder="Número da Agência" <?php if (isset($funcionario)) {
                                                                                                                                                                            echo "value='$funcionario->strFuncionarioAgencia'";
                                                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Conta</label>
                                                <input readonly required type="text" id="conta" name="conta" class="form-control" placeholder="Número da Conta" <?php if (isset($funcionario)) {
                                                                                                                                                                    echo "value='$funcionario->strFuncionarioConta'";
                                                                                                                                                                } ?>>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="content">
                                <fieldset>
                                    <legend>Dados Profissionais - Registro</legend>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="admissao">Data de Admissão</label>
                                                <input readonly required type="date" id="admissao" name="admissao" class="form-control" <?php if (isset($funcionario)) {
                                                                                                                                            echo "value='$funcionario->strFuncionarioDateAdmissao'";
                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="registro">Data de Registro</label>
                                                <input readonly required type="date" id="registro" name="registro" class="form-control" <?php if (isset($funcionario)) {
                                                                                                                                            echo "value='$funcionario->strFuncionarioDateRegistro'";
                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="obs">Cargo</label>
                                                <input readonly type=text name="cargo" id="cargo" class="form-control" value="<?php echo $funcionario->strCargoNome; ?>">
                                                
                                            </div>
                                        </div>
                                        <!--div class="col-md-12">
                                            <div class="form-group">
                                                <label for="obs">Observações</label>
                                                <textarea readonly type=text name="obs" id="obs" class="form-control"></textarea>
                                            </div>
                                        </div-->
                                    </div>
                                </fieldset>
                            </div>

                            <div class="content">
                                <fieldset>
                                    <legend>Dados Profissionais - Pagamentos</legend>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="salario">Salário Base</label>
                                                <input readonly required type="text" id="salario" name="salario" class="form-control money" placeholder="Salário" <?php if (isset($funcionario)) {
                                                                                                                                                                            echo "value='$funcionario->strFuncionarioSalarioBase'";
                                                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="fora">Adicionais Eventuais</label>
                                                <input readonly required type="text" id="fora" name="fora" class="form-control money" placeholder="Por Fora" <?php if (isset($funcionario)) {
                                                                                                                                                                            echo "value='$funcionario->strFuncionarioPorFora'";
                                                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="creditos">Créditos</label>
                                                <input readonly required type="text" id="creditos" name="creditos" class="form-control money" placeholder="Créditos" <?php if (isset($funcionario)) {
                                                                                                                                                                            echo "value='$funcionario->strFuncionarioCreditos'";
                                                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="vr">Vale Refeição</label>
                                                <input readonly type="text" id="vr" name="vr" class="form-control money" placeholder="Vale Refeição" <?php if(isset($funcionario)){ echo "value='$funcionario->strFuncionarioVR'"; } ?>>                                                                                                         
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Vale Transporte</label>
                                                <input readonly required type="text" id="conta" name="vt" class="form-control money" placeholder="Vale Transporte" <?php if (isset($funcionario)) {
                                                                                                                                                                        echo "value='$funcionario->strFuncionarioVT'";
                                                                                                                                                                    } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="convenio">Convênio Básico</label>
                                                <input readonly required type="text" id="convenio" name="convenio" class="form-control money" placeholder="Valor do Convênio" <?php if (isset($funcionario)) {
                                                                                                                                                                                    echo "value='$funcionario->strFuncionarioConvenio'";
                                                                                                                                                                                } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Adicional do Convênio (Plus)</label>
                                                <input readonly required type="currency" id="conta" name="ac" class="form-control money" placeholder="Adicional ao Convênio" <?php if (isset($funcionario)) {
                                                                                                                                                                                    echo "value='$funcionario->strFuncionarioAdicional'";
                                                                                                                                                                                } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Plano odontológico</label>
                                                <input readonly required type="currency" id="conta" name="po" class="form-control money" placeholder="Plano Odontologico" <?php if (isset($funcionario)) {
                                                                                                                                                                                echo "value='$funcionario->strFuncionarioPlanoOdontologico'";
                                                                                                                                                                            } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="total">Total Atual</label>
                                                <input readonly required type="text" id="total" name="total" class="form-control money" placeholder="Total Atual" <?php if (isset($funcionario)) {
                                                                                                                                                                        echo "value='$funcionario->strFuncionarioSalarioBruto'";
                                                                                                                                                                    } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="pagamento">Data de Pagamento</label>
                                                <input readonly name="pagamento" id="pagamento" class="form-control" value=<?= $funcionario->strFuncionarioDatePagamento ?>>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="content">
                                <fieldset>
                                    <legend>Documentos - Arquivos</legend>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''><a data-fancybox data-type="pdf" href="<?=URL?><?=$funcionario->fileFuncionarioCPF?>">Visualizar CPF</a></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioRG ?>">Visualizar RG</a></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioCarteiraTrabalho ?>">Visualizar Carteira de trabalho</a></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioPis ?>">Visualizar PIS</a></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioComprovanteEndereco ?>">Visualizar Conprovante de endereço</a></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioTituloEleitor ?>">Visualizar Titulo de eleitor</a></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioExameMedico ?>">Visualizar Exame Medico</a></label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>




                        </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo URL; ?>plugins/masks/jquery.mask.js"></script>

<!--script>
    $(document).ready(function() {
        $(".money").mask("#.##0,00", {
            reverse: true
        });
        $('#cep').mask('99999-999');
        $('#cpf').mask('999.999.999-99');
        $('#rg').mask('99.999.999-9');
        $('#celular').mask('(99) 99999-9999');
        $('#telefone').mask('(99) 9999-9999');
        $('#cnpj').mask('99.999.999/9999-99');
    });
</script-->