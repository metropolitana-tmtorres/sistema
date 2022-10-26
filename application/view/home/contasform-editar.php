  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Conta
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

    <section class="content container-fluid">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Editar Conta</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="<?php echo URL; ?>home/editconta">
                <div class="box-body">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <select name="cliente" required id="cliente" class="form-control">
                            <option value="" disabled selected>Selecione um Cliente</option>
                            <?php foreach($clientes as $c) : ?>
                                <option <?php if(isset($conta->intClienteID) && $conta->intClienteID == $c->intClienteID) { echo "selected"; } ?> value="<?php echo $c->intClienteID; ?>"><?php echo $c->strClienteFantasia; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="segmento">Segmento de Mercado</label>
                        <select name="segmento" required id="segmento" class="form-control">
                            <option value="" disabled selected>Selecione uma Agência</option>
                            <?php foreach($segmentos as $s) : ?>
                                <option <?php if(isset($conta->intSegmentoID) && $conta->intSegmentoID == $s->intSegmentoID) { echo "selected"; } ?> value="<?php echo $s->intSegmentoID; ?>"><?php echo $s->strSegmentoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Agência <small>(opcional)</small></label>
                        <select name="agencia" id="" class="form-control">
                                <option value="" disabled selected>Selecione uma Agência</option>
                            <?php foreach($agencias as $a) : ?>
                                <option <?php if(isset($conta->intAgenciaID) && $conta->intAgenciaID == $a->intAgenciaID) { echo "selected"; } ?> value="<?php echo $a->intAgenciaID; ?>"><?php echo $a->strAgenciaNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nome da Conta</label>
                        <input type="text" required name="nome" id="nome" class="form-control" value="<?php if(isset($conta->strContaNome)) { echo $conta->strContaNome; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nome do Contato</label>
                        <input type="text" required name="contato" class="form-control" value="<?php if(isset($conta->strContaContato)) { echo $conta->strContaContato; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Cargo do Contato</label>
                        <input type="text" required name="cargo" class="form-control" value="<?php if(isset($conta->strContaContatoCargo)) { echo $conta->strContaContatoCargo; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="">E-Mail do Contato</label>
                        <input type="mail" equired name="email" class="form-control" value="<?php if(isset($conta->strContaContatoEmail)) { echo $conta->strContaContatoEmail; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Telefone do Contato</label>
                        <input type="text" required name="telefone" id="telefone" class="form-control telefone" value="<?php if(isset($conta->strContaContatoTelefone)) { echo $conta->strContaContatoTelefone; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Celular do Contato</label>
                        <input type="text" required name="celular" id="celular" class="form-control celular" value="<?php if(isset($conta->strContaContatoCelular)) { echo $conta->strContaContatoCelular; } ?>">
                    </div>
                
                    <input type="hidden" name="conta" value="<?php echo $id; ?>">
                    <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                    <button type="submit" class="btn btn-primary">Editar Conta</button>
                </div>   
            </form>
        </div>
    </div>
    </section>
<!-- /.box-body -->
</div>
