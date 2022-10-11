
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if(isset($obj)) {echo 'Editar Contrato';} else {echo 'Cadastrar Contrato';} ?>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
            <button type="button" class="btn btn-info" onclick="window.history.go(-1); return false;">
                <i class="fa fa-arrow-left"></i> Voltar
            </button>
        </li>
      </ol>
    </section>
    
    <?php if(isset($obj)) {$url = 'editContrato';} else {$url = 'addContrato';} ?>

    <form method="POST" action="<?php echo URL; ?>home/<?php echo $url; ?>" enctype="multipart/form-data">
    <div class="box-body">
      <div class="form-group">
        <label for="">Tipo</label>
          <select name="tipo" class="form-control select2" data-placeholder="Escolha um Tipo">
            <option value="" <?php if(!isset($obj)) {echo "selected";}?> disabled>Escolha um Tipo</option>
            <option <?php if(isset($obj->strContratoTipo) && $obj->strContratoTipo == "pp") {echo "selected";} ?> value="pp">P.P.</option>
            <option <?php if(isset($obj->strContratoTipo) && $obj->strContratoTipo == "c") {echo "selected";} ?> value="c">Contrato</option>
            <option <?php if(isset($obj->strContratoTipo) && $obj->strContratoTipo == "pi") {echo "selected";} ?> value="pi">P.I.</option>
          </select>
      </div>
      <div class="form-group">
        <label for="">Autorização</label>
        <input type="text" value="<?php if(isset($obj->strContratoAutorizacao)) {echo $obj->strContratoAutorizacao;} ?>" name="autorizacao" class="form-control" />
      </div>
      <div class="form-group">
        <label>CNPJ Cliente</label>
        <select name="clienteCnpj" class="form-control select2" data-placeholder="Selecione o CNPJ do Cliente">
          <option value="" <?php if(!isset($obj)) {echo "selected";}?> disabled>Selecione o CNPJ do Cliente</option>    
          <?php foreach($clientes as $cliente) :
              $c = $this->getClienteCnpj($cliente->intClienteID);
          ?> 
              <option <?php if(isset($obj->intClienteID) && $obj->intClienteID == $cliente->intClienteID) {echo "selected";}?> 
              value="<?php echo $cliente->intClienteID; ?>">
                      <?php echo $c->strClienteCNPJ; ?>
              </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>CNPJ Agência</label>
        <select name="agenciaCnpj" class="form-control select2" data-placeholder="Selecione o CNPJ da Agência">
          <option value="" <?php if(!isset($obj)) {echo "selected";}?> disabled>Selecione o CNPJ da Agência</option>    
          <?php foreach($agencias as $agencia) :
              $a = $this->getAgenciaCnpj($agencia->intAgenciaID);
          ?> 
              <option <?php if(isset($obj->intAgenciaID) && $obj->intAgenciaID == $agencia->intAgenciaID) {echo "selected";}?> 
              value="<?php echo $agencia->intAgenciaID; ?>">
                      <?php echo $a->strAgenciaCNPJ; ?>
              </option>
          <?php endforeach; ?>
        </select>
      </div>  
      <div class="form-group">
        <label for="">Nome do Projeto</label>
        <input type="text" value="<?php if(isset($obj->strProjetoNome)) {echo $obj->strProjetoNome;} ?>" name="nomeProjeto" class="form-control" />
      </div>
      <div class="form-group">
        <label>Vendedor</label>
        <select name="vendedor" class="form-control select2" data-placeholder="Selecione o Vendedor">
          <option value="" <?php if(!isset($obj)) {echo "selected";}?> disabled>Selecione o Vendedor</option>    
          <?php foreach($vendedores as $vendedor) :
              $v = $this->getAdmNome($vendedor->intAdmID);
          ?> 
              <option <?php if(isset($obj->intAdmID) && $obj->intAdmID == $vendedor->intAdmID) {echo "selected";}?> 
              value="<?php echo $vendedor->intAdmID; ?>">
                      <?php echo $v->strAdmNome; ?>
              </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="">Valor do Contrato</label>
        <input type="text" value="<?php if(isset($obj->strContratoValor)) {echo $obj->strContratoValor;} ?>" name="valor" class="form-control" />
      </div>  
      <div class="form-group">
        <label for="">Data</label>
        <input type="date" value="<?php if(isset($obj->strContratoData)) {echo $obj->strContratoData;} ?>" name="contratoData" class="form-control" />
      </div>  
      
      <?php if(!isset($obj)) : ?>
      <div class="form-group">
        <label for="">Selecione o Contrato</label>
        <input type="file" value="<?php if(isset($obj->strContratoPDF)) {echo $obj->strContratoPDF;} ?>" name="contratoPdf" id="contratoPdf" class="form-control" />
      </div>  
      <?php endif; ?>
      
      <?php if(isset($obj)) : ?>
          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">  
          <input name="contratoId" type="hidden" value="<?php echo $obj->intContratoID; ?>">
          <button type="submit" class="btn btn-primary">Editar Contrato</button>
      <?php else : ?>
          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
          <button type="submit" class="btn btn-primary">Cadastrar Contrato</button>
      <?php endif; ?>
    </div>   
    </form>
<!-- /.box-body -->
</div>