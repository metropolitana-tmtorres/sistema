
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if(isset($obj)) {echo 'Editar Planilha Orçamentária';} else {echo 'Cadastrar Planilha Orçamentária';} ?>
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
    
    <?php if(isset($obj)) {$url = 'editPo';} else {$url = 'addPo';} ?>
    <?php ?>

    <form method="POST" action="<?php echo URL; ?>home/<?php echo $url; ?>">
    <div class="box-body">
        <div class="form-group">
            <label for="">CRM</label>
            <select name="crm" class="form-control select2" style="width: 100%;" data-placeholder="Selecione um CRM">
                <?php foreach($crms as $cr) {

                        echo "<option value='{$cr->intCrmID}'>
                                {$this->showCode($cr->intCrmID, 'C')}
                            </option>";

                }?>
            </select>
        </div>
        <div class="form-group">
            <label>Cliente</label>
            <select name="cliente" class="form-control select2" data-placeholder="Selecione um Cliente"  id='clientes'  onchange="fetchClientes()">
                <option value="" <?php if(!isset($obj)) {echo "selected";}?> disabled>Selecione um Cliente</option>    
                <?php foreach($clientes as $cliente) :
                    $c = $this->getClienteNameByID($cliente->intClienteID);
                ?> 
                    <option <?php if(isset($obj->intClienteID) && $obj->intClienteID == $cliente->intClienteID) {echo "selected";}?> 
                    value="<?php echo $cliente->intClienteID; ?>">
                            <?php echo $c->strClienteFantasia; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Conta</label>
            <select name="conta" class="form-control select2" id=contas data-placeholder="Selecione uma Conta">
            </select>
        </div>
        <div class="form-group">
            <label for="">Data</label>
            <input type="date" value="<?php if(isset($obj->strPoDate)) {echo $obj->strPoDate;} else echo date('Y-m-d') ?>"  required name="podate" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Status</label>
                <select name="stats" class="form-control select2" data-placeholder="Escolha um Status">
                    <option value="" <?php if(!isset($obj)) {echo "selected";}?> disabled>Escolha um Status</option>
                    <option <?php if(isset($obj->strPoStatus) && $obj->strPoStatus == "NE") {echo "selected";} ?> value="NE">Negativa</option>
                    <option <?php if(isset($obj->strPoStatus) && $obj->strPoStatus == "AN") {echo "selected";} ?> value="AN">Andamento</option>
                    <option <?php if(isset($obj->strPoStatus) && $obj->strPoStatus == "AP") {echo "selected";} ?> value="AP">Aprovada</option>
                    <option <?php if(isset($obj->strPoStatus) && $obj->strPoStatus == "EN") {echo "selected";} ?> value="EN">Entregue</option>
                </select>
        </div>
        <div class="form-group">
            <label for="validade">Validade</label>
            <input type="date" value="<?php if(isset($obj->strPoDate)) {echo $obj->strPoDate;} ?>" name="validade" class="form-control" />
        </div>
        <div class="form-group">
            <label for="prazo">Prazo</label>
            <input type="text" value="<?php if(isset($obj->strPoPrazo)) {echo $obj->strPoPrazo;} ?>" name="prazo" class="form-control">
        </div>

        <?php if(isset($obj)) : ?>
            <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">  
            <input name="poId" type="hidden" value="<?php echo $obj->intPoID; ?>">
            <button type="submit" class="btn btn-primary">Editar P.O.</button>
        <?php else : ?>
            <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
            <button type="submit" class="btn btn-primary">Cadastrar P.O.</button>
        <?php endif; ?>
    </div>   
    </form>
<!-- /.box-body -->
</div>
<script>
    fetchClientes();
    function fetchClientes(){
        const contas=document.querySelector('#contas');
        contas.innerHTML='';
        let intClienteID=document.querySelector('#clientes').value;
        fetch(`<?=URL?>api/contas/${intClienteID}`)
        .then(function(response) {
            return response.json();
        })
        .then(function(json) {
            console.log(json);
            json.forEach((element)=>{
                contas.insertAdjacentHTML('beforeEnd',`<option value='${element.intContaID}'>${element.strContaNome}</option>`);
            });
        });
    }
</script>