<?
$this->establecerTitulo("Administrar permisos");

//$c = new \DepotServer\Conexion();
$db = new \DepotServer\BaseDatos();
$usuarios = $db::table('usuarios')->select('id', 'usuario', 'nombre')->where('activo', '=', '1')->get()->all();

$mod2 = $this->os(2);

foreach ($usuarios as $key => $usuario) {
  $tabla .= <<<EOM
  <div class="col-md-4 col-xs-12">
  <a href="/app/{$mod2}/modificar/{$usuario->id}">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{$usuario->usuario}</span>
        <span class="info-box-number">{$usuario->nombre}</span>
      </div>
    </div>
  </a>
  </div>
EOM;
}
$this->ev("tablaUsuarios",$tabla);
?>
