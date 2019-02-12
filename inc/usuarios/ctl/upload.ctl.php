<?php
$this->establecerTitulo("Upload");

$uploadCampo = \DepotServer\DSUploader::generar("logotipo", "/upload/usuarios/");
$this->ev("campoCarga", $uploadCampo["campo"]);
$this->agregarScript($uploadCampo["script"]);