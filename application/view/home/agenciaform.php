  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if(isset($obj)) {echo 'Editar Agência';} else {echo 'Cadastrar Agência';} ?>  
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

    <?php if(isset($obj)) {$url = 'editagencia';} else {$url = 'addagencia';} ?>
    <form action="<?php echo URL; ?>home/<?php echo $url?>" method="POST">
      <div class="box-body">
        <div class="form-group">
            <label for="">Nome da Agência</label>
            <input value="<?php if(isset($obj->strAgenciaNome)) {echo $obj->strAgenciaNome;} ?>" type="text" required name="nome" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Contato</label>
            <input value="<?php if(isset($obj->strAgenciaContato)) {echo $obj->strAgenciaContato;} ?>" type="text" required name="contato" class="form-control">
        </div>
        <div class="form-group">
            <label for="">E-Mail</label>
            <input value="<?php if(isset($obj->strAgenciaEmail)) {echo $obj->strAgenciaEmail;} ?>" type="mail" required name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Telefone</label>
            <input value="<?php if(isset($obj->strAgenciaTelefone)) {echo $obj->strAgenciaTelefone;} ?>" type="text"name="telefone" id="telefone" class="form-control">
        </div>

        <div class="form-group">
            <label for="">CNPJ</label>
            <input value="<?php if(isset($obj->strAgenciaCNPJ)) {echo $obj->strAgenciaCNPJ;} ?>" required name="cnpj" id="cnpj" class="form-control">
        </div>

        <?php if(isset($obj)) : ?>
          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>"> 
          <input name="agenciaId" type="hidden" value="<?php echo $obj->intAgenciaID; ?>">
          <button type="submit" class="btn btn-primary">Editar Agencia</button>
        <?php else : ?>
          <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
          <button type="submit" class="btn btn-primary">Cadastrar Agencia</button>
        <?php endif; ?>

      </div>
    </form>
    </div>