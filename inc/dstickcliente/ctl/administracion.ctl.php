<?
$this->establecerTitulo("Administrador de clientes");

$bd = new DepotServer\BaseDatos();
switch( $_REQUEST['acc'] ){
	case "crear":
		$res = $bd::table("dstick_cliente")->insertGetId([ 'nombre' => $_REQUEST['txtnombre'], 'razonSocial' => $_REQUEST['txtrazonSocial'], 'logotipo' => $_REQUEST['txtlogotipo'],  ]);
		if($res){
			echo $this->msgOK("Se registro el cliente correctamente con el id ".$res.".");
		}else{
			echo $this->msgError("Ocurri&oacute; un error, intentelo nuevamente.");
		}
	break;
}

$uploadCampo = \DepotServer\DSUploader::generar("txtlogotipo", "/upload/dstickcliente/");
$this->ev("txtlogotipo", $uploadCampo["campo"]);
$this->agregarScript($uploadCampo["script"]);

$script = <<<EOM
	$('#tbldatabcf44986c63bd375c5b2e2d4baf6f551e').bootstrapTable( 'resetView' , {height: $( document ).height() - 120 } );

	$('#frmActualizar').on('show.bs.modal', function (event) {    $("#cargando").show();    $("#cargandodiv").show(); $('#frmActualizar form')[0].reset(); var ids = $.map($("#tbldatabcf44986c63bd375c5b2e2d4baf6f551e").bootstrapTable('getSelections'), function (row) {	return row.id });    var opc=ids[0];     if(opc>0){	$.ajax({ method: 'POST', dataType:'json', url: '/json/{$this->os(2)}/obtenerobjetos/'+opc }).done(function( wsdl ) { var data = wsdl['rows'][0]; $("#cargando").hide(); $("#cargandodiv").hide();  $("#idObjeto").val(data.id); 
 $("#dtxtnombre").val(data.nombre);  $("#dtxtrazonSocial").val(data.razonSocial);  $("#dtxtlogotipo").val(data.logotipo);  });  }else{ 	alert("Debe seleccionar cliente primero.");	$("#cargando").hide(); $("#cargandodiv").hide(); return false; } });
	$("#btnActualizar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {}; var nombres = ["nombre","razonSocial","logotipo"]; var campos = ["dtxtnombre","dtxtrazonSocial","dtxtlogotipo"];  jQuery.each( campos, function( i , campo){ valores[nombres[i]] = $("#"+campo).val(); }); valores["idObjeto"] = $("#idObjeto").val(); valores["acc"] = "actualizar"; $.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success");$("#tbldatabcf44986c63bd375c5b2e2d4baf6f551e").bootstrapTable('refresh'); $('#frmActualizar').modal('hide'); }else if(data.ack == 201){ $.notify(data.msg, "warn"); }else{ $.notify(data.msg, "error"); } }).fail(function() { alert( "error" ); $.notify(data.msg, "success"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide(); });
	});
	$("#frmActualizar input").keypress( function( event ) { if ( event.which === 13 ) { event.preventDefault(); $("#btnActualizar").click(); return false; } });

	$("#btnEliminar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {"idObjeto": $("#eidObjeto").val(), "acc": "eliminar" };
		$.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success"); $("#tbldatabcf44986c63bd375c5b2e2d4baf6f551e").bootstrapTable('refresh'); $('#frmEliminar').addClass("animated hinge").modal('hide').removeClass("animated hinge"); }else{ $.notify(data.msg, "error"); } }).fail(function() { $.notify(data.msg, "error"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide();  });
	});
	$("#frmEliminar").on('show.bs.modal', function (event) {	var ids = $.map($("#tbldatabcf44986c63bd375c5b2e2d4baf6f551e").bootstrapTable('getSelections'), function (row) { return row.id }); 		var opc=ids[0]; 		if(opc>0){ 			$("#eidObjeto").val(opc);		}else{		alert("Debe seleccionar cliente primero."); 			return false;		}	});



EOM;
$this->agregarScript($script);
?>
