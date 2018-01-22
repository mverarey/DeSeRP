<?php
$this->establecerTitulo("Principal");

$db = new \DepotServer\BaseDatos();
$this->ev("usuariosSistema", $db::table("usuarios")->count());

$variables = $db::table("preferencias")->where("variable", "LIKE", "sistema_%")->get()->all();
foreach($variables as $va){
  $this->ev($va->variable, $va->valor);
}
