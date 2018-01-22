<?php
$this->establecerTitulo("Principal");

$db = new \DepotServer\BaseDatos();
$this->ev("usuariosSistema", $db::table("usuarios")->count() );
$this->ev("modulosInstalados", (sizeof($this->filesystem->obtenerDirectorios("inc"))-6) );

$variables = $db::table("preferencias")->where("variable", "LIKE", "sistema_%")->get()->all();
foreach($variables as $va){
  $this->ev($va->variable, $va->valor);
}

//echo "<pre>".print_r(sizeof($this->filesystem->obtenerDirectorios("inc")), true)."</pre>";
