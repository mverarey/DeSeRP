<?
$this->establecerTitulo("Administrador de campos");

$c = new Conexion();
switch( $_REQUEST['acc'] ){
	case "crear":
		$res = $c->insertar("test_formbuilder",
					array(  NULL,  $_REQUEST['txtcampo'],  $_REQUEST['txtnumero'],  $_REQUEST['txttextolargo'],  )
				);
		if($res){
			echo $this->msgOK("Se registro el campo correctamente con el id ".$res.".");
		}else{
			echo $this->msgError("Ocurri&oacute; un error, intentelo nuevamente.");
		}
	break;
	
	case "actualizar":
		$res = $c->actualizar("test_formbuilder",
				array(
					 "campo" => $_REQUEST['campo'],  "numero" => $_REQUEST['numero'],  "textolargo" => $_REQUEST['textolargo'], 
				),
				$_REQUEST['idObjeto']
			);
		if($res > 0){
			echo $this->msgOK("Se ha actualizado exitosamente.");
		}else if($res == 0){
			echo $this->msgAlerta("No se realizar&oacute;n cambios.");
		}
	break;
	
	case "eliminar":
		$res = $c->borrar("test_formbuilder",
				array(
					"id", $_REQUEST['idObjeto']
				)
			);
		if($res > 0){
			echo $this->msgOK("Se ha eliminado exitosamente.");
		}else if($res == 0){
			echo $this->msgAlerta("No se realizar&oacute;n cambios.");
		}
	break;
}

$script = <<<EOM
	/* $("#mopciones").tabs({selected:1}); */

	$('#frmActualizar').on('show.bs.modal', function (event) {    $("#cargando").show();    $("#cargandodiv").show();    var ids = $.map($("#tbldatab72484a1261a244a50ab35a51e3194de7").bootstrapTable('getSelections'), function (row) {	return row.id });    var opc=ids[0];     if(opc>0){	$.ajax({ method: 'POST', dataType:'json', url: '/wsdl/{$this->os(2)}/obtenerobjetos/'+opc }).done(function( data ) { $("#cargando").hide(); $("#cargandodiv").hide();  $("#idObjeto").val(data.id); 
 $("#dtxtcampo").val(data.campo);  $("#dtxtnumero").val(data.numero);  $("#dtxttextolargo").val(data.textolargo);  });  }else{ 	alert("Debe seleccionar campo primero.");	$("#cargando").hide(); $("#cargandodiv").hide(); return false; } });
	
	$("#frmEliminar").on('show.bs.modal', function (event) {	var ids = $.map($("#tbldatab72484a1261a244a50ab35a51e3194de7").bootstrapTable('getSelections'), function (row) { return row.id }); 		var opc=ids[0]; 		if(opc>0){ 			$("#eidObjeto").val(opc);		}else{		alert("Debe seleccionar campo primero."); 			return false;		}	});

	$("#btnActualizar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {}; var nombres = ["campo","numero","textolargo"]; var campos = ["dtxtcampo","dtxtnumero","dtxttextolargo"];  jQuery.each( campos, function( i , campo){ valores[nombres[i]] = $("#"+campo).val(); }); valores["idObjeto"] = $("#idObjeto").val(); valores["acc"] = "actualizar"; $.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success");$("#tbldatab72484a1261a244a50ab35a51e3194de7").bootstrapTable('refresh'); $('#frmActualizar').modal('hide'); }else if(data.ack == 201){ $.notify(data.msg, "warn"); }else{ $.notify(data.msg, "error"); } }).fail(function() { alert( "error" ); $.notify(data.msg, "success"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide(); });
	});
	$("#frmActualizar input").keypress( function( event ) { if ( event.which === 13 ) { event.preventDefault(); $("#btnActualizar").click(); return false; } });

EOM;
$this->agregarScript($script);
?>