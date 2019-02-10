<?
$this->establecerTitulo("Administrador de contenidos");

$bd = new DepotServer\BaseDatos();
switch( $_REQUEST['acc'] ){
	case "crear":
		$res = $bd::table("dstick_ticket_contenido")->insertGetId([ 'idTicket' => $_REQUEST['txtidTicket'], 'idUsuario' => $_REQUEST['txtidUsuario'], 'contenido' => $_REQUEST['txtcontenido'], 'fechaPublicacion' => $_REQUEST['txtfechaPublicacion'], 'adjuntos' => $_REQUEST['txtadjuntos'],  ]);
		if($res){
			echo $this->msgOK("Se registro el contenido correctamente con el id ".$res.".");
		}else{
			echo $this->msgError("Ocurri&oacute; un error, intentelo nuevamente.");
		}
	break;
}

$script = <<<EOM
	$('#tbldatab3863efa5ed398ec30b809414819a3127').bootstrapTable( 'resetView' , {height: $( document ).height() - 120 } );

	$('#frmActualizar').on('show.bs.modal', function (event) {    $("#cargando").show();    $("#cargandodiv").show(); $('#frmActualizar form')[0].reset(); var ids = $.map($("#tbldatab3863efa5ed398ec30b809414819a3127").bootstrapTable('getSelections'), function (row) {	return row.id });    var opc=ids[0];     if(opc>0){	$.ajax({ method: 'POST', dataType:'json', url: '/json/{$this->os(2)}/obtenerobjetos/'+opc }).done(function( wsdl ) { var data = wsdl['rows'][0]; $("#cargando").hide(); $("#cargandodiv").hide(); 	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_0/'+ data.idTicket }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidTicket').append(option).trigger('change'); $('#dtxtidTicket').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_1/'+ data.idUsuario }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidUsuario').append(option).trigger('change'); $('#dtxtidUsuario').trigger({ type: 'select2:select', params: { data: data } }); }); $("#idObjeto").val(data.id); 
 $("#dtxtcontenido").val(data.contenido);  $("#dtxtfechaPublicacion").val(data.fechaPublicacion);  $("#dtxtadjuntos").val(data.adjuntos);  });  }else{ 	alert("Debe seleccionar contenido primero.");	$("#cargando").hide(); $("#cargandodiv").hide(); return false; } });
	$("#btnActualizar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {}; var nombres = ["idTicket","idUsuario","contenido","fechaPublicacion","adjuntos"]; var campos = ["dtxtidTicket","dtxtidUsuario","dtxtcontenido","dtxtfechaPublicacion","dtxtadjuntos"];  jQuery.each( campos, function( i , campo){ valores[nombres[i]] = $("#"+campo).val(); }); valores["idObjeto"] = $("#idObjeto").val(); valores["acc"] = "actualizar"; $.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success");$("#tbldatab3863efa5ed398ec30b809414819a3127").bootstrapTable('refresh'); $('#frmActualizar').modal('hide'); }else if(data.ack == 201){ $.notify(data.msg, "warn"); }else{ $.notify(data.msg, "error"); } }).fail(function() { alert( "error" ); $.notify(data.msg, "success"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide(); });
	});
	$("#frmActualizar input").keypress( function( event ) { if ( event.which === 13 ) { event.preventDefault(); $("#btnActualizar").click(); return false; } });

	$("#btnEliminar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {"idObjeto": $("#eidObjeto").val(), "acc": "eliminar" };
		$.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success"); $("#tbldatab3863efa5ed398ec30b809414819a3127").bootstrapTable('refresh'); $('#frmEliminar').addClass("animated hinge").modal('hide').removeClass("animated hinge"); }else{ $.notify(data.msg, "error"); } }).fail(function() { $.notify(data.msg, "error"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide();  });
	});
	$("#frmEliminar").on('show.bs.modal', function (event) {	var ids = $.map($("#tbldatab3863efa5ed398ec30b809414819a3127").bootstrapTable('getSelections'), function (row) { return row.id }); 		var opc=ids[0]; 		if(opc>0){ 			$("#eidObjeto").val(opc);		}else{		alert("Debe seleccionar contenido primero."); 			return false;		}	});

	$("#dtxtidTicket,#txtidTicket").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_0" }; return query; } }, language: "es" });	$("#dtxtidUsuario,#txtidUsuario").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_1" }; return query; } }, language: "es" });

EOM;
$this->agregarScript($script);
?>
