<?php
// $urlAtual = $this->getUrl();
$a = $this->coreModel->checkAccess($adm->intCargoID);
// echo $adm->intAdmID; exit;
// echo "<script>console.log('".$a->strCargoAccess."');</script>";
$access = explode(',', $a->strCargoAccess);



$approvalFornecedor = 0;
$approvalFuncionario = 0;
$approvalClient = 0;
$approvalAccount = 0;
$reprovelAccount = 0;
$reproveClientes = 0;
$reproveFornecedor = 0;
$reproveColaboradores = 0;


if (in_array('aprovarFornecedores', $access))
  $approvalFornecedor = $this->fornecedorModel->findApprovalFornecedor();
$reproveFornecedor = $this->fornecedorModel->findReproveFornecedor();

if (in_array('aprovarColaboradores', $access))
  $approvalFuncionario = $this->funcionariosModel->findApprovalFuncionario();
$reproveColaboradores = $this->funcionariosModel->findReproveFuncionario();

if (in_array('aprovarClientes', $access))
  $approvalClient = $this->clientesModel->findApprovalClient();
$reproveClientes = $this->clientesModel->findReproveClient();

if (in_array('aprovarContas', $access))
  $approvalAccount = $this->clientesModel->findApprovalAccount();
$reproveContas = $this->clientesModel->findReproveAccount();
$approval = $approvalClient + $approvalAccount + $approvalFornecedor + $approvalFuncionario;


