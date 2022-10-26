  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <?php if (isset($obj)) {
                    echo 'Editar Cliente';
                } else {
                    echo 'Cadastrar Cliente';
                } ?>
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

      <?php if (isset($obj)) {
            $url = 'editcliente';
        } else {
            $url = 'addcliente';
        } ?>
      <section class="content container-fluid">
          <div class="box">

              <!-- /.box-header -->
              <div class="box-body">
                  <form method="POST" action="<?php echo URL; ?>home/<?php echo $url; ?>">
                      <div class="box-body">
                          <div class="content">
                              <fieldset>
                                  <legend>Dados Empresariais</legend>
                                  <div class="row">
                                      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">CNPJ</label>
                                              <div class="input-group">

                                                  <input id="cnpj" value="<?php if (isset($obj->strClienteCNPJ)) {
                                                                                echo $obj->strClienteCNPJ;
                                                                            } ?>" type="text" required name="cnpj" placeholder="" class="form-control">
                                                  <span class="input-group-btn"><input type="button" id="VerificarCNPJ" class="btn btn-primary" value="Verificar CNPJ" /></span>
                                              </div>
                                          </div>
                                      </div>

                                      <div id="cnpjDetails">
                                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                              <div class="form-group">
                                                  <label for="">Razão Social</label>
                                                  <input id="razao" type="text" value="<?php if (isset($obj->strClienteRazao)) {
                                                                                            echo $obj->strClienteRazao;
                                                                                        } ?>" name="razao" class="form-control">
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                              <div class="form-group">
                                                  <label for="">Nome Fantasia</label>
                                                  <input id="fantasia" type="text" required value="<?php if (isset($obj->strClienteFantasia)) {
                                                                                                        echo $obj->strClienteFantasia;
                                                                                                    } ?>" name="fantasia" class="form-control">
                                              </div>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">

                                              <div class="form-group">
                                                  <label for="">Contato</label>
                                                  <input type="text" value="<?php if (isset($obj->strClienteContato)) {
                                                                                echo $obj->strClienteContato;
                                                                            } ?>" name="contato" class="form-control">
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">

                                              <div class="form-group">
                                                  <label for="">Cargo do Contato</label>
                                                  <input type="text" value="<?php if (isset($obj->strClienteContatoCargo)) {
                                                                                echo $obj->strClienteContatoCargo;
                                                                            } ?>" name="cargo" class="form-control">
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                              <div class="form-group">
                                                  <label for="">E-Mail</label>
                                                  <input type="mail" value="<?php if (isset($obj->strClienteEmail)) {
                                                                                echo $obj->strClienteEmail;
                                                                            } ?>" name="email" class="form-control">
                                              </div>
                                          </div>
                                          <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                              <div class="form-group">
                                                  <label for="">Telefone</label>
                                                  <input type="text" value="<?php if (isset($obj->strClienteTelefone)) {
                                                                                echo $obj->strClienteTelefone;
                                                                            } ?>" name="telefone" id="telefone" class="telefone form-control">
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                              <div class="form-group">
                                                  <label for="cep">CEP</label>
                                                  <div class="input-group">
                                                      <input id="cep" value="<?php if (isset($obj->strClienteCep)) {
                                                                                    echo $obj->strClienteCep;
                                                                                } ?>" type="text" name="cep" class="form-control" placeholder="">
                                                      <span class="input-group-btn"><input type="button" id="VerificarCEP" class="btn btn-primary" value="Verificar" /></span>
                                                  </div>
                                              </div>

                                          </div>
                                      </div>
                                      <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Endereço</label>
                                              <input id="endereco" type="text" value="<?php if (isset($obj->strClienteEndereco)) {
                                                                                            echo $obj->strClienteEndereco;
                                                                                        } ?>" name="endereco" id="endereco" class="form-control">
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
                                              <label for="cidade">Cidade</label>
                                              <input id="cidade" type="text" value="<?php if (isset($obj->strClienteCidade)) {
                                                                                        echo $obj->strClienteCidade;
                                                                                    } ?>" class="form-control" name="cidade" id="cidade" />
                                          </div>
                                      </div>
                                      <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="cidade">Estado</label>
                                              <input type="text" value="<?php if (isset($obj->strClienteEstado)) {
                                                                            echo $obj->strClienteEstado;
                                                                        } ?>" class="form-control" name="estado" id="estado" />
                                          </div>
                                      </div>













                                  </div>
                              </fieldset>
                          </div>



                          <div class="content">
                              <fieldset>
                                  <legend>Dados Pessoais</legend>
                                  <div class="row">
                                      <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">

                                          <div class="form-group">
                                              <label for="">Responsável</label>
                                              <input type="text" value="<?php if (isset($obj->strClienteResponsavel)) {
                                                                            echo $obj->strClienteResponsavel;
                                                                        } ?>" name="responsavel" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">RG do Responsável</label>
                                              <input type="text" value="<?php if (isset($obj->strClienteRg)) {
                                                                            echo $obj->strClienteRg;
                                                                        } ?>" name="rg" id="rg" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">CPF do Responsável</label>
                                              <input type="text" value="<?php if (isset($obj->strClienteCpf)) {
                                                                            echo $obj->strClienteCpf;
                                                                        } ?>" id="cpf" name="cpf" class="form-control">
                                          </div>
                                      </div>




                                      <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">

                                          <div class="form-group">
                                              <label for="">Celular</label>
                                              <input type="text" value="<?php if (isset($obj->strClienteCelular)) {
                                                                            echo $obj->strClienteCelular;
                                                                        } ?>" name="celular" id="celular" class="telefone form-control">
                                          </div>
                                      </div>
                                  </div>
                              </fieldset>
                          </div>

                          <div class="content">
                              <fieldset>
                                  <legend>Ramo de atividade</legend>
                                  <div class="row">
                                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Segmento de Mercado</label>
                                              <select name="segmento" id="" class="form-control">
                                                  <?php foreach ($segmentos as $s) : ?>
                                                      <option value="<?php echo $s->intSegmentoID; ?>"><?php echo $s->strSegmentoNome; ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="">Agência <small>(opcional)</small></label>
                                              <select name="agencia" id="" class="form-control">
                                                  <option value="0" disabled>Selecione uma Agência</option>
                                                  <?php foreach ($agencias as $a) : ?>
                                                      <option value="<?php echo $a->intAgenciaID; ?>"><?php echo $a->strAgenciaNome; ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </fieldset>
                          </div>
                      </div>






                      <?php if (isset($obj)) : ?>
                          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                          <input name="clienteId" type="hidden" value="<?php echo $obj->intClienteID; ?>">
                          <button type="submit" class="btn btn-primary">Editar Cliente</button>
                      <?php else : ?>
                          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                          <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
                      <?php endif; ?>

              </div>
              </form>
          </div>
  </div>

  <script src="<?php echo URL; ?>plugins/masks/jquery.mask.js"></script>
  <script>
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