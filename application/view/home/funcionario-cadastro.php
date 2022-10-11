<?php
if (isset($funcionario)) {
    $action = "editFuncionario";
    if (isset($_GET['aprovar'])) {
        $action = "editFuncionario?aprovar=true";
    }
} else {
    $action = "addColaborador";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            if (isset($funcionario)) {
                echo "Editar Colaborador";
            } else {
                echo "Cadastrar Colaborador";
            }
            ?>
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
        <?php elseif (isset($_GET['reapprove']) && $_GET['reapprove'] == 'true') : ?>
            <?php echo "<script>$(function () {toastr['success']('Reenviado para aprovação!')}); </script>";?>
        <?php elseif (isset($_GET['reapprove']) && $_GET['reapprove'] == 'error') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao reenviar para aprovação!') }); </script>"; ?>
        <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
            <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados!') }); </script>"; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12 col-sm-12">

                <form method="POST" action="<?php echo URL; ?>home/<?php echo $action; ?>" enctype='multipart/form-data'>

                    <!--box-body: Dados Pessoais -->
                    <div class="box box-primary">
                        <!--div class="box-header with-border">
                            <h3 class="box-title">Dados Pessoais</h3>
                        </div-->
                        <div class="box-body">

                            <div class="content">
                                <fieldset>
                                    <legend>Dados Pessoais</legend>
                                    <div class="form-group">
                                        <label for="nome">Nome Completo</label>
                                        <input required type="text" id="nome" name="nome" class="form-control" placeholder="Nome Completo" <?php if (isset($funcionario)) {
                                                                                                                                                echo "value='$funcionario->strFuncionarioNome'";
                                                                                                                                            } ?>>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rg">RG</label>
                                                <input type="text" id="rg" name="rg" class="form-control rg" placeholder="00.000.000-0" <?php if (isset($funcionario)) {
                                                                                                                                            echo "value='$funcionario->strFuncionarioRG'";
                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cpf">CPF</label>
                                                <input type="text" id="cpf" name="cpf" class="form-control cpf" placeholder="000.000.000-00" <?php if (isset($funcionario)) {
                                                                                                                                                    echo "value='$funcionario->strFuncionarioCPF'";
                                                                                                                                                } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nascimento">Data de Nascimento</label>
                                                <input type="date" id="nascimento" name="nascimento" class="form-control" <?php if (isset($funcionario)) {
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
                                                <input type="text" id="banco" name="banco" class="form-control" placeholder="Nome do Banco" <?php if (isset($funcionario)) {
                                                                                                                                                echo "value='$funcionario->strFuncionarioBanco'";
                                                                                                                                            } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <div class="form-group">
                                                <label for="agencia">Agência</label>
                                                <input type="text" id="agencia" name="agencia" class="form-control" placeholder="0000" <?php if (isset($funcionario)) {
                                                                                                                                            echo "value='$funcionario->strFuncionarioAgencia'";
                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Conta</label>
                                                <input type="text" id="conta" name="conta" class="form-control" placeholder="0000-0" <?php if (isset($funcionario)) {
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
                                                <input type="date" id="admissao" name="admissao" class="form-control" <?php if (isset($funcionario)) {
                                                                                                                            echo "value='$funcionario->strFuncionarioDateAdmissao'";
                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="registro">Data de Registro</label>
                                                <input type="date" id="registro" name="registro" class="form-control" <?php if (isset($funcionario)) {
                                                                                                                            echo "value='$funcionario->strFuncionarioDateRegistro'";
                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="cargo">Selecione o Cargo</label>
                                                <select name="cargo" id="cargo" class="form-control">
                                                    <?php foreach ($cargos as $c) : ?>
                                                        <option value="<?php echo $c->intCargoID; ?>" <?php if (isset($funcionario->intCargoID) && $funcionario->intCargoID == $c->intCargoID) : echo "selected";
                                                                                                        endif; ?>><?php echo $c->strCargoNome . " (" . $c->strDepartamentoNome . ")"; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--div class="col-md-12">

                                            <div class="form-group">
                                                <label for="obs">Observações</label>
                                                <textarea type=text name="obs" id="obs" class="form-control"></textarea>
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
                                                <input type="text" name="salario" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                                                echo "value='$funcionario->strFuncionarioSalarioBase'";
                                                                                                                                                            } ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="fora">Adicionais Eventuais</label>
                                                <input type="text" name="fora" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                                            echo "value='$funcionario->strFuncionarioPorFora'";
                                                                                                                                                        } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="creditos">Créditos</label>
                                                <input type="text" name="creditos" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                                echo "value='$funcionario->strFuncionarioCreditos'";
                                                                                                                                            } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="vr">Vale Refeição</label>
                                                <input type="text" id="vr" name="vr" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                    echo "value='$funcionario->strFuncionarioVR'";
                                                                                                                                } ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Vale Transporte</label>
                                                <input type="text" id="vt" name="vt" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                    echo "value='$funcionario->strFuncionarioVT'";
                                                                                                                                } ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="convenio">Convênio Básico</label>
                                                <input type="text" id="convenio" name="convenio" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                                echo "value='$funcionario->strFuncionarioConvenio'";
                                                                                                                                            } ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Adicional do Convênio (Plus)</label>
                                                <input type="text" id="conta" name="ac" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                            echo "value='$funcionario->strFuncionarioAdicional'";
                                                                                                                                        } ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group">
                                                <label for="conta">Plano Odontológico</label>
                                                <input id="conta" name="po" class="form-control money" placeholder="" <?php if (isset($funcionario)) {
                                                                                                                                            echo "value='$funcionario->strFuncionarioPlanoOdontologico'";
                                                                                                                                        } ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label for="pagamento">Data de Pagamento</label>
                                                <select name="pagamento" id="pagamento" class="form-control">
                                                    <option value="01" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '01') : echo "selected";
                                                                        endif; ?>>01</option>
                                                    <option value="02" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '02') : echo "selected";
                                                                        endif; ?>>02</option>
                                                    <option value="03" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '03') : echo "selected";
                                                                        endif; ?>>03</option>
                                                    <option value="04" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '04') : echo "selected";
                                                                        endif; ?>>04</option>
                                                    <option value="05" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '05') : echo "selected";
                                                                        endif; ?>>05</option>
                                                    <option value="06" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '06') : echo "selected";
                                                                        endif; ?>>06</option>
                                                    <option value="07" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '07') : echo "selected";
                                                                        endif; ?>>07</option>
                                                    <option value="08" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '08') : echo "selected";
                                                                        endif; ?>>08</option>
                                                    <option value="09" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '09') : echo "selected";
                                                                        endif; ?>>09</option>
                                                    <option value="10" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '10') : echo "selected";
                                                                        endif; ?>>10</option>
                                                    <option value="11" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '11') : echo "selected";
                                                                        endif; ?>>11</option>
                                                    <option value="12" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '12') : echo "selected";
                                                                        endif; ?>>12</option>
                                                    <option value="13" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '13') : echo "selected";
                                                                        endif; ?>>13</option>
                                                    <option value="14" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '14') : echo "selected";
                                                                        endif; ?>>14</option>
                                                    <option value="15" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '15') : echo "selected";
                                                                        endif; ?>>15</option>
                                                    <option value="16" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '16') : echo "selected";
                                                                        endif; ?>>16</option>
                                                    <option value="17" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '17') : echo "selected";
                                                                        endif; ?>>17</option>
                                                    <option value="18" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '18') : echo "selected";
                                                                        endif; ?>>18</option>
                                                    <option value="19" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '19') : echo "selected";
                                                                        endif; ?>>19</option>
                                                    <option value="20" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '20') : echo "selected";
                                                                        endif; ?>>20</option>
                                                    <option value="21" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '21') : echo "selected";
                                                                        endif; ?>>21</option>
                                                    <option value="22" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '22') : echo "selected";
                                                                        endif; ?>>22</option>
                                                    <option value="23" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '23') : echo "selected";
                                                                        endif; ?>>23</option>
                                                    <option value="24" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '24') : echo "selected";
                                                                        endif; ?>>24</option>
                                                    <option value="25" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '25') : echo "selected";
                                                                        endif; ?>>25</option>
                                                    <option value="26" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '26') : echo "selected";
                                                                        endif; ?>>26</option>
                                                    <option value="27" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '27') : echo "selected";
                                                                        endif; ?>>27</option>
                                                    <option value="28" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '28') : echo "selected";
                                                                        endif; ?>>28</option>
                                                    <option value="29" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '29') : echo "selected";
                                                                        endif; ?>>29</option>
                                                    <option value="30" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '30') : echo "selected";
                                                                        endif; ?>>30</option>
                                                    <option value="31" <?php if (isset($funcionario->strFuncionarioDatePagamento) && $funcionario->strFuncionarioDatePagamento == '31') : echo "selected";
                                                                        endif; ?>>31</option>
                                                </select>
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
                                                <label for=''>CPF</label>
                                                <input class='form-control' id='' type='file' name='fileFuncionarioCPF'>

                                                <?php if (isset($funcionario)) { ?><a data-fancybox data-type="pdf" data-width="800" data-height="auto" href="<?= URL ?><?= $funcionario->fileFuncionarioCPF ?>">Visualizar CPF</a><?php } ?>


                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''>RG</label>
                                                <input class='form-control' id='' type='file' name='fileFuncionarioRG'>
                                                <?php if (isset($funcionario)) { ?><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioRG ?>">Visualizar RG</a><?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''>Carteira de trabalho</label>
                                                <input class='form-control' id='' type='file' name='fileFuncionarioCarteiraTrabalho'>
                                                <?php if (isset($funcionario)) { ?><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioCarteiraTrabalho ?>">Visualizar Carteira de trabalho</a><?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''>PIS</label>
                                                <input class='form-control' id='' type='file' name='fileFuncionarioPis'>
                                                <?php if (isset($funcionario)) { ?><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioPis ?>">Visualizar PIS</a><?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''>Conprovante de endereço</label>
                                                <input class='form-control' id='' type='file' name='fileFuncionarioComprovanteEndereco'>
                                                <?php if (isset($funcionario)) { ?><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioComprovanteEndereco ?>">Visualizar Comprovante de endereço</a><?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">

                                            <div class='formgroup'>
                                                <label for=''>Titulo de eleitor</label>
                                                <input class='form-control' id='' type='file' name='fileFuncionarioTituloEleitor'>
                                                <?php if (isset($funcionario)) { ?><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioTituloEleitor ?>">Visualizar Titulo de eleitor</a><?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <div class='formgroup'>
                                                <label for=''>Exame Medico</label>
                                                <input class='form-control' id='' type='file' name='fileFuncionarioExameMedico'>
                                                <?php if (isset($funcionario)) { ?><a data-fancybox data-type="pdf" href="<?= URL ?><?= $funcionario->fileFuncionarioExameMedico ?>">Visualizar Exame Medico</a><?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                        </div>
                    </div>


                    <div class="box-footer">
                        <?php if (isset($funcionario)) : ?>
                            <input type="hidden" name="fID" value="<?php echo $funcionario->intFuncionarioID; ?>">
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Salvar Colaborador</button>
                        <?php if (isset($_GET['aprovar'])) : ?>
                            <a class='btn btn-success' href="<?php echo URL; ?>home/reapprovecolaborador/<?= $funcionario->intFuncionarioID; ?>" title="Reenviar para Aprovação">Reenviar para Aprovação</a>
                            <a class='btn btn-success' href="<?php echo URL; ?>home/approvefuncionario/<?= $funcionario->intFuncionarioID; ?>" title="Aprovar Colaborador">Aprovar</a>
                            <a class='btn btn-danger' href="#" data-toggle="modal" data-target="#modal" title="Reprovar Colaborador">Reprovar</a>
                        <?php endif; ?>

                    </div>
                </form>

                <div class="modal modal-info fade" id="modal">
                    <form action="<?= URL; ?>home/reproveFuncionario" method="post">
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
                                        <input type="text" readonly class="form-control" name="nome" value="<?= $funcionario->strFuncionarioNome; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Motivo de Reprovação</label>
                                        <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" value="<?= $funcionario->intFuncionarioID; ?>">
                                    <input type="hidden" name="adm" value="<?= $adm->strAdmNome; ?>">
                                    <input type="hidden" name="solicitante" value="<?= $adm->strAdmNome; ?>">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-outline">Reprovar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </form>
                </div>




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

<script>
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
</script>