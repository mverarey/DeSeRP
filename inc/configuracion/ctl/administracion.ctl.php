<?php
$this->establecerTitulo("Configuración del sistema");

$db = new \DepotServer\BaseDatos();

switch ($_REQUEST['acc']) {
  case 'actualizar':

    $listaVars = explode("|",base64_decode($_REQUEST['listaVars']));

    foreach($listaVars as $variable){
      $db::table("preferencias")->where("variable", $variable)->update(['valor' => $_REQUEST[$variable]]);
    }

    echo $this->msgOk("Variables actualizadas.");

    break;

  default:
    break;
}

$variables = $db::table("preferencias")->where("variable", "LIKE", "sistema_%")->get()->all();
foreach($variables as $va){
  $this->ev($va->variable, $va->valor);
  $listaVars[] = $va->variable;
}
$this->ev("listaVars", base64_encode(implode("|", $listaVars)) );
