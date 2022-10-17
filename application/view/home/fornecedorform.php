  <div class="content-wrapper">
    <section class="content-header">
      <h1>Fornecedores</h1>
      <ol class="breadcrumb">
        <li>
          <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
            <i class="fa fa-arrow-left"></i> Voltar
          </button>
        </li>
      </ol>
    </section>
    <section class="content container-fluid">
      <br>
      <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
        <div class="alert alert-success">Dados salvos com sucesso</div>
      <?php elseif (isset($_GET['reapprove']) && $_GET['reapprove'] == 'true') : ?>
        <div class="alert alert-success">Reenviado para aprovação com sucesso!</div>
      <?php elseif (isset($_GET['reapprove']) && $_GET['reapprove'] == 'error') : ?>
        <div class="alert alert-danger">Houve um erro ao reenviar para aprovação!</div>
      <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
        <div class="alert alert-danger">Houve um erro ao salvar os dados</div>
      <?php endif; ?>

      <div class="box">
      <?php if (isset($obj)) {
          if (isset($_GET['aprovar']))  $url = 'editfornecedor?aprovar=true';
          else $url = 'editfornecedor';
        } else {
          $url = 'addfornecedor';
        } ?>
        <form action="<?php echo URL; ?>home/<?php echo $url ?>" method="POST" enctype='multipart/form-data'>
          <div class="box-body">

            <div class="content">
              <fieldset>
                <legend>Dados empresariais</legend>
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">CNPJ</label>
                      <div class="input-group">

                        <input id="cnpj" value="<?php if (isset($obj->strFornecedorCnpj)) {
                                                  echo $obj->strFornecedorCnpj;
                                                } ?>" type="text" required name="cnpj" placeholder="" class="form-control">
                        <span class="input-group-btn"><input type="button" id="VerificarCNPJ" class="btn btn-primary" value="Verificar CNPJ" /></span>
                      </div>
                    </div>
                  </div>

                  <div id="cnpjDetails">


                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Razão Social</label>
                        <input id="razao" value="<?php if (isset($obj->strFornecedorRazao)) {
                                                    echo $obj->strFornecedorRazao;
                                                  } ?>" type="text" required name="razao" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Nome Fantasia</label>
                        <input id="fantasia" value="<?php if (isset($obj->strFornecedorFantasia)) {
                                                      echo $obj->strFornecedorFantasia;
                                                    } ?>" type="text" required name="fantasia" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Contato</label>
                        <input value="<?php if (isset($obj->strFornecedorContato)) {
                                        echo $obj->strFornecedorContato;
                                      } ?>" type="text" name="contato" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">E-Mail</label>
                        <input value="<?php if (isset($obj->strFornecedorEmail)) {
                                        echo $obj->strFornecedorEmail;
                                      } ?>" type="mail" name="email" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Telefone</label>
                        <input value="<?php if (isset($obj->strFornecedorTelefone)) {
                                        echo $obj->strFornecedorTelefone;
                                      } ?>" type="text" name="telefone" id="telefone" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">CEP</label>
                        <div class="input-group">
                          <input id="cep" value="<?php if (isset($obj->strFornecedorCep)) {
                                                    echo $obj->strFornecedorCep;
                                                  } ?>" type="text" name="cep" class="form-control" placeholder="">
                          <span class="input-group-btn"> <input type="button" id="VerificarCEP" class="btn btn-primary" value="Verificar" /></span>
                        </div>

                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Endereço</label>
                        <input id="endereco" value="<?php if (isset($obj->strFornecedorEndereco)) {
                                                      echo $obj->strFornecedorEndereco;
                                                    } ?>" type="text" name="endereco" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">

                      <div class="form-group">
                        <label for="">Complemento</label>
                        <input id="complemento" value="<?php if (isset($obj->strFornecedorComplemento)) {
                                                          echo $obj->strFornecedorComplemento;
                                                        } ?>" type="text" name="complemento" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Cidade</label>
                        <input id="cidade" value="<?php if (isset($obj->strFornecedorCidade)) {
                                                    echo $obj->strFornecedorCidade;
                                                  } ?>" type="text" name="cidade" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Estado</label>
                        <input id="estado" value="<?php if (isset($obj->strFornecedorEstado)) {
                                                    echo $obj->strFornecedorEstado;
                                                  } ?>" type="text" name="estado" class="form-control" placeholder="">
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Fornecedor VIP?</label>
                        <select name="vip" class="form-control" onchange="showVip(this.value);">
                          <option value="" selected disabled>Selecione uma Opção</option>
                          <option <?php if (isset($obj->strFornecedorVip) && $obj->strFornecedorVip == 'y') {
                                    echo "selected";
                                  } ?> value="y">Sim</option>
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
                        <input value="<?php if (isset($obj->strFornecedorNome)) {
                                        echo $obj->strFornecedorNome;
                                      } ?>" type="text" name="nome" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">RG</label>
                        <input id="rg" value="<?php if (isset($obj->strFornecedorRg)) {
                                                echo $obj->strFornecedorRg;
                                              } ?>" type="text" name="rg" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">CPF</label>
                        <input id="cpf" value="<?php if (isset($obj->strFornecedorCpf)) {
                                                  echo $obj->strFornecedorCpf;
                                                } ?>" type="text" name="cpf" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Data de Nascimento</label>
                        <input id="data" value="<?php if (isset($obj->strFornecedorNascimento)) {
                                                  echo $obj->strFornecedorNascimento;
                                                } ?>" type="text" name="nascimento" class="form-control" placeholder="">
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
                        <input value="<?php if (isset($obj->strFornecedorBanco)) {
                                        echo $obj->strFornecedorBanco;
                                      } ?>" type="text" name="banco" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                      <div class="form-group">
                        <label for="">Agência</label>
                        <input value="<?php if (isset($obj->strFornecedorAgencia)) {
                                        echo $obj->strFornecedorAgencia;
                                      } ?>" type="text" name="agencia" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                      <div class="form-group">
                        <label for="">Conta</label>
                        <input value="<?php if (isset($obj->strFornecedorConta)) {
                                        echo $obj->strFornecedorConta;
                                      } ?>" type="text" name="conta" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="">Favorecido</label>
                        <input value="<?php if (isset($obj->strFornecedorFavorecido)) {
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

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="cargo">Selecione o Cargo</label>
                      <select name="cargo" id="cargo" class="form-control">
                        <?php foreach ($cargos as $c) : ?>
                          <option value="<?php echo $c->intCargoID; ?>"><?php echo $c->strCargoNome . "(" . $c->strDepartamentoNome . ")"; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Valor da Prestação de Serviço</label>
                      <input type='currency' value="<?php if (isset($obj->strFornecedorValor)) {
                                                      echo $obj->strFornecedorValor;
                                                    } ?>" name="valor" class="form-control money" placeholder="" />
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Plano Médico</label>
                      <input type='currency' value="<?php if (isset($obj->strFornecedorPlanoMedico)) {
                                                      echo $obj->strFornecedorPlanoMedico;
                                                    } ?>" name="planoMedico" class="form-control money" placeholder="" />
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Plano Médico Extra</label>
                      <input type='currency' value="<?php if (isset($obj->strFornecedorExtra)) {
                                                      echo $obj->strFornecedorExtra;
                                                    } ?>" name="Extra" class="form-control money" placeholder="" />
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Plano odontológico</label>
                      <input type='currency' value="<?php if (isset($obj->strFornecedorPlanoOdontologico)) {
                                                      echo $obj->strFornecedorPlanoOdontologico;
                                                    } ?>" name="po" class="form-control money" placeholder="" />
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Valor VT</label>
                      <input type='currency' value="<?php if (isset($obj->strFornecedorVT)) {
                                                      echo $obj->strFornecedorVT;
                                                    } ?>" name="VT" class="form-control money" placeholder="" />
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Valor VR</label>
                      <input type='currency' value="<?php if (isset($obj->strFornecedorVR)) {
                                                      echo $obj->strFornecedorVR;
                                                    } ?>" name="VR" class="form-control money" placeholder="" />
                    </div>
                  </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="total_calculado">Total</label>
                            <input type='currency' id="total_calculado" class="form-control" style="resize: none"
                                   readonly disabled
                                   value="<?php if (isset($obj->decimalValorTotal) && $obj->decimalValorTotal) {
                                       echo $obj->decimalValorTotal;
                                   } ?>"
                            />
                        </div>
                    </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="obs">Observações</label>
                      <textarea type=text name="obs" id="obs" class="form-control" style="resize: none"></textarea>
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="content">
                <fieldset>
                  <legend>Documentações - Arquivos</legend>

                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class=form-group>
                            <label for=''>CPF</label>
                            <input class='form-control' type=file name='fileFornecedorCPF'>
                            <?php
                            if ($obj && file_exists($obj->fileFornecedorCPF)) {
                                $file = URL . '' . $obj->fileFornecedorCPF;
                            ?>
                                <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar RG</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class=form-group>
                            <label for=''>RG</label>
                            <input class='form-control' type=file name='fileFornecedorRG'>
                            <?php
                            if ($obj && file_exists($obj->fileFornecedorRG)) {
                                $file = URL . '' . $obj->fileFornecedorRG;
                                ?>
                                <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar RG</a>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class=form-group>
                            <label for=''>Comprovante de endereço</label>
                            <input class='form-control' type=file name='fileFornecedorComprovanteEndereço'>
                            <?php
                            if ($obj && file_exists($obj->fileFornecedorComprovanteEndereço)) {
                                $file = URL . '' . $obj->fileFornecedorComprovanteEndereço;
                                ?>
                                <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar Comprovante de
                                    Endereço</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class=form-group>
                            <label for=''>Contrato Social</label>
                            <input class='form-control' type=file name='fileFornecedorContratoSocial'>
                            <?php
                            if ($obj && file_exists($obj->fileFornecedorContratoSocial)) {
                                $file = URL . '' . $obj->fileFornecedorContratoSocial;
                                ?>
                                <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar Contrato Social</a>
                            <?php } ?>
                        </div>
                    </div>

                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class=form-group>
                      <label for=''>CNPJ</label>
                      <input class='form-control' type=file name='fileFornecedorCartãoCNPJ'>
                      <?php
                      if ($obj && file_exists($obj->fileFornecedorCartãoCNPJ)) {
                          $file =  URL . '' . $obj->fileFornecedorCartãoCNPJ;
                      ?>
                        <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar CNPJ</a>
                      <?php } ?>
                    </div>
                  </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class=form-group>
                            <label for=''>Contrato de prestação de serviço</label>
                            <input class='form-control' type=file name='fileFornecedorContratoPrestação'>
                            <?php
                            if ($obj && file_exists($obj->fileFornecedorContratoPrestação)) {
                                $file = URL . '' . $obj->fileFornecedorContratoPrestação;
                                ?>
                                <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar Contrato de prestação de
                                    serviço</a>
                            <?php } else {
                                echo "Não enviado.<br>";
                            } ?>
                        </div>
                    </div>

                </fieldset>
              </div>

            </div>

            <!--div class="row">
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">Nome Completo</label>
                  <input value="<?php if (isset($obj->strFornecedorNome)) {
                                  echo $obj->strFornecedorNome;
                                } ?>" type="text" name="nome" class="form-control" placeholder='Informe o nome completo'>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">RG</label>
                  <input id="rg" value="<?php if (isset($obj->strFornecedorRg)) {
                                          echo $obj->strFornecedorRg;
                                        } ?>" type="text" name="rg" class="form-control" placeholder='Informe o RG'>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">CPF</label>
                  <input id="cpf" value="<?php if (isset($obj->strFornecedorCpf)) {
                                            echo $obj->strFornecedorCpf;
                                          } ?>" type="text" name="cpf" class="form-control" placeholder='Informe o CPF'>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">Data de Nascimento</label>
                  <input id="data" value="<?php if (isset($obj->strFornecedorNascimento)) {
                                            echo $obj->strFornecedorNascimento;
                                          } ?>" type="text" name="nascimento" class="form-control" placeholder='Informe a data de nascimento'>
                </div>
              </div>


              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">Banco</label>
                  <input value="<?php if (isset($obj->strFornecedorBanco)) {
                                  echo $obj->strFornecedorBanco;
                                } ?>" type="text" name="banco" class="form-control" placeholder='Informe o nome do banco'>
                </div>
              </div>
              <div class="col-xs-1">
                <div class="form-group">
                  <label for="">Agência</label>
                  <input value="<?php if (isset($obj->strFornecedorAgencia)) {
                                  echo $obj->strFornecedorAgencia;
                                } ?>" type="text" name="agencia" class="form-control" placeholder='Informe a agência com o dígito'>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group">
                  <label for="">Conta</label>
                  <input value="<?php if (isset($obj->strFornecedorConta)) {
                                  echo $obj->strFornecedorConta;
                                } ?>" type="text" name="conta" class="form-control" placeholder='Informe a conta com o dígito'>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">Favorecido</label>
                  <input value="<?php if (isset($obj->strFornecedorFavorecido)) {
                                  echo $obj->strFornecedorFavorecido;
                                } ?>" type="text" name="favorecido" class="form-control" placeholder='Informe o favorecido da conta'>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">


                <div class="form-group">
                  <label for="">Valor</label>
                  <input type='currency' value="<?php if (isset($obj->strFornecedorValor)) {
                                                  echo $obj->strFornecedorValor;
                                                } ?>" name="valor" class="form-control money" placeholder='Informe o valor mensal' />
                </div>
              </div>




              <div class="col-xs-12">
                <div class="form-group">
                  <label for="cargo">Selecione o Cargo</label>
                  <select name="cargo" id="cargo" class="form-control">
                    <?php foreach ($cargos as $c) : ?>
                      <option value="<?php echo $c->intCargoID; ?>"><?php echo $c->strCargoNome . "(" . $c->strDepartamentoNome . ")"; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="obs">Observações</label>
                  <textarea type=text name="obs" id="obs" class="form-control"></textarea>
                </div>
              </div>

              <div class="col-xs-2">
                <div class="form-group">
                  <label for="">Valor VT</label>
                  <input type='currency' value="<?php if (isset($obj->strFornecedorVT)) {
                                                  echo $obj->strFornecedorVT;
                                                } ?>" name="VT" class="form-control money" placeholder='Informe o valor do VT' />
                  <label for="descontar">Não descontar VT?</label>
                  <input type=checkbox name="descontar" id=descontar value=1 <?php if (isset($obj->intFornecedorDescontoVT)) if ($obj->intFornecedorDescontoVT == 0) echo 'checked' ?>>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group">
                  <label for="">Valor VR</label>
                  <input type='currency' value="<?php if (isset($obj->strFornecedorVR)) {
                                                  echo $obj->strFornecedorVR;
                                                } ?>" name="VR" class="form-control money" placeholder='Informe o valor do VR' />
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group">
                  <label for="">Plano Médico</label>
                  <input type='currency' value="<?php if (isset($obj->strFornecedorPlanoMedico)) {
                                                  echo $obj->strFornecedorPlanoMedico;
                                                } ?>" name="planoMedico" class="form-control money" placeholder='Informe o valor do plano medico' />
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">Plano Médico Extra</label>
                  <input type='currency' value="<?php if (isset($obj->strFornecedorExtra)) {
                                                  echo $obj->strFornecedorExtra;
                                                } ?>" name="Extra" class="form-control money" placeholder='Informe o valor extra do plano medico' />
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="">Plano odontológico</label>
                  <input type='currency' value="<?php if (isset($obj->strFornecedorPlanoOdontologico)) {
                                                  echo $obj->strFornecedorPlanoOdontologico;
                                                } ?>" name="po" class="form-control money" placeholder='Informe o valor extra do plano medico' />
                </div>
              </div>










              <div class="col-xs-12">
                <h3>Arquivos</h3>
                <hr>
                <div class=form-group>
                  <label for=''>CPF</label>
                  <input class='form-control' type=file name='fileFornecedorCPF'>
                  <?php
                  $file =  URL . '' . $obj->fileFornecedorCPF;
                  if (file_exists($obj->fileFornecedorCPF)) {
                  ?>
                    <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar CPF</a>
                  <?php
                  }
                  ?>

                </div>
                <div class=form-group>
                  <label for=''>RG</label>
                  <input class='form-control' type=file name='fileFornecedorRG'>
                  <?php
                  $file =  URL . '' . $obj->fileFornecedorRG;
                  if (file_exists($obj->fileFornecedorRG)) {
                  ?>
                    <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar RG</a>
                  <?php
                  }
                  ?>

                </div>
                <div class=form-group>
                  <label for=''>Comprovante de endereço</label>
                  <input class='form-control' type=file name='fileFornecedorComprovanteEndereço'>
                  <?php
                  $file =  URL . '' . $obj->fileFornecedorComprovanteEndereço;
                  if (file_exists($obj->fileFornecedorComprovanteEndereço)) {
                  ?>
                    <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar Comprovante de Endereço</a>
                  <?php
                  }
                  ?>

                </div>
                <div class=form-group>
                  <label for=''>Contrato Social</label>
                  <input class='form-control' type=file name='fileFornecedorContratoSocial'>
                  <?php
                  $file =  URL . '' . $obj->fileFornecedorContratoSocial;
                  if (file_exists($obj->fileFornecedorContratoSocial)) {
                  ?>
                    <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar Contrato Social</a>
                  <?php
                  }
                  ?>

                </div>
                <div class=form-group>
                  <label for=''>CNPJ</label>
                  <input class='form-control' type=file name='fileFornecedorCartãoCNPJ'>
                  <?php
                  $file =  URL . '' . $obj->fileFornecedorCartãoCNPJ;
                  if (file_exists($obj->fileFornecedorCartãoCNPJ)) {
                  ?>
                    <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar CNPJ</a>
                  <?php
                  }
                  ?>

                </div>
                <div class=form-group>
                  <label for=''>Contrato de prestação de serviço</label>
                  <input class='form-control' type=file name='fileFornecedorContratoPrestação'>
                  <?php
                  $file =  URL . '' . $obj->fileFornecedorContratoPrestação;
                  if (file_exists($obj->fileFornecedorContratoPrestação)) { ?>
                    <a data-fancybox data-type="pdf" href='<?= $file ?>'>Visualizar Contrato de prestação de serviço</a>
                  <?php } else {
                    echo "Não enviado.<br>";
                  } ?>

                </div>

              </div>


            </div-->

            <div class="row">
              <div class="col-xs-12">
                <?php if (isset($obj)) : ?>
                  <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                  <input name="fornecedorId" type="hidden" value="<?php echo $obj->intFornecedorID; ?>">
                  <button type="submit" class="btn btn-primary">Salvar Fornecedor</button>
                <?php else : ?>
                  <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                  <button type="submit" class="btn btn-primary">Salvar Fornecedor</button>
                <?php endif; ?>

                <?php if (isset($_GET['aprovar'])) : ?>
                  <a class='btn btn-success' href="<?php echo URL; ?>home/reapprovefornecedor/<?= $obj->intFornecedorID ?>" title="Reenviar para Aprovação">Reenviar para Aprovação</a>
                  <?php if (in_array('aprovarFornecedores', $permissions)) { ?>
                    <a class='btn btn-success' href="<?php echo URL; ?>home/approvefornecedor/<?= $obj->intFornecedorID ?>" title="Aprovar Fornecedor">Aprovar</a>
                    <a class='btn btn-danger' href="#" data-toggle="modal" data-target="#modal-<?= $obj->intFornecedorID ?>" title="Reprovar Fornecedor">Reprovar</a>
                  <?php } ?>
                <?php endif; ?>
              </div>
            </div>

          </div>





        </form>
      </div>
      <!-- /.box-body -->
  </div>
  <!-- /.box -->


  <!-- /.content-wrapper -->
  <?php if (isset($_GET['aprovar'])) : ?>
    <div class="modal modal-info fade" id="modal-<?= $obj->intFornecedorID; ?>">
      <form action="<?= URL; ?>home/reproveFornecedor" method="post">
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
                <input type="text" readonly class="form-control" name="fantasia" value="<?= $obj->strFornecedorFantasia; ?>">
              </div>
              <div class="form-group">
                <label for="">Motivo de Reprovação</label>
                <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="id" value="<?= $obj->intFornecedorID; ?>">
              <input type="hidden" name="adm" value="<?= $adm->strAdmNome; ?>">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-outline">Reprovar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </form>
    </div>
  <?php endif; ?>


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

      <?php if (isset($obj)) : ?>
        $('#cargo').val(<?= $obj->intCargoID ?>).trigger('change');
      <?php endif; ?>
        $("form input[type=currency]").change(function () {
            var valor_total = 0;
            $("form input[type=currency][id!=total_calculado]").each(function (index, element) {
                var value = $(element).val();
                if(value){
                    valor_total = valor_total + parseFloat(value.replace(".","").replace(",","."));
                }
            })
            $("#total_calculado").val((valor_total.toFixed(2)+"").replace(".",","))

        })
    });

    const INPUT_ENDERECO = document.querySelector('#endereco');
    const INPUT_CIDADE = document.querySelector('#cidade');

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