<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Aprovação do Sistema</h1>


    
    <?php if ($adm->intDepartamentoID == 1) : ?>
      <section class="content">
        <div class="row">
          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo $approvalAccount?></h3>
                <p><?php if ($approvalAccount >= 2){echo "Contas";}else{ echo "Conta";} ?> para aprovar</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <a href="aprovarcontas" class="small-box-footer">
                Analisar Contas <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo $approvalClient ?></h3>
                <p><?php if ($approvalClient >= 2){echo "Clientes";}else{ echo "Cliente";} ?> para aprovar</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="aprovarclientes" class="small-box-footer">
                Analisar Clientes <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $approvalFornecedor ?></h3>
                <p><?php if ($approvalFornecedor >= 2){echo "Fornecedores";}else{ echo "Fornecedor";} ?> para aprovar</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="aprovarfornecedores" class="small-box-footer">
                Analisar Fornecedores <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $approvalFuncionario ?></h3>
                <p><?php  if ($approvalFuncionario >= 2){echo "Colaboradores";}else{ echo "Colaborador";} ?> para aprovar</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="aprovarcolaboradores" class="small-box-footer">
                Analisar Colaboradores <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

        </div>
      </section>
    <?php endif; ?>

    <h1>Reprovações do Sistema</h1>
    <?php if ($adm->intDepartamentoID == 1) : ?>
      <section class="content">
        <div class="row">
          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo $reproveContas?></h3>
                <p><?php if ($reproveContas >= 2){echo "Contas";}else{ echo "Conta";} ?>reprovadas</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-cart"></i>
              </div>
              <a href="aprovarcontas" class="small-box-footer">
                Analisar Contas <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo $reproveClientes ?></h3>
                <p><?php if ($reproveClientes >= 2){echo "Clientes";}else{ echo "Cliente";} ?> reprovados</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="clientesreprovados" class="small-box-footer">
                Analisar Clientes <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $approvalFornecedor ?></h3>
                <p><?php if ($approvalFornecedor >= 2){echo "Fornecedores";}else{ echo "Fornecedor";} ?> para aprovar</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="aprovarfornecedores" class="small-box-footer">
                Analisar Fornecedores <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $approvalFuncionario ?></h3>
                <p><?php  if ($approvalFuncionario >= 2){echo "Colaboradores";}else{ echo "Colaborador";} ?> para aprovar</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="aprovarcolaboradores" class="small-box-footer">
                Analisar Colaboradores <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

        </div>
      </section>
    <?php endif; ?>

    <!-- WIDGET'S PARA DASHBOARD DO RH -->
    <?php if ($adm->intDepartamentoID == 6) : ?>
<section class="content">
<div class="col-lg-6 col-xs-6">

<div class="small-box bg-yellow">
  <div class="inner">
    <h3>44</h3>
    <p>User Registrations</p>
  </div>
  <div class="icon">
    <i class="ion ion-person-add"></i>
  </div>
  <a href="#" class="small-box-footer">
    More info <i class="fa fa-arrow-circle-right"></i>
  </a>
</div>
</div>

<div class="col-lg-6 col-xs-6">

<div class="small-box bg-red">
  <div class="inner">
    <h3>65</h3>
    <p>Unique Visitors</p>
  </div>
  <div class="icon">
    <i class="ion ion-pie-graph"></i>
  </div>
  <a href="#" class="small-box-footer">
    More info <i class="fa fa-arrow-circle-right"></i>
  </a>
</div>
</div>
</section>
      <?php endif; ?>


  </section>

  <section class="content"></section>

  <!-- Main content -->
  <!--section class="content container-fluid">
    <BR>
    <?php echo md5('123456'); ?>
    <h1>Olá, <strong><?php echo $adm->strAdmNome; ?></strong>,</h1>
    <h3>Utilize o menu ao lado para navegar no sistema.</h3>
  </section-->
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->