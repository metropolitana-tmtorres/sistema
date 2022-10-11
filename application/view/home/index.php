<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema Metropolitana FM 98.5</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo URL; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL; ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo URL; ?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo URL; ?>"><img src="<?php echo URL; ?>img/logo.png" width="300" class="center-block" /></a>
  </div>
  <!-- /.login-logo -->
    <?php if(isset($_GET['error']) && $_GET['error'] == "data") : ?>
        <div class="alert alert-danger">Seu e-mail ou senha está incorreto</div>
    <?php elseif(isset($_GET['error']) && $_GET['error'] == "log") : ?>
        <div class="alert alert-danger">Você precisa preencher seus dados de acesso abaixo para acessar o sistema</div>
    <?php elseif(isset($_GET['error']) && $_GET['error'] == "inactive") : ?>
        <div class="alert alert-danger">Este usuário esta inativo e não pode acessar o sistema</div>
    <?php elseif(isset($_GET['logout']) && $_GET['logout'] == "true") : ?>
        <div class="alert alert-success">Você saiu do sistema com segurança</div>
    <?php endif; ?>

  <div id="loginbox" class="login-box-body">
    <p class="login-box-msg">Informe seus dados para acessar</p>

    <form action="<?php echo URL; ?>home/login" method="post">
      <div class="form-group has-feedback">
        <input type="email" required class="form-control" name="mail" placeholder="E-Mail">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" required name="pass" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Lembrar-me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="loginbtn" class="btn btn-primary btn-block btn-flat">Acessar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo URL; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo URL; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo URL; ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo URL; ?>js/application.js"></script>
<script>
  $(function () {
    // $('#fullscreen').trigger('click');
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
