  <div class="content-wrapper">
    <section class="content-header">
      <h1>Fornecedores</h1>
      <ol class="breadcrumb">
        <li>
          <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
            <i class="fa fa-arrow-left"></i>Voltar
          </button>
        </li>
      </ol>
    </section>
    <section class="content container-fluid">
      <div class="box box-primary">
        <?php if (isset($obj)) {
          $url = 'editfornecedor';
        } else {
          $url = 'addfornecedor';
        } ?>
        <form action="<?php echo URL; ?>home/<?php echo $url ?>" method="POST" enctype='multipart/form-data'>
          <div class="box-body">

            <div class="content">
              <fieldset>
                <legend>Dados Empresariais</legend>
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">CNPJ</label>
                      <input readonly id="cnpj" value="<?php if (isset($obj->strFornecedorCnpj)) {
                                                          echo $obj->strFornecedorCnpj;
                                                        } ?>" type="text" required name="cnpj" id="cnpj" placeholder="" class="form-control">
                    </div>
                  </div>
                  <div id="cnpjDetails">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Razão Social</label>
                        <input readonly id="razao" value="<?php if (isset($obj->strFornecedorRazao)) {
                                                            echo $obj->strFornecedorRazao;
                                                          } ?>" type="text" required name="razao" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Nome Fantasia</label>
                        <input readonly id="fantasia" value="<?php if (isset($obj->strFornecedorFantasia)) {
                                                                echo $obj->strFornecedorFantasia;
                                                              } ?>" type="text" required name="fantasia" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Contato</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorContato)) {
                                                  echo $obj->strFornecedorContato;
                                                } ?>" type="text" name="contato" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">E-Mail</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorEmail)) {
                                                  echo $obj->strFornecedorEmail;
                                                } ?>" type="mail" name="email" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Telefone</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorTelefone)) {
                                                  echo $obj->strFornecedorTelefone;
                                                } ?>" type="text" name="telefone" id="celular" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">CEP</label>
                        <input readonly id="cep" value="<?php if (isset($obj->strFornecedorCep)) {
                                                          echo $obj->strFornecedorCep;
                                                        } ?>" type="text" name="cep" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Endereço</label>
                        <input readonly id="endereco" value="<?php if (isset($obj->strFornecedorEndereco)) {
                                                                echo $obj->strFornecedorEndereco;
                                                              } ?>" type="text" name="endereco" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Complemento</label>
                        <input readonly id="complemento" value="<?php if (isset($obj->strFornecedorComplemento)) {
                                                                  echo $obj->strFornecedorComplemento;
                                                                } ?>" type="text" name="complemento" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Cidade</label>
                        <input readonly id="cidade" value="<?php if (isset($obj->strFornecedorCidade)) {
                                                              echo $obj->strFornecedorCidade;
                                                            } ?>" type="text" name="cidade" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Estado</label>
                        <input readonly id="estado" value="<?php if (isset($obj->strFornecedorEstado)) {
                                                              echo $obj->strFornecedorEstado;
                                                            } ?>" type="text" name="estado" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Fornecedor VIP?</label>
                        <select readonly name="vip" class="form-control" onchange="showVip(this.value);">
                          <option value="  selected disabled>Selecione uma Opção</option>
                                        <option <?php if (isset($obj->strFornecedorVip) && $obj->strFornecedorVip == 'y') {
                                                  echo "selected";
                                                } ?> value=" y">Sim</option>
                          <option <?php if (isset($obj->strFornecedorVip) && $obj->strFornecedorVip == 'n') {
                                    echo "selected";
                                  } ?> value="n">Não</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>

            <div id="vip" <?php if (isset($obj->strFornecedorVip) && $obj->strFornecedorVip == 'y') {
                            echo "style='display: block;'";
                          } else {
                            echo "style='display: none;'";
                          } ?>>

              <div class="content">
                <fieldset>
                  <legend>Dados Pessoais</legend>
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Nome Completo</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorNome)) {
                                                  echo $obj->strFornecedorNome;
                                                } ?>" type="text" name="nome" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">RG</label>
                        <input readonly id="rg" value="<?php if (isset($obj->strFornecedorRg)) {
                                                          echo $obj->strFornecedorRg;
                                                        } ?>" type="text" name="rg" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">CPF</label>
                        <input readonly id="cpf" value="<?php if (isset($obj->strFornecedorCpf)) {
                                                          echo $obj->strFornecedorCpf;
                                                        } ?>" type="text" name="cpf" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Data de Nascimento</label>
                        <input readonly id="data" value="<?php if (isset($obj->strFornecedorNascimento)) {
                                                            echo $obj->strFornecedorNascimento;
                                                          } ?>" type="text" name="nascimento" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="content">
                <fieldset>
                  <legend>Dados Bancários</legend>
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Banco</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorBanco)) {
                                                  echo $obj->strFornecedorBanco;
                                                } ?>" type="text" name="banco" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Agência</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorAgencia)) {
                                                  echo $obj->strFornecedorAgencia;
                                                } ?>" type="text" name="agencia" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Conta</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorConta)) {
                                                  echo $obj->strFornecedorConta;
                                                } ?>" type="text" name="conta" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Favorecido</label>
                        <input readonly value="<?php if (isset($obj->strFornecedorFavorecido)) {
                                                  echo $obj->strFornecedorFavorecido;
                                                } ?>" type="text" name="favorecido" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="content">
                <fieldset>
                  <legend>Prestação de Serviço</legend>
                  <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Valor da Prestação de Serviço</label>
                        <input readonly type='currency' value="<?php if (isset($obj->strFornecedorValor)) {
                                                                  echo $obj->strFornecedorValor;
                                                                } ?>" name="valor" class="form-control money" placeholder="" />
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Plano Médico</label>
                        <input readonly type='currency' value="<?php if (isset($obj->strFornecedorPlanoMedico)) {
                                                                  echo $obj->strFornecedorPlanoMedico;
                                                                } ?>" name="planoMedico" class="form-control money" placeholder="" />
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Plano Médico Extra</label>
                        <input readonly type='currency' value="<?php if (isset($obj->strFornecedorExtra)) {
                                                                  echo $obj->strFornecedorExtra;
                                                                } ?>" name="Extra" class="form-control money" placeholder="" />
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Plano odontológico</label>
                        <input readonly type='currency' value="<?php if (isset($obj->strFornecedorPlanoOdontologico)) {
                                                                  echo $obj->strFornecedorPlanoOdontologico;
                                                                } ?>" name="po" class="form-control money" placeholder="" />
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Valor VT</label>
                        <input readonly type='currency' value="<?php if (isset($obj->strFornecedorVT)) {
                                                                  echo $obj->strFornecedorVT;
                                                                } ?>" name="VT" class="form-control money" placeholder="" />
                        <label for="descontar">Não descontar VT?</label>
                        <input readonly type=checkbox name="descontar" id=descontar value=1 <?php if (isset($obj->intFornecedorDescontoVT)) if ($obj->intFornecedorDescontoVT == 0) echo 'checked' ?>>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Valor VR</label>
                        <input readonly type='currency' value="<?php if (isset($obj->strFornecedorVR)) {
                                                                  echo $obj->strFornecedorVR;
                                                                } ?>" name="VR" class="form-control money" placeholder="" />
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Valor total do Serviço</label>
                        <input readonly type='currency' value="" name="valorTotalServico" class="form-control money" placeholder="" />
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label for="obs">Observações</label>
                        <textarea readonly type=text name="obs" id="obs" class="form-control" style="resize: none"></textarea>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="content">
                <fieldset>
                  <legend>Documentações - Arquivos</legend>
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class=form-group>
                        <a data-fancybox data-type="pdf" href='<?= URL ?><?= $obj->fileFornecedorCPF ?>'>Visualizar CPF</a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class=form-group>
                        <a data-fancybox data-type="pdf" href='<?= URL ?><?= $obj->fileFornecedorRG ?>'>Visualizar RG</a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class=form-group>
                        <a data-fancybox data-type="pdf" href='<?= URL ?><?= $obj->fileFornecedorComprovanteEndereço ?>'>Visualizar Comprovante de entereço</a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class=form-group>
                        <a data-fancybox data-type="pdf" href='<?= URL ?><?= $obj->fileFornecedorContratoSocial ?>'>Visualizar Contrato Social</a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class=form-group>
                        <a data-fancybox data-type="pdf" href='<?= URL ?><?= $obj->fileFornecedorCartãoCNPJ ?>'>Visualizar CNPJ</a>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class=form-group>
                        <a data-fancybox data-type="pdf" href='<?= URL ?><?= $obj->fileFornecedorContratoPrestação ?>'>Visualizar Contrato de prestação de serviço</a>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
        </form>
      </div>
    </section>
  </div>


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
      $('#data').mask('99/99/9999');
    });

    const INPUT_ENDERECO = document.querySelector('#endereco');
    const INPUT_CIDADE = document.querySelector('#cidade');
    const INPUT_ESTADO = document.querySelector('#estado');

    const buscarCEP = (cep) => {
      let check = false;
      if (cep.length < 8) return;
      let url = 'https://viacep.com.br/ws/${cep}/json/'.replace('${cep}', cep);
      fetch(url)
        .then((res) => {
          if (res.ok) {
            res.json().then((json) => {
              if (!json.erro) {
                // let endereco = json.logradouro;
                let endereco = json.logradouro;
                let cidade = json.localidade;
                let estado = json.uf;
                // Preenche os campos
                // INPUT_ENDERECO.value = endereco;
                INPUT_ENDERECO.value = endereco;
                INPUT_CIDADE.value = cidade;
                INPUT_ESTADO.value = estado;
              }
            });
          }
        });
    }

    let btnVerificarCEP = document.querySelector('#VerificarCEP');
    // Adiciona o evento click
    btnVerificarCEP.addEventListener('click', function(e) {
      let campoCEP = document.querySelector('#cep');
      buscarCEP(campoCEP.value);
    });
  </script>