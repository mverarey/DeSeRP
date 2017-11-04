<?php
require_once("../../../vendor/autoload.php");
use DepotServer\Migracion;

$urlAbsoluta = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ingreso a DeSeRP :: DeSeRP 3.0 r 05.10.17</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/assets/admin-lte/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/assets/admin-lte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/assets/admin-lte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="/assets/bootstrap-table/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="/assets/deserp/DeSeRP.css">
  <link rel="stylesheet" href="/assets/animate.css/animate.min.css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <!-- jQuery 3 --><script src="/assets/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 --><script src="/assets/admin-lte/bootstrap/js/bootstrap.min.js"></script>
  <!-- SlimScroll --><script src="/assets/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick --><script src="/assets/admin-lte/plugins/fastclick/fastclick.min.js"></script>
  <!-- AdminLTE App --><script src="/assets/admin-lte/dist/js/app.min.js"></script>
</head>
<body class="hold-transition sidebar-mini fixed  skin-blue ">
  <!-- Site wrapper -->
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">DSRP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">DeSeRP</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="navbar-custom-menu">
        </div>
      </nav>
    </header>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <div class="sidebar">
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Instalador
        </h1>

      </section>
      <!-- Main content -->
      <section class="content">

<?
if($_REQUEST['acc'] == "instalar"){

echo  Migracion::probarConexion();
echo  Migracion::crearTablas();

$usuario = "test".date("YmdHis");
echo  Migracion::crearUsuario($usuario, $password);

?>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <ul class="list-group animated bounceInLeft">
      <li class="list-group-item list-group-item-success">Resultado de instalación</li>
      <li class="list-group-item"><span class="badge list-group-item-success"><i class="fa fa-check"></i></span> Generando archivo de Configuración</li>
      <li class="list-group-item"><span class="badge list-group-item-success"><i class="fa fa-check"></i></span> Conectando a base de datos</li>
      <li class="list-group-item"><span class="badge list-group-item-success"><i class="fa fa-check"></i></span> Instalando tablas</li>
      <li class="list-group-item"><span class="badge list-group-item-success"><i class="fa fa-check"></i></span> Eliminado archivo de instalación</li>
    </ul>
  </div>
</div>
<?
  echo "<pre>";
  print_r($_REQUEST);
  echo "</pre>";



}else{

?>
        <p>Ingrese los detalles de la conexión que se le solicitan.</p>
        <fieldset class="login">
          <form action="/instalador" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="box">
                  <div class="box-header">
                    <h2>Base de datos</h2>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="txtservidor">Servidor</label>
                      <input type="text" class="form-control" id="txtservidor" name="servidor" placeholder="Ingrese el servidor" value="localhost">
                    </div>
                    <div class="form-group">
                      <label for="txtusuario">Usuario</label>
                      <input type="text" class="form-control" id="txtusuario" name="usuario" placeholder="Ingrese el usuario" value="root">
                    </div>
                    <div class="form-group">
                      <label for="txtpassword">Password</label>
                      <input type="text" class="form-control" id="txtpassword" name="password" placeholder="Ingrese el password" value="">
                    </div>
                    <div class="form-group">
                      <label for="txtdb">Base de datos</label>
                      <input type="text" class="form-control" id="txtdb" name="db" placeholder="Ingrese el db" value="tipi_proto">
                    </div>
                    <div class="form-group">
                      <label for="txtdriver">Driver</label>
                      <input type="text" class="form-control" id="txtdriver" name="driver" placeholder="Ingrese el driver" value="mysql">
                    </div>
                    <div class="form-group">
                      <label for="txtcharset">Charset</label>
                      <input type="text" class="form-control" id="txtcharset" name="charset" placeholder="Ingrese el charset" value="utf8">
                    </div>
                    <div class="form-group">
                      <label for="txtcollation">Collation</label>
                      <input type="text" class="form-control" id="txtcollation" name="collation" placeholder="Ingrese el collation" value="utf8_unicode_ci">
                    </div>
                    <div class="form-group">
                      <label for="txtprefix">Prefix</label>
                      <input type="text" class="form-control" id="txtprefix" name="prefix" placeholder="Ingrese el prefix" value="">
                    </div>
                  </div>
                </div>
                <div class="box">
                  <div class="box-header">
                    <h3>Acceso a sistema</h3>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="txtusuario">Usuario</label>
                      <input type="text" class="form-control" id="txtusuario" name="usuariousr" placeholder="Ingrese el usuario" value="administrador">
                    </div>
                    <div class="form-group">
                      <label for="txtpasswordusr">Contrase&ntilde;a</label>
                      <input type="password" class="form-control" id="txtpasswordusr" name="passwordusr" value="">
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="reemplazar" value="true" checked> ¿Desea reemplazar/instalar la información actual?
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box">
                  <div class="box-header">
                    <h3>SMTP</h3>
                  </div>
                  <div class="box-body">

                    <div class="form-group">
                      <label for="txtsmtp_host">Host</label>
                      <input type="text" class="form-control" id="txtsmtp_host" name="smtp_host" placeholder="Ingrese el smtp_host" value="smtp.depotserver.com">
                    </div>
                    <div class="form-group">
                      <label for="txtsmtp_port">Puerto</label>
                      <input type="text" class="form-control" id="txtsmtp_port" name="smtp_port" placeholder="Ingrese el smtp_port" value="26">
                    </div>
                    <div class="form-group">
                      <label for="txtsmtp_auth">Auth</label>
                      <input type="text" class="form-control" id="txtsmtp_auth" name="smtp_auth" placeholder="Ingrese el smtp_auth" value="true">
                    </div>
                    <div class="form-group">
                      <label for="txtsmtp_usuario">Usuario</label>
                      <input type="text" class="form-control" id="txtsmtp_usuario" name="smtp_usuario" placeholder="Ingrese el smtp_usuario" value="">
                    </div>
                    <div class="form-group">
                      <label for="txtsmtp_password">Password</label>
                      <input type="text" class="form-control" id="txtsmtp_password" name="smtp_password" placeholder="Ingrese el smtp_password" value="">
                    </div>
                    <div class="form-group">
                      <label for="txtsmtp_persist">Persist</label>
                      <input type="text" class="form-control" id="txtsmtp_persist" name="smtp_persist" placeholder="Ingrese el smtp_persist" value="false">
                    </div>

                  </div>
                </div>
                <div class="box">
                  <div class="box-header">
                    <h3>Generales</h3>
                  </div>
                  <div class="box-body">

                    <div class="form-group">
                      <label for="txturl_absoluta">Url absoluta</label>
                      <input type="text" class="form-control" id="txturl_absoluta" name="url_absoluta" placeholder="Ingrese el url_absoluta" value="<?=$urlAbsoluta?>">
                    </div>
                    <div class="form-group">
                      <label for="txtlocale">Locale</label>
                      <input type="text" class="form-control" id="txtlocale" name="locale" placeholder="Ingrese el locale" value="es_MX">
                    </div>
                    <div class="form-group">
                      <label for="txtdebug">Debug</label>
                      <input type="text" class="form-control" id="txtdebug" name="debug" placeholder="Ingrese el debug" value="false">
                    </div>
                    <div class="form-group">
                      <label for="txttimezone">Timezone</label>
                      <input type="text" class="form-control" id="txttimezone" name="timezone" placeholder="Ingrese el timezone" value="America/Mexico_City">
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="alert alert-danger">
              <p>Precaución: Esto reemplazara el documento de configuración actual.</p>

              <div class="row">
                <button class="btn btn-warning col-md-8 col-md-offset-2"><i class="fa fa-floppy-o"></i> Instalar</button>
              </div>
            </div>

            <input type="hidden" name="acc" value="instalar" />
          </form>

        </fieldset>
<? } ?>
      </div>
      <!-- /.box-body -->
    </div>    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
  </div>
  <strong>DeSeRP <a href="http://depotserver.com">Depot Server</a>. | Theme: <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>
<!-- Control Sidebar -->
</div>
<!-- ./wrapper -->
</body>
</html>
