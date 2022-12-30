<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>Adicionar Teste</h1>
    <ol class="breadcrumb">
        <li>
            <?php if(isset($_GET['salvo'])) : ?>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.location.href = '<?php echo URL; ?>/home/crm';">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php else: ?>
                <button type="button" class="btn-sm btn-goBack btn-flat" onclick="window.history.go(-1); return false;">
                    <i class="fa fa-arrow-left"></i> Voltar
                </button>
            <?php endif; ?>
            <button type="button" class="btn-sm btn-register btn-flat" onclick="window.location.href='<?php echo URL; ?>home/deducaodoinssform'">
                <i class="fa fa-edit"></i> Cadastrar
            </button>
        </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <BR>

    <?php if (isset($_GET['salvo']) && $_GET['salvo'] == 'true') : ?>
      <?php echo "<script>$(function () {toastr['success']('Dados salvos com sucesso!')}); </script>";?>
      <!--div class="alert alert-success">Dados salvos com sucesso</div-->
    <?php elseif (isset($_GET['erro']) && $_GET['erro'] == 'true') : ?>
      <?php echo "<script> $(function () {toastr['warning']('Houve um erro ao salvar os dados!') }); </script>"; ?>
    <?php endif; ?>


      <div class="box">
          <form action="<?php echo URL; ?>songs/updatesong" method="POST">
              <label>Artist</label>
              <input autofocus type="text" name="artist" value="<?php echo htmlspecialchars($tn->artist, ENT_QUOTES, 'UTF-8'); ?>" required />
              <label>Track</label>
              <input type="text" name="track" value="<?php echo htmlspecialchars($tn->track, ENT_QUOTES, 'UTF-8'); ?>" required />
              <label>Link</label>
              <input type="text" name="link" value="<?php echo htmlspecialchars($tn->link, ENT_QUOTES, 'UTF-8'); ?>" />
              <input type="hidden" name="song_id" value="<?php echo htmlspecialchars($tn->id, ENT_QUOTES, 'UTF-8'); ?>" />
              <input type="submit" name="submit_update_song" value="Update" />
          </form>

      </div>




  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

