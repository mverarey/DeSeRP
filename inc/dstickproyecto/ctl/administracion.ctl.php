<?
$this->establecerTitulo("Administrador de proyectos");

$bd = new DepotServer\BaseDatos();
switch( $_REQUEST['acc'] ){
	case "crear":
		$res = $bd::table("dstick_proyecto")->insertGetId([ 'idLiderProyecto' => $_REQUEST['txtidLiderProyecto'], 'idCategoria' => $_REQUEST['txtidCategoria'], 'idCliente' => $_REQUEST['txtidCliente'], 'nombre' => $_REQUEST['txtnombre'], 'descripcion' => $_REQUEST['txtdescripcion'], 'fechaCreacion' => $_REQUEST['txtfechaCreacion'], 'fechaInicio' => $_REQUEST['txtfechaInicio'], 'fechaFin' => $_REQUEST['txtfechaFin'], 'estado' => $_REQUEST['txtestado'],  ]);
		if($res){
			echo $this->msgOK("Se registro el proyecto correctamente con el id ".$res.".");
		}else{
			echo $this->msgError("Ocurri&oacute; un error, intentelo nuevamente.");
		}
	break;
}

$script = <<<EOM
	$('#tbldatab0d48d5325dfbacbe15be19c115a681d8').bootstrapTable( 'resetView' , {height: $( document ).height() - 120 } );

	$('#frmActualizar').on('show.bs.modal', function (event) {    $("#cargando").show();    $("#cargandodiv").show(); $('#frmActualizar form')[0].reset(); var ids = $.map($("#tbldatab0d48d5325dfbacbe15be19c115a681d8").bootstrapTable('getSelections'), function (row) {	return row.id });    var opc=ids[0];     if(opc>0){	$.ajax({ method: 'POST', dataType:'json', url: '/json/{$this->os(2)}/obtenerobjetos/'+opc }).done(function( wsdl ) { var data = wsdl['rows'][0]; $("#cargando").hide(); $("#cargandodiv").hide(); 	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_0/'+ data.idCategoria }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidCategoria').append(option).trigger('change'); $('#dtxtidCategoria').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_1/'+ data.idCliente }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidCliente').append(option).trigger('change'); $('#dtxtidCliente').trigger({ type: 'select2:select', params: { data: data } }); });	$.ajax({ url: '/wsdl/{$this->os(2)}/controlador/fk/fk_2/'+ data.idLiderProyecto }).then(function (datos) {
	    	var option = new Option(datos.results[0].text, datos.results[0].id, true, true); $('#dtxtidLiderProyecto').append(option).trigger('change'); $('#dtxtidLiderProyecto').trigger({ type: 'select2:select', params: { data: data } }); }); $("#idObjeto").val(data.id); 
 $("#dtxtnombre").val(data.nombre);  $("#dtxtdescripcion").val(data.descripcion);  $("#dtxtfechaCreacion").val(data.fechaCreacion);  $("#dtxtfechaInicio").val(data.fechaInicio);  $("#dtxtfechaFin").val(data.fechaFin);  $("#dtxtestado").val(data.estado);  });  }else{ 	alert("Debe seleccionar proyecto primero.");	$("#cargando").hide(); $("#cargandodiv").hide(); return false; } });
	$("#btnActualizar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {}; var nombres = ["idLiderProyecto","idCategoria","idCliente","nombre","descripcion","fechaCreacion","fechaInicio","fechaFin","estado"]; var campos = ["dtxtidLiderProyecto","dtxtidCategoria","dtxtidCliente","dtxtnombre","dtxtdescripcion","dtxtfechaCreacion","dtxtfechaInicio","dtxtfechaFin","dtxtestado"];  jQuery.each( campos, function( i , campo){ valores[nombres[i]] = $("#"+campo).val(); }); valores["idObjeto"] = $("#idObjeto").val(); valores["acc"] = "actualizar"; $.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success");$("#tbldatab0d48d5325dfbacbe15be19c115a681d8").bootstrapTable('refresh'); $('#frmActualizar').modal('hide'); }else if(data.ack == 201){ $.notify(data.msg, "warn"); }else{ $.notify(data.msg, "error"); } }).fail(function() { alert( "error" ); $.notify(data.msg, "success"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide(); });
	});
	$("#frmActualizar input").keypress( function( event ) { if ( event.which === 13 ) { event.preventDefault(); $("#btnActualizar").click(); return false; } });

	$("#btnEliminar").click(function(){
		$("#cargando").show();    $("#cargandodiv").show(); var valores = {"idObjeto": $("#eidObjeto").val(), "acc": "eliminar" };
		$.ajax({ type: 'POST', dataType:'json', data:valores, url: '/wsdl/{$this->os(2)}/controlador' }).done(function( data ){ if(data.ack == 200){ $.notify(data.msg, "success"); $("#tbldatab0d48d5325dfbacbe15be19c115a681d8").bootstrapTable('refresh'); $('#frmEliminar').addClass("animated hinge").modal('hide').removeClass("animated hinge"); }else{ $.notify(data.msg, "error"); } }).fail(function() { $.notify(data.msg, "error"); }).always(function(){ $("#cargando").hide();    $("#cargandodiv").hide();  });
	});
	$("#frmEliminar").on('show.bs.modal', function (event) {	var ids = $.map($("#tbldatab0d48d5325dfbacbe15be19c115a681d8").bootstrapTable('getSelections'), function (row) { return row.id }); 		var opc=ids[0]; 		if(opc>0){ 			$("#eidObjeto").val(opc);		}else{		alert("Debe seleccionar proyecto primero."); 			return false;		}	});

	$("#dtxtidCategoria,#txtidCategoria").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_0" }; return query; } }, language: "es" });	$("#dtxtidCliente,#txtidCliente").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_1" }; return query; } }, language: "es" });	$("#dtxtidLiderProyecto,#txtidLiderProyecto").select2({ ajax: { url: '/wsdl/{$this->os(2)}/controlador', type: 'POST', dataType: 'json', delay:250, cache:true, minimumInputLength: 1, data: function (params) { var query = { "q": params.term, "acc":"fk_2" }; return query; } }, language: "es" });

EOM;
$this->agregarScript($script);
?>
