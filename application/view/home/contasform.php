  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cadastrar Conta
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
    
    <section class="content container-fluid">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Cadastrar Conta</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="<?php echo URL; ?>home/addconta">
                <div class="box-body">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <select name="cliente" required id="cliente" class="form-control">
                            <option value="" disabled selected>Selecione um Cliente</option>
                            <?php foreach($clientes as $c) : ?>
                                <option value="<?php echo $c->intClienteID; ?>"><?php echo $c->strClienteFantasia; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="segmento">Segmento de Mercado</label>
                        <select name="segmento" id="segmento" class="form-control">
                            <option value="" disabled selected>Selecione um Segmento</option>
                            <?php foreach($segmentos as $s) : ?>
                                <option value="<?php echo $s->intSegmentoID; ?>"><?php echo $s->strSegmentoNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Agência <small>(opcional)</small></label>
                        <select name="agencia" id="" class="form-control">
                                <option value="0" selected selected>Cliente Direto</option>
                            <?php foreach($agencias as $a) : ?>
                                <option value="<?php echo $a->intAgenciaID; ?>"><?php echo $a->strAgenciaNome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nome da Conta</label>
                        <input type="text" required name="nome" id="nome" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nome do Contato</label>
                        <input type="text" name="contato" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Cargo do Contato</label>
                        <input type="text" name="cargo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">E-Mail do Contato</label>
                        <input type="mail" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Telefone do Contato</label>
                        <input type="text" name="telefone" id="telefone" class="form-control telefone">
                    </div>
                    <div class="form-group">
                        <label for="">Celular do Contato</label>
                        <input type="text" name="celular" id="celular" class="form-control celular">
                    </div>
                
                    <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
                    <button type="submit" class="btn btn-primary">Cadastrar Conta</button>
                </div>   
            </form>
        </div>
    </div>
    </section>
<!-- /.box-body -->
</div>
