  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php if (isset($obj)) {
          echo 'Editar Agência';
        } else {
          echo 'Cadastro de Agências';
        } ?>
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
        <?php if (isset($obj)) {
          $url = 'editagencia';
        } else {
          $url = 'addagencia';
        } ?>
        <form action="<?php echo URL; ?>home/<?php echo $url ?>" method="POST">
          <div class="box-body">
            <div class="content">
              <fieldset>
                <legend>Agências</legend>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">CNPJ</label>
                      <input value="<?php if (isset($obj->strAgenciaCNPJ)) {
                                      echo $obj->strAgenciaCNPJ;
                                    } ?>" required name="cnpj" id="cnpj" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Nome da Agência</label>
                      <input value="<?php if (isset($obj->strAgenciaNome)) {
                                      echo $obj->strAgenciaNome;
                                    } ?>" type="text" required name="nome" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Contato</label>
                      <input value="<?php if (isset($obj->strAgenciaContato)) {
                                      echo $obj->strAgenciaContato;
                                    } ?>" type="text" required name="contato" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">E-Mail</label>
                      <input value="<?php if (isset($obj->strAgenciaEmail)) {
                                      echo $obj->strAgenciaEmail;
                                    } ?>" type="mail" required name="email" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="">Telefone</label>
                      <input value="<?php if (isset($obj->strAgenciaTelefone)) {
                                      echo $obj->strAgenciaTelefone;
                                    } ?>" type="text" name="telefone" id="telefone" class="form-control">
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>





<div class="row">
  <div class="col-md-12 col-xs-12 text-center">
  <?php if (isset($obj)) : ?>
              <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
              <input name="agenciaId" type="hidden" value="<?php echo $obj->intAgenciaID; ?>">
              <button type="submit" class="btn bg-orange btn-flat"><i class="fa fa-edit"></i> Editar Agência</button>
            <?php else : ?>
              <input type="hidden" name="adm" value="<?php echo $adm->intAdmID; ?>">
              <button type="submit" class="btn btn-register btn-flat"><i class="fa fa-check"></i> Cadastrar Agência</button>
            <?php endif; ?>

  </div>
</div>

            
          </div>
        </form>
      </div>
    </section>
  </div>

  <script src="<?php echo URL; ?>plugins/masks/jquery.mask.js"></script>