?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema Metropolitana FM 98.5</title>

  <!-- jQuery 3 -->
  <script src="<?php echo URL; ?>bower_components/jquery/dist/jquery.min.js"></script>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo URL; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>plugins/toastr/toastr.min.css"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo URL; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL; ?>dist/css/AdminLTE.min.css">
  <!-- Select2 Style -->
  <link rel="stylesheet" href="<?php echo URL; ?>css/select2.css">

  <link rel="stylesheet" href="<?php echo URL; ?>dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/style.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="<?php echo URL; ?>home/dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?php echo URL; ?>img/p.png" alt=""></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="<?php echo URL; ?>img/logo.png" alt=""></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less -->
            <!--  <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <?php if ($approval >= 1) : ?>
                  <span class="label label-warning"><?php echo $approval; ?></span>
                <?php endif; ?>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Você tem <?php echo $approval; ?> notificações</li>
                <li>

                  <ul class="menu">
                    <?php if (in_array('aprovarClientes', $access)) : ?>
                      <li>
                        <a href="<?php echo URL; ?>home/aprovarclientes">
                          <i class="fa fa-users text-aqua"></i> <?php if ($approvalClient != 1) {
                                                                  echo $approvalClient . " clientes para aprovar";
                                                                } else {
                                                                  echo $approvalClient . " cliente para aprovar";
                                                                } ?>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php if (in_array('aprovarContas', $access)) : ?>
                      <li>
                        <a href="<?php echo URL; ?>home/aprovarcontas">
                          <i class="fa fa-users text-aqua"></i> <?php if ($approvalAccount != 1) {
                                                                  echo $approvalAccount . " contas para aprovar";
                                                                } else {
                                                                  echo $approvalAccount . " conta para aprovar";
                                                                } ?>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php if (in_array('aprovarFornecedores', $access)) : ?>
                      <li>
                        <a href="<?php echo URL; ?>home/aprovarfornecedores">
                          <i class="fa fa-users text-aqua"></i> <?php if ($approvalFornecedor != 1) {
                                                                  echo $approvalFornecedor . " fornecedores para aprovar";
                                                                } else {
                                                                  echo $approvalFornecedor . " fornecedor para aprovar";
                                                                } ?>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php if (in_array('aprovarColaboradores', $access)) : ?>
                      <li>
                        <a href="<?php echo URL; ?>home/aprovarcolaboradores">
                          <i class="fa fa-users text-aqua"></i> <?php if ($approvalFuncionario != 1) {
                                                                  echo $approvalFuncionario . " colaboradores para aprovar";
                                                                } else {
                                                                  echo $approvalFuncionario . " colaborador para aprovar";
                                                                } ?>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php if (in_array('aprovarColaboradores', $access)) : ?>
                      <li>
                        <a href="<?php echo URL; ?>home/aprovarcolaboradores">
                          <i class="fa fa-users text-aqua"></i> <?php if ($reproveColaboradores != 1) {
                                                                  echo $reproveColaboradores . " colaboradores para aprovar";
                                                                } else {
                                                                  echo $reproveColaboradores . " colaborador para aprovar";
                                                                } ?>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php if (in_array('aprovarFornecedores', $access)) : ?>
                      <li>
                        <a href="<?php echo URL; ?>home/aprovarcolaboradores">
                          <i class="fa fa-users text-aqua"></i> <?php if ($reproveFornecedor != 1) {
                                                                  echo $reproveFornecedor . " colaboradores reprovados";
                                                                } else {
                                                                  echo $reproveFornecedor . " colaborador reprovados";
                                                                } ?>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
               <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li> -->
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="hidden-xs"><?php echo $adm->strAdmNome; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-footer">
                  <a href="<?php echo URL; ?>home/logout" class="btn btn-default">Sair do Sistema</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <!-- Optionally, you can add icons to the links -->


          <li class="treeview">
            <a href="<?php echo URL; ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>

          </li>


          <li class="treeview">
            <a href="#"><i class="fa fa-newspaper-o"></i><span>Comercial</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('crm', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/crm"><i class="fa fa-circle-o text-aqua"></i>CRM</a></li>
              <?php endif;
              if (in_array('briefing', $access)) : ?>
                <!-- <li><a href="<?php echo URL; ?>home/allbriefings"><i class="fa fa-circle-o text-aqua"></i>Briefing</a></li> -->
              <?php endif;
              if (in_array('contratos', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/contratos"><i class="fa fa-circle-o text-aqua"></i>Contratos</a></li>
              <?php endif;
              if (in_array('vendedores', $access)) : ?>
                <!-- <li><a href="#"><i class="fa fa-circle-o text-aqua"></i>Vendedores</a></li> -->
              <?php endif;
              if (in_array('agencias', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/agencias"><i class="fa fa-circle-o text-aqua"></i>Agências</a></li>
              <?php endif;
              if (in_array('clientes', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/clientes"><i class="fa fa-circle-o text-aqua"></i>Clientes</a></li>
              <?php endif;
              if (in_array('contas', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/contas"><i class="fa fa-circle-o text-aqua"></i>Contas</a></li>
              <?php endif;
              if (in_array('carteira', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/carteira"><i class="fa fa-circle-o text-aqua"></i>Carteira de Clientes</a></li>
              <?php endif;
              if (in_array('propostas', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/propostas"><i class="fa fa-circle-o text-aqua"></i>Propostas</a></li>
              <?php endif;
              if (in_array('po', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/po"><i class="fa fa-circle-o text-aqua"></i>Planilha Orçamentaria</a></li>
              <?php endif;
              if (in_array('dc', $access)) : ?>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i>Divisão de Contrato</a></li>
              <?php endif;
              if (in_array('segmentos', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/segmentos"><i class="fa fa-circle-o text-aqua"></i>Segmentos</a></li>
              <?php endif;
              if (in_array('produtos', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/contatos"><i class="fa fa-circle-o text-aqua"></i>Contatos</a></li>
                <li class="treeview">
                  <a href="#">Produtos e Pacotes
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo URL; ?>home/produtoscategoria"><i class="fa fa-circle-o text-aqua"></i>Categorias</a></li>
                    <li><a href="<?php echo URL; ?>home/produtos"><i class="fa fa-circle-o text-aqua"></i>Produtos</a></li>
                    <li><a href="<?php echo URL; ?>home/pacotes"><i class="fa fa-circle-o text-aqua"></i>Pacotes</a></li>
                  </ul>
                </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php if (in_array('os', $access)) : ?>
            <!-- <li <?php //if($urlAtual == 'crm') {echo "class='active'"; } 
                      ?>><a href="#"><span>Ordem de Serviço</span></a></li> -->
          <?php endif; ?>
          <!-- <li class="treeview">
            <a href="#"><span>Logística</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> -->
          <?php if (in_array('estoque', $access)) : ?>
            <!-- <li><a href="<?php echo URL; ?>home/estoque">Estoque</a></li> -->
          <?php endif; ?>
          <!-- </ul> -->
          <!-- </li> -->
          <li class="treeview">
            <a href="#"><i class="fa fa-pencil-square-o"></i><span>Administrativo</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('fornecedores', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/fornecedores"><i class="fa fa-circle-o text-aqua"></i>Fornecedores</a></li>
              <?php endif;
              if (in_array('cargos', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/cargos"><i class="fa fa-circle-o text-aqua"></i>Cargos</a></li>
              <?php endif;
              if (in_array('moedas', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/moedas"><i class="fa fa-circle-o text-aqua"></i>Moedas</a></li>
              <?php endif;
              if (in_array('departamentos', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/departamentos"><i class="fa fa-circle-o text-aqua"></i>Departamentos</a></li>
              <?php endif;
              if (in_array('recepcao', $access)) : endif; ?>

              <li class="treeview">
                <a href="#">Contas<span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span></a>
                <ul class="treeview-menu">
                  <?php if (in_array('centroCustos', $access)) : ?>
                    <li><a href="<?php echo URL; ?>home/centroDeCustos"><i class="fa fa-circle-o text-aqua"></i>Centro de custos</a></li>
                  <?php endif;
                  if (in_array('planoContas', $access)) : ?>
                    <li><a href="<?php echo URL; ?>home/planoDeContas"><i class="fa fa-circle-o text-aqua"></i>Plano de Contas</a></li>
                  <?php endif;
                  if (in_array('subPlanoContas', $access)) : ?>
                    <li><a href="<?php echo URL; ?>home/subPlanoDeContas"><i class="fa fa-circle-o text-aqua"></i>Sub-Planos de Contas</a></li>
                  <?php endif;
                  if (in_array('fechamentoContas', $access)) : ?>
                    <li><a href="<?php echo URL; ?>home/fechamentoDeContas"><i class="fa fa-circle-o text-aqua"></i>Fechamento de contas</a></li>
                  <?php endif;
                  if (in_array('contasAPagar', $access)) : ?>
                    <li><a href="<?php echo URL; ?>home/contasAPagar"><i class="fa fa-circle-o text-aqua"></i>Contas a pagar</a></li>
                  <?php endif; ?>
                </ul>
              </li>




              <!-- <li><a href="#"> Recepção</a></li> -->

              <!-- <li><a href="<?php echo URL; ?>home/recebimento"> Recebimento</a></li> -->
              <!-- <li class="treeview">
                <a href="#"> Recebimento
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                <?php if (in_array('contrato', $access)) : ?>
                  <li><a href="<?php echo URL; ?>home/contacontrato"> Contrato</a></li>
                  <?php endif;
                if (in_array('nfe', $access)) : ?>
                  <li><a href="#"> Notas Fiscais</a></li>
                  <?php endif;
                if (in_array('boletos', $access)) : ?>
                  <li><a href="#"> Boletos</a></li>
                  <?php endif;
                if (in_array('sefaz', $access)) : ?>
                  <li><a href="#"> SEFAZ</a></li>
                  <?php endif; ?>
                </ul>
              </li> -->
              <!-- <li class="treeview">
                <a href="#"> Pagamento
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <?php if (in_array('manipulapgto', $access)) : ?>
                  <li><a href="#"> Manipula PGTO</a></li> -->
            <?php endif; ?>
            <!-- <li class="treeview">
                    <a href="#"> Comissão
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <?php if (in_array('regrascomissao', $access)) : ?>
                      <li><a href="#"> <i class="fa fa-circle-o text-aqua"></i>Regras de Comissão</a></li>
                      <?php endif;
                      if (in_array('orcamentos', $access)) : ?>
                      <li><a href="#"> <i class="fa fa-circle-o text-aqua"></i>Metas</a></li>
                      <?php endif; ?>
                    </ul>
                  </li> -->
            </ul>
          </li>
          <?php if (in_array('centrocustos', $access)) : ?>
            <!-- <li><a href="#"> <i class="fa fa-circle-o text-aqua"></i>Centro de custos</a></li> -->
          <?php endif; ?>
          <li class="treeview">
            <a href="#"><i class="fa fa-users"></i><span>Recursos Humanos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('colaboradores', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/funcionarios"><i class="fa fa-circle-o text-aqua"></i> Colaboradores</a></li>
              <?php endif; ?>
              <!-- <li class="treeview">
                    <a href="#"> Folha
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <?php if (in_array('salarial', $access)) : ?>
                      <li><a href="#"> <i class="fa fa-circle-o text-aqua"></i>Salarial</a></li>
                      <?php endif;
                      if (in_array('vr', $access)) : ?>
                      <li><a href="#"> <i class="fa fa-circle-o text-aqua"></i>Vale-Transporte</a></li>
                      <?php endif; ?>
                    </ul>
                  </li> -->
              <?php if (in_array('vr', $access)) : ?>
                <!-- <li><a href="#"> <i class="fa fa-circle-o text-aqua"></i>Vale-Refeição</a></li> -->
              <?php endif;
              if (in_array('planosaude', $access)) : ?>
                <!-- <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Plano de Saúde</a></li> -->
              <?php endif; ?>
              <!-- </ul> -->
              <!-- </li> -->
              <!-- <li class="treeview">
                <a href="#"> Operacional
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <?php if (in_array('frota', $access)) : ?>
                  <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Frota</a></li>
                  <?php endif;
                  if (in_array('seguro', $access)) : ?>
                  <li><a href="#"> <i class="fa fa-circle-o text-aqua"></i>Seguro</a></li>
                  <?php endif; ?>
                </ul>
              </li> -->
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-thumbs-o-up"></i><span>Aprovação Sistema</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('aprovarClientes', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/aprovarclientes"><i class="fa fa-circle-o text-green"></i><span>Clientes</span> <small class="label pull-right bg-green"><?php if ($approvalClient == 0) {
                                                                                                                        } else {
                                                                                                                          echo $approvalClient;
                                                                                                                        } ?></small></a></li>
              <?php endif; ?>
              <?php if (in_array('aprovarContas', $access)) : ?>
                <li> <a href="<?php echo URL; ?>home/aprovarcontas"><i class="fa fa-circle-o text-green"></i><span>Contas</span> <small class="label pull-right bg-green"><?php if ($approvalAccount == 0) {
                                                                                                                    } else {
                                                                                                                      echo $approvalAccount;
                                                                                                                    } ?></small></a></li>
              <?php endif; ?>
              <?php if (in_array('aprovarFornecedores', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/aprovarfornecedores"><i class="fa fa-circle-o text-green"></i><span>Fornecedores</span> <small class="label pull-right bg-green"><?php if ($approvalFornecedor == 0) {
                                                                                                                                } else {
                                                                                                                                  echo $approvalFornecedor;
                                                                                                                                } ?></small></a></li>
              <?php endif; ?>
              <?php if (in_array('aprovarColaboradores', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/aprovarcolaboradores"><i class="fa fa-circle-o text-green"></i><span>Colaboradores</span> <small class="label pull-right bg-green"><?php if ($approvalFuncionario == 0) {
                                                                                                                                  } else {
                                                                                                                                    echo $approvalFuncionario;
                                                                                                                                  } ?></small></a></li>
              <?php endif; ?>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-thumbs-o-down"></i><span>Reprovação Sistema</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('aprovarClientes', $access)) : ?>
                <li>
                  <a href="<?php echo URL; ?>home/clientesreprovados">
                    <i class="fa fa-circle-o text-red"></i><span>Clientes</span> <small class="label pull-right bg-red"><?php if ($reproveClientes == 0) {
                                                                    } else {
                                                                      echo $reproveClientes;
                                                                    } ?></small> </small>
                  </a>
                </li>
              <?php endif; ?>
              <?php if (in_array('aprovarContas', $access)) : ?>
                <li>
                  <a href="<?php echo URL; ?>home/contasreprovadas">
                  <i class="fa fa-circle-o text-red"></i><span> Contas</span> <small class="label pull-right bg-red"><?php if ($reproveContas == 0) {
                                                                  } else {
                                                                    echo $reproveContas;
                                                                  } ?></small> </small>
                  </a>
                </li>
              <?php endif; ?>

              <?php if (in_array('aprovarFornecedores', $access)) : ?>
                <li>
                  <a href="<?php echo URL; ?>home/fornecedoresreprovados">
                  <i class="fa fa-circle-o text-red"></i><span>Fornecedor</span> <small class="label pull-right bg-red"><?php if ($reproveFornecedor == 0) {
                                                                      } else {
                                                                        echo $reproveFornecedor;
                                                                      } ?></small> </small>
                  </a>
                </li>
              <?php endif; ?>

              <?php if (in_array('aprovarColaboradores', $access)) : ?>
                <li>
                  <a href="<?php echo URL; ?>home/funcionariosreprovados">
                  <i class="fa fa-circle-o text-red"></i><span>Colaboradores</span> <small class="label pull-right bg-red"><?php if ($reproveColaboradores == 0) {
                                                                          } else {
                                                                            echo $reproveColaboradores;
                                                                          } ?></small> </small>
                  </a>
                </li>
              <?php endif; ?>

            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i><span>Sistema</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('usuarios', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/adm"><i class="fa fa-circle-o text-aqua text-aqua"></i>Usuários</a></li>
              <?php endif;
              if (in_array('permissoes', $access)) : ?>
                <li><a href="<?php echo URL; ?>home/permissoes"><i class="fa fa-circle-o text-aqua text-aqua"></i>Permissões</a></li>
              <?php endif; ?>
            </ul>
          </li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>