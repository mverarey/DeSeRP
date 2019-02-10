<?php
if( strlen($this->os(4)) == 0 ){ throw new Exception("Proyecto no válido"); }
$db = new DepotServer\BaseDatos();
$proyecto = $db::table("dstick_proyecto")->where("id", $this->os(4))->get()->first();
$this->establecerTitulo($proyecto->nombre);

print_r($proyecto);